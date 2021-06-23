<style>
    .registrationWrapper p {
        font-family: Arial;
        color: #8b8c8d;
	font-size: 12px;
        margin: 0 0 10px 0px;
        width: 600px;
    }
    .grey-corner-m {
        padding-left: 0px;
    }
    div.input-field input, textarea.input-long {
        background: none;
        border: 1px solid #c3c3c3;
        border-radius: 2px;
        font-family: OfficinaSansCBook;
        font-size: 13px;
        font-weight: normal;
        width: 500px;
    }
    .reg-form {
        width: auto;
    }
    .grey-corner-m {
        background: transparent;
    }
    .field-data span {
        font-weight: bold;
        font-size: 14px;
        font-family: OfficinaSansCBook;
        color: #8b8c8d;
    }
    .almost-h2 {
        text-transform: uppercase;
        font-weight: bold;
        margin: 10px 0;
        color: #606060;
        font-size: 15px;
    }
	.inputRed{
		border:1px solid #ff4040 !important;
		background: #ffcece !important;
	}
	.inputGreen{
		border:1px solid #83c954 !important;
		background: #e8ffce !important;
	}
</style>
<div class="registrationWrapper">
	<h2 style="text-transform: uppercase;">Регистрация юридического лица</h2>
    <p><strong>Заполнение анкеты для заключения договора юридическим лицом</strong></p>
    <p>Просим Вас при заполнении анкеты использовать информацию, которая в случае необходимости может быть подтверждена документально.</p>
    <p>Знаком <span class="orandzh">*</span> отмечены обязательные для заполнения поля</p>
    <form method="post" action="/account/signup/2/">
        <input type="hidden" name="type" value="1" />
        <input type="hidden" name="active" value="1" />
        <input type="hidden" name="access" value="0" />
        <div class="reg-form">
            <div class="grey-corner-m">
                <div class="form-field">
                    <div class="field-data">                         
                        <div class="input-field"><?php echo $this->user->login; ?></div>
                    </div>
                    <div class="field-info">
                        <!--Заполняется в соответствии с паспортными данными
                        <div class="field-info-example">
                                <span>Пример:</span><br />
                                <em>Сидоров Сидор Сидорович</em>
                        </div>-->
                    </div>
                </div>
                <?php
                $error = $this->user->login->getMessages();
                if (!empty($error)) { ?>
                <div class="error-list">
                    <ul>
                        <?php foreach ($error as $keyError => $valueError) { ?> <li><?php echo $valueError; ?></li><?php } ?>
                    </ul>
                </div>
                <?php } ?>
                <div class="form-field">
                    <div class="field-data">                             
                        <div class="input-field"><?php echo $this->user->email; ?></div>
                    </div>
                    <div class="field-info"></div>
                </div>
                <?php
                $error = $this->user->email->getMessages();
                if (!empty($error)) { ?>
                <div class="error-list"><ul>
                        <?php foreach ($error as $keyError => $valueError) { ?> <li><?php echo $valueError; ?></li><?php } ?>
                    </ul></div>
                <?php } ?>
                <div class="form-field">
                    <div class="field-data">                         
                        <div class="input-field"><?php echo $this->info->name; ?></div>
                    </div>
                    <div class="field-info"></div>
                </div>
                <?php
                $error = $this->info->name->getMessages();
                if (!empty($error)) { ?>
                <div class="error-list"><ul>
                        <?php foreach ($error as $keyError => $valueError) { ?> <li><?php echo $valueError; ?></li><?php } ?>
                    </ul></div>
                <?php } ?>

                <div class="form-field">
                    <div class="field-data">                             
                        <div class="input-field"><?php echo $this->info->phone; ?></div>
                    </div>
                    <div class="field-info"></div>
                </div>
                <?php
                $error = $this->info->phone->getMessages();
                if (!empty($error)) { ?>
                <div class="error-list">
                    <ul>
                        <?php foreach ($error as $keyError => $valueError) { ?> <li><?php echo $valueError; ?></li><?php } ?>
                    </ul>
                </div>
                <?php } ?>
                <div class="almost-h2">Реквизиты</div>
                <div class="form-field">
                    <div class="field-data">                          
                        <div class="input-field"><?php echo $this->info->title; ?></div>
                    </div>
                    <div class="field-info"></div>
                </div>
                <?php
                $error = $this->info->title->getMessages();
                if (!empty($error)) { ?>
                <div class="error-list">
                    <ul>
                        <?php foreach ($error as $keyError => $valueError) { ?> <li><?php echo $valueError; ?></li><?php } ?>
                    </ul>
                </div>
                <?php } ?>
                <div class="form-field">
                    <div class="field-data">                          
                        <div class="input-field"><?php echo $this->info->ur_address; ?></div>
                    </div>
                    <div class="field-info"></div>
                </div>
                <?php
                $error = $this->info->ur_address->getMessages();
                if (!empty($error)) { ?>
                <div class="error-list">
                    <ul>
                        <?php foreach ($error as $keyError => $valueError) { ?> <li><?php echo $valueError; ?></li><?php } ?>
                    </ul>
                </div>
                <?php } ?>
                <div class="form-field">
                    <div class="field-data">                         
                        <div class="input-field"><?php echo $this->info->fact_address; ?></div>
                    </div>
                    <div class="field-info"></div>
                </div>
                <?php
                $error = $this->info->fact_address->getMessages();
                if (!empty($error)) { ?>
                <div class="error-list">
                    <ul>
                        <?php foreach ($error as $keyError => $valueError) { ?> <li><?php echo $valueError; ?></li><?php } ?>
                    </ul>
                </div>
                <?php } ?>
                <div class="form-field">
                    <div class="field-data">                          
                        <div class="input-field"><?php echo $this->info->ogrn; ?></div>
                    </div>
                    <div class="field-info"></div>
                </div>
                <?php
                $error = $this->info->ogrn->getMessages();
                if (!empty($error)) { ?>
                <div class="error-list">
                    <ul>
                        <?php foreach ($error as $keyError => $valueError) { ?> <li><?php echo $valueError; ?></li><?php } ?>
                    </ul>
                </div>
                <?php } ?>
                <div class="form-field">
                    <div class="field-data">                          
                        <div class="input-field"><?php echo $this->info->inn; ?></div>
                    </div>
                    <div class="field-info"></div>
                </div>
                <?php
                $error = $this->info->inn->getMessages();
                if (!empty($error)) { ?>
                <div class="error-list">
                    <ul>
                        <?php foreach ($error as $keyError => $valueError) { ?> <li><?php echo $valueError; ?></li><?php } ?>
                    </ul>
                </div>
                <?php } ?>
                <div class="form-field">
                    <div class="field-data">                         
                        <div class="input-field"><?php echo $this->info->bank; ?></div>
                    </div>
                    <div class="field-info"></div>
                </div>
                <?php
                $error = $this->info->bank->getMessages();
                if (!empty($error)) { ?>
                <div class="error-list">
                    <ul>
                        <?php foreach ($error as $keyError => $valueError) { ?> <li><?php echo $valueError; ?></li><?php } ?>
                    </ul>
                </div>
                <?php } ?>
                <div class="form-field">
                    <div class="field-data">
                         <div class="input-field"><?php echo $this->info->kpp; ?></div>
                    </div>
                    <div class="field-info"></div>
                </div>
                <?php
                $error = $this->info->kpp->getMessages();
                if (!empty($error)) { ?>
                <div class="error-list">
                    <ul>
                        <?php foreach ($error as $keyError => $valueError) { ?> <li><?php echo $valueError; ?></li><?php } ?>
                    </ul>
                </div>
                <?php } ?>
                <div class="form-field">
                    <div class="field-data">                              
                        <div class="input-field"><?php echo $this->info->rs; ?></div>
                    </div>
                    <div class="field-info"></div>
                </div>
                <?php
                $error = $this->info->rs->getMessages();
                if (!empty($error)) { ?>
                <div class="error-list">
                    <ul>
                        <?php foreach ($error as $keyError => $valueError) { ?> <li><?php echo $valueError; ?></li><?php } ?>
                    </ul>
                </div>
                <?php } ?>
                <div class="form-field">
                    <div class="field-data">                         
                        <div class="input-field"><?php echo $this->info->ks; ?></div>
                    </div>
                    <div class="field-info"></div>
                </div>
                <?php
                $error = $this->info->ks->getMessages();
                if (!empty($error)) { ?>
                <div class="error-list">
                    <ul>
                        <?php foreach ($error as $keyError => $valueError) { ?> <li><?php echo $valueError; ?></li><?php } ?>
                    </ul>
                </div>
                <?php } ?>
                <div class="form-field">
                    <div class="field-data">                               
                        <div class="input-field"><?php echo $this->info->bik; ?></div>
                    </div>
                    <div class="field-info"></div>
                </div>
                <?php
                $error = $this->info->bik->getMessages();
                if (!empty($error)) { ?>
                <div class="error-list">
                    <ul>
                        <?php foreach ($error as $keyError => $valueError) { ?> <li><?php echo $valueError; ?></li><?php } ?>
                    </ul>
                </div>
                <?php } ?>
                <div class="form-field">
                    <div class="field-data">                                    
                        <div class="input-field"><?php echo $this->info->okpo; ?></div>
                    </div>
                    <div class="field-info"></div>
                </div>
                <?php
                $error = $this->info->okpo->getMessages();
                if (!empty($error)) { ?>
                <div class="error-list">
                    <ul>
                        <?php foreach ($error as $keyError => $valueError) { ?> <li><?php echo $valueError; ?></li><?php } ?>
                    </ul>
                </div>
                <?php } ?>
                <div class="form-field">
                    <div class="field-data">                                  
                        <div class="field-input"><?php echo $this->info->info; ?></div>
                    </div>
                    <div class="field-info"></div>
                </div>
                <?php
                $error = $this->info->info->getMessages();
                if (!empty($error)) { ?>
                <div class="error-list">
                    <ul>
                        <?php foreach ($error as $keyError => $valueError) { ?> <li><?php echo $valueError; ?></li><?php } ?>
                    </ul>
                </div>
                <?php } ?>
            </div>
        </div>
        <div>
            <p>
                Выберите пароль, который Вы будете использовать для доступа в раздел "Для клиентов" 
                для заказа и настройки услуг:
            </p>
        </div>
        <div class="reg-form">
            <div class="grey-corner-m">
                <div class="form-field">
                    <div class="field-data">                              
                        <div class="input-field"><?php echo $this->user->password; ?></div>
                        <?php
                        $error = $this->user->password->getMessages();
                        if (!empty($error)) { ?>
                        <div class="error-list"><ul>
                                <?php foreach ($error as $keyError => $valueError) { ?> <li><?php echo $valueError; ?></li><?php } ?>
                            </ul></div>
                        <?php } ?>                              
                        <div class="input-field"><?php echo $this->user->verifypassword; ?></div>
                        <?php
                        $error = $this->user->verifypassword->getMessages();
                        if (!empty($error)) { ?>
                        <div class="error-list"><ul>
                                <?php foreach ($error as $keyError => $valueError) { ?> <li><?php echo $valueError; ?></li><?php } ?>
                            </ul></div>
                        <?php } ?>
                    </div>
                    <div class="field-info">
                        <p style="margin-left: 0px;">Разрешается использовать только латинские буквы и цифры.</p>							
                    </div>
                </div>
            </div>
        </div>
        <div><input type="submit" class="send-form" value="Отправить анкету" /></div>
    </form>
