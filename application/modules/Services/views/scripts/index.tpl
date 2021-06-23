<h1><?php echo Engine_Application::getPageHeader(); ?></h1>
<div class="block-razd"></div>
<div class="chain">
	<a href="/">Главная</a>
	Услуги
</div>
<?php foreach ($this->paginator as $services) { ?>
<div class="block-razd"></div>
<div class="block services">
	<div class="block-title">
		<?php echo $this->Link('/services/' . ($services['url'] ? $services['url'] . '-' : '') . $services['id'] . '.html', $services['name']); ?>
	</div>
	<?php echo $services['short']; ?>
<!--	<div class="block-more">
		?php echo $this->Link('/services/' . ($services['url'] ? $services['url'] . '-' : '') . $services['id'] . '.html', 'Подробнее'); ?>
	</div>-->
</div>
<?php } ?>
<?php if($this->paginator->count() > 1) { ?>
    <div class="main-razd"></div>
    <?php echo $this->paginationControl($this->paginator, 'Sliding', 'pagination/user-page.tpl'); ?>
<?php } ?>