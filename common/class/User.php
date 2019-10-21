<?php

/*
* User management class
* ---------------------
*
*/

class User {

  public $userData = array();
  public $userID = 0;

  private $_isLoggedIn = false;
  private $_isAuthenticated = false;
  private $secureOnlyCookies = false;
  private $cookiesExpire = 365;
  private $db;

  public function __construct($autoLogin = false) {
    global $db, $configUseSecureCookies;
    $this->db = &$db;
    $this->secureOnlyCookies = $configUseSecureCookies;
    $this->cookiesExpire = time() + ($this->cookiesExpire * 24 * 3600);

    if ($autoLogin) {
      $userID = $this->readUserSession();
      if ($userID !== false) {
        $this->getUserByID($userID);
        if ($_SESSION['newCookieIssued'] != true) {
          $_SESSION['newCookieIssued'] = true;
          $this->createLoginSession();
        }
        $this->login();
      }
    }
  }

  /*
  * Funcoes de login's logout
  */
  private function createLoginCookie() {
    global $basePath;

    $cypher = new Cypher();
    $userID = $cypher->normalizeNumber($this->userID);
    $serial = $this->issueNewSerial();
    $keyID = $cypher->getLatestKeyID();
    $signature = $cypher->createSignature($this->userID, $keyID, $serial);

    setcookie('CMS_userid', $cypher->encodeNumericString($userID), $this->cookiesExpire, $basePath, COOKIE_DOMAIN, $this->secureOnlyCookies);
    setcookie('CMS_kid', $keyID, $this->cookiesExpire, $basePath, COOKIE_DOMAIN, $this->secureOnlyCookies);
    setcookie('CMS_sid', $serial, $this->cookiesExpire, $basePath, COOKIE_DOMAIN, $this->secureOnlyCookies);
    setcookie('CMS_sig', $signature, $this->cookiesExpire, $basePath, COOKIE_DOMAIN, $this->secureOnlyCookies);
    return array($userID,$serial,$keyID,$signature);
  }

  private function createLoginSession() {
    $cypher = new Cypher();
    $userID = $cypher->normalizeNumber($this->userID);
    $serial = $this->issueNewSerial();
    $keyID = $cypher->getLatestKeyID();
    $signature = $cypher->createSignature($this->userID, $keyID, $serial);

    $_SESSION['CMS_userid'] = $cypher->encodeNumericString($userID);
    $_SESSION['CMS_kid'] = $keyID;
    $_SESSION['CMS_sid'] = $serial;
    $_SESSION['CMS_sig'] = $signature;
  }

  private function issueNewSerial() {
    global $browserID, $deviceDetected;
    $userIP = get_ip_address();
    $cypher = new Cypher();
    $newUserSerial = $cypher->generateUniqID();
    $serial = $this->db->getSingleRecord("SELECT id, serial FROM {$this->db->userSerialStorageTable} WHERE `user_id`={$this->userID}");
    if ($serial['id'] > 0) {
      $this->db->ExecuteQuery("UPDATE {$this->db->userSerialStorageTable} SET `date_time`=now(), `last_ip`='{$userIP}'  WHERE id={$serial['id']}");
      $newUserSerial = $serial['serial'];
    } else {
      $this->db->ExecuteQuery("INSERT INTO {$this->db->userSerialStorageTable} SET `user_id`={$this->userID}, `date_time`=now(), `serial`='{$newUserSerial}', `last_ip`='{$userIP}'");
    }
    return $newUserSerial;
  }

  public function readUserSession() {
    global $browserID;
    $cypher = new Cypher();
    $userID = $cypher->extractNumber($cypher->decodeNumericString($_SESSION['CMS_userid']));
    $checkSignature = $cypher->checkSignature($_SESSION['CMS_sig'], $userID, $_SESSION['CMS_kid'], $_SESSION['CMS_sid']);
    if ($cypher->checkSignature($_SESSION['CMS_sig'], $userID, $_SESSION['CMS_kid'], $_SESSION['CMS_sid'])) {
      $sql = "SELECT `serial` FROM {$this->db->userSerialStorageTable} WHERE `user_id`={$userID} ORDER BY `date_time` DESC LIMIT 0,1";
      $currentSerial = $this->db->getSingleValue($sql);

      if ($currentSerial == $_SESSION['CMS_sid']) {
        return $userID;
      } else {
        return false;
      }
    } else {
      return false;
    }
  }

