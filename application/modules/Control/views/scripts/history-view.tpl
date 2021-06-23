<?php /* <div class="path">
	<a href="/"><img alt="" src="/themes/default/images/house.png" /></a>
	<a href="/control/">Личный кабинет</a>
	<a href="/control/history/">История заказов</a>
	<span>Заказ № <?php echo $this->orderInfo['id']; ?></span>
</div> */ ?>
<!--<h2>Заказ № <?php echo $this->orderInfo['id']; ?></h2>-->

<h2 class="h2-black">Заказ № <?php echo $this->orderInfo['id']; ?> от <?php echo $this->Date($this->orderInfo['date'], 'numeric'); ?></h2>
<table cellspacing="0" class="order-properties"><tbody>
    <tr>
        <td class="field-name">Текущий статус заказа:</td>
        <td class="field-value"><?php echo $this->statusList[$this->orderInfo['status_id']]['name']; ?> (от <?php echo $this->Date($this->orderInfo['status_modified'], 'numeric'); ?>)</td>
    </tr>
    <tr>
        <td class="field-name">Склад с которого забирать:</td>
        <td class="field-value"><?php if ($this->orderInfo['warehouse_type'] == "1") { echo "Тверская 18"; } else { echo "Томскснаб"; } ?></td>
    </tr>
    <tr>
        <td class="field-name">Сумма заказа</td>
        <td class="field-value"><b><?php echo number_format($this->totalSum, 0, '.', ' '); ?> руб</b></td>
    </tr>
<!--    <tr>
        <td class="field-name">Отменен:</td>
        <td class="field-value">Нет&nbsp;<a href="/personal/order/cancel/4/?CANCEL=Y">Отменить</a></td>
    </tr>-->
</tbody></table>

<h2 class="h2-black">Данные вашей учетной записи</h2>
<table cellspacing="0" class="order-properties"><tbody>
    <tr>
        <td class="field-name">Учетная запись:</td>
        <td class="field-value"><?php echo $this->userInfo['name']; ?></td>
    </tr>
    <tr>
        <td class="field-name">Логин</td>
        <td class="field-value"><?php echo $this->user['login']; ?></td>
    </tr>
    <tr>
        <td class="field-name">E-Mail адрес:</td>
        <td class="field-value"><a href="mailto:<?php echo $this->user['email']; ?>"><?php echo $this->user['email']; ?></a></td>
    </tr>
</tbody></table>

<h2 class="h2-black">Параметры заказа</h2>				
<table cellspacing="0" class="order-properties"><tbody>
    <tr>
        <td class="field-title" colspan="2">Личные данные</td>
    </tr>
    <tr>
        <td class="field-name">Ф.И.О.:</td>
        <td class="field-value"><?php echo $this->orderInfo['customer_name']; ?></td>
    </tr>
    <tr>
        <td class="field-name">E-Mail:</td>
        <td class="field-value"><?php echo $this->orderInfo['customer_email']; ?></td>
    </tr>
    <tr>
        <td class="field-name">Телефон:</td>
        <td class="field-value"><?php echo $this->orderInfo['customer_phone']; ?></td>
    </tr>
    <?php /*?>
    <tr>
        <td class="field-title" colspan="2">Данные для доставки</td>
    </tr>
    <tr>
        <td class="field-name">Индекс:</td>
        <td class="field-value">101000</td>
    </tr>
    <tr>
        <td class="field-name">Город:</td>
        <td class="field-value">Москва</td>
    </tr>
    <tr>
        <td class="field-name">Адрес доставки:</td>
        <td class="field-value">ул. Первомайская 93</td>
    </tr>
    <?php*/ ?>
</tbody></table>
				
<h2 class="h2-black">Содержимое заказа</h2>		
<table cellspacing="0" class="order-history" width="100%">
    <thead>
        <tr>
            <th>Наименование</h>
            <th>Цена</th>
            <!--<th>Налоги</th>
            <th>Вес</th>-->
            <th>Количество</th>
            <th>Сумма</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($this->items as $item) { ?>
        <tr>
            <td><?php echo $item['name']; ?></td>
            <td class="cart-item-price"><?php echo number_format($item['price'], 0, '.', ' '); ?> руб</td>
            <!--<td class="cart-item-price">0%</td>
            <td class="cart-item-weight">0 кг</td>-->
            <td class="cart-item-quantity"><?php echo $item['amount']; ?></td>
            <td class="cart-item-price"><?php echo number_format($item['price'] * $item['amount'], 0, '.', ' '); ?> руб</td>
        </tr>
    <?php } ?>
    </tbody>
    <tfoot>									    
        <tr>
            <td class="cart-item-name"><p>Цена:</p><p><b>Итого:</b></p></td>
            <td class="cart-item-price">
                <p><?php echo number_format($this->totalSum, 0, '.', ' '); ?> руб</p>
                <p><b><?php echo number_format($this->totalSum, 0, '.', ' '); ?> руб</b></p>
            </td>
            <!--<td class="cart-item-weight">&nbsp;</td>
            <td class="cart-item-weight">&nbsp;</td>-->
            <td class="cart-item-quantity">&nbsp;</td>
            <td class="cart-item-quantity">&nbsp;</td>
        </tr>
    </tfoot>
</table>	
<?php /*?>	
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="order-history order-history-more">
	<tr>
		<th width="47%">Наименование товара / Артикул</th>
		<th width="14%">Упаковка/л.</th>
		<th width="13%">Цена/руб.</th>
		<th width="14%">Количество</th>
		<th width="12%">Сумма</th>
	</tr>
	<?php $total_sum = 0; ?>
	<?php foreach ($this->items as $item) { ?>
	<tr>
		<td><?php echo $item['name']; ?></td>
		<td>&ndash;</td>
		<td><strong><?php echo number_format($item['price'], 0, '.', ' '); ?> руб.</strong></td>
		<td><?php echo $item['amount']; ?></td>
		<td><strong><?php echo number_format($item['price'] * $item['amount'], 0, '.', ' '); ?> руб.</strong></td>
	</tr>
	<?php $total_sum += $item['price']* $item['amount']; ?>
	<?php } ?>
</table>

<div class="page-razd"></div>
<div class="order-history-info">
	<table border="0" cellspacing="0" cellpadding="0" align="right">
        <tr>
            <td width="145px">Суммарная стоимость:</td>
            <td width="135px"><strong>7500 руб.</strong></td>
        </tr>
        <tr>
            <td>Ваша скидка 10%:</td>
            <td><strong>500 руб.</strong></td>
        </tr>
        <tr>
            <td>Доставка:</td>
            <td><strong>200 руб.</strong></td>
        </tr>
        <tr>
            <td width="145px">Итоговая сумма:</td>
            <td width="135px"><span class="total-price"><?php echo number_format($total_sum, 0, '.', ' '); ?> руб.</span></td>
        </tr>
	</table>
</div>
<div class="page-razd"></div>
<div class="order-history-info">
<table border="0" cellspacing="0" cellpadding="0" align="right">
    <tr>
        <td width="145px">Дата заказа:</td>
        <td width="135px"><span class="order-date"><?php echo $this->Date($this->orderInfo['date'], 'slash'); ?></span></td>
    </tr>
    <tr>
        <td>Дата отправки:</td>
        <td><span class="order-date"></span></td>
    </tr>
    <tr>
        <td valign="top">Статус:</td>
        <td><span class="order-status"><?php echo $this->statusList[$this->orderInfo['status_id']]['name']; ?></span></td>
</table>
</div>
<div class="page-razd"></div>
<div class="back history-back"><a href="/control/history/">Вернуться</a></div>
<?php*/ ?>