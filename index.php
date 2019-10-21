<?php

function microtime_float() {
  list($usec, $sec) = explode(" ", microtime());
  return ((float)$usec + (float)$sec);
}
$time_start = microtime_float();

session_start();
ini_set("session.use_trans_sid", "0");
ini_set("session.use_only_cookies", "1");

include 'init.php';

if (trim(str_replace("/", "", $url_address[0])) == '') {
  $processor = "index";
} else {
  $processor = trim(str_replace("/", "", $url_address[0]));
}

$tag = new Tag();
$content = new Content();
$relationship = new Relationship();

if (file_exists("processors/$processor.php")) {
  require("processors/$processor.php");
}

require "processors/menu.php";

include "skin/includes/header.php";
?>
<div class="container">
  <section class="sectionsViewer">
    <?php
    if (file_exists("skin/pages/$processor.php")) {
      require("skin/pages/$processor.php");
    } else {
      $listaProdutos = $content->getList(array('status'=>'LIVE'));
      require("skin/index.php");
    }
    ?>
  </section>
</div>
<?php
include "skin/includes/footer.php";

$time_end = microtime_float();
$time = $time_end - $time_start;
echo "<!-- " . $time . " seconds -->";