  public function readUserCookie() {
    global $browserID;
    $cypher = new Cypher();
    $userID = $cypher->extractNumber($cypher->decodeNumericString($_COOKIE['CMS_userid']));
    if ($cypher->checkSignature($_COOKIE['CMS_sig'], $userID, $_COOKIE['CMS_kid'], $_COOKIE['CMS_sid'])) {
      $currentSerial = $this->db->getSingleValue("SELECT `serial` FROM {$this->db->userSerialStorageTable} WHERE `user_id`={$userID} ORDER BY `date_time` DESC LIMIT 0,1");
      if ($currentSerial == $_COOKIE['CMS_sid']) {
        return $userID;
      } else {
        return false;
      }
    } else {
      return false;
    }
  }

  public function login($createCookie = false) {
    if ($this->userID > 0) {
      $this->_isLoggedIn = true;
      if ($createCookie) {
        $this->createLoginCookie();
      } else {
        $this->createLoginSession();
      }

      $_SESSION["CMS_usermail"] = $this->userData['email'];
      $this->setExtraData();
      $this->db->ExecuteQuery("UPDATE {$this->db->usersTable} SET `last_login`=now() WHERE id={$this->userID}");
      return true;
    } else {
      return false;
    }
  }

  public function isLoggedIn() {
    return $this->_isLoggedIn;
  }

  public function isAuthenticated() {
    return $this->_isAuthenticated;
  }

  public function logout() {
    global $browserID;

    session_destroy();
    $sqlDel = "DELETE FROM {$this->db->userSerialStorageTable} WHERE `user_id`={$this->userID}";
    $regDel = $this->db->ExecuteQuery($sqlDel);

    setcookie('CMS_userid', '', -1, $basePath, COOKIE_DOMAIN, $this->secureOnlyCookies);
    setcookie('CMS_kid', '', -1, $basePath, COOKIE_DOMAIN, $this->secureOnlyCookies);
    setcookie('CMS_sid', '', -1, $basePath, COOKIE_DOMAIN, $this->secureOnlyCookies);
    setcookie('CMS_sig', '', -1, $this->cookiesExpire, $basePath, COOKIE_DOMAIN, $this->secureOnlyCookies);
    $this->reset(true);
  }

  public function reset($resetLoginStatus = false) {
    $this->userData = array();
    $this->userID = 0;
    if ($resetLoginStatus) {
      $this->_isLoggedIn = false;
      $this->_isAuthenticated = false;
    }
  }

  public function loginByEmail($emailAddress, $password, $userIDToCheck = 0) {
    $this->getUserByEmail($emailAddress);

    if ($userIDToCheck > 0 && $this->userData['id'] != intval($userIDToCheck)) {
      $check = $userIDToCheck.' > 0 && '.$this->userData['id'].' != '.intval($userIDToCheck);
      return false;
    }
    $pass = new PasswordHash(11, FALSE);
    $password = $pass->CheckPassword($password, $this->userData['password']);
    if ($password) {
      $coockie = $this->createLoginCookie();
      $this->login();
      return $coockie;
      return true;
    } else {
      return false;
    }
  }

  /*
  * Funcoes de manipulacao dos dados do usuario
  */
  public function getUserByEmail($emailAddress) {
    if ($this->userID > 0 && $this->userID == $this->userData['id']) {
      return $this->userData;
    } else {
      $sql = "SELECT u.*, c.* FROM {$this->db->usersTable} u LEFT JOIN {$this->db->userContentTable} c ON c.user_id=u.id WHERE u.email='{$emailAddress}'";
      $userData = cleanSlashes($this->db->getSingleRecord($sql));
      if ($userData['id'] <= 0) {
        $sql1 = "SELECT user_id FROM {$this->db->userEmailTable} WHERE email='{$emailAddress}'";
        $userID = $this->db->getSingleValue($sql1);
        if ($userID > 0) {
          $sql2 = "SELECT u.*, c.* FROM {$this->db->usersTable} u LEFT JOIN {$this->db->userContentTable} c ON c.user_id=u.id WHERE u.id={$userID}";
          $userData = cleanSlashes($this->db->getSingleRecord($sql2));
        } else {
          return false;
        }
      } elseif ($userData['id'] >= 1) {
        $this->userData = $userData;
        $this->userID = $userData['id'];
        $this->setExtraData();
        return $this->userData;
      } else {
        return false;
      }
    }
  }

