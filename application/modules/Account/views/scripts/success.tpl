<div class="path">
	<a href="/"><img alt="" src="/themes/default/images/house.png" /></a>
	<span>Регистрация</span>
</div>
<h1>Регистрация успешна</h1>
<p>Спасибо за регистрацию на нашем сайте!</p>
<?php if ($this->user == 'fiz') { ?>
<p>Теперь вы можете <a href="/account/login/">войти в личный кабинет</a></p>
<?php } elseif ($this->user = 'ur') { ?>
<p>Пожалуйста, дождитесь одобрения вашего аккаунта. Администратор сайта свяжется с Вами в ближайшее время.</p>
<p>&nbsp;</p>
<p>Вернуться <a href="/">на главную</a></p>
<?php } ?>
