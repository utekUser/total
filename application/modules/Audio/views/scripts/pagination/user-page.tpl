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
    <div class="pager">
      <?php if (isset($this->previous)) { ?>
            <a href="?page=<?php echo $this->previous; ?>">Назад</a>
      <?php } ?>
      <?php foreach ($this->pagesInRange as $page) { ?>
        <?php if ($page != $this->current) { ?>
            <a href="?page=<?php echo $page; ?>"><?php echo $page; ?></a>
        <?php } else { ?>
            <span><?php echo $page; ?></span>
        <?php } ?>
      <?php } ?>
      <?php if (isset($this->next)) { ?>
            <a href="?page=<?php echo $this->next; ?>">Далее</a>
      <?php } ?>
    </div>
<?php } ?>