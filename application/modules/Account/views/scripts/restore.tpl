<?php /* <div class="path">
<a href="/"><img alt="" src="/themes/default/images/house.png" /></a>
<span>Восстановление пароля</span>
</div> */ ?>
<h2 style="text-transform: uppercase;">Восстановление пароля</h2>
<style>
    .auth-form input[type="submit"] {
        background: url(/themes/default/images/newdesign/send.png);
        width: 96px;
        height: 31px;
        border: 0px;
    }
    .auth-form input[type="submit"]:hover {
        background: url(/themes/default/images/newdesign/sendh.png);
    }
</style>
<?php if($this->error) { ?>
<div class="error-message">
    <div class="block-orange-tl">
        <div class="block-orange-tr">
            <div class="block-orange-tm"></div>
        </div>
    </div>
    <div class="block-orange-ml">
        <div class="block-orange-mr">
            <div class="block-orange-mm"><?php foreach ($this->error as $error) echo "$error<br />"; ?></div>
        </div>
    </div>
    <div class="block-orange-bl">
        <div class="block-orange-br">
            <div class="block-orange-bm"></div>
        </div>
    </div>
</div>
<?php } ?>
<?php if($this->newPassError) { ?>
<div class="error-message">
    <div class="block-orange-tl">
        <div class="block-orange-tr">
            <div class="block-orange-tm"></div>
        </div>
    </div>
    <div class="block-orange-ml">
        <div class="block-orange-mr">
            <div class="block-orange-mm"><?php foreach ($this->newPassError as $error) echo "$error\n"; ?></div>
        </div>
    </div>
    <div class="block-orange-bl">
        <div class="block-orange-br">
            <div class="block-orange-bm"></div>
        </div>
    </div>
</div>
<?php } ?>
<?php //if($this->successMessage) { ?>
<?php //echo $this->successMessage; ?>
<?php //} else
if ($this->mode == 'restore' && !$this->error) { ?>
<form action="" method="post" class="auth-form" id="kcaptchaimg">
    <div class="form-auth-row new-pass">
        <div class="title">Новый пароль:</div>
        <div class="field new-email"><div><div><input type="password" value="" name="password" /></div></div></div>
    </div>
    <div class="form-auth-row new-pass">
        <div class="title">Повторите пароль:</div>
        <div class="field input-small"><div><div><input type="password" value="" name="repeatpassword" /></div></div></div>
    </div>
    <input type="submit" value="Отправить" class="restore" />
    <!--<div class="book-form">
                <div class="book-form-title"><b>Новый пароль:</b></div>
                <div class="book-form-input">
                        <input type="password" class="book-input-i" name="password" value="" />
                </div>
        </div>
         <div class="book-form">
                <div class="book-form-title"><b>Повторите пароль:</b></div>
                <div class="book-form-input">
                        <input type="password" class="book-input-i" name="repeatpassword" value="" />
                </div>
        </div>
        <div class="book-form">
                <div class="book-form-title">&nbsp;</div>
                <div class="book-form-input">
                        <span class="art-button-wrapper">
                            <span class="art-button-l"></span>
                            <span class="art-button-r"></span>
                            <input type="submit" class="button art-button" name="button" value="Отправить">
                    </span>
                </div>
        </div>-->
</form>
<?php }elseif ($this->mode == 'newpassword') { ?>
<p>Ваш пароль успешно изменен!</p>
<p>Теперь вы можете <a href="/account/login/" title="Войти на сайтт">войти на сайт</a>, используя новый пароль.</p>
<?php } elseif(!$this->mode) { ?>
<div class="auth-info">Если вы забыли пароль, введите логин или e-mail, указанные вами при регистрации.<br/>
    Информация для смены пароля будет выслана вам по e-mail.</div>
<form action="/account/restore/" method="post" class="auth-form">
    <div class="form-auth-row restore-pass">
        <?php /* <div class="title">Логин или e-mail:</div> */ ?>
        <div class="field new-email"><div><div><input type="text" placeholder="Логин или e-mail:" value="<?php echo (isset($this->search) ? $this->search : ''); ?>" name="email" /></div></div></div>
        <div class="link"><a href="/account/login/">Я вспомнил пароль!</a></div>
        <?php /* <div class="page-razd"></div> */ ?>
    </div>
    <script>
        function call() {
            $.ajax({
                type: 'POST',
                url: '/externals/kcaptcha/?<?php echo session_name(); ?>=<?php echo session_id(); ?>',
                success: function (data) {
                    $("#kcaptchaimg1").attr("src", "/externals/kcaptcha/?<?php echo session_name(); ?>=<?php echo session_id(); ?>");
                },
                error: function (xhr, str) {
                    alert('Возникла ошибка: ' + xhr.responseCode);
                }
            });
        }
    </script>
    <div class="form-auth-row restore-pass">                                                                         
        <?php /* <div class="title">Код защиты:</div> */ ?>
        <div class="field input-small" style="float: none;"><div><div><input type="text" value="" autocomplete="off" name="captcha" placeholder="Код защиты:" /></div></div></div>
        <img style="margin-left: 0px;" class="captcha" alt="kcaptcha" id="kcaptchaimg1" src="/externals/kcaptcha/?<?php echo session_name(); ?>=<?php echo session_id(); ?>" /><a href="#kcaptchaimg" onclick="call()"><img style="margin: 0 10px 0 0;" src="/themes/default/images/newdesign/refresharr.png" title="Обновить картинку" />Обновить картинку</a>
        <?php /* <div class="page-razd"></div> */ ?>
    </div>
    <?php
    /*$error = $this->elements['captcha']->getMessages();
    if (!empty($error)) { ?>
    <ul class="errorlist">
        <?php foreach ($error as $keyError => $valueError) { ?>
        <li><?php echo $valueError; ?></li>
        <?php } ?>
    </ul>
    <?php } */?>
    <input style="margin: 0;" type="submit" value="Отправить" class="restore" />
</form>
<?php } ?>