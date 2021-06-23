<div class="path">
    <a href="/"><img alt="" src="/themes/default/images/house.png" /></a>
    <a href="/control/">Личный кабинет</a>
    <span>Личные данные</span>
</div>
<h1>Личные данные</h1>
<div class="">Просим Вас при заполнении анкеты использовать информацию, которая в случае необходимости может быть
    подтверждена документально.<br /><br />
    Знаком <span class="orandzh">*</span> отмечены обязательные для заполнения поля.
</div>
<?php if ($this->success) { ?><div class="error-list"><?php echo $this->success;  ?></div><?php }  ?>

<form method="post" action="/control/profile/">
<div class="private-profile">
<div class="grey-corner-m">

<div class="form-field">
    <div class="field-data">
        <span>Логин </span><span class="orandzh">*</span>
    </div>
    <div class="input-field">
        <input readonly="readonly" class="disabled" type="text" value="<?php echo $this->user['login']; ?>"
               name="login" />
    </div>
</div>
<?php
            $error = $this->userA->login->getMessages();
if (!empty($error)) { ?>
<div class="error-list"><ul>
        <?php foreach ($error as $keyError => $valueError) { ?> <li><?php echo $valueError; ?></li><?php } ?>
    </ul></div>
<?php } ?>

<div class="form-field">
    <div class="field-data">
        <span>Электронная почта </span><span class="orandzh">*</span>
    </div>
    <div class="input-field input-middle"><input readonly="readonly" class="disabled" type="text" value="<?php
echo $this->user['email']; ?>" name="email" /></div>
</div>
<?php
            $error = $this->userA->email->getMessages();
if (!empty($error)) { ?>
<div class="error-list"><ul>
        <?php foreach ($error as $keyError => $valueError) { ?> <li><?php echo $valueError; ?></li><?php } ?>
    </ul></div>
<?php } ?>

<div class="form-field">
    <div class="field-data">
        <span>Контактное имя </span><span class="orandzh">*</span>
    </div>
    <div class="input-field input-middle"><input type="text" value="<?php echo $this->info['name']; ?>"
                                                 name="name" /></div>
</div>
<?php
            $error = $this->infoA->name->getMessages();
if (!empty($error)) { ?>
<div class="error-list"><ul>
        <?php foreach ($error as $keyError => $valueError) { ?> <li><?php echo $valueError; ?></li><?php } ?>
    </ul></div>
<?php } ?>

<div class="form-field">
    <div class="field-data">
        <span>Телефон </span><span class="orandzh">*</span>
    </div>
    <div class="input-field input-middle"><input type="text" value="<?php echo $this->info['phone']; ?>"
                                                 name="phone" /></div>
</div>
<?php
            $error = $this->infoA->phone->getMessages();
if (!empty($error)) { ?>
<div class="error-list"><ul>
        <?php foreach ($error as $keyError => $valueError) { ?> <li><?php echo $valueError; ?></li><?php } ?>
    </ul></div>
<?php } ?>

