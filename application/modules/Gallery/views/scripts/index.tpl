<h1>Работы студии</h1>
<div class="works-menu">
	<div class="video-sm"><a href="/video/"><img alt="" src="/themes/default/images/video-small.png" /></a></div>
	<div class="foto-sm active"><img alt="" src="/themes/default/images/foto-small.png" /></div>
	<div class="audio-sm"><a href="/audio/"><img alt="" src="/themes/default/images/audio-small.png" /></a></div>
	<div class="clear"></div>
	<div class="main-razd"></div>
	<div class="chain">
		<div class="section"><a href="/gallery/">Фото</a></div>
		<div class="subsection">
		<?php
        $section = array();
        ?>
		<?php foreach ($this->section as $photoSection) { ?>
		  <?php $section[$photoSection->id] = $photoSection->url; ?>
		  <?php if($this->sectionName == $photoSection->name) { ?>
    		  <?php echo $this->Link('/gallery/' . $photoSection->url . '/', $photoSection->name, $photoSection->name, 'chain-a-active'); ?><br />
    		<?php } else {?>
    		  <?php echo $this->Link('/gallery/' . $photoSection->url . '/', $photoSection->name, $photoSection->name); ?><br />
    		<?php } ?>
		<?php } ?>
		</div>
	</div>
	
	<div class="main-razd"></div>
</div>
<?php foreach ($this->paginator as $album) { ?>
<div class="block">
	<?php if($album['picture'] != '') { ?>
	<a href="/gallery/<?php echo $section[$album['section_id']] . '/' . ($album['url'] ? $album['url'] . '-' : '') . $album['id']; ?>.html">
	   <img class="picture" alt="" src="/<?php echo $album['picture']; ?>p.jpg" />
	</a>
	<?php } ?>
	<span class="block-date"><?php echo $this->Date($album['posted'], 'date'); ?></span>
	<span class="block-r">|</span>
	<span class="block-views">Просмотров: <?php echo $album['view']; ?></span>
	<span class="block-r">|</span>
	<span class="block-comments">Комментариев: <?php echo $album['comment']; ?></span>
	<div class="block-title">
		<?php echo $this->Link('/gallery/' . $section[$album['section_id']] . '/' . ($album['url'] ? $album['url'] . '-' : '') . $album['id'] . '.html', $album['name']); ?>
	</div>
	<?php echo $album['short']; ?>
	<div class="block-more"><?php echo $this->Link('/gallery/' . $section[$album['section_id']] . '/' . ($album['url'] ? $album['url'] . '-' : '') . $album['id'] . '.html', 'Подробнее'); ?></div>
</div>
<?php } ?>
<?php if($this->paginator->count() > 1) { ?>
    <div class="main-razd"></div>
    <?php echo $this->paginationControl($this->paginator, 'Sliding', 'pagination/user-page.tpl'); ?>
<?php } ?>