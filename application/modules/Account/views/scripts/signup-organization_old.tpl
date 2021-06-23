<?php if ($_SERVER['REMOTE_ADDR'] == '78.140.9.206' || $_SERVER['REMOTE_ADDR'] == '46.161.158.155' || $_SERVER['REMOTE_ADDR'] == '88.204.72.104' || $_SERVER['REMOTE_ADDR'] == '95.170.159.81') { ?>
<?php /* <div class="path">
<a href="/"><img alt="" src="/themes/default/images/house.png" /></a>
<span>Регистрация юридического лица</span>
</div>
<h1>Регистрация юридического лица</h1>

<div style="float: right; width: 240px; margin: 110px 0 0;">
<p>Компания «Томавтотрейд» никогда и ни при каких условиях не разглашает личные данные своих клиентов.</p>
<p>Ваша информация будет использована лишь для оформления заказов и более удобной работы с сайтом.</p>
</div> */ ?>
<style>
    .registrationWrapper p {
        font-family: OfficinaSansCBook;
        color: #8b8c8d;
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
</style>
<div class="registrationWrapper">
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
                        <span>Логин </span><span class="orandzh">*</span>
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
                        <span>E-mail </span><span class="orandzh">*</span>
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
                        <span>Контактное имя </span><span class="orandzh">*</span>
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
                        <span>Телефон </span><span class="orandzh">*</span>
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
                        <span>Наименование организации </span><span class="orandzh">*</span>
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
                        <span>Юридический адрес </span><span class="orandzh">*</span>
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
                        <span>Фактический адрес (адрес доставки по умолчанию) </span><span class="orandzh">*</span>
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
                        <span>ОГРН </span><span class="orandzh">*</span>
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
                        <span>ИНН </span><span class="orandzh">*</span>
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
                        <span>Банк </span><span class="orandzh">*</span>
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
                        <span>КПП </span><span class="orandzh">*</span>
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
                        <span>Р/С </span><span class="orandzh">*</span>
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
                        <span>КС </span><span class="orandzh">*</span>
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
                        <span>БИК </span><span class="orandzh">*</span>
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
                        <span>ОКПО </span>
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
                        <span>Дополнительная информация:</span>
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
            <?php /* <div class="grey-corner-tl">
            <div class="grey-corner-tr">
            <div class="grey-corner-tm"></div>
            </div> */ ?>
            <div class="grey-corner-m">
                <div class="form-field">
                    <div class="field-data">
                        <span>Пароль </span><span class="orandzh">*</span>
                        <div class="input-field"><?php echo $this->user->password; ?></div>
                        <?php
                        $error = $this->user->password->getMessages();
                        if (!empty($error)) { ?>
                        <div class="error-list"><ul>
                                <?php foreach ($error as $keyError => $valueError) { ?> <li><?php echo $valueError; ?></li><?php } ?>
                            </ul></div>
                        <?php } ?>
                        <span>Подтверждение пароля </span><span class="orandzh">*</span>
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
            <?php /* <div class="grey-corner-bl">
            <div class="grey-corner-br">
            <div class="grey-corner-bm"></div>
            </div> */ ?>
        </div>
        <div><input type="submit" class="send-form" value="Отправить анкету" /></div>
    </form>
</div>
<?php } else { ?>
<div class="path">
    <a href="/"><img alt="" src="/themes/default/images/house.png" /></a>
    <span>Регистрация юридического лица</span>
</div>
<h1>Регистрация юридического лица</h1>

<div style="float: right; width: 240px; margin: 110px 0 0;">
    <p>Компания «Томавтотрейд» никогда и ни при каких условиях не разглашает личные данные своих клиентов.</p>
    <p>Ваша информация будет использована лишь для оформления заказов и более удобной работы с сайтом.</p>
</div>

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
                    <span>Логин </span><span class="orandzh">*</span>
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
            <div class="error-list"><ul>
                    <?php foreach ($error as $keyError => $valueError) { ?> <li><?php echo $valueError; ?></li><?php } ?>
                </ul></div>
            <?php } ?>



            <div class="form-field">
                <div class="field-data">
                    <span>E-mail </span><span class="orandzh">*</span>
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


            <?php //echo '<pre>'; print_r($this->elementsInfo); echo '</pre>'; ?>

            <div class="form-field">
                <div class="field-data">
                    <span>Контактное имя </span><span class="orandzh">*</span>
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
                    <span>Телефон </span><span class="orandzh">*</span>
                    <div class="input-field"><?php echo $this->info->phone; ?></div>
                </div>
                <div class="field-info"></div>
            </div>
            <?php
            $error = $this->info->phone->getMessages();
            if (!empty($error)) { ?>
            <div class="error-list"><ul>
                    <?php foreach ($error as $keyError => $valueError) { ?> <li><?php echo $valueError; ?></li><?php } ?>
                </ul></div>
            <?php } ?>



            <div class="almost-h2">Реквизиты</div>
            <div class="form-field">
                <div class="field-data">
                    <span>Наименование организации </span><span class="orandzh">*</span>
                    <div class="input-field"><?php echo $this->info->title; ?></div>
                </div>
                <div class="field-info"></div>
            </div>
            <?php
            $error = $this->info->title->getMessages();
            if (!empty($error)) { ?>
            <div class="error-list"><ul>
                    <?php foreach ($error as $keyError => $valueError) { ?> <li><?php echo $valueError; ?></li><?php } ?>
                </ul></div>
            <?php } ?>



            <div class="form-field">
                <div class="field-data">
                    <span>Юридический адрес </span><span class="orandzh">*</span>
                    <div class="input-field"><?php echo $this->info->ur_address; ?></div>
                </div>
                <div class="field-info"></div>
            </div>
            <?php
            $error = $this->info->ur_address->getMessages();
            if (!empty($error)) { ?>
            <div class="error-list"><ul>
                    <?php foreach ($error as $keyError => $valueError) { ?> <li><?php echo $valueError; ?></li><?php } ?>
                </ul></div>
            <?php } ?>



            <div class="form-field">
                <div class="field-data">
                    <span>Фактический адрес (адрес доставки по умолчанию) </span><span class="orandzh">*</span>
                    <div class="input-field"><?php echo $this->info->fact_address; ?></div>
                </div>
                <div class="field-info"></div>
            </div>
            <?php
            $error = $this->info->fact_address->getMessages();
            if (!empty($error)) { ?>
            <div class="error-list"><ul>
                    <?php foreach ($error as $keyError => $valueError) { ?> <li><?php echo $valueError; ?></li><?php } ?>
                </ul></div>
            <?php } ?>



            <div class="form-field">
                <div class="field-data">
                    <span>ОГРН </span><span class="orandzh">*</span>
                    <div class="input-field"><?php echo $this->info->ogrn; ?></div>
                </div>
                <div class="field-info"></div>
            </div>
            <?php
            $error = $this->info->ogrn->getMessages();
            if (!empty($error)) { ?>
            <div class="error-list"><ul>
                    <?php foreach ($error as $keyError => $valueError) { ?> <li><?php echo $valueError; ?></li><?php } ?>
                </ul></div>
            <?php } ?>



            <div class="form-field">
                <div class="field-data">
                    <span>ИНН </span><span class="orandzh">*</span>
                    <div class="input-field"><?php echo $this->info->inn; ?></div>
                </div>
                <div class="field-info"></div>
            </div>
            <?php
            $error = $this->info->inn->getMessages();
            if (!empty($error)) { ?>
            <div class="error-list"><ul>
                    <?php foreach ($error as $keyError => $valueError) { ?> <li><?php echo $valueError; ?></li><?php } ?>
                </ul></div>
            <?php } ?>



            <div class="form-field">
                <div class="field-data">
                    <span>Банк </span><span class="orandzh">*</span>
                    <div class="input-field"><?php echo $this->info->bank; ?></div>
                </div>
                <div class="field-info"></div>
            </div>
            <?php
            $error = $this->info->bank->getMessages();
            if (!empty($error)) { ?>
            <div class="error-list"><ul>
                    <?php foreach ($error as $keyError => $valueError) { ?> <li><?php echo $valueError; ?></li><?php } ?>
                </ul></div>
            <?php } ?>



            <div class="form-field">
                <div class="field-data">
                    <span>КПП </span><span class="orandzh">*</span>
                    <div class="input-field"><?php echo $this->info->kpp; ?></div>
                </div>
                <div class="field-info"></div>
            </div>
            <?php
            $error = $this->info->kpp->getMessages();
            if (!empty($error)) { ?>
            <div class="error-list"><ul>
                    <?php foreach ($error as $keyError => $valueError) { ?> <li><?php echo $valueError; ?></li><?php } ?>
                </ul></div>
            <?php } ?>



            <div class="form-field">
                <div class="field-data">
                    <span>Р/С </span><span class="orandzh">*</span>
                    <div class="input-field"><?php echo $this->info->rs; ?></div>
                </div>
                <div class="field-info"></div>
            </div>
            <?php
            $error = $this->info->rs->getMessages();
            if (!empty($error)) { ?>
            <div class="error-list"><ul>
                    <?php foreach ($error as $keyError => $valueError) { ?> <li><?php echo $valueError; ?></li><?php } ?>
                </ul></div>
            <?php } ?>



            <div class="form-field">
                <div class="field-data">
                    <span>КС </span><span class="orandzh">*</span>
                    <div class="input-field"><?php echo $this->info->ks; ?></div>
                </div>
                <div class="field-info"></div>
            </div>
            <?php
            $error = $this->info->ks->getMessages();
            if (!empty($error)) { ?>
            <div class="error-list"><ul>
                    <?php foreach ($error as $keyError => $valueError) { ?> <li><?php echo $valueError; ?></li><?php } ?>
                </ul></div>
            <?php } ?>



            <div class="form-field">
                <div class="field-data">
                    <span>БИК </span><span class="orandzh">*</span>
                    <div class="input-field"><?php echo $this->info->bik; ?></div>
                </div>
                <div class="field-info"></div>
            </div>
            <?php
            $error = $this->info->bik->getMessages();
            if (!empty($error)) { ?>
            <div class="error-list"><ul>
                    <?php foreach ($error as $keyError => $valueError) { ?> <li><?php echo $valueError; ?></li><?php } ?>
                </ul></div>
            <?php } ?>



            <div class="form-field">
                <div class="field-data">
                    <span>ОКПО </span>
                    <div class="input-field"><?php echo $this->info->okpo; ?></div>
                </div>
                <div class="field-info"></div>
            </div>
            <?php
            $error = $this->info->okpo->getMessages();
            if (!empty($error)) { ?>
            <div class="error-list"><ul>
                    <?php foreach ($error as $keyError => $valueError) { ?> <li><?php echo $valueError; ?></li><?php } ?>
                </ul></div>
            <?php } ?>



            <div class="form-field">
                <div class="field-data">
                    <span>Дополнительная информация:</span>
                    <div class="field-input"><?php echo $this->info->info; ?></div>
                </div>
                <div class="field-info"></div>
            </div>
            <?php
            $error = $this->info->info->getMessages();
            if (!empty($error)) { ?>
            <div class="error-list"><ul>
                    <?php foreach ($error as $keyError => $valueError) { ?> <li><?php echo $valueError; ?></li><?php } ?>
                </ul></div>
            <?php } ?>
        </div>
    </div>
    <div>Выберите пароль, который Вы будете использовать для доступа в раздел "Для клиентов"<br /> для заказа и настройки услуг:</div>
    <div class="reg-form">
        <div class="grey-corner-tl">
            <div class="grey-corner-tr">
                <div class="grey-corner-tm"></div>
            </div>
        </div>
        <div class="grey-corner-m">
            <div class="form-field">
                <div class="field-data">
                    <span>Пароль </span><span class="orandzh">*</span>
                    <div class="input-field"><?php echo $this->user->password; ?></div>
                    <?php
                    $error = $this->user->password->getMessages();
                    if (!empty($error)) { ?>
                    <div class="error-list"><ul>
                            <?php foreach ($error as $keyError => $valueError) { ?> <li><?php echo $valueError; ?></li><?php } ?>
                        </ul></div>
                    <?php } ?>
                    <span>Подтверждение пароля </span><span class="orandzh">*</span>
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
                    Разрешается использовать только латинские буквы и цифры.							
                </div>
            </div>
        </div>
        <div class="grey-corner-bl">
            <div class="grey-corner-br">
                <div class="grey-corner-bm"></div>
            </div>
        </div>
    </div>
    <div><input type="submit" class="send-form" value="Отправить анкету" /></div>
</form>
<?php } ?>