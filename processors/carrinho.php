<?php
if ($currentUser['id']) {
  switch ($_POST['theForm']) {
    case 'addCart':
      $produtoID = $db->esc(trim($_POST['contentID']));
      $quantidade = $db->esc(trim($_POST['quantidade']));
      $price = $db->esc(trim($_POST['price']));
      $name = $db->esc(trim($_POST['produto']));
      $url = $db->esc(trim($_POST['normal_name']));
      $image = $db->esc(trim($_POST['image']));
      if ($image) {
        $imageFile = "{$image}";
      } else {
        $imageFile = "{$imagePath}default_image.png";
      }
      $imageFile = "{$basePath}{$imageFile}";
      $requestUser = addUserRequest($produtoID, $quantidade, $price, $image, $name, $url);

      break;

    case 'remCart':
      break;

    default:
      $requestUser = getListRequest();
      $requestUser = $requestUser[0];
      break;
  }
}
$debg = array($_POST);
