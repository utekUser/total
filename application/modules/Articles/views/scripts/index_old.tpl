<div class="breadcrumbsDesign">
    <p>
        <a href="/" title="Главная">
            <span class="bold">Главная</span>
        </a> » 
        <a href="/articles/" title="<?php echo Engine_Application::getPageHeader(); ?>">
            <span class="underline"><?php echo Engine_Application::getPageHeader(); ?></span>
        </a>
    </p>
</div>
<?php /* <div class="path">
<a href="/"><img alt="" src="/themes/default/images/house.png" /></a>
<span><?php echo Engine_Application::getPageHeader(); ?></span>
</div> */ ?>
<h2 style="padding-top: 20px;"><?php echo Engine_Application::getPageHeader(); ?></h2>
<div class="artickle-path">Выбор раздела: <a href="/articles/">Все разделы</a></div>
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
            <li><?php echo $this->Link('/articles/' . $sectionValue['url'] . '/', $sectionValue['name'], $sectionValue['name']); ?><span>(<?php echo $sectionValue['amount']; ?>)</span></li>
		<?php } ?>
        <?php } ?>
    </ul>
</div>
<div class="page-razd" style="margin-bottom:15px;"></div>
<?php foreach ($this->paginator as $someArticle) { ?>
<div class="news-main">
    <?php if($someArticle['picture'] != '') { ?>
    <div class="news-photo">
        <a href="<?php echo '/articles/' . $section[$someArticle['section_id']] . '/' . ($someArticle['url'] ? $someArticle['url'] . '-' : '') . $someArticle['id'] . '.html'; ?>">
            <img alt="" src="/<?php echo $someArticle['picture']; ?>p.jpg" />
        </a>
    </div>
    <?php } ?>
    <span class="news-date"><img src="/themes/default/images/newdesign/clock.png" /> <?php echo $this->Date($someArticle['posted'], 'date'); ?></span>
    <span class="news-views"><img src="/themes/default/images/newdesign/eye.png" /> <?php echo $someArticle['view']; ?></span>
    <div class="news-a"><?php echo $this->Link('/articles/' . $section[$someArticle['section_id']] . '/' . ($someArticle['url'] ? $someArticle['url'] . '-' : '') . $someArticle['id'] . '.html', $someArticle['name']); ?></div>
    <div><?php echo $someArticle['short']; ?></div>
    <div class="detailed"><?php echo $this->Link('/articles/' . $section[$someArticle['section_id']] . '/' . ($someArticle['url'] ? $someArticle['url'] . '-' : '') . $someArticle['id'] . '.html', 'Подробнее'); ?></div>
</div>
<?php } ?>
<?php if($this->paginator->count() > 1) { ?>
<div class="page-razd"></div>
<?php echo $this->paginationControl($this->paginator, 'Sliding', 'user-page.tpl'); ?>
<?php } ?>