<div class="artickle-path">Выбор раздела: <a href="/articles/">Все разделы</a></div>
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
<div style="margin-bottom:15px;"></div>
<?php foreach ($this->paginator as $someArticle) { ?>
<div class="news-main">
    <?php if($someArticle['picture'] != '') { ?>
    <div class="news-photo">
        <a href="<?php echo '/articles/' . $section[$someArticle['section_id']] . '/' . ($someArticle['url'] ? $someArticle['url'] . '-' : '') . $someArticle['id'] . '.html'; ?>">
            <img style="border: 0px;" alt="" src="/<?php echo $someArticle['picture']; ?>p.jpg" />
        </a>
    </div>
    <?php } ?>
    <span class="news-date" style="color: #939495; font-family: Arial; font-size: 11px; font-weight: normal;"><img src="/themes/default/images/newdesign/clock.png" /> <?php echo $this->Date($someArticle['posted'], 'date'); ?></span>
    <span class="news-views"><img src="/themes/default/images/newdesign/eye.png" /> <?php echo $someArticle['view']; ?></span>
    <div class="news-a"><?php echo $this->Link('/articles/' . $section[$someArticle['section_id']] . '/' . ($someArticle['url'] ? $someArticle['url'] . '-' : '') . $someArticle['id'] . '.html', $someArticle['name']); ?></div>
    <div><p><?php echo $someArticle['short']; ?></p></div>
    <?php /* <div class="detailed"><?php echo $this->Link('/articles/' . $section[$someArticle['section_id']] . '/' . ($someArticle['url'] ? $someArticle['url'] . '-' : '') . $someArticle['id'] . '.html', 'Подробнее'); ?></div> */ ?>
</div>
<?php } ?>
<?php if($this->paginator->count() > 1) { ?>
<div class="newPaginator">
<?php echo $this->paginationControl($this->paginator, 'Sliding', 'user-page.tpl'); ?>
</div>
<?php } ?>