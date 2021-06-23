<?php /* <div class="path">
<a href="/"><img alt="" src="/themes/default/images/house.png" /></a>
<a href="/control/profile/">Личный кабинет</a>
<a href="/messages/">Сообщения</a>
<span>Написать сообщение</span>
</div>
<h2>Написать сообщение:</h2>
*/ ?>
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
    div.input-field input {
        width: 490px;
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
    div.input-field div {
        background: transparent;
        height: 25px;
        padding: 0;
    }
    div.input-field div div {
        background: transparent;
        height: 25px;
        padding: 0;
    }
    .sendb {
        background: url(/themes/default/images/newdesign/send.png);
        width: 96px;
        height: 31px;
        border: 0px;
        font-size: 0px;
    }
    .sendb:hover {
        background: url(/themes/default/images/newdesign/sendh.png);
    }
</style>
<?php if($formError = $this->form->getMessages()) { ?>
<div class="error-message">
    <div class="block-orange-tl">
        <div class="block-orange-tr">
            <div class="block-orange-tm"></div>
        </div>
    </div>
    <div class="block-orange-ml">
        <div class="block-orange-mr">
            <div class="block-orange-mm">Ошибки в полях ввода</div>
        </div>
    </div>
    <div class="block-orange-bl">
        <div class="block-orange-br">
            <div class="block-orange-bm"></div>
        </div>
    </div>
</div>
<?php } ?>

<form id="form1" method="post" action="/messages/send/">
    <?php /* <div class="grey-corner-tl">
    <div class="grey-corner-tr">
    <div class="grey-corner-tm"></div>
    </div>
    </div> */ ?>
    <div class="grey-corner-m">
        <div class="form-field">
            <div class="field-data">
                <span>Тема: </span><span class="orandzh">*</span>
                <div class="input-field"><div><div><?php echo $this->form->title; ?></div></div></div>
                <?php
                $error = $this->form->title->getMessages();
                if (!empty($error)) { ?>
                <div class="error-list"><ul>
                        <?php foreach ($error as $keyError => $valueError) { ?> <li><?php echo $valueError; ?></li><?php } ?>
                    </ul></div>
                <?php } ?>
            </div>
            <div class="field-info"></div>
        </div>
        <div class="form-field">
            <div class="field-data">
                <span>Сообщение: </span><span class="orandzh">*</span>
                <div class="field-input">
                    <?php echo $this->form->body; ?>
                    <!--				<textarea name="body" value="" rows="5" cols="20" class="input-long"><?php //echo $this->form->body->displayValue(); ?></textarea>-->
                </div>
                <?php
                $error = $this->form->body->getMessages();
                if (!empty($error)) { ?>
                <div class="error-list"><ul>
                        <?php foreach ($error as $keyError => $valueError) { ?> <li><?php echo $valueError; ?></li><?php } ?>
                    </ul></div>
                <?php } ?>
            </div>
            <div class="field-info"></div>
        </div>
        <div class="book-form">
            <div class="book-form-title">&nbsp;</div>
            <div class="book-form-input">
                <input type="submit" class="sendb" class="book-button" name="button" value="">
            </div>
            <div class="book-form-remark"></div>
        </div>
    </div>
    <?php /* <div class="grey-corner-bl">
    <div class="grey-corner-br">
    <div class="grey-corner-bm"></div>
    </div>
    </div> */ ?>
</form>