<?php

$user = new User();
$user->userID = $_SESSION["CMS_userid"];
$user->logout();

header("Location: {$basePath}");
