<?php /* <div class="path">
<a href="/"><img alt="" src="/themes/default/images/house.png" /></a>
<span><?php echo Engine_Application::getPageHeader(); ?></span>
</div>
<h2><?php echo Engine_Application::getPageHeader(); ?></h2> */ ?>

<div class="before-order">
    После подтверждения – заказ будет отправлен в обработку. С Вами свяжется наш менеджер.
    <br />Знаком <span class="orandzh">*</span> отмечены обязательные для заполнения поля.
</div>
<?php if (sizeof($this->error)) { ?>
<div class="error-list" style="margin: 0 0 10px 0;"><?php foreach ($this->error as $error) echo $error . '<br />'; ?></div>
<?php } ?>
<style>
    input, textarea {
    background: #ffffff;
    border: 1px solid #c3c3c3;
    border-radius: 2px;
    font-family: OfficinaSansCBook;
    font-size: 13px;
    font-weight: normal;
    width: 490px;
    height: 25px;
    padding: 4px 10px;
    font-size: 12px;
}
</style>
<form method="post" action="/order/">

    <h2 class="h2-black">Информация для оплаты и доставки заказа</h2>

    <?php if (!$this->userType) { ?>
    <table class="order-user-info">
        <tbody>
            <tr>
                <td valign="top" align="right"><p>Ф.И.О.<span class="orandzh">*</span>:</p></td>
                <td><input type="text" name="name" value="<?php echo $this->userInfo['name']; ?>" size="40" maxlength="250" /></td>
            </tr>
            <tr>
                <td valign="top" align="right"><p>E-Mail<span class="orandzh">*</span>:</p></td>
                <td><input type="text" name="email" value="<?php echo $this->user['email']; ?>" size="40" maxlength="250" /></td>
            </tr>
            <tr>
                <td valign="top" align="right"><p>Телефон<span class="orandzh">*</span>:</p></td>
                <td><input type="text" name="phone" value="<?php echo $this->userInfo['phone']; ?>" size="0" maxlength="250" /></td>
            </tr>
        </tbody>
    </table>
    <?php } else { ?>
    <table class="order-user-info">
        <tbody>
            <tr>
                <td valign="top" align="right"><p>Название компании<span class="orandzh">*</span>:</p></td>
                <td><input type="text" name="title" value="<?php echo htmlspecialchars($this->userInfo['title']); ?>" size="40" maxlength="250" /></td>
            </tr>
            <tr>
                <td valign="top" align="right"><p>Юридический адрес:</p></td>
                <td><textarea name="ur_address" cols="40" style="height: 100px;" rows="4"><?php echo $this->userInfo['ur_address']; ?></textarea></td>
            </tr>
            <tr>
                <td valign="top" align="right"><p>ИНН:</p></td>
                <td><input type="text" name="inn" value="<?php echo $this->userInfo['inn']; ?>" size="0" maxlength="250" /></td>
            </tr>
            <tr>
                <td valign="top" align="right"><p>КПП:</p></td>
                <td><input type="text" name="kpp" value="<?php echo $this->userInfo['kpp']; ?>" size="0" maxlength="250" /></td>
            </tr>
            <tr>
                <td valign="top" align="right"><p>Контактное лицо<span class="orandzh">*</span>:</p></td>
                <td><input type="text" name="name" value="<?php echo $this->userInfo['name']; ?>" size="0" maxlength="250" /></td>
            </tr>
            <tr>
                <td valign="top" align="right"><p>E-Mail<span class="orandzh">*</span>:</p></td>
                <td><input type="text" name="email" value="<?php echo $this->user['email']; ?>" size="40" maxlength="250" /></td>
            </tr>
            <tr>
                <td valign="top" align="right"><p>Телефон:</p></td>
                <td><input type="text" name="phone" value="<?php echo $this->userInfo['phone']; ?>" size="0" maxlength="250" /></td>
            </tr>
            <!--<tr>
                <td valign="top" align="right"><p>Факс:</p></td>
                <td><input type="text" name="ORDER_PROP_15" value="" size="0" maxlength="250" /></td>
            </tr>-->
        </tbody>
    </table>
    <?php } ?>
    <?php if (sizeof($this->items)) { ?>

    <h2 class="h2-black">Состав заказа</h2>

    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="order-history order-history-more">
        <tr>
            <th width="47%">Наименование товара / Артикул</th>
            <!--<th width="14%">Упаковка/л.</th>-->
            <th width="13%">Цена/руб.</th>
            <th width="14%">Количество</th>
            <th width="12%">Сумма</th>
        </tr>
        <?php $totalPrice = 0; ?>
        <?php foreach ($this->items as $item) { ?>
        <tr>
            <td><?php echo $item['name']; ?></td>
            <!--<td>&ndash;</td>-->
            <td><strong><?php echo $item['price']; ?> руб.</strong></td>
            <td><?php echo $item['amount']; ?></td>
            <td><strong><?php echo $item['price'] * $item['amount']; ?> руб.</strong></td>
        </tr>
        <?php $totalPrice += $item['price'] * $item['amount']; ?>
        <?php } ?>
    </table>
    <div class="page-razd"></div>
    <?php } ?>
    <div class="order-history-info">
        <table border="0" cellspacing="0" cellpadding="0" align="right">
            <tr>
                <td width="145px">Товаров на:</td>
                <td width="135px"><strong><?php echo $totalPrice; ?> руб.</strong></td>
            </tr>
            <?php if ($this->userInfo['vip'] != '') { ?>

            <tr>
                <td>Скидка (<?php echo $this->userInfo['vip']; ?>%):</td>
                <?php $sale = $totalPrice * $this->userInfo['vip'] / 100; ?>
                <td><strong><?php echo $sale; ?> руб.</strong></td>
            </tr>
            <?php } else $sale= 0; ?>
        </table>
    </div>
    <div class="page-razd"></div>
    <div class="order-history-info">
        <table border="0" cellspacing="0" cellpadding="0" align="right">
            <tr>
                <td width="145px">Итого:</td>
                <td width="135px">
                    <span class="total-price"><?php echo $totalPrice - $sale; ?> руб.</span>
                    <input type="hidden" name="total_sum" value="<?php echo $totalPrice - $sale; ?>" />
                </td>
            </tr>
        </table>
    </div>

    <?php
    if (isset($_GET['code'][0])) {
    $searchRequest = htmlspecialchars($_GET['code'][0]);
    }
    $category = ' (категория: свечи)';
    ?>
    <br>
    <h2 class="h2-black">Желаемый продукт</h2   >
    <p>... Вы можете добавить его в заказ в раздел «Желаемая продукция» — наши менеджеры свяжутся с Вами, подтвердят возможность выполнения заказа и сообщат о возможных сроках доставки.</p>

    <div id="desiredtable">
        <table style="width: 100%">
            <thead>
                <tr>
                    <td style="font-weight: 700">Наименование желаемого товара для заказа</td>
                </tr>
            </thead>
            <?php foreach ($this->desired as $product) { ?>
            <tr>
                <td><?php echo htmlspecialchars($product['name']); ?></td>
            </tr>
            <?php } ?>
        </table>
    </div>
    <br>
    <div>
        <div style="float: left; margin-right: 50px; width: 300px; overflow: auto;">
            <h2 class="h2-black">Способы доставки</h2>
            <div class="radio-group">
                <?php if (!$this->userType) { ?>
                <label><input class="ttttt" type="radio" name="delivery_type" value="1" checked="checked" />Самовывоз <?php /* (Тверская, 18) */ ?></label>
                <?php } else {  ?>
                <label>
                    <input class="ttttt" type="radio" name="delivery_type" value="1"
                           <?php if (!isset($_POST['delivery_type']) || (isset($_POST['delivery_type']) && $_POST['delivery_type'] == 1)) { echo 'checked="checked"'; } ?> />
                           Самовывоз <?php /* (Тверская, 18) */ ?>
                </label>
                <label>
                    <input type="radio" name="delivery_type" value="2"
                           <?php if (isset($_POST['delivery_type']) && $_POST['delivery_type'] == 2) { echo 'checked="checked"'; } ?> />
                           Доставка экспедитором (курьером)
                </label>
                <script type="text/javascript">
                    $('input[name=delivery_type]').click(function () {
                        if ($('input[name=delivery_type]:checked').val() == 2) {
                            $(".delivery-schedule").show();
                            $('input[name=warehouse_type]').attr('disabled','disabled');                            
                            $('input[name=warehouse_type]').removeAttr("checked");
                        } else {
                            $(".delivery-schedule").hide();
                            $('input[name=warehouse_type]').removeAttr("disabled");
                            $('input[name=warehouse_type]').first().attr('checked','checked');
                        }
                    });
                </script>
                <?php if (isset($_POST['delivery_type']) && $_POST['delivery_type'] == 2) {
                $st = "display: block; ";	
                } else {
                $st = "display: none; ";		
                } ?>
                <div class="delivery-schedule" style="<?php echo $st; ?>margin: 0 0 0 23px">
                    <p><strong>График доставки заказов экспедитором (курьером)</strong></p>
                    <table border="1" cellpadding="10" cellspacing="0">
                        <tr>
                            <th scope="col">Заявки поступившие</th>
                            <th scope="col">Срок выполнения</th>
                        </tr>
                        <tr>
                            <td>до 10:00</td>
                            <td>в день подачи</td>
                        </tr>
                        <tr>
                            <td>после 10:00</td>
                            <td>на следующий рабочий день</td>
                        </tr>
                    </table>
                    <p>Заказы, поступившие после 10:00, сумма которых выше 10 тыс. руб. могут быть доставлены по согласованию с вашим менеджером в тот же день.</p>
                </div>
                <?php } ?>
            </div>
        </div>
        <?php /* <div style="float: left; overflow: auto; width: 300px;">
            <h2 class="h2-black">С какого склада забирать</h2>
            <div class="radio-group">
                <label><input type="radio" name="warehouse_type" value="1"<?php if ((isset($_POST['warehouse_type']) && $_POST['warehouse_type'] == 1) || !isset($_POST['warehouse_type'])) { echo 'checked="checked"'; } ?> />Тверская 18</label>
                <label><input type="radio" name="warehouse_type" value="2"<?php if (isset($_POST['warehouse_type']) && $_POST['warehouse_type'] == 2) { echo 'checked="checked"'; } ?> />Томскснаб</label>
                <label><input type="radio" name="warehouse_type" value="3"<?php if (isset($_POST['warehouse_type']) && $_POST['warehouse_type'] == 3) { echo 'checked="checked"'; } ?> />Томскснаб-Фильтра</label>
            </div>
        </div> */ ?>
        <br style="clear: left;" />
    </div>
    <h2 class="h2-black">Способы оплаты</h2>
    <div class="radio-group"> 
        <label><input type="radio" name="payment_type" value="1"<?php if ((isset($_POST['payment_type']) && $_POST['payment_type'] == 1) || !isset($_POST['payment_type'])) { echo 'checked="checked"'; } ?> />Наличными</label>
        <label><input type="radio" name="payment_type" value="2"<?php if (isset($_POST['payment_type']) && $_POST['payment_type'] == 2) { echo 'checked="checked"'; } ?> />Безналичный расчет</label>
    </div>


    <h2 class="h2-black">Ваши комментарии к заказу</h2>
    <div class="order-comment"><textarea style="width:95%; height: 100px;" name="comment" rows="7"><?php echo (isset($_POST['comment']) ? htmlspecialchars($_POST['comment']) : ""); ?></textarea></div>
    <div><input class="order-approve" type="submit" value="Подтвердить заказ" /></div>
</form>