<?php
//# Content class
// Handles pages actions on the CMS

/* Class notes
Possible content status:
'new' => newly created content, not yet saved by the editor
'draft' => content that has been saved by the editor but not yet published
'active' => content that is published (or ready to be published on a future date)
'blocked' => UGC content that is blocked by the admin, either for revision or request
'trashed' => content that has been sent to trash (pre-delete)
'deleted' => content that has been deleted from trash

*/

class Content {

  private $db;
  private $parser = false;

  public function __construct() {
    global $db, $currentUser;
    $this->db = &$db;
    $this->currentUser = &$currentUser;
  }

  //# Content::getList($params)
  // Get a list of pages from the database.
  // The params variable can be used to define conditions, sorting and limits.
  public function getList($params = array()) {
    if (!is_array($params)) return false;

    return $this->getList_Site($params);
  }

  private function getList_Site($params) {

    $sql = "SELECT id FROM {$this->db->contentTable} WHERE workflow_status='{$params['status']}'";
    $tab = $this->db->ExecuteQuery($sql);

    while ($res = $this->db->getResult($tab, DBAL_ASSOC)) {
      $list[] = $this->getContent(array('id'=>$res['id']));
    }

    return $list;
  }

  private function prepareFilters($params) {

    $filters = array();
    $filters['ignoreNewPages'] = "c.`page_status` != 'new'";

    if (is_array($params['excludeIDs'])) $params['excludeIDs'] = implode(',', $params['excludeIDs']);
    if ($params['excludeIDs'] != '') {
      $params['excludeIDs'] = explode(',', $params['excludeIDs']);
      foreach($params['excludeIDs'] as $key => $exludeID) {
        $params['excludeIDs'][$key] = "'" . $this->db->esc(intval(trim($exludeID), 10)) . "'";
      }
      if (count($params['excludeIDs']) == 1) {
        $filters['excludeIDs'] = "c.`id` <> " . $params['excludeIDs'][0];
      } elseif (count($params['excludeIDs']) > 1) {
        $filters['excludeIDs'] = "c.`id` NOT IN (" . implode(',', $params['excludeIDs']) . ")";
      }
    }

    if (is_array($params['includeIDs'])) $params['includeIDs'] = implode(',', $params['includeIDs']);
    if ($params['includeIDs'] != '') {
      $params['includeIDs'] = explode(',', $params['includeIDs']);
      foreach($params['includeIDs'] as $key => $exludeID) {
        $params['includeIDs'][$key] = "'" . $this->db->esc(intval(trim($exludeID), 10)) . "'";
      }
      if (count($params['includeIDs']) == 1) {
        $filters['includeIDs'] = "c.`id` = " . $params['includeIDs'][0];
      } elseif (count($params['includeIDs']) > 1) {
        $filters['includeIDs'] = "c.`id` IN (" . implode(',', $params['includeIDs']) . ")";
      }
    }

    if (is_array($params['excludeChildOf'])) $params['excludeChildOf'] = implode(',', $params['excludeChildOf']);
    if ($params['excludeChildOf'] != '') {
      $params['excludeChildOf'] = explode(',', $params['excludeChildOf']);
      foreach($params['excludeChildOf'] as $key => $exludeID) {
        $params['excludeChildOf'][$key] = "'" . $this->db->esc(intval(trim($exludeID), 10)) . "'";
      }
      if (count($params['excludeChildOf']) == 1) {
        $filters['excludeChildOf'] = "c.`page_parent` <> " . $params['excludeChildOf'][0];
      } elseif (count($params['excludeChildOf']) > 1) {
        $filters['excludeChildOf'] = "c.`page_parent` NOT IN (" . implode(',', $params['excludeChildOf']) . ")";
      }
    }

    if (is_array($params['childOf'])) $params['childOf'] = implode(',', $params['childOf']);
    if ($params['childOf'] != '') {
      $params['childOf'] = explode(',', $params['childOf']);
      foreach($params['childOf'] as $key => $includeID) {
        $params['childOf'][$key] = "'" . $this->db->esc(intval(trim($includeID), 10)) . "'";
      }
      if (count($params['childOf']) == 1) {
        $filters['childOf'] = "c.`page_parent` = " . $params['childOf'][0];
      } elseif (count($params['childOf']) > 1) {
        $filters['childOf'] = "c.`page_parent` IN (" . implode(',', $params['childOf']) . ")";
      }
    }

    if (is_array($params['type'])) $params['type'] = implode(',', $params['type']);
    if ($params['type'] != '') {
      $params['type'] = explode(',', $params['type']);
      foreach($params['type'] as $key => $type) {
        $params['type'][$key] = "'" . $this->db->esc(strtoupper(trim($type))) . "'";
      }
      if (count($params['type']) == 1) {
        $filters['type'] = "c.`page_type`=" . $params['type'][0];
      } elseif (count($params['type']) > 1) {
        $filters['type'] = "c.`page_type` IN (" . implode(',', $params['type']) . ")";
      }
    }

    if (is_array($params['excludeType'])) $params['excludeType'] = implode(',', $params['excludeType']);
    if ($params['excludeType'] != '') {
      $params['excludeType'] = explode(',', $params['excludeType']);
      foreach($params['excludeType'] as $key => $type) {
        $params['excludeType'][$key] = "'" . $this->db->esc(strtoupper(trim($type))) . "'";
      }
      if (count($params['excludeType']) == 1) {
        $filters['excludeType'] = "c.`page_type`<>" . $params['excludeType'][0];
      } elseif (count($params['excludeType']) > 1) {
        $filters['excludeType'] = "c.`page_type` NOT IN (" . implode(',', $params['excludeType']) . ")";
      }
    }

    if (is_array($params['tags'])) $params['tags'] = implode(',', $params['tags']);
    if ($params['tags'] != '') {
      $params['tags'] = explode(',', $params['tags']);
      foreach($params['tags'] as $key => $tag) {
        if (intval(trim($tag), 10) > 0) {
          $params['tags'][$key] = "'" . $this->db->esc(intval(trim($tag), 10)) . "'";
        } else {
          $tagID = $this->db->getSingleValue("SELECT id FROM `{$this->db->tagsTable}` WHERE `normal_name`='" . $this->db->esc(trim($tag)) . "'");
          if ($tagID > 0) {
            $params['tags'][$key] = "'" . $this->db->esc(intval(trim($tagID), 10)) . "'";
          }
        }
      }
      if (count($params['tags']) > 0) {
        $filters['tags'] = "c.`id` IN (SELECT DISTINCT(`content_id`) FROM `{$this->db->relationshipTable}` WHERE `relation_type`='tag' AND `relation_id` IN (" . implode(',', $params['tags']) . "))";
      }
    }

    if ($params['search'] != '') {
      $filters['name'] = "c.`name` LIKE '%" . $this->db->esc($params['search']) . "%'";
      if ($params['searchContent'] == true) {
        $filters['name'] .= " OR t.`description` LIKE '%" . $this->db->esc($params['search']) . "%' OR t.`standfirst` LIKE '%" . $this->db->esc($params['search']) . "%'";
      }
    }

    if ($params['startWith'] != '') {
      $filters['name'] = "c.`name` LIKE '" . $this->db->esc($params['startWith']) . "%'";
    }

    $return = array(
      'conditions' => '(' . implode(') AND (', $filters) . ')'
    );

    return $return;
  }

