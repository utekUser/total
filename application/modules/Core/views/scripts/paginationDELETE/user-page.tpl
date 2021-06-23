<?php
//												echo "<pre>";
//												print_r($this);
//												echo "</pre>";
//												exit;
												
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: search.tpl 7244 2010-09-01 01:49:53Z john $
 * @author     John
 */
?>

<?php
  // Parse query and remove page
  if( !empty($this->query) && ( is_string($this->query) || is_array($this->query)) ) {
    $query = $this->query;
    if( is_string($query) ) $query = parse_str(trim($query, '?'));
    unset($query['page']);
    $query = http_build_query($query);
    if( $query ) $query = '?' . $query;
  } else {
    $query = '';
  }
  // Add params
  $params = ( !empty($this->params) && is_array($this->params) ? $this->params : array() );
  unset($params['page']);
?>


<?php if ($this->pageCount > 1): ?>
  <div class="pages">
    <ul class="paginationControl">
      <?php if (isset($this->previous)): ?>
        <li>
<!--//          <a href="<?php echo $this->url(array_merge($params, array('page' => $this->previous))) . $query; ?>"><?php echo '&#171; Обратно' ?></a>-->
          <a href="?page=<?php echo $this->previous; ?>"><?php echo '&#171; Обратно' ?></a>
        </li>
      <?php endif; ?>
      <?php foreach ($this->pagesInRange as $page): ?>
        <?php if ($page != $this->current): ?>
          <li>
<!--            <a href="<?php echo $this->url(array_merge($params, array('page' => $page))) . $query; ?>"><?php echo $page; ?></a>-->
            <a href="?page=<?php echo $page; ?>"><?php echo $page; ?></a>
          </li>
        <?php else: ?>
          <li class="selected">
            <a href='#'><?php echo $page; ?></a>
          </li>
        <?php endif; ?>
      <?php endforeach; ?>
      <?php if (isset($this->next)): ?>
        <li>
<!--          <a href="<?php echo $this->url(array_merge($params, array('page' => $this->next))) . $query; ?>"><?php echo 'Дальше &#187;' ?></a>-->
          <a href="?page=<?php echo $this->next; ?>"><?php echo 'Дальше &#187;' ?></a>
        </li>
      <?php endif; ?>
    </ul>
  </div>
<?php endif; ?>