  public function getUserByID($userID) {
    $userID = intval($userID);
    if ($this->userID > 0 && $this->userID == $this->userData['id']) {
      return $this->userData;
    } else {
      $sql = "SELECT u.*, c.* FROM {$this->db->usersTable} u LEFT JOIN {$this->db->userContentTable} c ON c.user_id=u.id WHERE u.id='{$userID}'";
      $userData = cleanSlashes($this->db->getSingleRecord($sql));
      if ($userData["id"] > 0) {
        $this->userData = $userData;
        $this->userID = $userData['id'];
        $this->setExtraData();
        return $this->userData;
      } else {
        return false;
      }
      return $result;
    }
  }

  private function setExtraData() {
    global $basePath, $documentRoot;
    $this->userData['_isLoggedIn'] = $this->_isLoggedIn;
    $this->userData['userID'] = $this->userID;
    $this->userData['_isAuthenticated'] = $this->_isAuthenticated;
    $this->userData['_profilePanel'] = $basePath . 'profile/' . $this->userID;
    $this->userData['_baseProfile'] = $basePath . 'profile/' . $this->userID;
    $this->userData['fullName'] = trim($this->userData['firstname'] . ' ' . $this->userData['lastname']);
    $this->userData['displayName'] = $this->userData['fullName'];

    $sqlSa = "SELECT `user_id` FROM `{$this->db->sasTable}` WHERE `key`='" . hash('sha512', 'uKey' . $this->userID . 'r' . substr($this->userData['regid'], substr($this->userID, -1) + substr($this->userID, -3, 1), 10)) . "'";
    $saID = $this->db->getSingleValue($sqlSa);

    if ($saID > 0) {
      $this->userData['saID'] = $saID;
      $this->userData['is_sa'] = true;
    } else {
      $this->userData['saID'] = 0;
      $this->userData['is_sa'] = false;
    }

    //Birthday
    $birthdate = explode('-', $this->userData['birthdate']);
    $this->userData['birthdayDay'] = $birthdate[2];
    $this->userData['birthdayMonth'] = $birthdate[1];
    $this->userData['birthdayYear'] = $birthdate[0];
    $this->userData['birthDate'] = "{$birthdate[2]}/{$birthdate[1]}/{$birthdate[0]}";

    //user preferences
    $preferences = cleanSlashes($this->db->getSingleRecord("SELECT * FROM {$this->db->userPreferencesTable} WHERE user_id={$this->userID}"));
    $this->userData['preferences'] = $preferences;
    //notificaion_level
    $this->userData['notificaion_level'] = $this->getMailLevel($this->userData['email']);
  }

  public function getMailLevel($emailAddress) {
    $email_key = md5($emailAddress);
    $userLevel = $this->db->getSingleValue("SELECT block_level FROM {$this->db->userEmailLevel} WHERE email_key='{$email_key}'");
    if ($userLevel == 0) $userLevel = 100;

    return $userLevel;
  }

  public function deleteRecoveryUser($userID = 0) {
    if ($userID >= 1) {
      $sqlD = "DELETE FROM {$this->db->userPasswordRecoveryTable} WHERE user_id='{$userID}'";
    } else {
      $sqlD = "DELETE FROM {$this->db->userPasswordRecoveryTable} WHERE date_time < DATE_SUB(NOW(), INTERVAL 1 DAY)";
    }

    if ($this->db->ExecuteQuery($sqlD)) {
      $status = 'success';
    } else {
      $status = 'error';
    }
    #$result['dbg'] = $sqlD;

    $result['status'] = $status;
    return $result;
  }

  public function manageRecoveryPassword($userID) {
    $sqlR = "SELECT * FROM {$this->db->userPasswordRecoveryTable} WHERE user_id='{$userID}'";
    $res = $this->db->getSingleRecord($sqlR);

    if ($res['user_id'] == $userID) {
      $status = 'success';
      $result = $res;
    } else {
      $status = 'error';
    }
    #$result['sql'] = $sqlR;

    $result['status'] = $status;
    return $result;
  }