  //# Content::query($params)
  //
  public function query($params) {
    global $customPageTypes;

    if (cmsFacet == 'site') {
      $queryJoins = "LEFT JOIN `dw_content_text` t ON t.`language`='" . mainLanguageCode . "' AND t.`content_id` = c.`id`";
      $nonTranslatedFilter = "AND t.`normal_name` <> ''";
      if (!isset($params['searchContent'])) $params['searchContent'] = true;
    }

    # Retorna uma matriz com todos os conteúdos
    $filters = $this->prepareFilters($params);

    switch($params['sortBy']) {
      case 'publishDate':
        $querySort = "ORDER BY c.`publish_date`";
        if ($params['sortDirection'] == 'asc') {
          $querySort .= ' ASC';
        } else {
          $querySort .= ' DESC';
        }
        $querySort .= ", c.`page_order` DESC, c.`id` DESC";
        break;

      case 'pageName':
        $querySort = "ORDER BY t.`name`";
        if ($params['sortDirection'] == 'desc') {
          $querySort .= ' DESC';
        } else {
          $querySort .= ' ASC';
        }
        $querySort .= ", c.`page_order` DESC, c.`id` DESC";
        break;

      case 'orderName':
        $querySort = "ORDER BY c.`page_order`";
        if ($params['sortDirection'] == 'desc') {
          $querySort .= ' DESC';
        } else {
          $querySort .= ' ASC';
        }
        $querySort .= ", t.`name` ASC";
        break;

      case 'searchPriority':
        $searchkeywordEscaped = $this->db->esc($params['search']);
        $priorityCases = ", CASE
          WHEN t.name = '{$searchkeywordEscaped}' THEN 10
          WHEN t.name LIKE '{$searchkeywordEscaped}' THEN 8
          WHEN t.name LIKE '{$searchkeywordEscaped}%' THEN 6
          WHEN (t.name LIKE '%{$searchkeywordEscaped}%' || t.name LIKE '%{$searchkeywordEscaped}') THEN 5
          WHEN t.standfirst LIKE '{$searchkeywordEscaped}' THEN 4
          WHEN t.standfirst LIKE '{$searchkeywordEscaped}%' THEN 3
          WHEN (t.standfirst LIKE '%{$searchkeywordEscaped}%' || t.standfirst LIKE '%{$searchkeywordEscaped}') THEN 2
        ELSE 0 END as priority";
        $querySort = "ORDER BY priority DESC, t.`name` ASC";
        break;

      case 'pageViews':
        $querySort = "ORDER BY c.`stats_pageviews`";
        if ($params['sortDirection'] == 'asc') {
          $querySort .= ' ASC';
        } else {
          $querySort .= ' DESC';
        }
        $querySort .= ", t.`name` ASC";
        break;

      case 'pageShares':
        $querySort = "ORDER BY c.`stats_shares`";
        if ($params['sortDirection'] == 'asc') {
          $querySort .= ' ASC';
        } else {
          $querySort .= ' DESC';
        }
        $querySort .= ", t.`name` ASC";
        break;

      case 'pageComments':
        $querySort = "ORDER BY c.`stats_comments`";
        if ($params['sortDirection'] == 'asc') {
          $querySort .= ' ASC';
        } else {
          $querySort .= ' DESC';
        }
        $querySort .= ", t.`name` ASC";
        break;

      case 'pageFollows':
        $querySort = "ORDER BY c.`stats_follows`";
        if ($params['sortDirection'] == 'asc') {
          $querySort .= ' ASC';
        } else {
          $querySort .= ' DESC';
        }
        $querySort .= ", t.`name` ASC";
        break;

      case 'pageOrder':
      default:
        $querySort = "ORDER BY c.`page_order`";
        if ($params['sortDirection'] == 'desc') {
          $querySort .= ' DESC';
        } else {
          $querySort .= ' ASC';
        }
        $querySort .= ", c.`id` DESC";
        break;
    }

    if (intval($params['limit'], 10) > 0) {

      if ($params['offset'] != '') {
        $offset = intval($params['offset'], 10);
      } else {
        $offset = 0;
      }

      $queryLimit = " LIMIT {$offset}," . intval($params['limit'], 10);
    }

    $sql = "SELECT
      c.`id`
      {$priorityCases}
    FROM
      `{$this->db->contentTable}` c
    LEFT JOIN
      `{$this->db->usersTable}` u ON u.`id`=c.`updated_by`
    {$queryJoins}
    WHERE
      c.`published`=1 AND
      {$filters['conditions']}
      {$nonTranslatedFilter}
    {$querySort}
    {$queryLimit}  ";

    $pages = array();
    $tab = $this->db->executeQuery($sql);
    while ($page = cleanSlashes($this->db->getResult($tab))) {
      $pages[] = $this->getContent(array('id' => $page['id']));
    }
    if (count($pages) > 0) {
      return $pages;
    } else {
      return false;
    }
  }

