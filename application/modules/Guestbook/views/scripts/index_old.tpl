<?php if (/*$_SERVER['REMOTE_ADDR'] == '78.140.9.206' ||*/ $_SERVER['REMOTE_ADDR'] == '46.161.158.155' || $_SERVER['REMOTE_ADDR'] == '88.204.72.104' || $_SERVER['REMOTE_ADDR'] == '95.170.159.81') { ?>
<style>
    .guestbookWrapper .before-form {
        color: #8b8c8d;
        font-family: Arial;
        font-size: 12px;
    }
    .guestbookWrapper .reviews {
        margin-top: 25px;
    }
    .guestbookWrapper .h2-black {
        color: #606060;
        font-family: OfficinaSansCBook;
        text-transform: uppercase;
        font-size: 20px;
        font-weight: normal;
    }
    .guestbookWrapper .question {
        margin: 5px 0 25px 0;
    }
    .guestbookWrapper .question .news-a, .guestbookWrapper .answer .news-a {
        color: #00aaf0;
        font-family: Arial;
        font-size: 12px;
    }
    .guestbookWrapper .question .news-date {
        color: #939495;
        font-family: Arial;
        font-size: 11px;
        font-weight: normal;
    }
    .guestbookWrapper .question .answer {
        margin: 10px 0;
    }
    .guestbookWrapper .question .newsText, .guestbookWrapper .question .newsText p {
        color: #8b8c8d;
        font-family: Arial;
        font-size: 12px;
        text-align: justify;
        margin: 0;
        width: 625px;
    }
    .guestbookWrapper .question p {
        margin: 10px 0 0 0;
    }
    .leftPart {
        float: left;
        margin-right: 25px;
        width: 185px;
    }
    .rightPart {
        float: left;
        width: 355px;
    }
    .guestbookWrapper .inpNew {
        margin: 0 0 15px 0;
    }
    .guestbookWrapper .inpNew input, .guestbookWrapper .inpNew textarea {
        background: none;
        border: 1px solid #c3c3c3;
        border-radius: 2px;
        font-family: OfficinaSansCBook;
        font-size: 13px;
        font-weight: normal;
    }
    .guestbookWrapper .inpNew textarea {
        height: 63px;
        padding: 10px;
        font-family: OfficinaSansCBook;
        font-size: 13px;
        font-weight: normal;
    }
    .captchaA {
        color: #00aaf0;
        text-decoration: underline;
        font-family: Arial;
        font-size: 13px;
    }
    .captchaA:hover {
        color: #03597d;
    }
    .submitbuttonW {
        background: url(/themes/default/images/newdesign/send.png);
        width: 96px;
        height: 31px;
        border: 0px;
    }
    .submitbuttonW:hover {
        background: url(/themes/default/images/newdesign/sendh.png);
    }
</style>
<div class="guestbookWrapper" id="kcaptchaimga">
    <form action="" method="post" id="form1">
        <div class="before-form">Сообщение будет отображаться после проверки администратором!</div>
        <div class="questionForm">
            <div class="leftPart">
                <div class="input-field inpNew"><?php echo $this->form->author; ?></div>
                <div class="input-field inpNew"><?php echo $this->form->email; ?></div>
                <div class="input-field inpNew">
                    <input placeholder="Введите текст с картинки:*" required="true" type="text" value="" name="captcha" />
                </div>
            </div>
            <div class="rightPart">
                <div class="field-input inpNew">
                    <?php
                    $this->form->question->setAttribs(array(
                    'class' => 'input-long',
                    'cols' => '20',
                    'rows' => '5',
                    'required' => 'true',
                    'placeholder' => 'Введите текст сообщения:*',
                    ));
                    ?>
                    <?php echo $this->form->question; ?>
                </div>
                <script>
                    function call() {
                        $.ajax({
                            type: 'POST',
                            url: '/externals/kcaptcha/?<?php echo session_name(); ?>=<?php echo session_id(); ?>',
                            success: function () {
                                $("#kcaptchaimg").attr("src", "/externals/kcaptcha/?<?php echo session_name(); ?>=<?php echo session_id(); ?>");
                            },
                            error: function (xhr) {
                                alert('Возникла ошибка: ' + xhr.responseCode);
                            }
                        });
                    }
                </script>
                <img alt="kcaptcha" id="kcaptchaimg" src="/externals/kcaptcha/?<?php echo session_name(); ?>=<?php echo session_id(); ?>" />
                <a class="captchaA" href="#kcaptchaimga" onclick="call();"><img src="/themes/default/images/newdesign/arrow.png" /> Обновить картинку</a>
            </div>
        </div>
        <br style="clear: left;" />
        <div class="before-form">Поля, отмеченные знаком *, обязательны для заполнения.</div>
        <input type="submit" value="" name="button" class="submitbuttonW" />
    </form>    
    <?php if (count($this->paginator)) { ?>
    <div class="reviews">
        <h2 class="h2-black">Вопросы-ответы</h2>
        <?php foreach ($this->paginator as $value) { ?>
        <div class="question">
            <p>
                <span class="news-a"><?php echo $this->escape($value['author']); ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <span class="news-date">
                    <img src="/themes/default/images/newdesign/clock.png" />
                    <?php echo $this->Date($value['posted'], 'datetimesec'); ?>
                </span>
            </p>
            <div class="newsText">
                <?php echo $this->escape($value['question']); ?>
            </div>
            <?php if($value['answer'] != '') { ?>
            <p>
                <span class="news-a">Ответ</span>
            </p>
            <div class="newsText">
                <?php echo $value['answer']; ?>
            </div>
            <?php } ?>	
        </div>
        <?php } ?>
    </div>
    <?php } ?>
    <?php if($this->paginator->count() > 1) { ?>
    <?php echo $this->paginationControl($this->paginator, 'Sliding', 'user-page.tpl'); ?>
    <?php } ?>

</div>
<?php } else { ?>   
<div class="path">
    <a href="/"><img alt="" src="/themes/default/images/house.png" /></a>
    <span><?php echo Engine_Application::getPageHeader(); ?></span>
</div> 
<h1><?php echo Engine_Application::getPageHeader(); ?></h1> 
<div class="guestbook">

    <div class="main-razd"></div>
    <div class="before-form">Сообщение будет отображаться после проверки администратором! <br />
        Поля, отмеченные знаком <span class="orandzh">*</span>, обязательны для заполнения.</div>

    <?php
    /*$error = $this->form->getMessages();
    if (!empty($error)) {
    ?>
    <div class="form-error">Ошибки в полях ввода</div>
    <?php }*/ ?>

    <form action="" method="post" id="form1">
        <div class="grey-corner-tl">
            <div class="grey-corner-tr">
                <div class="grey-corner-tm"></div>
            </div>
        </div>
        <div class="grey-corner-m">
            <div class="form-field">
                <div class="field-data">
                    <span>Ваше имя: </span><span class="orandzh">*</span>
                    <div class="input-field"><div><div><?php echo $this->form->author; ?></div></div></div>
                </div>
                <div class="field-info"></div>
            </div>
            <?php
            $error = $this->elements['author']->getMessages();
            if (!empty($error)) { ?>
            <div class="error-list"><ul>
                    <?php foreach ($error as $keyError => $valueError) { ?> <li><?php echo $valueError; ?></li><?php } ?>
                </ul></div>
            <?php } ?>
            <div class="form-field">
                <div class="field-data">
                    <span>E-mail: </span><span class="orandzh">*</span>
                    <div class="input-field"><div><div><?php echo $this->form->email; ?></div></div></div>
                </div>
                <div class="field-info"></div>
            </div>
            <?php
            $error = $this->elements['email']->getMessages();
            if (!empty($error)) { ?>
            <div class="error-list"><ul>
                    <?php foreach ($error as $keyError => $valueError) { ?> <li><?php echo $valueError; ?></li><?php } ?>
                </ul></div>
            <?php } ?>
            <div class="form-field">
                <div class="field-data">
                    <span>Сообщение: </span><span class="orandzh">*</span>
                    <div class="field-input">
                        <?php
                        $this->form->question->setAttribs(array(
                        'class' => 'input-long',
                        'cols' => '20',
                        'rows' => '5'
                        ));
                        ?>
                        <?php echo $this->form->question; ?>
                    </div>
                </div>
                <div class="field-info"></div>
            </div>
            <?php
            $error = $this->elements['question']->getMessages();
            if (!empty($error)) { ?>
            <div class="error-list"><ul>
                    <?php foreach ($error as $keyError => $valueError) { ?> <li><?php echo $valueError; ?></li><?php } ?>
                </ul></div>
            <?php } ?>
            <div class="form-field">
                <div class="field-data">
                    <span>Код защиты: </span><span class="orandzh">*</span>
                    <div class="input-field"><div><div><input type="text" value="" name="captcha" /></div></div></div>
                    <script>
                        function call() {
                            $.ajax({
                                type: 'POST',
                                url: '/externals/kcaptcha/?<?php echo session_name(); ?>=<?php echo session_id(); ?>',
                                success: function () {
                                    $("#kcaptchaimg").attr("src", "/externals/kcaptcha/?<?php echo session_name(); ?>=<?php echo session_id(); ?>");
                                },
                                error: function (xhr) {
                                    alert('Возникла ошибка: ' + xhr.responseCode);
                                }
                            });
                        }
                    </script>
                    <img alt="kcaptcha" id="kcaptchaimg" src="/externals/kcaptcha/?<?php echo session_name(); ?>=<?php echo session_id(); ?>" /><a style="font-size: 11px;" href="#kcaptchaimg" onclick="call()">Обновить картинку</a>
                </div>
                <div class="field-info"></div>
            </div>
            <?php
            $error = $this->elements['captcha']->getMessages();
            if (!empty($error)) { ?>
            <div class="error-list"><ul>
                    <?php foreach ($error as $keyError => $valueError) { ?>
                    <li><?php echo $valueError; ?></li>
                    <?php } ?>
                </ul></div>
            <?php } ?>
            <div class="book-form">
                <div class="book-form-title">&nbsp;</div>
                <div class="book-form-input">
                    <input type="submit" value="" name="button" class="book-button" />
                </div>
                <div class="book-form-remark"></div>
            </div>
        </div>
        <div class="grey-corner-bl">
            <div class="grey-corner-br">
                <div class="grey-corner-bm"></div>
            </div>
        </div>
    </form>
    <?php if (count($this->paginator)) { ?>
    <div class="main-razd"></div>
    <div class="reviews"><h2 class="h2-black">Отзывы посетителей</h2>
        <?php foreach ($this->paginator as $value) { ?>
        <div class="question">
            <span class="news-a"><?php echo $this->escape($value['author']); ?></span>
            <span class="news-r">|</span>
            <span class="news-date"><?php echo $this->Date($value['posted'], 'datetimesec'); ?></span>
            <div><?php echo $this->escape($value['question']); ?></div>
            <?php if($value['answer'] != '') { ?>	
            <div class="answer">
                <span class="news-a">Админ</span>
                <span class="news-r">|</span>
                <span class="news-date"><?php echo $this->Date($value['posted_answer'], 'datetimesec'); ?></span>
                <div><?php echo $value['answer']; ?></div>
            </div>	
            <?php } ?>	
        </div>
        <?php } ?>
    </div>
    <?php } ?>

    <div class="main-razd"></div>
</div>
<?php if($this->paginator->count() > 1) { ?>
<?php echo $this->paginationControl($this->paginator, 'Sliding', 'user-page.tpl'); ?>
<?php } ?>

<?php } ?>