  //Follow stuff
  public function addFollow($kind, $ids) {
    if ($this->userID <= 0) return false;

    if (is_array($ids)) {
      foreach($ids as $id) {
        if (intval($id, 10) > 0) {
          $this->db->ExecuteQuery("INSERT INTO {$this->db->userFollowTable} SET user_id='{$this->userID}', follow_kind='{$kind}', follow_id='{$id}'");
        }
      }
    } else {
      if (intval($ids, 10) > 0) {
        $sql = "INSERT INTO {$this->db->userFollowTable} SET user_id='{$this->userID}', follow_kind='{$kind}', follow_id='{$ids}'";
        return $this->db->ExecuteQuery($sql);
      }
    }
  }

  public function removeFollow($kind, $id) {
    if ($this->userID <= 0) return false;

    return $this->db->ExecuteQuery("DELETE FROM {$this->db->userFollowTable} WHERE user_id='{$this->userID}' AND follow_kind='{$kind}' AND follow_id='{$id}'");
  }

  public function getFollows($offset=0, $limit=0, $kind=0) {
    if ($this->userID <= 0) return array();

    $content = new Content();

    if ($kind <> '' || $kind <> 0) {
      $whereCondition = " AND follow_kind='{$kind}'";
    }

    if ($limit >= 1) {
      $limit = " LIMIT {$offset},{$limit}";
    }

    $list = array();

    $sql1 = "SELECT * FROM {$this->db->userFollowTable} WHERE user_id='{$this->userID}'{$whereCondition}{$limit}";
    $tab1 = $this->db->ExecuteQuery($sql1);
    while($res1 = $this->db->getResult($tab1, DBAL_ASSOC)) {
      $contentData = $content->getContent(array('id'=>$res1['follow_id']));
      $list[] = array(
        'follow_id' => $res1['follow_id'],
        'follow_kind' => $res1['follow_kind'],
        'name' => $contentData['name'],
        'image' => $contentData['thumbnail'],
        'link' => $contentData['element_url']
      );
    }

    $result['list'] = $list;
    #$result['dbg'] = array($offset,$limit,$kind,$sql1);
    return $result;
  }

  public function getTotalFollows($kind=0) {
    if ($this->userID <= 0) return false;

    if ($kind <> '' || $kind <> 0) {
      $whereCondition = " AND follow_kind='{$kind}'";
    }
    $sql = "SELECT count(follow_id) FROM {$this->db->userFollowTable} WHERE user_id='{$this->userID}'{$whereCondition}";

    return $this->db->getSingleValue($sql);
  }

}

function getContentUserFollow($id) {
  global $db, $currentUser;

  if ($currentUser->userID <= 0) return false;

  $sql = "SELECT * FROM {$db->userFollowTable} WHERE user_id='{$currentUser->userID}' AND follow_id='{$id}'";
  #return $sql;
  $res = $db->getSingleRecord($sql);
  if ($res['follow_id'] == $id) {
    return true;
  } else {
    return false;
  }
}

function getContentTotalFollows($id) {
  global $db, $currentUser;

  $sql = "SELECT count(user_id) FROM {$db->userFollowTable} WHERE follow_id='{$id}'";

  return $db->getSingleValue($sql);
}