  //# Content::getContent($params)
  // Get the contents of a single page from the database.
  // The params variable can be used to determinate which page will be loaded.
  // Example: $pageData = $content->getContent(array('id' => 10)); to return the content
  // of content page ID 10.
  // Return will be an array of all content fields
  // Required parameters:
  // - id: the content ID
  public function getContent($params = array()) {
    if (!is_array($params)) return false;

    return $this->getContent_Site($params);
  }

  //# Content::getContent_Site($params)
  // Worker function for getting a list of pages when on the CMS panel
  // Additional data returned:
  // - Translations (as in getContentTranslations);
  private function getContent_Site($params) {
    if (intval($params['id'], 10) > 0) {
      $queryFilter = "`id`=" . $this->db->esc(intval($params['id'], 10));
    }

    if ($params['url'] != '') {
      $urlHash = sha1($params['url']);
      $urlHashEscaped = $this->db->esc($urlHash);
      $contentID = $this->db->getSingleValue("SELECT content_id FROM `{$this->db->contentURLTable}` WHERE `url_key`=UNHEX('{$urlHashEscaped}')");
      if ($contentID > 0) {
        $queryFilter = "`id`=" . $this->db->esc(intval($contentID, 10));
      }
    }

    if ($params['import_id'] != '') {
      $importIDEscaped = $this->db->esc($params['import_id']);
      $queryFilter = "`import_id`='{$importIDEscaped}'";
    }

    if ($queryFilter == '') return false;

    if ($params['__parentQuery'] === true) {
      $params['skipSEO'] = true;
      $params['skipTags'] = true;
      $params['skipFields'] = true;
      $params['skipGallery'] = true;
      $params['singleURL'] = true;
    }

    $sql = "SELECT *,
      UNIX_TIMESTAMP(publish_date) as publish_timestamp,
      DATE_FORMAT(publish_date, '%H') as publish_hour,
      DATE_FORMAT(publish_date, '%i') as publish_minute,
      DATE_FORMAT(publish_date, '%d/%m/%Y') as publish_date FROM `{$this->db->contentTable}` WHERE {$queryFilter} LIMIT 0,1";
    $content = cleanSlashes($this->db->getSingleRecord($sql));

    $content['isFollow'] = getContentUserFollow($content['id']);
    $content['totalFollows'] = getContentTotalFollows($content['id']);

    $content['translation'] = $this->getContentTranslations($content['id'], array(currentLanguageCode));

    if ($content['page_parent'] > 0)
    $content['page_parent'] = $this->getContent(array('id' => $content['page_parent'], '__parentQuery' => true));

    if ($params['skipTags'] !== true) {
      $tagQuery = "SELECT t.`id`, t.`name`, t.`parent_id`, t.`normal_name`
      FROM `{$this->db->tagsTable}` t
      JOIN `{$this->db->relationshipTable}` r ON r.`relation_id` = t.`id`
      WHERE
        r.`relation_type`='tag' AND
        r.`content_id`='{$content['id']}' AND
        t.`language`='" . $this->db->esc(currentLanguageCode) . "'
      ORDER BY t.name ASC";
      $tagIDs = array();
      $tags = $this->db->executeQuery($tagQuery);
      while($tag = $this->db->getResult($tags)) {
        $content['tags'][] = cleanSlashes($tag);
        $tagIDs[] = $tag['id'];
      }
      $content['tags_list'] = $tagIDs;
    }

    if ($content['image'] != '') {
      $content['thumb_sm'] = optimizedImage($content['image'], '480');
      $content['thumb_lg'] = optimizedImage($content['image'], '780');
    }

    if ($params['singleURL'] !== true) {
      $content['pageURLs'] = $this->getPageURLs(array('content_id' => $content['id']));
      $content['pageURL'] = $content['pageURLs'][currentLanguageCode][0];
    } else {
      $content['pageURLs'] = $this->getPageURLs(array('content_id' => $content['id'], 'language' => currentLanguageCode));
      $content['pageURL'] = $content['pageURLs'][currentLanguageCode][0];
      unset($content['pageURLs']);
    }


    if ($params['skipGallery'] !== true) {
      $media = new Media();
      $content['gallery'] = $media->getGallery($content['id'], $content['page_type'], 0, '', true);
    }

    // if ($content['fieldsParsed'] != true) {
    //   $this->parseFields($content);
    // }

    return $content;
  }

