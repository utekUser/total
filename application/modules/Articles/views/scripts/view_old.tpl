<div class="breadcrumbsDesign">
    <p>
        <a href="/" title="Главная">
            <span class="bold">Главная</span>
        </a> » 
        <a href="/articles/" title="<?php echo Engine_Application::getPageHeader(); ?>">
            <span class="bold"><?php echo Engine_Application::getPageHeader(); ?></span>
        </a> »
        <a href="<?php echo $_SERVER['REQUEST_URI']; ?>" title="<?php echo $this->currentArticle['name']; ?>">
            <span class="underline"><?php echo $this->currentArticle['name']; ?></span>
        </a>
    </p>
</div>
<?php /*
<div class="path">
<a href="/"><img alt="" src="/themes/default/images/house.png" /></a>
<a href="/articles/"><?php echo Engine_Application::getPageHeader(); ?></a>
<span><?php echo $this->currentArticle['name']; ?></span>
</div> */ ?>
<h1 style="font-size: 26px; font-weight: 400; padding-top: 20px;"><?php echo $this->currentArticle['name']; ?></h1>
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
    <span class="news-date"><img src="/themes/default/images/newdesign/clock.png" /> <?php echo $this->Date($this->currentArticle['posted'], 'date'); ?></span>
    <span class="news-views"><img src="/themes/default/images/newdesign/eye.png" /> <?php echo $this->currentArticle['view']; ?></span>
    <div><?php if($this->currentArticle['text'] != '') echo $this->currentArticle['text']; else echo $this->currentArticle['short']; ?></div>
</div>