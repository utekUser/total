<?php if (!empty($this->error)) { ?>
    <?php foreach ($this->error as $key => $value) { ?>
        <div class="error-t"></div>
        <div class="error-m">
        	<b>ОШИБКА:</b>
        	<?php echo $value; ?>
        	<?php if ($key === "password") { ?><br /><a href="#">Потеряли пароль?</a><?php } ?>
        </div>
        <div class="error-b" style="margin-bottom:10px;"></div>
    <?php } ?>
<?php } ?>

<div class="form-t"></div>
<div class="form-m">
	<form method="post" action="" id="loginform" name="loginform">
        <p>
        <label>Имя пользователя<br />
        <input type="text" tabindex="10" size="20" value="<?php echo htmlspecialchars($_POST['login']); ?>" class="input" id="user_login" name="login" /></label>
        </p>
        <p>
            <label>Пароль<br />
                <input type="password" tabindex="20" size="20" value="" class="input" id="user_pass" name="password" />
            </label>
        </p>
<!--        <p class="forgetmenot">
            <label>
                <input type="checkbox" tabindex="90" id="remember" name="remember" <?php echo (isset($_POST['remember']) ? 'checked="checked"' : ''); ?> /> Запомнить меня
            </label>
        </p>-->
        <p class="submit">
            <button class="button-primary">Войти</button>
<!--                <input type="submit" tabindex="100" value="Войти" class="button-primary" id="wp-submit" name="wp-submit">-->
        </p>
    </form>
</div>
<div class="form-b"></div>

<div id="nav" style="margin-bottom:40px;">
	<a title="Восстановление пароля" href="#">Забыли пароль?</a>
</div>