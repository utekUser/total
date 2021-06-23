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
<?php if ($this->pageCount > 1) { ?>
    <ul class="nav">
      <?php if (isset($this->previous)) { ?>
                    <li><a href="#" class="pager-first">Первая</a></li>
            <li><a class="pager-left" href="?page=<?php echo $this->previous; ?>">Предыдущая</a></li>
<!--//          <a href="<?php echo $this->url(array_merge($params, array('page' => $this->previous))) . $query; ?>"><?php echo '&#171; Обратно' ?></a>-->
      <?php } ?>
      <?php foreach ($this->pagesInRange as $page) { ?>
        <?php if ($page != $this->current) { ?>
<!--            <a href="<?php echo $this->url(array_merge($params, array('page' => $page))) . $query; ?>"><?php echo $page; ?></a>-->
            <li><a href="?page=<?php echo $page; ?>"><?php echo $page; ?></a></li>
        <?php } else { ?>
            <li><a href='#' class="pager-active"><?php echo $page; ?></a></li>
        <?php } ?>
      <?php } ?>
      <?php if (isset($this->next)) { ?>
<!--          <a href="<?php echo $this->url(array_merge($params, array('page' => $this->next))) . $query; ?>"><?php echo 'Дальше &#187;' ?></a>-->
            <li><a href="?page=<?php echo $this->next; ?>" class="pager-right">Следующая</a></li>
                    <li><a href="#" class="pager-last">Последняя</a></li>

      <?php } ?>
    </ul>
<?php } ?>