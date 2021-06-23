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
    <div class="newPaginator">
    <?php echo $this->paginationControl($this->paginator, 'Sliding', 'user-page.tpl'); ?>
    </div>
    <?php } ?>
</div>