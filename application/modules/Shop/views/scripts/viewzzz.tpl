<div class="path">
	<a href="/"><img alt="" src="/themes/default/images/house.png" /></a>
	<a href="/articles/"><?php echo Engine_Application::getPageHeader(); ?></a>
	<span><?php echo $this->currentArticle['name']; ?></span>
</div>
<h2><?php echo Engine_Application::getPageHeader(); ?>:</h2>
<div class="news-main">
	<div class="news-photo">
    <?php if ($this->currentArticle['picture'] != '') { ?>
        <a class="gallery" href="/<?php echo $this->currentArticle['picture']; ?>b.jpg"><img class="img-detailed" alt="" src="/<?php echo $this->currentArticle['picture']; ?>p.jpg" /></a>
    <?php } ?>
    <?php for ($i = 1; $i <= 5; $i++) { ?>
        <?php if ($this->currentArticle['picture' . $i] != '') { ?>
            <a class="gallery" href="/<?php echo $this->currentArticle['picture' . $i]; ?>b.jpg"><img class="img-detailed" alt="" src="/<?php echo $this->currentArticle['picture' . $i]; ?>p.jpg" /></a>
        <?php } ?>
    <?php } ?>
	</div>
	<span class="news-date"><?php echo $this->Date($this->currentArticle['posted'], 'date'); ?></span>
	<span class="news-r">|</span>
	<span class="news-views">Просмотров: <?php echo $this->currentArticle['view']; ?></span>
	<div class="news-a-detailed"><?php echo $this->currentArticle['name']; ?></div>
	<div><?php if($this->currentArticle['text'] != '') echo $this->currentArticle['text']; else echo $this->currentArticle['short']; ?></div>
</div>
<div class="page-razd"></div>
<div class="back"><a href="/articles/">Вернуться</a></div>