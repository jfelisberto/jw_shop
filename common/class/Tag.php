<?php
//# Tags class
// Handles tags actions on the CMS

class Tag {

  private $db;

  public function __construct() {
    global $db;
    $this->db = &$db;
  }


  //# Tag::getList($params)
  public function getList($params = array()) {
    if (!is_array($params)) return false;

    if ($params['autocomplete'] === true) {
      return $this->getList_Site_Autocomplete($params);
    } else {
      return $this->getList_Site($params);
    }

  }

  public function getTag($params = array()) {
    if (!is_array($params)) return false;

    return $this->getTag_Site($params);
  }

  //# Tag::getContent_Panel($params)
  private function getTag_Site($params) {
    if (intval($params['id'], 10) > 0) {
        $queryFilter = "`id`=" . $this->db->esc(intval($params['id'], 10));
    }

    if (intval($params['limit'], 10) > 0) {

      if ($params['offset'] != '') {
        $offset = intval($params['offset'], 10);
      } else {
        $offset = 0;
      }

      $queryLimit = " LIMIT {$offset}," . intval($params['limit'], 10);
    }

    if ($params['mainTag']) {
      $queryFilter = "parent_id=0 AND tag_status='active' ORDER BY name ASC";
    }
    if ($params['parent_id']) {
      $queryFilter = "parent_id={$params['parent_id']} AND tag_status='active' ORDER BY name ASC";
    }

    $sql = "SELECT * FROM `{$this->db->tagsTable}` WHERE {$queryFilter}{$queryLimit}";

    $data = array();
    $tab = $this->db->executeQuery($sql);
    while ($res = cleanSlashes($this->db->getResult($tab, DBAL_ASSOC))) {

      $res['updated_date_f'] = date('d/m/Y H:i:s', $res['updated_date']);

      $data[] = $res;

    }

    return $data;
  }

}
