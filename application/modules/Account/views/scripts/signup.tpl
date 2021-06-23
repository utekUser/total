<?php /* <div class="path">
	<a href="/"><img alt="" src="/themes/default/images/house.png" /></a>
	<span>Регистрация</span>
</div>
<h2><?php echo Engine_Application::getPageHeader(); ?></h2> */ ?>
<script type="text/javascript">
$(document).ready(function() {
    $('.account-type').click(function() {
        var input = $(this).parent().find('input');
        if (input.attr('checked') != 'checked') input.attr('checked', 'checked');
    });
});
</script>
<style>
label {
	text-decoration: underline; font-family: Arial; font-size: 12px; color: #00aaf0; cursor: pointer;
}
label:hover {
	color: #5b5b5b;
}
</style>
<div>
<p style="font-family: Arial; font-size: 12px; text-align: justify;">Регистрация нового пользователя под физическим лицом позволяет заказывать продукцию в обычном режиме (розничные цены). 
Выбор и заказ продукции происходит сразу после заполнения анкеты и подтверждения регистрации.</p>
<p style="font-family: Arial; font-size: 12px; text-align: justify;">Регистрация нового пользователя под организацией предназначена для оптовых покупателей, магазинов, автосервисов и т.д. 
Выбор и заказ продукции, доступ к личному кабинету для организации – будет доступен после того, как наш менеджер свяжется с вами для подтверждения данных.</p>
</div>
<?php if (sizeof($this->error)) { ?>
  <div class="error-list"><?php foreach ($this->error as $error) echo $error . '<br />'; ?></div>
<?php } ?>
<div class="make-account">
	<?php  /* <div class="grey-corner-tl">
		<div class="grey-corner-tr">
			<div class="grey-corner-tm"></div>
		</div>
	</div> */ ?>
	<div class="grey-corner-m" style="background: transparent;">
		<form method="post" action="/account/signup/">
			<?php /* <p><b>Завести аккаунт:</b></p> */ ?>
			<div style="float: left; margin: 0 20px 0 0; height: 50px;" >
				<input type="radio" id="acc0" name="account" value="1" <?php if ($this->account == 1 || !$this->account) echo 'checked="checked"'; ?> /><label for="acc0">Для физического лица</label>
			</div>
                        <div style="float: left; margin: 0 ; height: 50px; width: 460px;" >
				<input type="radio" id="acc1" name="account" value="2" <?php if ($this->account == 2) echo 'checked="checked"'; ?> /><label for="acc1">Для организации</label> <span style="font-family: Arial; font-size: 12px;">(для юридического лица и индивидуального предпринимателя (ИП))</span>
			</div>
			<?php if (false) { ?>
			<p class="razd-grey"></p>
			<p><input type="checkbox" name="agree" value="1" />
				Я ознакомлен со всеми условиями, на которых будут оказаны услуги и согласен с ними. <a href="#">Полный список документов</a>
			</p>
			<?php } ?>
<br style="clear: left;" />
			<?php /* <p class="razd-grey"></p> */ ?>
			<p><input type="submit" class="fill-in" value="Заполнить" /></p>
		</form>
	</div>
	<?php /* <div class="grey-corner-bl">
		<div class="grey-corner-br">
			<div class="grey-corner-bm"></div>
		</div>
	</div> */ ?>
</div>