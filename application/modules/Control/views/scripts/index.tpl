<?php /* <div class="path">
	<a href="/"><img alt="" src="/themes/default/images/house.png" /></a>
	<span>Личный кабинет</span>
</div>
<h1>Личный кабинет</h1>    */ ?>
<?php if (Engine_Cms::displayContent(6)) { ?>
    <?php echo Engine_Cms::displayContent(6); ?>
<?php } ?>
<?php /* if (!$this->isManager) { ?>
	<a style="margin:10px 0 0" href="/messages/send/" class="add-message">Написать сообщение</a>
<?php } */ ?>
<?php /* ?>
<div class="mes-admin">
    <div class="page-razd"></div>
    <?php if ($this->success && $_SERVER['REMOTE_ADDR'] = '91.221.60.226') { ?>
    <p>Спасибо! Ваше сообщение отправлено и будет рассмотрено администратором!</p>
    <p>Есть ещё вопросы? Вы можете <a href="/control/" title="Задать еще вопрос">задать другой вопрос</a>.</p>
    <?php } elseif ($_SERVER['REMOTE_ADDR'] = '91.221.60.226') { ?>
    <span class="title">Написать администратору</span>
    <form method="post" action="/control/">
        <div class="grey-corner-tl">
            <div class="grey-corner-tr">
                <div class="grey-corner-tm"></div>
            </div>
        </div>
        <div class="grey-corner-m">
            <div class="form-field">
                <div class="field-data">
                    <span>Ваше сообщение: </span><span class="orandzh">*</span>
                    <div class="field-input">
                        <textarea class="input-long" cols="20" rows="5" name="message"></textarea>
                        <input type="hidden" name="author" value="<?php echo $this->userLogin; ?>" />
                        <input type="hidden" name="email" value="<?php echo $this->userEmail; ?>" />
                    </div>
                </div>
                <div class="field-info"></div>
            </div>
            <?php
            $error = $this->elements['message']->getMessages();
            if (!empty($error)) { ?>
                <div class="error-list"><ul>
                <?php foreach ($error as $keyError => $valueError) { ?> <li><?php echo $valueError; ?></li><?php } ?>
                </ul></div>
            <?php } ?>
            <div class="book-form">
                <div class="book-form-title">&nbsp;</div>
                <div class="book-form-input"><input type="submit" class="book-button" name="button" value=""></div>
                <div class="book-form-remark"></div>
            </div>
        </div> 
        <div class="grey-corner-bl">
            <div class="grey-corner-br">
                <div class="grey-corner-bm"></div>
            </div>
        </div>
    </form> 
    <?php } ?>
</div>
<?php */ ?>
<?php if ($this->priceType == 'base') { /* ?>
<script type="text/javascript">
        $(document).ready(function(){
            function arcticmodal_close() {
                $('#boxFootball').arcticmodal('close');
            }
            if (!$.cookie('wasVisitFootball1')) {
                $('#boxFootball').arcticmodal({
                    closeOnOverlayClick: true,
                    closeOnEsc: true
                });
            }
            $.cookie('wasVisitFootball1', true, {
                expires: 1,
                path: '/control/'
            });
        });
        </script>   
<div style="display: none;">
<div id="boxFootball" class="box-modal">
<div class="box-modal_close arcticmodal-close">закрыть</div>
<img style="display: block;" src="/media/filebrowser/uploads/banners/2016/03/10toplugs.jpg" alt="" width="500" /></div>
</div>
<?php */ } else { /* ?>
<script type="text/javascript">
        $(document).ready(function(){
            function arcticmodal_close() {
                $('#boxFootball').arcticmodal('close');
            }
            if (!$.cookie('wasVisitFootball1')) {
                $('#boxFootball').arcticmodal({
                    closeOnOverlayClick: true,
                    closeOnEsc: true
                });
            }
            $.cookie('wasVisitFootball1', true, {
                expires: 1,
                path: '/control/'
            });
        });
        </script>   
<div style="display: none;">
<div id="boxFootball" class="box-modal">
<div class="box-modal_close arcticmodal-close">закрыть</div>
<img style="display: block;" src="/media/filebrowser/uploads/banners/2018/01/220118.jpg" alt="" width="500" /></div>
</div>
<?php */ } ?>
<?php if ($this->isOrderMessageShow == 1) { ?>
<script type="text/javascript">
    $(document).ready(function(){
        function arcticmodal_close() {
            $('#boxBasketMessage').arcticmodal('close');
        }
        if (!$.cookie('wasBasketMessage')) {
            $('#boxBasketMessage').arcticmodal({
                closeOnOverlayClick: true,
                closeOnEsc: true
            });
        }
        $.cookie('wasBasketMessage', true, {
            expires: 1,
            path: '/control/'
        });
    });
</script> 
<div style="display: none;">
	<div id="boxBasketMessage" class="box-modal" style="padding: 40px;">
		<div class="box-modal_close arcticmodal-close">закрыть</div>
		<h3>Уважаемый клиент!</h3>
		<p>Напоминаем Вам, что у Вас имеются не оформленные заказы!</p>
		<p>Рекомендуем оформить заказ в течении трех дней.</p>
		<p>По истечению данного срока выбранные Вами товары, будут удалены!</p>
	</div>
</div>
<?php } ?>