  //# Content::getContentTranslations($contentID, $languages = '')
  // Get the translations for content specified by $contentID. All translations will be returned
  // except if the $languages, a comma separated string of language codes, is set
  // Example: $content->getContentTranslations(10, 'en_US, pt_BR') to return
  // only the en_US and pt_BR translations of content ID 10.
  public function getContentTranslations($contentID, $languages = array()) {
    if (is_array($languages)) {
      foreach($languages as $lang) {
        $langs[] = $this->db->esc($lang);
      }
      $langs = implode("','", $langs);
    }
    $languageFilter = '';
    if ($langs != '') {
      $languageFilter = " AND `language` IN ('{$langs}')";
    }
    $contentIDEscaped = $this->db->esc(intval($contentID, 10));
    $langs = $this->db->executeQuery("SELECT * FROM `{$this->db->contentTextTable}` WHERE `content_id`='{$contentIDEscaped}' {$languageFilter}");
    $translations = array();
    while ($lang = cleanSlashes($this->db->getResult($langs))) {
      #$lang['price'] = pricetValue($lang['price']);
      $translations[$lang['language']] = $lang;

    }
    if (count($languages) == 1) {
      return $translations[$languages[0]];
    } else {
      return $translations;
    }
  }

  //# Content::getAvailableLanguages($contentID)
  // Get the available languages of a content. Return is an array of language codes.
  // Example: $languages = $content->getAvailableLanguages(10);
  // $languages = array(
  //   0 => 'en_US',
  //   1 => 'pt_BR',
  //   2 => 'es_ES',
  //   3 => 'fr_FR'
  // )
  public function getAvailableLanguages($contentID) {
    $contentIDEscaped = $this->db->esc(intval($contentID), 10);
    $langs = $this->db->executeQuery("SELECT `language` FROM `{$this->db->contentTextTable}` WHERE `content_id`='{$contentIDEscaped}'");
    $availableLangs = array();
    while ($lang = cleanSlashes($this->db->getResult($langs))) {
      $availableLangs[] = $lang['language'];
    }
    return $availableLangs;
  }

