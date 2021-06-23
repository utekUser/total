<div class="path">
	<a href="/"><img alt="" src="/themes/default/images/house.png" /></a>
	<span><?php echo Engine_Application::getPageHeader(); ?></span>
</div>
<h2><?php echo Engine_Application::getPageHeader(); ?>:</h2>
<div class="artickle-path">Выбор раздела: <a href="/video/">Все разделы</a></div>
<div class="page-razd"></div>
<div class="artickle-section">
	<ul>
	<?php
    $section = array();
    ?>
    <?php foreach ($this->section as $sectionValue) { ?>
        <?php $section[$sectionValue['id']] = $sectionValue['url']; ?>
		<?php if($this->sectionName == $sectionValue['name']) { ?>
            <li><span class="active"><b><?php echo $sectionValue['name']; ?></b><span>(<?php echo $sectionValue['amount']; ?>)</span></span></li>
		<?php } else {?>
            <li><?php echo $this->Link('/video/' . $sectionValue['url'] . '/', $sectionValue['name'], $sectionValue['name']); ?><span>(<?php echo $sectionValue['amount']; ?>)</span></li>
		<?php } ?>
    <?php } ?>
	</ul>
</div>
<div class="page-razd" style="margin-bottom:15px;"></div>
<?php foreach ($this->paginator as $video) { ?>
<div class="news-main">
    <?php if($video['picture'] != '') { ?>
    <div class="news-photo">
        <a href="<?php echo '/video/' . $section[$video['section_id']] . '/' . ($video['url'] ? $video['url'] . '-' : '') . $video['id'] . '.html'; ?>">
            <img alt="" src="/<?php echo $video['picture']; ?>p.jpg" />
        </a>
    </div>
    <?php } ?>
	<span class="news-date"><?php echo $this->Date($video['posted'], 'date'); ?></span>
	<span class="news-r">|</span>
	<span class="news-views">Просмотров: <?php echo $video['view']; ?></span>
	<div class="news-a"><?php echo $this->Link('/video/' . $section[$video['section_id']] . '/' . ($video['url'] ? $video['url'] . '-' : '') . $video['id'] . '.html', $video['name']); ?></div>
	<div><?php echo $video['short']; ?></div>
	<div class="detailed"><?php echo $this->Link('/video/' . $section[$video['section_id']] . '/' . ($video['url'] ? $video['url'] . '-' : '') . $video['id'] . '.html', 'Подробнее'); ?></div>
</div>
<?php } ?>
<?php if($this->paginator->count() > 1) { ?>
    <div class="page-razd"></div>
    <?php echo $this->paginationControl($this->paginator, 'Sliding', 'user-page.tpl'); ?>
<?php } ?>