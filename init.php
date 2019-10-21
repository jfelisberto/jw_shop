<?php

//Display debug erros
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_WARNING);
#error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
#error_reporting(E_ALL);
ini_set('display_errors', 1);

ini_set('memory_limit', '512M');

//# Detect disk path for php includes, hostname and web path for templates
$dwCMSDiskPath = dirname(__FILE__);
if (substr($dwCMSDiskPath, -1, 1) != '/') $dwCMSDiskPath .= '/';

$documentRoot = $_SERVER['DOCUMENT_ROOT'];
$dwBasePathDetected = str_replace($documentRoot, '', $dwCMSDiskPath);
if (substr($dwBasePathDetected, 0, 1) != '/') $dwBasePathDetected = '/' . $dwBasePathDetected;
if (substr($dwBasePathDetected, -1, 1) != '/') $dwBasePathDetected .= '/';

//Carregar configuração
require_once 'config.php';

if ($basePath != $dwBasePathDetected) {
  if (substr($basePath, 0, 1) != '/') $basePath = '/' . $basePath;
  if (substr($basePath, -1, 1) != '/') $basePath .= '/';
}

//sets php timezone
putenv("TZ={$cfgTimezone}");
date_default_timezone_set("TZ={$cfgTimezone}");

//Define o banco de dados$confDtBs = 'dbhospnet';
setlocale(LC_ALL, "pt_BR", "pt_BR.iso-8859-1", "pt_BR.utf-8", "portuguese", "ptb_BRA");
$dataExtenso = strftime("%a, %d de %b de %Y");
$sistemVersion = "v 0.9";
$currentYear = date("Y", time());
$SISprefixo = $sistemName." &#8211; ".$sistemVersion;

$settings['languagePath'][$settings['language']['mainLanguage']['code']] = ($settings['language']['mainLanguage']['urlName'] != '') ? $settings['language']['mainLanguage']['urlName'] : $settings['language']['mainLanguage']['code'];
$currentLanguagePath = $settings['languagePath'][currentLanguageCode];

//Obtem a url
#$url_address = explode('/', $_SERVER['REQUEST_URI']);
$url_address = explode('/', $_GET['reqAddress']);

define('cmsFacet', 'site');
//Carregar classes do sistema
require_once 'common/class/Cypher.php';
require_once 'common/class/Password_Hash.php';
require_once 'common/class/DB_Layer.php';
require_once 'common/class/User.php';

require_once 'common/class/Tag.php';
require_once 'common/class/Content.php';
require_once 'common/class/Media.php';
require_once 'common/class/Relationship.php';

//Carregar bibliotecas
require_once 'common/libs/fpdf/fpdf.php';
require_once 'common/libs/phpmailer/class.phpmailer.php';
require_once 'common/libs/phpmailer/class.smtp.php';
require_once 'common/libs/sendgrid/sendgrid-php.php';

//Carregar arquivos
require_once 'common/_functions.php';

// Path defaults
$imagePath = "img/";
#$pluginPath = $basePath . $pluginPath;
$pluginPath = 'common/plugins/';

### Iniciado conexao com o banco
$db = new DataBase(
  $settings['database']['host'],
  $settings['database']['username'],
  $settings['database']['password'],
  $settings['database']['dbname']
);
$db->showQueries = false;
$db->showTotalQueries = false;
//Conect SGBD
$conectionDB = $db->DataBaseConnect();
#if ($db->SGBDconnect() === false) {
if ($conectionDB['dbStatus'] === false) {
  #header("HTTP/1.0 500 Internal Server Error");
  $template->assign('db_debug', $conectionDB);
  $template->assign('content', '500page');
  $template->display("index.tpl");
  exit;
}
//Select DataBase
$selectDB = $db->SelectDatabase($confDtBs);
//if ($db->SGBDselect($confDtBs) === false) {
if ($selectDB['dbStatus'] === false) {
  header("HTTP/1.0 500 Internal Server Error");
  exit;
};

//sets SGBD timezone;
$db->ExecuteQuery("SET time_zone='{$cfgTimezone}'");
$db->ExecuteQuery("SET names 'UTF8'");
$db->ExecuteQuery("SET CHARACTER_SET 'UTF8'");

//creates the databaseNames on the DB class
$db->contentTable = TBL_PREFIX . 'content';
$db->contentTextTable = TBL_PREFIX . 'content_text';
$db->contentURLTable = TBL_PREFIX . 'content_url';

$db->mediaFilesTable = TBL_PREFIX . 'media_files';
$db->mediaGalleriesTable = TBL_PREFIX . 'media_galleries';
$db->mediaGalleryImagesTable = TBL_PREFIX . 'media_gallery_images';
$db->mediaGalleryImageDataTable = TBL_PREFIX . 'media_gallery_imagedata';
$db->mediaImageResizesTable = TBL_PREFIX . 'media_resizes';

$db->relationshipTable = TBL_PREFIX . 'relationship';
$db->relationshipTextsTable = TBL_PREFIX . 'relationship_text';

$db->requestTable = TBL_PREFIX . 'request';
$db->requestContentTable = TBL_PREFIX . 'request_content';

$db->tagsTable = TBL_PREFIX . 'tags';

$db->sasTable = TBL_PREFIX . 'sas';
$db->usersTable = TBL_PREFIX . 'user';
$db->userContentTable = TBL_PREFIX . 'user_content';
$db->userKeyStorageTable = TBL_PREFIX . 'user_keys';
$db->userEmailTable = TBL_PREFIX . 'user_email';
$db->userEmailLevel = TBL_PREFIX . 'user_email_level';
$db->userFollowTable = TBL_PREFIX . 'user_follow';
$db->userFollowTable = TBL_PREFIX . 'user_saved';
$db->userKeyStorageTable = TBL_PREFIX . 'user_keys';
$db->userPreferencesTable = TBL_PREFIX . 'user_preferences';
$db->userPasswordRecoveryTable = TBL_PREFIX . 'user_pwdrecovery';
$db->userSerialStorageTable = TBL_PREFIX . 'user_serial';


if(IsSet($_SESSION["CMS_userid"])) {
  $takeUser = new User();
  $currentUser = $takeUser->getUserByEmail($_SESSION['CMS_usermail']);
  $currentUser['preferences']['itens_per_page'] = 10;
  $theme = 'start';
  $titlePage .= " - Usu&aacute;rio: ";
} else {
  unset($_SESSION['CMS_userid']);
  unset($_SESSION['CMS_kid']);
  unset($_SESSION['CMS_sid']);
  unset($_SESSION['CMS_sig']);
  unset($_SESSION['CMS_username']);
  unset($_SESSION['CMS_usermail']);
  $theme = 'smoothess';
}