function addUserRequest($produtoID, $quantidade, $price, $imageFile, $name, $url) {
  global $db, $currentUser;

  $amount = floatValue($price * intval($quantidade));

  $fiedsData = "
    `user_id`='{$currentUser['id']}',
    `cliente`='{$currentUser['fullName']}',
    `address_name`='{$currentUser['address_name']}',
    `address_number`='{$currentUser['address_number']}',
    `address_complement`='{$currentUser['address_complement']}',
    `address_details`='{$currentUser['address_details']}',
    `address_postcode`='{$currentUser['address_postcode']}',
    `address_district`='{$currentUser['address_district']}',
    `address_city_name`='{$currentUser['address_city_name']}',
    `address_state_name`='{$currentUser['address_state_name']}',
    `address_country_name`='{$currentUser['address_country_name']}',
    `address_latitude`='{$currentUser['address_latitude']}',
    `address_longitude`='{$currentUser['address_longitude']}',
    `address_phone`='{$currentUser['address_phone']}',
    `address_phone2`='{$currentUser['address_phone2']}',
    `address_phone3`='{$currentUser['address_phone3']}',";

  $sql0 = "SELECT id, payment_freight, payment_amount FROM {$db->requestTable} WHERE user_id={$currentUser['id']}";
  $request = $db->getSingleRecord($sql0);

  if ($request['id'] >= 1) {
    $fiedsData .= "
      `updated_date`=NOW(),
      `updated_by`='{$currentUser['id']}'
    ";
    $sqlReqDT = "UPDATE {$db->requestTable} SET $fiedsData WHERE id={$request['id']}";
    $requesType = 'update';
  } else {
    $fiedsData .= "
      `payment_status`='pending',
      `created_date`=NOW(),
      `created_by`='{$currentUser['id']}'
    ";
    $sqlReqDT = "INSERT INTO {$db->requestTable} SET $fiedsData";
    $requesType = 'insert';
  }

  if ($db->ExecuteQuery($sqlReqDT)) {
    $status = 'success';
    if ($requesType == 'insert') {
      $requestID = $db->getInsertID();
    } else {
      $requestID = $request['id'];
    }

## 'pending', 'approved', 'unauthorized', 'canceled'
    $sql1 = "SELECT * FROM {$db->requestContentTable} WHERE request_id={$requestID} AND content_id={$produtoID}";
    $requestContent = $db->getSingleRecord($sql1);

    $fiedsContent = "
    `name`='{$name}',
    `image`='{$imageFile}',
    `page_url`='{$url}',
    `price`='{$price}',
    `quantidade`='{$quantidade}',
    `amount`='{$amount}',
    `freight`='7.55',";

    $fiedsData2 = "";

    if ($requestContent['request_id'] >= 1) {
      $fiedsContent .= "
        `updated_date`=NOW(),
        `updated_by`='{$currentUser['id']}'
      ";
      $sqlReqCT = "UPDATE {$db->requestContentTable} SET $fiedsContent WHERE request_id={$requestID} AND content_id={$produtoID}";
      $requesContentType = 'update';
    } else {
      $fiedsContent .= "
        `request_id`='{$requestID}',
        `content_id`='{$produtoID}',
        `created_date`=NOW(),
        `created_by`='{$currentUser['id']}'
      ";
      $sqlReqCT = "INSERT INTO {$db->requestContentTable} SET $fiedsContent";
      $requesContentType = 'insert';
    }

    if ($db->ExecuteQuery($sqlReqCT)) {
      $status = 'success';

      $sql2 = "SELECT amount, freight FROM {$db->requestContentTable} WHERE request_id={$requestID}";
      $tab2 = $db->ExecuteQuery($sql2);
      while ($res2 = $db->getResult($tab2, DBAL_ASSOC)) {
        if ($payment_value == 0) {
          $payment_value = $res2['amount'];
        } else {
          $payment_value = ($payment_value + $res2['amount']);
        }

        if ($payment_freight == 0) {
          $payment_freight = $res2['freight'];
        } else {
          $payment_freight = ($payment_freight + $res2['freight']);
        }
      }

      $payment_amount = ($payment_value + $payment_freight);
      $sqlReqDT = "UPDATE {$db->requestTable} SET payment_value='{$payment_value}', payment_freight='{$payment_freight}', payment_amount='{$payment_amount}' WHERE id={$requestID}";
      $db->ExecuteQuery($sqlReqDT);

    } else {
      $status = 'error';
    }
    
  } else {
    $status = 'error';
    $message = _("Hoouve um erro ao registrar seu pedido");
  }

  $result['dbg'] = array($sql0,$fiedsData,$sqlReqDT,$sql1,$fiedsContent,$sqlReqCT,$sql2,$sqlReqDT);
  $result['status'] = $status;
  $result['message'] = $message;
  return $result;
}

function getListRequest() {
  global $db, $currentUser;

  $sql0 = "SELECT * FROM {$db->requestTable} WHERE user_id={$currentUser['id']}";
  $tab0 = $db->ExecuteQuery($sql0);

  while ($res0 = $db->getResult($tab0, DBAL_ASSOC)) {
    $sql1 = "SELECT * FROM {$db->requestContentTable} WHERE request_id={$res0['id']}";
    $tab1 = $db->ExecuteQuery($sql1);
    while ($res1 = $db->getResult($tab1, DBAL_ASSOC)) {
      $listProd[] = $res1;
    }
    $res0['products'] = $listProd;

    $list[] = $res0;
  }

  return $list;
}
