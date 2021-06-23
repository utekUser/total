<div class="path">
	<a href="/"><img alt="" src="/themes/default/images/house.png" /></a>
	<a href="/news/"><?php echo Engine_Application::getPageHeader(); ?></a>
	<span><?php echo $this->currentNew['name']; ?></span>
</div>
<h2><?php echo Engine_Application::getPageHeader(); ?>:</h2>
<div class="news-main">
	<div class="news-photo">
	 <?php if ($this->currentNew['picture'] != '') { ?>
	 <a class="gallery" href="/<?php echo $this->currentNew['picture']; ?>b.jpg"><img class="img-detailed" alt="" src="/<?php echo $this->currentNew['picture']; ?>p.jpg" /></a>
	 <?php } ?>
	 <?php for ($i = 1; $i <= 5; $i++) { ?>
        <?php if ($this->currentNew['picture' . $i] != '') { ?>
        <a class="gallery" href="/<?php echo $this->currentNew['picture' . $i]; ?>b.jpg"><img class="img-detailed" alt="" src="/<?php echo $this->currentNew['picture' . $i]; ?>p.jpg" /></a>
        <?php } ?>
    <?php } ?>
	</div>
	<span class="news-date"><?php echo $this->Date($this->currentNew['posted'], 'date'); ?></span>
	<span class="news-r">|</span>
	<span class="news-views">Просмотров: <?php echo $this->currentNew['view']; ?></span>
	<div class="news-a-detailed"><?php echo $this->currentNew['name']; ?></div>
	<div><?php if ($this->currentNew['text'] == '') echo $this->currentNew['short']; else echo $this->currentNew['text']; ?></div>
</div>
<div class="page-razd"></div>
<div class="back"><a href="/news/">Вернуться</a></div>