</div>
<script type="text/javascript">
var login, email, loginStat, emailStat;
$(function(){
	$("#login").change(function(){
		login =  $("#login").val();
		var expLogin = /^[a-zA-Z0-9_]+$/g;
		var resLogin =  login.search(expLogin);
		if(resLogin ==  -1) {
			$("#login").next().hide().text("Неверный  логин").css("color","red").
			fadeIn(400);
			$("#login").removeClass().addClass("inputRed");
			loginStat  = 0;
			/*buttonOnAndOff();*/
		} else {
			$.ajax({
				url:  "/account/checklogin",
				type:  "GET",
				data:  "login=" + login,
				cache:  false,
				success:  function(response) {					
					if(response  == "yes") {
						$("#login").next().hide().text("Логин уже существует").css("color","red").fadeIn(400);
						$("#login").removeClass().addClass("inputRed");						
					} else {
						$("#login").removeClass().addClass("inputGreen");
						$("#login").next().text("");
					}                                             
				}
			});
			loginStat  = 1;
			/*buttonOnAndOff();*/
		}
	});
	$("#login").keyup(function(){
		$("#login").removeClass();
		$("#login").next().text("");
	});
	$("#email").change(function(){
		email =  $("#email").val();
		/*var expLogin = ^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$;
		var resLogin =  email.search(expLogin);
		if(resLogin ==  -1) {
			$("#email").next().hide().text("Неверный e-mail").css("color","red").
			fadeIn(400);
			$("#email").removeClass().addClass("inputRed");
			loginStat  = 0;
			/*buttonOnAndOff();*
		} else {*/
			$.ajax({
				url:  "/account/checkemail",
				type:  "GET",
				data:  "email=" + email,
				cache:  false,
				success:  function(response) {					
					if(response  == "yes") {
						$("#email").next().hide().text("E-mail уже существует").css("color","red").fadeIn(400);
						$("#email").removeClass().addClass("inputRed");						
					} else {
						$("#email").removeClass().addClass("inputGreen");
						$("#email").next().text("");
					}                                             
				}
			});
			loginStat  = 1;
			/*buttonOnAndOff();*/
		/*}*/
	});
	$("#email").keyup(function(){
		$("#email").removeClass();
		$("#email").next().text("");
	});
	/*function  buttonOnAndOff(){
		if(emailStat == 1 && loginStat  == 1){
			$("#submit").removeAttr("disabled");
		}  {
			$("#submit").attr("disabled","disabled");
		}
	}*/
});
</script>