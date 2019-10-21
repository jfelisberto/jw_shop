<?php
$json = array();
$takeUser = new User();

if ($_POST["method"] == 'login') {
  $email = strtolower(addslashes($_POST["user"]));
  $ret = validateEmail($email);

  if ($ret['status'] == 'error') {
    $json['return'] = $ret;
    $json['status'] = 'error';
    $json['message'] = $ret['message'];
    $json['error_field'] = '#reg_email';
    writeJsonOutput($json);
  }

  $takeUser->getUserByEmail($email);

  if ($daysUpdPswd) {
    $dateStart = strtotime($isUser['passwd_update']);
    $dateEnd = strtotime(date("Y-m-d H:m:s"));
    $daysOfDate = floor(($dateEnd - $dateStart) / 86400);
    $dateResult = $daysOfDate >= $daysUpdPswd ? 'setPassword' : 'login';
    $json['daysUpdPswd']  = "{$daysOfDate} <> {$daysUpdPswd} | {$dateResult}";
  } else {
    $dateResult = 'login';
  }

  if ($takeUser->userID > 0) {
    if ($takeUser->loginByEmail($email, $_POST["password"])) {
      if ($takeUser->userData["active"] == 'N') {
        $json['status'] = 'error';
        $json['message'] = _("Seu endereço de e-mail ainda não foi ativado."); //Your e-mail address has not been activated yet.
        $json['message'] = sprintf(_("Seu endereço de e-mail ainda não foi ativado. %sReenviar e-mail de confirmação?%s"), "<a href='#' class='resendConf readmore abortDT' data-return='#jsReturn' data-button='#doLogin' data-useremail='#user'>", "</a>"); //Your e-mail address has not been activated yet. %sResend confirmation e-mail?%s
        $json["field"] = '#user';
      } elseif ($takeUser->userData['active'] == 'B' || $takeUser->userData['blocked'] == 'Y') {
        $json['status'] = 'error';
        $json['message'] = _("Sua conta foi bloqueada pelo administrador."); //Your account has been blocked by the administrator.
        $json['messageLink'] = sprintf(_("Sua conta foi bloqueada pelo administrador.<br />Se você acredita que isso é um erro,%sentre em contato conosco%s"), '<a href="' . $basePath . 'contact" class="readmore abortDT">', '</a>'); //Your account has been blocked by the administrator.<br />If you believe this is an error, %scontact us%s
        $json["field"] = '#user';
      } else {
        if ($dateResult == 'login') {
          $json['return'] = $takeUser;
          $json['status'] = 'success';
          if ($_POST['goBack'] != '') {
            $goto = $_POST['goBack'];
          } else {
            $goto = $basePath;
          }
          if ($takeUser->first_login) {
            $json['isFirstLogin'] = true;
          }
          $json['goto'] = $goto;
        } else {
          $daysDif = ($daysOfDate - $daysUpdPswd);
          $json['status'] = 'error';
          $json['warning'] = true;
          $json['message'] = sprintf(_("Sua senha não é alterada à %s dias!"), $daysDif); //Your password is not changed at %s days!
          $json['messageLink'] = sprintf(_("Sua senha não é alterada à %s dias!<br />%sAlterar minha senha?%s"), $daysDif,"<a href='#' class='recoverPWD readmore abortDT'>", "</a>"); //Your password is not changed at %s days!<br />%sChange my password?%s
        }
      }
    } else {
      $json['status'] = 'error';
      $json['message'] = _("Senha inválida!"); //Invalid Password!
      $json['messageLink'] = sprintf(_("Senha inválida!<br />%sEsqueceu sua senha?%s"), "<a href='#' class='recoverPWD readmore abortDT'>", "</a>"); //Invalid Password!<br />%sForgot your password?%s
      $json["field"] = '#password';
    }
  } else {
    $json['status'] = 'error';
    $json['message'] = _("Usuário não encontrado! Verifique seu e-mail."); //User not found! Please check your e-mail.
    $json["field"] = '#user';
    $json["dbg"] = $takeUser;
  }

  writeJsonOutput($json);
}
