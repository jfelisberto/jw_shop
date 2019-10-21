<?php
/*
* Cypher management class
* ---------------------
*/

class Cypher {

  private $salt1;
  private $salt2;
  private $salt3;

  private $db;

  public function __construct() {
    global $db, $settings;
    $this->db = &$db;

    $this->salt1 = $settings['security']['salt1'];
    $this->salt2 = $settings['security']['siteHash'];
    $this->salt3 = $settings['security']['salt2'];

    //check if we have a key for the day
    $todays = date('Y-m-d 00:00:00');
    $keyID = $this->db->getSingleValue("SELECT `id` FROM {$this->db->userKeyStorageTable} WHERE `datetime` = '{$todays}'");
    if ($keyID == '') {
      $uniqID = $this->generateUniqID();
      while($this->db->getSingleValue("SELECT `id` FROM {$this->db->userKeyStorageTable} WHERE id='{$uniqID}'") != '') {
        $uniqID = $this->generateUniqID();
      }
      $key = $this->generateUniqID(64);
      $sql = "INSERT INTO {$this->db->userKeyStorageTable} SET `id`='{$uniqID}', `datetime`='{$todays}', `key`='{$key}'";
      $this->db->ExecuteQuery($sql);
    }

    //cleanup the key and serial tables
    $this->db->ExecuteQuery("DELETE FROM {$this->db->userKeyStorageTable} WHERE `datetime` < DATE_SUB(now(), INTERVAL 1 YEAR)");
    $this->db->ExecuteQuery("DELETE FROM {$this->db->userSerialStorageTable} WHERE `datetime` < DATE_SUB(now(), INTERVAL 1 YEAR)");
  }

  public function normalizeNumber($inputNumber) {
    if (strlen($inputNumber) > 13) return false;
    $output = '';
    if (strlen($inputNumber) == 100) {
      $output = '00';
    } elseif (strlen($inputNumber) < 10) {
      $output = '0' . strlen($inputNumber);
    } else {
      $output = strlen($inputNumber);
    }
    $numbersToAdd = 15 - strlen($inputNumber);
    for ($x = 1; $x <= $numbersToAdd; $x++)
    $output .= rand(0,9);

    $output .= $inputNumber;

    return($output);
  }

  public function randPadNumber($inputNumber, $outputLength) {
    $output = '';
    if (strlen($inputNumber) == 100) {
      $output = '00';
    } elseif (strlen($inputNumber) < 10) {
      $output = '0' . strlen($inputNumber);
    } else {
      $output = strlen($inputNumber);
    }
    $numbersToAdd = $outputLength - strlen($inputNumber) - 2;
    for ($x = 1; $x <= $numbersToAdd; $x++)
    $output .= rand(0,9);

    $output .= $inputNumber;

    return($output);
  }

  public function extractNumber($normalizedInput) {
    $numberLength = intval(substr($normalizedInput, 0, 2));
    $output = substr($normalizedInput, -$numberLength);
    return $output;
  }

  public function createSignature($userID, $keyID=null, $serial=null) {
    if ($keyID == null) $keyID = $this->getLatestKey();
    if ($serial == null) $serial = $this->getLatestUserSerial($userID);

    $key = $this->db->getSingleValue("SELECT `key` FROM {$this->db->userKeyStorageTable} WHERE id='{$keyID}'");
    if ($key == '') return false;
    $signature = $this->salt1 . $userID . $this->salt2 . $key . $this->salt3 . $serial . '|##PRETTY Nice Signature!!';
    return hash('sha512', $signature);
  }

  public function checkSignature($signature, $userID, $keyID=null, $serial=null) {

    if ($keyID == null) $keyID = $this->getLatestKey();
    if ($serial == null) $serial = $this->getLatestUserSerial($userID);

    return ($this->createSignature($userID, $keyID, $serial) === $signature) ? true : false;
  }

  public function generateUniqID($idLength = 8, $urlSafe = false) {
    srand();
    if ($urlSafe) {
      $allowedChars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    } else {
      $allowedChars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()_+.';
    }
    $allowedChars = str_shuffle($allowedChars);
    $allowedChars = str_shuffle($allowedChars);
    $allowedChars = str_shuffle($allowedChars);

    $uniqID = '';
    for ($x = 1; $x <= $idLength; $x++)
    $uniqID .= $allowedChars[rand(0,  strlen($allowedChars)-1)];

    return $uniqID;
  }

  public function getLatestKeyID() {
    return $this->db->getSingleValue("SELECT `id` FROM {$this->db->userKeyStorageTable} ORDER BY `datetime` DESC LIMIT 0,1");
  }

  private function getLatestKey() {
    return $this->db->getSingleValue("SELECT `key` FROM {$this->db->userKeyStorageTable} ORDER BY `datetime` DESC LIMIT 0,1");
  }

  private function getLatestUserSerial($userID) {
    return $this->db->getSingleValue("SELECT `serial` FROM {$this->db->userSerialStorageTable} WHERE `user_id`={$userID} ORDER BY `datetime` DESC LIMIT 0,1");
  }

  public function encodeNumericString($inputString) {
    $string[1] = '!WDV(SCAXZ';
    $string[2] = 'qpalzmrigj';
    $string[3] = 'BFE@NJI)PL';
    $string[4] = 'nwhsctxkdv';
    $string[5] = 'RG-UTY$MKO';

    srand();
    $output = '';
    for($x = 0; $x < strlen($inputString); $x++) {
      $output .= $string[rand(1,5)][$inputString[$x]];
    }
    return $output;
  }

  public function decodeNumericString($inputString) {

    $output = '';
    for($x = 0; $x < strlen($inputString); $x++) {
      switch($inputString[$x]) {
        case '!':
        case 'B':
        case 'R':
        case 'q':
        case 'n': $output .= '0'; break;
        case 'W':
        case 'F':
        case 'G':
        case 'p':
        case 'w': $output .= '1'; break;
        case 'D':
        case 'E':
        case '-':
        case 'a':
        case 'h': $output .= '2'; break;
        case 'V':
        case '@':
        case 'U':
        case 'l':
        case 's': $output .= '3'; break;
        case '(':
        case 'N':
        case 'T':
        case 'z':
        case 'c': $output .= '4'; break;
        case 'S':
        case 'J':
        case 'Y':
        case 'm':
        case 't': $output .= '5'; break;
        case 'C':
        case 'I':
        case '$':
        case 'r':
        case 'x': $output .= '6'; break;
        case 'A':
        case ')':
        case 'M':
        case 'i':
        case 'k': $output .= '7'; break;
        case 'X':
        case 'P':
        case 'K':
        case 'g':
        case 'd': $output .= '8'; break;
        case 'Z':
        case 'L':
        case 'O':
        case 'j':
        case 'v': $output .= '9'; break;
      }
    }
    return $output;
  }
}
