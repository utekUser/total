<div class="comments">
    <!--Комментарии-->
    <?php if (count($this->data)) { ?>
        <a name="comments_block"></a>
        <b>Комментарии:</b>
        <?php foreach ($this->data as $page) { ?>
            <div class="question">
                <span class="question-author"><?php echo $this->escape($page['username']); ?></span>
                <span class="question-razd">|</span>
                <span class="question-date"><?php echo $this->Date($page['creation_date'], 'datetime'); ?></span>
                <div><?php echo $this->escape($page['body']); ?></div>	
            </div>
        <?php } ?>
    <?php } ?>
    <!--Комментарии-->
    
    <!--Пейджер-->
    <?php
    // Parse query and remove page
    if( !empty($this->query) && ( is_string($this->query) || is_array($this->query)) ) {
    $query = $this->query;
    if( is_string($query) ) $query = parse_str(trim($query, '?'));
    unset($query['page']);
    $query = http_build_query($query);
    if( $query ) $query = '?' . $query;
    } else {
    $query = '';
    }
    // Add params
    $params = ( !empty($this->params) && is_array($this->params) ? $this->params : array() );
    unset($params['page']);
    ?>
    <?php if ($this->pageCount > 1) { ?>
    <div class="pager">
    <?php if (isset($this->previous)) { ?>
    <a href="?page=<?php echo $this->previous; ?>#comment_add">Назад</a>
    <?php } ?>
    <?php foreach ($this->pagesInRange as $page) { ?>
    <?php if ($page != $this->current) { ?>
    <a href="?page=<?php echo $page; ?>#comment_add"><?php echo $page; ?></a>
    <?php } else { ?>
    <span><?php echo $page; ?></span>
    <?php } ?>
    <?php } ?>
    <?php if (isset($this->next)) { ?>
    <a href="?page=<?php echo $this->next; ?>#comment_add">Далее</a>
    <?php } ?>
    
    | <a href="/articles/video/213123123-325.html?page=all#comments_block">Показать все</a>
    </div>
    <?php } ?>
    <!--Пейджер-->
    
    <!--Добавление комментария-->
    <div class="spacer"></div>
    <b>Ваш комментарий:</b>
    <div class="main-razd"></div>
    <div class="before-form">
        Сообщение будет отображаться после проверки администратором! <br />
        Поля, <b>выделенные полужирным</b>, обязательны для заполнения.
    </div>
    <?php
    $error = $this->form->getMessages();
    $elements = $this->form->getElements();
    if (!empty($error)) {
    ?>
    <div class="form-error">Ошибки в полях ввода</div>
    <?php } ?>
    <a name="comment_add"></a>
    <form action="#comment_add" method="post" id="form1" class="guestbook">
        <div class="book-form">
        <div class="book-form-title"><b>Ваше имя:</b></div>
        <div class="book-form-input">
        <?php
        $element = $elements['username'];
        echo $element->display();
        $error = $element->getMessages();
        if (!empty($error)) { ?>
        <ul class="errorlist">
        <?php foreach ($error as $keyError => $valueError) { ?>
        <li><?php echo $valueError; ?></li>
        <?php } ?>
        </ul>
        <?php } ?>
        </div>
        <div class="book-form-remark"></div>
        </div>
        <div class="book-form">
        <div class="book-form-title">E-mail:</div>
        <div class="book-form-input">
        <?php
        $element = $elements['email'];
        echo $element->display();
        $error = $element->getMessages();
        if (!empty($error)) { ?>
        <ul class="errorlist">
        <?php foreach ($error as $keyError => $valueError) { ?>
        <li><?php echo $valueError; ?></li>
        <?php } ?>
        </ul>
        <?php } ?>
        </div>
        <div class="book-form-remark"></div>
        </div>
        
        <div class="book-form">
        <div class="book-form-title"><b>Сообщение:</b></div>
        <div class="book-form-input">
        <?php
        $element = $elements['body'];
        echo $element->display();
        $error = $element->getMessages();
        if (!empty($error)) { ?>
        <ul class="errorlist">
        <?php foreach ($error as $keyError => $valueError) { ?>
        <li><?php echo $valueError; ?></li>
        <?php } ?>
        </ul>
        <?php } ?>
        </div>
        <div class="book-form-remark"></div>
        </div>
        <div class="book-form">
        <div class="book-form-title"><b>Код защиты:</b></div>
        <div class="book-form-input">
<script>
function call() {
        $.ajax({
        	type: 'POST',
                url: '/externals/kcaptcha/?<?php echo session_name(); ?>=<?php echo session_id(); ?>',
                success: function (data) {
			$("#kcaptchaimg").attr("src", "/externals/kcaptcha/?<?php echo session_name(); ?>=<?php echo session_id(); ?>");
                },
                error: function (xhr, str) {
                	alert('Возникла ошибка: ' + xhr.responseCode);
                }
       });
}
</script>
        <img alt="kcaptcha" id="kcaptchaimg" src="/externals/kcaptcha/?<?php echo session_name(); ?>=<?php echo session_id(); ?>" /><a style="font-size: 11px;" href="#kcaptchaimg" onclick="call()">Обновить картинку</a>
        <div class="book-input-code">
        <?php
        $element = $elements['captcha'];
        echo $element->display();
        ?>
        </div>
        <div style="clear:both">
        <?php
        $error = $element->getMessages();
        if (!empty($error)) { ?>
        <ul class="errorlist">
        <?php foreach ($error as $keyError => $valueError) { ?>
        <li><?php echo $valueError; ?></li>
        <?php } ?>
        </ul>
        <?php } ?>
        </div>
        </div>
        <div class="book-form-remark"></div>
        </div>
        <div class="book-form">
        <div class="book-form-title">&nbsp;</div>
        <div class="book-form-input">
        <input type="submit" value="" name="button" class="book-button" />
        </div>
        <div class="book-form-remark"></div>
        </div>
    </form>
    <!--Добавление комментария-->
</div>