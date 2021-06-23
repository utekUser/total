<div class="path">
	<a href="/"><img alt="" src="/themes/default/images/house.png" /></a>
	<a href="/video/"><?php echo Engine_Application::getPageHeader(); ?></a>
	<span><?php echo $this->currentVideo['name']; ?></span>
</div>
<h2>Видео:</h2>
<div class="artickle-path">Выбор раздела: 
    <a href="/video/">Все разделы</a>
    <a href="/video/<?php echo $this->sectionUrl; ?>/"><?php echo $this->sectionName; ?></a>
    <span><?php echo $this->currentVideo['name']; ?></span>
</div>
<div class="page-razd"></div>
<div class="news-main">
	<span class="news-date"><?php echo $this->Date($this->currentVideo['posted'], 'date'); ?></span>
	<span class="news-r">|</span>
	<span class="news-views">Просмотров: <?php echo $this->currentVideo['view']; ?></span>
	<div class="news-a-detailed"><?php echo $this->currentVideo['name']; ?></div>
	<div>
		<?php if($this->currentVideo['before_video'] != '') echo $this->currentVideo['before_video']; ?>
        <div class="video-item">
            <object width="460" height="320" type="application/x-shockwave-flash" data="/externals/players/videoplayer.swf" name="single1">
                <param value="true" name="allowfullscreen">
                <param value="always" name="allowscriptaccess">
                <param value="transparent" name="wmode">
                <param value="file=/<?php echo $this->currentVideo['file']; ?>&amp;screencolor=000000<?php if ($this->currentVideo['picture'] != '') echo '&amp;image=/' . $this->currentVideo['picture'] . 'b.jpg'; ?>" name="flashvars">
                <param value="/externals/players/videoplayer.swf" name="src">
            </object>
        </div>
		<?php if($this->currentVideo['after_video'] != '') echo $this->currentVideo['after_video']; ?>
	</div>
	<div class="page-razd"></div>
	<div class="back"><a href="/video/">Вернуться</a></div>
</div>