<?php if ($this->user['type']) { ?>
<div class="almost-h2">Реквизиты</div>
<div class="form-field">
    <div class="field-data">
        <span>Наименование организации </span><span
                class="orandzh">*</span>
    </div>
    <div class="input-field input-middle"><?php echo $this->infoA->title; ?></div>
</div>
<?php
            $error = $this->infoA->title->getMessages();
if (!empty($error)) { ?>
<div class="error-list"><ul>
        <?php foreach ($error as $keyError => $valueError) { ?> <li><?php echo $valueError; ?></li><?php } ?>
    </ul></div>
<?php } ?>

<div class="form-field">
    <div class="field-data">
        <span>Юридический адрес </span><span class="orandzh">*</span>
    </div>
    <div class="input-field input-middle"><?php echo $this->infoA->ur_address; ?></div>
</div>
<?php
            $error = $this->infoA->ur_address->getMessages();
if (!empty($error)) { ?>
<div class="error-list"><ul>
        <?php foreach ($error as $keyError => $valueError) { ?> <li><?php echo $valueError; ?></li><?php } ?>
    </ul></div>
<?php } ?>

<div class="form-field">
    <div class="field-data">
        <span>Фактический адрес (адрес доставки по умолчанию) </span><span
                class="orandzh">*</span>
    </div>
    <div class="input-field input-middle"><input type="text" value="<?php echo $this->info['fact_address']; ?>" name="fact_address" /></div>
</div>
<?php
            $error = $this->infoA->fact_address->getMessages();
if (!empty($error)) { ?>
<div class="error-list"><ul>
        <?php foreach ($error as $keyError => $valueError) { ?> <li><?php echo $valueError; ?></li><?php } ?>
    </ul></div>
<?php } ?>

<div class="form-field">
    <div class="field-data">
        <span>ОГРН</span>
    </div>
    <div class="input-field input-middle"><input type="text" value="<?php echo $this->info['ogrn']; ?>" name="ogrn" /></div>
</div>
<div class="form-field">
    <div class="field-data">
        <span>ИНН </span><span class="orandzh">*</span>
    </div>
    <div class="input-field input-middle">
        <?php echo $this->infoA->inn; ?>
        <?php /* ?><input type="text" value="<?php echo $this->info['inn']; ?>" name="inn" /><?php */ ?>
    </div>
</div>
<?php
            $error = $this->infoA->inn->getMessages();
if (!empty($error)) { ?>
<div class="error-list"><ul>
        <?php foreach ($error as $keyError => $valueError) { ?> <li><?php echo $valueError; ?></li><?php } ?>
    </ul></div>
<?php } ?>

<div class="form-field">
    <div class="field-data">
        <span>Банк</span>
    </div>
    <div class="input-field input-middle"><input type="text" value="<?php echo $this->info['bank']; ?>" name="bank" /></div>
</div>
<div class="form-field">
    <div class="field-data">
        <span>КПП</span>
    </div>
    <div class="input-field input-middle"><input type="text" value="<?php echo $this->info['kpp']; ?>" name="kpp" /></div>
</div>
<div class="form-field">
    <div class="field-data">
        <span>Р/С</span>
    </div>
    <div class="input-field input-middle"><input type="text" value="<?php echo $this->info['rs']; ?>" name="rs" /></div>
</div>
<div class="form-field">
    <div class="field-data">
        <span>КС</span>
    </div>
    <div class="input-field input-middle"><input type="text" value="<?php echo $this->info['ks']; ?>" name="ks" /></div>
</div>
<div class="form-field">
    <div class="field-data">
        <span>БИК</span>
    </div>
    <div class="input-field input-middle"><input type="text" value="<?php echo $this->info['bik']; ?>" name="bik" /></div>
</div>
<div class="form-field">
    <div class="field-data">
        <span>ОКПО</span>
    </div>
    <div class="input-field input-middle"><input type="text" value="<?php echo $this->info['okpo']; ?>" name="okpo" /></div>
</div>
<div class="razd-grey"></div>
<div class="form-field no-margin">
    <div class="field-data">
        <span>Дополнительная информация</span>
    </div>
    <div class="field-input"><textarea class="input-long" cols="20" rows="5" value=""
                                       name="info"><?php echo $this->info['info']; ?></textarea></div>
</div>

<?php } else { ?>
<?php /* ?>
<div class="form-field">
    <div class="field-data">
        <span>Телефон</span>

    </div>
    <div class="input-field input-middle"><?php echo $this->infoA->phone; ?></div>
</div>
<?php
                $error = $this->error['phone'];
if (!empty($error)) { ?>
<div class="error-list"><ul><li><?php echo $error; ?></li></ul></div>
<?php } ?>
<?php */ ?>

<div class="form-field">
    <div class="field-data">
        <span>Адрес</span>
    </div>
    <div class="input-field input-big"><?php echo $this->infoA->address; ?></div>
</div>

<div class="form-field no-margin">
    <div class="field-data">
        <span>Дополнительная информация</span>
    </div>
    <div class="field-input"><textarea class="input-long" cols="20" rows="5" value=""
                                       name="info"><?php echo $this->info['info']; ?></textarea></div>
</div>
<?php } ?>

</div>
</div>
<div><input type="submit" class="safe-changes" value="Обновить данные" /></div><br><br>

<div>Заполните, если хотите изменить пароль:</div>
<div class="private-profile">
    <div class="grey-corner-tl">
        <div class="grey-corner-tr">
            <div class="grey-corner-tm"></div>
        </div>
    </div>
    <div class="grey-corner-m">
        <div class="form-field">
            <div class="form-field">
                <div class="field-data">
                    <span>Новый пароль</span><span class="orandzh">*</span>
                </div>
                <div class="input-field input-small"><input type="password" value=""
                                                            name="password" /></div>
            </div>

            <div class="form-field">
                <div class="field-data">
                    <span>Подтверждение пароля</span><span
                            class="orandzh">*</span>
                </div>
                <div class="input-field input-small"><input type="password" value=""
                                                            name="verifypassword" /></div>
            </div>
            <?php
                $error = $this->error['password'];
            if (!empty($error)) { ?>
            <div class="error-list"><ul><li><?php echo $error; ?></li></ul></div>
            <?php } ?>
        </div>
    </div>
</div>
<div><input type="submit" class="safe-changes" value="Изменить пароль" /></div>
</form>