  //# Content::getPageURL($params = array())
  // Get the page URLs for the content specified by content_id. All URLs will be returned
  // except if the $languages, a comma separated string of language codes, is set.
  // The $currentOnly flag defines if only the last URL change is to be returned - when set
  // as true, or if it should return a history of all URLs - when set to false
  // Required parameters:
  // - content_id:
  // Optional parameters:
  // - currentOnly: boolean; true (default) returns only the current URL for each language,
  //                         false returns all URLs for that page (including redirects)
  // - absoluteURL: boolean; true (default) returns an absolute URL including site's basePath
  //                         false returns URLs relative to site's basePath
  // - language: string; comma separated list of language codes to get the URLs
  // Example: $content->getPageURL(array('content_id' => 10, 'language' => 'en_US, pt_BR') to return
  // only the en_US and pt_BR URLs of content ID 10.
  public function getPageURLs($params = array()) {
    if (!is_array($params)) return false;
    if (intval($params['content_id']) <= 0) return false;

    global $settings;

    if (!isset($params['currentOnly'])) $params['currentOnly'] = true;
    if (!isset($params['absoluteURL'])) $params['absoluteURL'] = true;

    $contentIDEscaped = $this->db->esc($params['content_id']);

    if ($params['language'] != '') {
      $languageReturn = array_map('trim', explode(',', $params['language']));
    } else {
      $languageReturn = 'all';
    }

    if ($params['absoluteURL']) {
      $base = sitePath;
    } else {
      $base = '';
    }

    $pageURLs = array();

    // loop through all languages to get the page URLs
    foreach($settings['language']['all'] as $language) {
      // if the list of languages to return is defined and the current is not on the list, skip
      if (is_array($languageFilter) && !in_array($language, $languageReturn)) continue;

      $languageEscaped = $this->db->esc($language['code']);
      $languageFilter = "AND `language`='{$languageEscaped}'";

      // loop through the content translations table to generate the URLs
      if ($params['currentOnly'] === true) {
        $urlsQuery = $this->db->executeQuery("SELECT
            `language`,
            `page_url`
          FROM `{$this->db->contentURLTable}`
          WHERE
            `content_id`='{$contentIDEscaped}'
            {$languageFilter}
            {$currentCondition}
          ORDER BY `created_date` DESC
          LIMIT 0,1"
        );
      } else {
        $urlsQuery = $this->db->executeQuery("SELECT
            *,
            UNIX_TIMESTAMP(`created_date`) as created_date
          FROM `{$this->db->contentURLTable}`
          WHERE
            `content_id`='{$contentIDEscaped}'
            {$languageFilter}
            {$currentCondition}
          ORDER BY `created_date` DESC"
        );
      }
      while($url = $this->db->getResult($urlsQuery)) {
        if ($params['currentOnly'] === true) {
          $pageURLs[$url['language']][] = $base . $url['page_url'];
        } else {
          $url['page_url'] = $base . $url['page_url'];
          $pageURLs[$url['language']][] = $url;
        }
      }
    }

    return $pageURLs;
  }

