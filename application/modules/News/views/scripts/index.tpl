<?php foreach ($this->paginator as $news) { ?>
<div class="news-main">
    <?php if($news['picture'] != '') { ?>
    <div class="news-photo" style="position: relative;">
        <a href="/news/<?php echo ($news['url'] ? $news['url'] . '-' : '') . $news['id'] . '.html'; ?>">
            <img alt="" style="border: 0px;" src="/<?php echo $news['picture']; ?>p.jpg" />
            <?php if ($news['stock']) { ?><img style="border: 0; position: absolute; bottom: 0;" src="/images/stock.png" /><?php } ?>
        </a>
    </div>
    <?php } ?>
    <span class="news-date" style="color: #939495; font-family: Arial; font-size: 11px; font-weight: normal;"><img src="/themes/default/images/newdesign/clock.png" /> <?php echo $this->Date($news['posted'], 'date'); ?></span>
    <span class="news-views"><img src="/themes/default/images/newdesign/eye.png" /> <?php echo $news['view']; ?></span>
    <div class="news-a"><?php echo $this->Link('/news/' . ($news['url'] ? $news['url'] . '-' : '') . $news['id'] . '.html', $news['name']); ?></div>
    <div><?php echo $news['short']; ?></div>
</div>
<?php } ?>

<?php if($this->paginator->count() > 1) { ?>
<div class="newPaginator">
<?php echo $this->paginationControl($this->paginator, 'Sliding', 'user-page.tpl'); ?>
</div>
<?php } ?>