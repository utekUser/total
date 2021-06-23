<div class="path">
	<a href="/"><img alt="" src="/themes/default/images/house.png" /></a>
	<a href="/control/profile/">Личный кабинет</a>
	<a href="/control/notice">Уведомления</a>
	<span><?php echo $this->notice->name; ?></span>
</div>
<h2><?php echo $this->notice->name; ?></h2>
<p><?php echo $this->notice->message; ?></p>