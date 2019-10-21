<?php

function writeJsonInput($jsonData) {

  header("Content-type: application/json; charset=utf-8", true);

  $jsonInput = json_decode($jsonData);

  return $jsonInput;
}

function writeJsonOutput($jsonData, $exitAfterOutput = true) {

  header("Content-type: application/json; charset=utf-8", true);
  echo json_encode($jsonData);

  if ($exitAfterOutput) {
    exit;
  }

  return true;
}

function sqlTOdate($dateTime, $vTime='N') {
  $dateTime = explode(' ', $dateTime);

  $date = explode('-', $dateTime[0]);
  $time = $dateTime[1];

  $dateTime = "{$date[2]}/{$date[1]}/{$date[0]}";

  $dateTime = $vTime == 'Y' ? "{$dateTime} {$time}" : $dateTime;

  return $dateTime;
}

function dateTOsql($date, $time=0) {
  $date = explode("/", $date);

  $date = "{$date[2]}-{$date[1]}-{$date[0]}";

  $dateTime = $time < 0 ? "{$date} {$time}" : $date;

  return $dateTime;
}

function floatValue($val){
  $val = str_replace("R$ ","",$val);
  $val = str_replace(".","",$val);
  $val = str_replace(",",".",$val);
  $val = preg_replace('/\.(?=.*\.)/', '', $val);
  return $val;
}

function pricetValue($val){
  $val = str_replace(".",",",$val);
  $val = preg_replace('/\.(?=.*\.)/', '', $val);
  return "R$ {$val}";
}

function strpos_array($haystack, $needles) {
  if (is_array($needles)) {
    foreach ($needles as $str) {
      if (is_array($str)) {
        $pos = strpos_array($haystack, $str);
      } else {
        $pos = strpos($haystack, $str);
      }
      if ($pos !== FALSE) {
        return $pos;
      }
    }
  } else {
    return strpos($haystack, $needles);
  }
}

function cleanSlashes($inputArray) {
  if (is_array($inputArray)) {
    $return = array();
    foreach($inputArray as $key=>$val) {
      if (is_array($val)) {
        $return[$key] = cleanSlashes($val);
      } else {
        $return[$key] = stripslashes($val);
        if ($return[$key] == '0000-00-00') {
          $return[$key] = '';
        }
      }
    }
  } else {
    $return = stripslashes($inputArray);
  }
  return $return;
}

function get_ip_address($onlyInternetIPs = true) {
  foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
    if (array_key_exists($key, $_SERVER) === true) {
      foreach (explode(',', $_SERVER[$key]) as $ip) {
        $ip = trim($ip); // just to be safe
        if ($onlyInternetIPs) {
          if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
            return $ip;
          }
        } else {
          if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_RES_RANGE) !== false) {
            return $ip;
          }
        }
      }
    }
  }
}

function human_filesize($bytes, $decimals = 2) {
  $sz = 'BKMGTP';
  $factor = floor((strlen($bytes) - 1) / 3);
  return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
}

function make_normal_name($text) {
  $text = utf8_decode(trim($text));
  $text = strtr($text, utf8_decode("ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖÙÚÛÜÝßàáâãäåæçèéêëìíîïðñòóôõöùúûüýÿ"), "AAAAAAACEEEEIIIIDNOOOOOUUUUYBaaaaaaaceeeeiiiionooooouuuuyy");
  $text = strtr($text, "\xE1\xE8\xEF\xEC\xE9\xED\xF2", "\x61\x63\x64\x65\x65\x69\x6E");
  $text = strtr($text, "\xF3\xF8\x9A\x9D\xF9\xFA\xFD\x9E\xF4\xBC\xBE", "\x6F\x72\x73\x74\x75\x75\x79\x7A\x6F\x4C\x6C");
  $text = strtr($text, "\xC1\xC8\xCF\xCC\xC9\xCD\xC2\xD3\xD8", "\x41\x43\x44\x45\x45\x49\x4E\x4F\x52");
  $text = strtr($text, "\x8A\x8D\xDA\xDD\x8E\xD2\xD9\xEF\xCF", "\x53\x54\x55\x59\x5A\x4E\x55\x64\x44");

  $valid = '1234567890qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM-.';
  $bs = array("_", "|", "&", "&amp;", ":", "\"", "\'", "\\", "/", " ", "----", "---", "--", "--", ".");
  $rp = array("-", "", "", "", "", "", "", "", "", "-", "-", "-", "-", "-", "");
  $text = str_replace($bs, $rp, stripslashes(strip_tags($text)));
  $final = '';
  for ($x = 0; $x < strlen($text); $x++) {
    $chr = substr($text, $x, 1);
    if (strpos($valid, $chr) !== false) {
      $final .= $chr;
    }
  }
  return strtolower($final);
}

