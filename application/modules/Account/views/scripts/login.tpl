<?php /* <div class="path">
<a href="/"><img alt="" src="/themes/default/images/house.png" /></a>
<span>Авторизация</span>
</div> */ ?>
<h2>Авторизация</h2>
<div class="auth-info">В данном разделе Вы можете ввести свой индивидуальный код, выданный Вам при первичном обслуживании в нашем автосервисе, и посмотреть историю обслуживания.</div>
<?php if($this->error) { ?>
<div class="error-message">
    <div class="block-orange-tl">
        <div class="block-orange-tr">
            <div class="block-orange-tm"></div>
        </div>
    </div>
    <div class="block-orange-ml">
        <div class="block-orange-mr">
            <div class="block-orange-mm"><?php foreach ($this->error as $error) echo "$error\n"; ?></div>
        </div>
    </div>
    <div class="block-orange-bl">
        <div class="block-orange-br">
            <div class="block-orange-bm"></div>
        </div>
    </div>
</div>
<?php } ?>
<style>
    .auth-form {
        margin: 20px 0 0 35px;
    }
    div.field input{
        background: none;
        border: 1px solid #c3c3c3;
        border-radius: 2px;
        font-family: OfficinaSansCBook;
        font-size: 13px;
        font-weight: normal;
        height: 25px;
        padding: 4px 10px;
    }
    .auth-form .field {
        margin: 0 40px 0 0;
    }
    div.field div, div.field div div, div.field {
        background: transparent;
        height: 45px;
        padding: 0;
    }
    .auth-form input[type="submit"] {
        background: url(/themes/default/images/newdesign/send.png);
        width: 96px;
        height: 31px;
        border: 0px;
    }
    .auth-form input[type="submit"]:hover {
        background: url(/themes/default/images/newdesign/sendh.png);
    }
    .remember-me {
        overflow: hidden;
        margin: 0 0 13px 0px;
    }
    .auth-form .link, .remember-me {
        font-size: 12px;
        margin: 5px 0;
    }
</style>
<form action="/account/login/" method="post" class="auth-form">
    <div class="form-auth-row">
        <?php /* <div class="title">Логин:</div> */ ?>
        <div class="field"><div><div class="inpNew"><input type="text" value="" name="login" placeholder="Логин:"></div></div></div>
        <div class="link"><a href="/account/signup/">Регистрация</a></div>
    </div>	
    <div class="form-auth-row">
        <?php /* <div class="title">Пароль:</div> */ ?>
        <div class="field"><div><div class="inpNew"><input type="password" value="" name="password" placeholder="Пароль:"></div></div></div>
        <div class="link"><a href="/account/restore/">Забыли пароль?</a></div>
    </div>
    <div class="remember-me">
        <input type="checkbox" name="remember" checked="checked">
        <a href="#">Оставаться в системе</a> 
    </div>
    <?php /* <div class="page-razd"></div> */ ?>
    <input type="submit" value="Войти" class="submitbuttonW" />
</form>