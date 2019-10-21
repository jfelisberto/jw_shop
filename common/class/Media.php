<?php

class Media {

  public $userID;

  private $db;

  public function __construct() {
    global $db;

    $this->db = &$db;
  }

  ## Functions galleries
  /* ***
  * obtendo a galeria
  * $pid = id do conteudo
  * $kind = tipo de conteudo
  * $galleryID = id da galeria
  * $galleryKind = tipo da galeria
  * $data = (true/false) determina se retorna os itens vinculados a galeria
  *** */
  #public function getGallery($pid, $kind='CNT', $galleryID, $galleryKind, $data=false, $status=false) {
  public function getGallery($pid, $kind='CNT', $galleryID, $galleryKind, $data=false, $paramter = array()) {
    return $this->getGallery_Site($pid);
  }

  private function getGallery_Site($content_id) {
    $result = array();

    $contentIDEscaped = $this->db->esc(intval($content_id, 10));

    $sqlGalleries = "SELECT id, is_main FROM `{$this->db->mediaGalleriesTable}` WHERE `content_id`='{$contentIDEscaped}' AND published=1";
    $galleries = $this->db->executeQuery($sqlGalleries);
    $totalGalleries = $this->db->getAffectedRows();
    while($gallery = $this->db->getResult($galleries, DBAL_ASSOC)) {

      $sqlPictures = "SELECT r.id, p.filename, p.realname, rd.title, rd.description, rd.legend, rd.copyright
        FROM {$this->db->mediaGalleryImagesTable} r
        LEFT JOIN {$this->db->mediaGalleryImageDataTable} rd ON rd.relation_id=r.id AND rd.language='" . currentLanguageCode . "'
        LEFT JOIN {$this->db->mediaFilesTable} p ON p.id=r.picture_id
        WHERE r.gallery_id={$gallery['id']} AND r.published='1' ORDER BY r.ordering ASC";

      $pictures = $this->db->ExecuteQuery($sqlPictures);

      while($picture = cleanSlashes($this->db->getResult($pictures, DBAL_ASSOC))) {

        $sqlResizes = "SELECT * FROM {$this->db->mediaImageResizesTable} WHERE `relation_id`={$picture['id']}";
        $resizes = $this->db->ExecuteQuery($sqlResizes);
        while($resize = cleanSlashes($this->db->getResult($resizes, DBAL_ASSOC))) {
          $picture['resizes']["w{$resize['width']}h{$resize['height']}"] = $resize['filename'];
        }
        if ($gallery['is_main'] == 1 || $totalGalleries == 1) {
          $result['pictures'][] = $picture;
        } else {
          $result['extra'][$gallery['id']]['pictures'][] = $picture;
        }

      }
    }

    return $result;
  }


}