function validateEmail($email, $more=0) {

  $email = strtolower(trim($email));
  $banDomain = '|aol.com.br|hotmail.com.br|msn.com.br|.com|.com.br|';
  $banlist = array( '!','#','$','%','&','*','(',')','+','=','Ç','ç','[',']','{','}','<','>','?',',',';','/','\\','°','º','ª','§','¬','¢','£','³','²','¹','"','\'','`','^','~','á','Á','à','À','ä','Ä','è','È','é','É','ê','Ê','ë','Ë','í','Í','ì','Ì','î','Î','ï','Ï','ó','Ó','ò','Ò','ô','Ô','õ','Õ','ö','Ö','ú','Ú','ù','Ù','û','Û','ü','Ü');

  if (str_replace(" ", "", stripslashes($email)) == "") {
    $ret['message'] = _('Você deve digitar o e-mail.');
    $ret['status'] = 'error';
  }

  if ($ret['status'] <> 'error') {
    $p = strpos($email, " ");
    if (($p >= 0) and ($p !== false)) {
      $ret['message'] = sprintf(_('O e-mail %s não pode ter espaços em branco.'), $email);
      $ret['status'] = 'error';
    }

    if ($ret['status'] <> 'error') {
      $p = strpos($email, "@");
      if ($p === false) {
        $ret['message'] = sprintf(_('O e-mail %s está em um formato inválido.'), $email);
        $ret['status'] = 'error';
      }

      if ($ret['status'] <> 'error') {
        $prov = substr($email, $p + 1);
        $pb = strpos($banDomain, '|' . $prov . '|');
        if (($pb >= 0) and ($pb !== false)) {
          $ret['message'] = sprintf(_('O domínio %s do e-mail %s é inválido.'), $prov, $email);
          $ret['status'] = 'error';
        }

        if ($ret['status'] <> 'error') {
          $pb = strpos_array($email, $banlist);
          if ($pb > 0) {
            $ret['message'] = sprintf(_('O e-mail %s contém caracteres especiais.<br/>Utilize somentes letras de A-Z e números de 0-9'), $email);
            $ret['status'] = 'error';
            $ret['pb'] = $pb;
          }
        }
      }
    }
  }

  $ret['email'] = $email;

  if (empty($ret['status'])) {
    $ret['message'] = _('E-mail válido.');
    $ret['status'] = 'success';
  }

  return $ret;
}

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
#use PHPMailer\PHPMailer\PHPMailer;
#use PHPMailer\PHPMailer\Exception;

/* ENVIO DE E-MAIL*/
function sendMail($from_address, $from_name, $rcpt_address, $subject, $html_body, $text_body = '', $bcc = array(), $cc = array(), $attFiles = array()) {

  global $settings;
  $emailSettings = $settings['email'];

  $mail = new PHPMailer();

  try {
    if ($emailSettings['useSMTP'] == true) {
      $mail->isSMTP();
      $mail->Host = $emailSettings['smtpSettings']['host'];
      $mail->Port = $emailSettings['smtpSettings']['port'];
      if ($emailSettings['smtpSettings']['requireAuth'] == true) {
        $mail->SMTPAuth = true; // Usa autenticação SMTP? (opcional)
        $mail->Username = $emailSettings['smtpSettings']['username']; // Usuário do servidor SMTP
        $mail->Password = $emailSettings['smtpSettings']['password'];
      }
      if ($emailSettings['smtpSettings']['requireSSL'] !== false) {
        $mail->SMTPSecure = $emailSettings['smtpSettings']['requireSSL'];
      } else {
        $mail->SMTPAutoTLS = false;
      }
    } else {
      $mail->isMail();
    }
    $mail->CharSet = 'UTF-8';

    if ($from_name == '') $from_name = $emailSettings['from']['name'];
    #$mail->SetFrom(mailFromAddress, $from_name . $from_extra);
    $mail->From = $emailSettings['from']['address'];
    $mail->FromName = $emailSettings['from']['name'];
    $mail->AddReplyTo($from_address, $from_name);
    $mail->AddAddress($rcpt_address);

    if (count($bcc) > 0) {
      for ($x = 0; $x < count($bcc); $x++)
      $mail->AddBCC($bcc[$x]);
    }

    if (count($cc) > 0) {
      for ($x = 0; $x < count($cc); $x++)
      $mail->AddCC($cc[$x]);
    }

    if (count($attFiles) > 0) {
      for ($x = 0; $x < count($attFiles); $x++)
      $mail->addAttachment($attFiles);
    }

    if ((strlen($html_body) > 0) and ( strlen($text_body) > 0)) {
      $mail->IsHTML(true);
      $mail->Body = $html_body;
      $mail->AltBody = $text_body;
    } elseif ((strlen($html_body) > 0) and ( strlen($text_body) == 0)) {
      $mail->IsHTML(true);
      $mail->Body = $html_body;
    } elseif ((strlen($html_body) == 0) and ( strlen($text_body) > 0)) {
      $mail->IsHTML(false);
      $mail->Body = $text_body;
    }

    $mail->Subject = $subject;

    $send = $mail->Send();

    if ($send) {
      //logEmailMessage($from_address, $from_name, $rcpt_address, $subject, $html_body, $text_body, $bcc, $cc, 'direct');
      $result['status'] = true;
    } else {
      $result['dbg'] = array(1,$send,$mail,$emailSettings);
      $result['status'] = false;
    }
  } catch (phpmailerException $e) {
    $result['dbg'] = array(2,$e);
    $result['status'] = false;
  } catch (Exception $e) {
    $result['dbg'] = array(3,$e);
    $result['status'] = false;
  }

  return $result;
}

