<div class="breadcrumbsDesign">
    <p>
        <a href="/" title="Главная">
            <span class="bold">Главная</span>
        </a> » 
        <a href="/news/" title="<?php echo Engine_Application::getPageHeader(); ?>">
            <span class="underline"><?php echo Engine_Application::getPageHeader(); ?></span>
        </a>
    </p>
</div>
<?php /* <div class="path">
    <a href="/"><img alt="" src="/themes/default/images/house.png" /></a>
    <span><?php echo Engine_Application::getPageHeader(); ?></span>
</div> */ ?>
<h2 style="padding-top: 20px;"><?php echo Engine_Application::getPageHeader(); ?></h2>
<?php foreach ($this->paginator as $news) { ?>
<div class="news-main">
    <?php if($news['picture'] != '') { ?>
    <div class="news-photo" style="position: relative;">
        <a href="/news/<?php echo ($news['url'] ? $news['url'] . '-' : '') . $news['id'] . '.html'; ?>">
            <img alt="" src="/<?php echo $news['picture']; ?>p.jpg" />
            <?php if ($news['stock']) { ?><img style="border: 0; position: absolute; bottom: 0;" src="/images/stock.png" /><?php } ?>
        </a>
    </div>
    <?php } ?>
    <span class="news-date"><img src="/themes/default/images/newdesign/clock.png" /> <?php echo $this->Date($news['posted'], 'date'); ?></span>
    <span class="news-views"><img src="/themes/default/images/newdesign/eye.png" /> <?php echo $news['view']; ?></span>
    <div class="news-a"><?php echo $this->Link('/news/' . ($news['url'] ? $news['url'] . '-' : '') . $news['id'] . '.html', $news['name']); ?></div>
    <div><?php echo $news['short']; ?></div>
</div>
<?php } ?>
<?php if($this->paginator->count() > 1) { ?>
<div class="page-razd"></div>
<?php echo $this->paginationControl($this->paginator, 'Sliding', 'user-page.tpl'); ?>
<?php } ?>