  //# Content::getCurrentURL($contentID, $language, $absoluteURL = true)
  // Get the page URLs for the content specified by contentID and language.
  // The functil will return an absolute URL, which includes the site's basePath config
  // when $absoluteURL is set to true (default), or an URL relative to site's basePath
  // with $absoluteURL set to false;
  // Example:
  // Considering that the basePath resolves to "/test-site/";
  // - $content->getCurrentURL(10, 'en_US') would output: /site/page-10
  // - $content->getCurrentURL(10, 'en_US', false) would output: page-10

  public function getCurrentURL($contentID, $language, $absoluteURL = true) {
    if ($language == '' || intval($contentID) <= 0) return false;

    $languageEscaped = $this->db->esc($language);
    $contentIDEscaped = $this->db->esc(intval($contentID, 10));

    if ($absoluteURL) {
      $base = sitePath;
    } else {
      $base = '';
    }
    $pageURL = $this->db->getSingleValue("SELECT
        `page_url`
      FROM `{$this->db->contentURLTable}`
      WHERE
        `content_id`='{$contentIDEscaped}' AND
        `language`='{$languageEscaped}'
      ORDER BY `created_date` DESC
      LIMIT 0,1"
    );

    if ($pageURL == '' || $pageURL == false) {
      return false;
    } else {
      return $base . $pageURL;
    }
  }

}
