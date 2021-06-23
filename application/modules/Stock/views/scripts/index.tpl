<div class="path">
	<a href="/"><img alt="" src="/themes/default/images/house.png" /></a>
	<span><?php echo Engine_Application::getPageHeader(); ?></span>
</div>
<h2><?php echo Engine_Application::getPageHeader(); ?>:</h2>
<?php foreach ($this->paginator as $news) { ?>
<div class="news-main">
    <?php if($news['picture'] != '') { ?>
    <div class="news-photo"><a href="/news/<?php echo ($news['url'] ? $news['url'] . '-' : '') . $news['id'] . '.html'; ?>"><img alt="" src="/<?php echo $news['picture']; ?>p.jpg" /></a></div>
	<?php } ?>
	<span class="news-date"><?php echo $this->Date($news['posted'], 'date'); ?></span>
	<span class="news-r">|</span>
	<span class="news-views">Просмотров: <?php echo $news['view']; ?></span>
	<div class="news-a"><?php echo $this->Link('/news/' . ($news['url'] ? $news['url'] . '-' : '') . $news['id'] . '.html', $news['name']); ?></div>
	<div><?php echo $news['short']; ?></div>
</div>
<?php } ?>
<?php if($this->paginator->count() > 1) { ?>
    <div class="page-razd"></div>
    <?php echo $this->paginationControl($this->paginator, 'Sliding', 'user-page.tpl'); ?>
<?php } ?>