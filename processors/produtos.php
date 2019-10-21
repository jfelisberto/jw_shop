<?php

if (IsSet($_POST['theForm'])) {
  $status = 'success';

  $json['data'] = "Produtos da categoria - {$_POST['normal_name']} - {$_GET['search']}";
  $json['dbg'] = array($_POST,$_GET);
  $json['status'] = $status;
  $json['message'] = $message;

  writeJsonOutput($json);
  exit;

} elseif (IsSet($url_address[1])) {
  $pageControl = 'produto';

  $pageURL = $db->esc(trim($url_address[1]));

  $sql = "SELECT id FROM {$db->contentURLTable} WHERE page_url='{$pageURL}'";
  $contentID = $db->getSingleValue($sql);
  $produto = $content->getContent(array('id'=>$contentID));

} else {
  $pageControl = 'list';
  $normal_name = $db->esc(trim($_GET['search']));
  $sql = "SELECT id FROM {$db->tagsTable} WHERE normal_name='{$normal_name}'";
  $mainTag = $db->getSinglevalue($sql);

  $parentTags = $tag->getTag(array('parent_id'=>$mainTag));

  $produtosRelation = $relationship->getItemID($mainTag, 'relation_id');

}
