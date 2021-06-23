<h1>Работы студии</h1>
<div class="works-menu">
	<div class="video-sm"><a href="/video/"><img alt="" src="/themes/default/images/video-small.png" /></a></div>
	<div class="foto-sm"><a href="/gallery/"><img alt="" src="/themes/default/images/foto-small.png" /></a></div>
	<div class="audio-sm active"><img alt="" src="/themes/default/images/audio-small.png" /></div>
	<div class="clear"></div>
	<div class="block-razd"></div>
</div>
<?php foreach ($this->paginator as $audio) { ?>
<div class="block">
	<span class="block-date"><?php echo $this->Date($audio['posted'], 'date'); ?></span>
	<span class="block-r">|</span>
	<span class="block-views">Просмотров: <?php echo $audio['view']; ?></span>
	<span class="block-r">|</span>
	<span class="block-comments">Комментариев: <?php echo $audio['comment']; ?></span>
	<div class="block-title">
		<?php echo $this->Link('/audio/' . ($audio['url'] ? $audio['url'] . '-' : '') . $audio['id'] . '.html', $audio['name']); ?>
	</div>
	<?php echo $audio['short']; ?>
	<div class="block-audio">
	   <object width="400" height="20" type="application/x-shockwave-flash" data="../../../externals/players/player_mp3_maxi.swf">
    	   <param value="mp3=/<?php echo $audio['file']; ?>&amp;showstop=1&amp;showvolume=1&amp;volume=75&amp;width=400" name="FlashVars">
    	   <param value="../../../externals/players/player_mp3_maxi.swf" name="src">
    	</object>
	</div>
	<div class="block-more">
		<?php echo $this->Link('/audio/' . ($audio['url'] ? $audio['url'] . '-' : '') . $audio['id'] . '.html', 'Подробнее'); ?>
	</div>
</div>
<?php } ?>
<?php if($this->paginator->count() > 1) { ?>
    <div class="main-razd"></div>
    <?php echo $this->paginationControl($this->paginator, 'Sliding', 'pagination/user-page.tpl'); ?>
<?php } ?>