function sendgridMail($from_address, $from_name, $rcpt_address, $subject, $html_body, $text_body = '', $bcc = array(), $cc = array(), $attFiles = array()) {
  try {
    $sendgrid = new SendGrid(SENDGRID_KEY);
    $mail = new SendGrid\Email();

    $from_extra = '';
    if ($from_name != APPNAME)
    $from_extra = ' via ' . APPNAME;

    if (substr($from_name, -2, 2) == '#.') {
      $from_extra = '';
      $from_name = substr($from_name, 0, -2);
    }

    $mail->setFrom(MAIL_NOREPLAY);
    $mail->setFromName($from_name . $from_extra);
    $mail->setReplyTo($from_address);
    $mail->addTo($rcpt_address);

    if (count($bcc) > 0) {
      for ($x = 0; $x < count($bcc); $x++)
      $mail->addSmtpapiTos($bcc[$x]);
    }

    if (count($cc) > 0) {
      for ($x = 0; $x < count($cc); $x++)
      $mail->addCc($cc[$x]);
    }

    if (count($attFiles) > 0) {
      for ($x = 0; $x < count($attFiles); $x++)
      $mail->addAttachment($attFiles);
    }

    if ((strlen($html_body) > 0) and ( strlen($text_body) > 0)) {
      $mail->setHtml($html_body);
      $mail->setText($text_body);
    } elseif ((strlen($html_body) > 0) and ( strlen($text_body) == 0)) {
      $mail->setHtml($html_body);
    } elseif ((strlen($html_body) == 0) and ( strlen($text_body) > 0)) {
      $mail->setText($text_body);
    }
    $mail->setSubject($subject);
    if ($sendgrid->send($mail)) {
        logEmailMessage($from_address, $from_name, $rcpt_address, $subject, $html_body, $text_body, $bcc, $cc, 'sendgrid');
        return true;
    } else {
        return sendMail($from_address, $from_name, $rcpt_address, $subject, $html_body, $text_body, $bcc, $cc, $attFiles);
    }
  } catch (Exception $e) {
    return sendMail($from_address, $from_name, $rcpt_address, $subject, $html_body, $text_body, $bcc, $cc, $attFiles);
  }
}

function optimizedImage($img, $size) {

  $imgFile = str_replace(uploadStorageRelPath, '', $img);
  $imgPath = explode('/', $imgFile);

  $optImg = str_replace(uploadStorageRelPath . $imgPath[0] . '/', uploadStorageRelPath . $imgPath[0] . '/opt_w' . $size . 'h0/', $img);
  $optImgFile = str_replace(uploadStorageRelPath, uploadStorageDiskPath, $optImg);
  $genImg = str_replace(uploadStorageRelPath . $imgPath[0] . '/',  'optimize/w' . $size . 'h0/' . uploadStorageFolderName . '/' . $imgPath[0] . '/', $img);

  if (file_exists("{$optImgFile}")) {
    return $optImg;
  } else {
    return $genImg;
  }

}
