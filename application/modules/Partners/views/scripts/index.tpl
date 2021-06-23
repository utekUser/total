<h1><?php echo Engine_Application::getPageHeader(); ?></h1>
<div class="block-razd"></div>
<div class="chain">
	<a href="/">Главная</a>
	Партнеры
</div>
<div class="block-razd"></div>
<?php foreach ($this->paginator as $partner) { ?>
<div class="block">
    <?php if($partner['picture'] != '') { ?>
    <div class="picture">
       <a href="<?php echo '/partners/' . ($partner['url'] ? $partner['url'] . '-' : '') . $partner['id'] . '.html'; ?>">
        <img alt="" src="/<?php echo $partner['picture'] ?>p.jpg" />
       </a>
    </div>   
	<?php } ?>
	<div class="block-title">
		<?php echo $this->Link('/partners/' . ($partner['url'] ? $partner['url'] . '-' : '') . $partner['id'] . '.html', $partner['name']); ?>
	</div>
	<div class="block-text"><?php echo $partner['short']; ?></div>
	<div class="block-more">
		<?php echo $this->Link('/partners/' . ($partner['url'] ? $partner['url'] . '-' : '') . $partner['id'] . '.html', 'Подробнее'); ?>
	</div>
</div>
<?php } ?>
<?php if($this->paginator->count() > 1) { ?>
    <div class="main-razd"></div>
    <?php echo $this->paginationControl($this->paginator, 'Sliding', 'pagination/user-page.tpl'); ?>
<?php } ?>