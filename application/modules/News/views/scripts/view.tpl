<?php /* <div class="breadcrumbsDesign">
    <p>
        <a href="/" title="Главная">
            <span class="bold">Главная</span>
        </a> » 
        <a href="/news/" title="<?php echo Engine_Application::getPageHeader(); ?>">
            <span class="bold"><?php echo Engine_Application::getPageHeader(); ?></span>
        </a> »
        <a href="<?php echo $_SERVER['REQUEST_URI']; ?>" title="<?php echo $this->currentNew['name']; ?>">
            <span class="underline"><?php echo $this->currentNew['name']; ?></span>
        </a>
    </p>
</div> */ ?>
<h1 style="font-size: 26px; font-weight: 400; text-transform: none; padding-top: 20px;"><?php echo $this->currentNew['name']; ?></h1>
<span class="news-date" style="color: #939495; font-family: Arial; font-size: 11px; font-weight: normal;"><img src="/themes/default/images/newdesign/clock.png" /> <?php echo $this->Date($this->currentNew['posted'], 'date'); ?></span>
<span class="news-views"><img src="/themes/default/images/newdesign/eye.png" /> <?php echo $this->currentNew['view']; ?></span>
<div class="news-main">
    <div class="news-photo" style="float: none;">
        <?php if (!$this->currentNew['picture_display'] && $this->currentNew['picture'] != '') { ?>
        <a class="gallery" href="/<?php echo $this->currentNew['picture']; ?>b.jpg"><img class="img-detailed" style="margin-bottom: 0;" alt="" src="/<?php echo $this->currentNew['picture']; ?>p.jpg" /></a>
        <?php } ?>
        <?php for ($i = 1; $i <= 5; $i++) { ?>
        <?php if ($this->currentNew['picture' . $i] != '') { ?>
        <a class="gallery" href="/<?php echo $this->currentNew['picture' . $i]; ?>b.jpg"><img class="img-detailed" alt="" src="/<?php echo $this->currentNew['picture' . $i]; ?>p.jpg" /></a>
        <?php } ?>
        <?php } ?>
    </div>

    <div><?php if ($this->currentNew['text'] == '') echo $this->currentNew['short']; else echo $this->currentNew['text']; ?></div>
</div>