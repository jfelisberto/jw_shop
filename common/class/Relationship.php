<?php
//# Relationship class
// Handles relationship of content with other cms entities

/* Class notes
Possible releationship types:
'tag' => content tag
'category' => the main tag or category of that content
*/

class Relationship {

  private $db;

  public function __construct() {
    global $db;
    $this->db = &$db;
  }

  public function getAllOfType($relationType, $contentID, $getTranslation = false) {
    return $this->getRelations('type', array('type' => $relationType, 'contentID' => $contentID), $getTranslation);
  }

  public function getAllOfTypeReverse($relationType, $contentID, $getTranslation = false) {
    return $this->getRelationsReverse('type', array('type' => $relationType, 'contentID' => $contentID), $getTranslation);
  }

  public function getAll($contentID, $getTranslation = false) {
    return $this->getRelations('content', array('contentID' => $contentID), $getTranslation);
  }

  public function getItemID($relationID, $field = 'id', $getTranslation = false) {
    $item = $this->getRelations('content', array('relationshipID' => $relationID, 'field' => $field), $getTranslation);

    $result['data'] = $item['list'];
    $result['status'] = $item['status'];
    $result['message'] = $item['message'];
    return $result;
  }

  public function getByID($relationshipID, $getTranslation = false) {
    return $this->delete('single', array('relationshipID' => $relationshipID), $getTranslation);
  }

  private function getRelations($mode, $data, $getTranslation) {
    $relationshipIDEscaped = $this->db->esc(intval($data['relationshipID'], 10));
    $relationshipFieldEscaped = $this->db->esc(trim(strtolower($data['field'])));
    $contentIDEscaped = $this->db->esc(intval($data['contentID'], 10));
    $relationTypeEscaped = $this->db->esc(trim(strtolower($data['type'])));
    $content = new Content();

    if ($relationshipIDEscaped >= 1) {
      $sql = "SELECT * FROM {$this->db->relationshipTable} WHERE {$relationshipFieldEscaped}='{$relationshipIDEscaped}' ORDER BY priority ASC";
    } else {
      $where_condtion = !empty($relationTypeEscaped) ? " AND relation_type='{$relationTypeEscaped}'" : "";
      $sql = "SELECT * FROM {$this->db->relationshipTable} WHERE content_id='{$contentIDEscaped}'{$where_condtion} ORDER BY priority ASC";
    }

    $tab = $this->db->ExecuteQuery($sql);

    if ($tab) {
      while ($res = $this->db->getResult($tab, DBAL_ASSOC)) {
        if (!empty($getTranslation)) {
          if (count($getTranslation) > 1) {
            foreach ($getTranslation as $key => $value) {
              $sql1a = "SELECT * FROM {$this->db->relationshipTextsTable} WHERE relationship_id='{$res['id']}' AND language='{$value['code']}'";
              $res1 = $this->db->getSingleRecord($sql1a);
              #$res1['code'] = $value['code'];
              #$res1['title'] = "Texto no idioma: {$value['label']}";
              $res['text'][$value['code']] = $res1;
              $sql1[] = $sql1a;
            }
          } else {
            $sql1 = "SELECT * FROM {$this->db->relationshipTextsTable} WHERE relationship_id='{$res['id']}' AND language='{$getTranslation}'";
            $res1 = $this->db->getSingleRecord($sql1);
            $res['text'] = $res1;
          }
        }
        if ($res['relation_type'] == 'media') {
          $sql2 = "SELECT * FROM {$this->db->mediaFilesTable} WHERE id='{$res['relation_id']}'";
          $res2 = $this->db->getSingleRecord($sql2);
          $res['data'] = $res2;
        }
        if ($res['relation_type'] == 'page') {
          $res['data'] = $content->getContent(array('id' => $res['conten_id'], '__parentQuery' => true));
        }
        if ($res['relation_type'] == 'page_reverse') {
          $res['data'] = $content->getContent(array('id' => $res['content_id'], '__parentQuery' => true));
        }
        if ($res['relation_type'] == 'tag' && !empty($res['content_id'])) {
          $res['data'] = $content->getContent(array('id' => $res['content_id'], '__parentQuery' => true));
        }

        $res['dbg'] = array($getTranslation, $sql1,$sql2);
        $list[] = $res;
      }
      $result['list'] = $list;
      $status = 'success';
      $message = "";
    } else {
      $status = 'error';
      $message = _("Houve um error ao processar sua requisição");
    }

    $result['status'] = $status;
    $result['message'] = $message;

    $result['dbg'] = array($mode,$data,$getTranslation,$sql,$list);
    return $result;
  }

  private function getRelationsReverse($mode, $data, $getTranslation) {
    $relationshipIDEscaped = $this->db->esc(intval($data['relationshipID'], 10));
    $contentIDEscaped = $this->db->esc(intval($data['contentID'], 10));
    $relationTypeEscaped = $this->db->esc(trim(strtolower($data['type'])));
    $content = new Content();

    if ($relationshipIDEscaped >= 1) {
      $sql = "SELECT * FROM {$this->db->relationshipTable} WHERE id='{$relationshipIDEscaped}' ORDER BY priority ASC";
    } else {
      $where_condtion = !empty($relationTypeEscaped) ? " AND relation_type='{$relationTypeEscaped}'" : "";
      $sql = "SELECT * FROM {$this->db->relationshipTable} WHERE relation_id='{$contentIDEscaped}'{$where_condtion} ORDER BY priority ASC";
    }

    $tab = $this->db->ExecuteQuery($sql);

    if ($tab) {
      while ($res = $this->db->getResult($tab, DBAL_ASSOC)) {

        if ($res['relation_type'] == 'page') {
          $res['data'] = $content->getContent(array('id' => $res['content_id'], '__parentQuery' => true));
        }

        $res['dbg'] = array($getTranslation, $sql1,$sql2);
        $list[] = $res;
      }
      $result['list'] = $list;
      $status = 'success';
      $message = "";
    } else {
      $status = 'error';
      $message = _("Houve um error ao processar sua requisição");
    }

    $result['status'] = $status;
    $result['message'] = $message;

    #$result['dbg'] = array($mode,$data,$getTranslation,$sql,$list);
    return $result;
  }
}
