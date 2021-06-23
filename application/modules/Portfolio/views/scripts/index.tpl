<h1><?php echo Engine_Application::getPageHeader(); ?></h1>
<div class="main-works">
	<div class="video">
		<a href="/video/"><img alt="" src="/themes/default/images/video.png" /></a>
		<h3><a href="/video/">Видео</a></h3>
		<ul>
        <?php foreach ($this->videoSection as $videoSection) { ?>
            <li><?php echo $this->Link('/video/' . $videoSection->url . '/', $videoSection->name, $videoSection->name); ?></li>
        <?php } ?>
		</ul>
	</div>
	<div class="foto">
		<a href="/gallery/"><img alt="" src="/themes/default/images/foto.png" /></a>
		<h3><a href="/gallery/">Фото</a></h3>
		<ul>
		<?php foreach ($this->gallerySection as $gallerySection) { ?>
		  <li><?php echo $this->Link('/gallery/' . $gallerySection->url . '/', $gallerySection->name, $gallerySection->name); ?></li>
		<?php } ?>
		</ul>
	</div>
	<div class="audio">
		<a href="/audio/"><img alt="" src="/themes/default/images/audio.png" /></a>
		<h3><a href="/audio/">Аудио</a></h3>
		<!--<ul>
			<li><a href="#">Свадебное</a></li>
			<li><a href="#">Детское</a></li>
			<li><a href="#">Документальное</a></li>
			<li><a href="#">Разное</a></li>
		</ul>-->
	</div>
</div>