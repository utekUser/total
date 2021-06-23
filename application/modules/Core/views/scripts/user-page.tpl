<?php
$adParam = "";
if (isset($this->addParam)) {
    $adParam = '&' . $this->addParam;
}
?>
<?php if ($this->pageCount > 1) { ?>
    <div class="pager">
      <?php if (isset($this->previous)) { ?>
            <a href="?page=<?php echo $this->previous; ?>" class="prev"><</a>
      <?php } ?>
      <?php foreach ($this->pagesInRange as $page) { ?>
        <?php if ($page != $this->current) { ?>
            <a href="?page=<?php echo $page . $adParam; ?>"><?php echo $page; ?></a>
        <?php } else { ?>
            <a href="?page=<?php echo $page; ?>" class="active"><?php echo $page; ?></a>
        <?php } ?>
      <?php } ?>
      <?php if (isset($this->next)) { ?>
            <a href="?page=<?php echo $this->next; ?>" class="next">></a>
      <?php } ?>
    </div>
<?php } ?>