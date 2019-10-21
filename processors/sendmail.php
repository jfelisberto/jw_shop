<?php

$email = strtolower(addslashes($_POST["email"]));
$ret = validateEmail($email);

if ($ret['status'] == 'error') {
  $jsonResponse['return'] = $ret;
  $status = 'error';
  $message = $ret['message'];
} else {
  $status = 'success';
  $message = 'Email enviado com sucesso. (Essa versão de teste não envia e-mails)';
}

$json['status'] = $status;
$json['message'] = $message;

writeJsonOutput($json);
