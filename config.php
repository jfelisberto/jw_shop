<?php
/* Definições de acesso ao banco de dados */
/*$cfgdbUSer = 'admin';
$cfgdbPass = 'WVEsPEJTek8moH7N';
$cfgdbServer = 'localhost';
$cfgdbTablePrefix = "jw_";
$cfgdbDatabase = "{$cfgdbTablePrefix}shop";
//set Idioma
$langLabel = "label_pt_br";
$language = "pt_BR";
*/

$sistemTimezone = 'America/Sao_Paulo';
$sistemName = 'JEFWeb.cms';
$sistemTitle = "Minha loja";

$cfgDomain = "jefweb.inet";
$titlePage = "{$cfgDomain} - Sistema de Gest&atilde;o";

/* ****
Se usar hostname setar $basePath = "/";
Se usar o sistema como sub-diretorio setar $basePath = "";
*/
$basePath = $dwBasePathDetected;

$settings['database'] = array(
  'username' => 'userMysql',
  'password' => 'senhaMysql',
  'host' => 'localhost',
  //'port' => '3306',
  'dbname' => 'jw_shop',
  'tablesprefix' => 'jw_',
  'charset' => 'utf8'
);
define('TBL_PREFIX', $settings['database']['tablesprefix']);

/* Definições de domínio, emails e protocolo */
$settings['email'] = array(
  'to' => array(
    'name' => $sistemName,
    'address' => 'julianoeloi1@gmail.com'
    #'address' => 'juliano@soldia.com'
  ),
  'from' => array(
    'name' => $sistemName,
    'address' => 'julianoeloi@yahoo.com.br'
    #'address' => 'juliano@soldia.com'
  ),
  'replay' => array(
    'name' => $sistemName,
    'address' => 'julianoeloi@hotmail.com'
  ),
  'noreply' => array(
    'name' => $sistemName,
    'address' => "julianoeloi@hotmail.com"
  ),
  // if your server requires all sent e-mail to go through a SMTP server, define useSMTP to true
  // and add the SMTP settings below.
  // Define useSMTP to false to use localhost relay aka mail() functionality.
  'useSMTP' => true,
  'smtpSettings' => array(
    // SMTP host name or address
    'host' => '',
    // Server port. Usually 25 or 587 for regular SMTP, 465 for SSL encrypted connection.
    'port' => 587,
    // If your SMTP host requires authentication, set requireAuth to true
    'requireAuth' => true,
    // if your host requires SSL/TLS connection, set requireSSL to true
    'requireSSL' => false,
    'username' => '',
    'password' => ''
  )
);

$settings['currency'] = array(
  'prefix' => 'R$',
  'thousands' => '.',
  'decimal' => ',',
  'precision' => 2,
  'negative' => true
);

$settings['language'] = array(
  'mainLanguage' => array(
    'code' => 'pt_BR',
    'label' => 'Portugues',
    // Language charset. UTF-8 is recommended for most languages
    'charset' => 'utf-8',
    'urlName' => 'pt'
  )
);

//# Media settings
$settings['media'] = array(
  'max_gallery' => 1,
  'img_size' => array(
    'image' => array(
      'name' => 'main',
      'w' => 934,
      'h' => 584,
      'method' => 'prop',
      #'field_table' => 'image',
      'field_table' => 'filename',
      'js' => true,
      'adjust' => false,
      'adjust_name' => _("Image")
    ),
    'thumb' => array(
      'name' => 'thumbnail',
      'w' => 480,
      'h' => 480,
      'method' => 'crop',
      'field_table' => 'thumbnail',
      'js' => true,
      'adjust' => true,
      'adjust_name' => _("Thumbnail")
    )
  ),
  'single_img_size' => array(
    'image' => array(
      'name' => 'main',
      'w' => 780,
      'h' => 780,
      'method' => 'crop',
      'field_table' => 'image',
      'js' => true,
      'adjust' => false
    ),
    'thumb' => array(
      'name' => 'thumbnail',
      'w' => 480,
      'h' => 480,
      'method' => 'crop',
      'field_table' => 'thumbnail',
      'js' => true,
      'adjust' => false
    )
  )
);

/* status fild settigns */
$selectStatus = array(
  'gender' => array(
    '0' => 'Select an option',
    'M' => 'Male',
    'F' => 'Female'
  ),
  'user' => array(
    'active' => 'Active',
    'blocked' => 'Blocked',
    'disabled' => 'Disabled',
    'pending' => 'Pending',
    'setup' => 'Setup'
  ),
  'content' => array(
    'active' => 'Active',
    'blocked' => 'Blocked',
    'delete' => 'Delete',
    'draft' => 'Draft',
    'import' => 'Import',
    'promotion' => 'Promotion',
    'review' => 'Review',
    'show' => 'Show',
    'scraping' => 'Scraping',
    'trash' => 'Trash'
  )
);

define('currentLanguageCode', $settings['language']['mainLanguage']['code']);
define('sitePath', $settings['site']['basePath']);

define('COOKIE_DOMAIN', $cfgDomain);
define('SITE_DOMAIN', $cfgDomain);
define('HTTP_PROTOCOL', 'http://'); // set 'http://' or 'https://'
define('SITE_URL', HTTP_PROTOCOL . "{$_SERVER['HTTP_HOST']}{$basePath}");
define('APPNAME', $siteName);
define('APPTITLE', $sistemTitle);

define('MAIL_TO', $settings['email']['to']);
define('MAIL_SEND', $settings['email']['from']);
define('MAIL_NOREPLAY', $settings['email']['noreply']);
