<?php /* <div class="path">
<a href="/"><img alt="" src="/themes/default/images/house.png" /></a>
<a href="/control/">Личный кабинет</a>
<span>История заказов</span>
</div> */ ?>
<h2>История заказов</h2>
<script type="text/javascript">
    $(document).ready(function () {
        $('.order-history td').hover(
                function () {
                    $(this).parent().css('background', '#f2f2f2');
                },
                function () {
                    $(this).parent().css('background', '#fff');
                }
        );
    });
</script>
<p>На этой странице Вы можете просмотреть историю и отследить состояние (статус) Ваших заказов.</p>

<style>
    .order-history table th, .order-history table td {
        background: #ffffff;
        text-align: left;
    }
    .order-history table {
        border: 0px;
        border-bottom: 5px solid #f1f0f0;
        border-radius: 3px;
    }
</style>
<div class="order-history">
    <?php if (sizeof($this->savedorders)) { ?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th colspan="3">
        <p>Заказы, не отправленные поставщику</p>
        </th>
        </tr>
        <tr>            
		<th style="border-bottom: 1px solid #e4e4e4; border-top: 1px solid #e4e4e4; width: 45%;">Заказчик</th>
            <th style="border-bottom: 1px solid #e4e4e4; border-top: 1px solid #e4e4e4; width: 25%;">Дата заказа</th>
            <th style="border-bottom: 1px solid #e4e4e4; border-top: 1px solid #e4e4e4; width: 20%;">Позиций в заказе</th>
            <th style="border-bottom: 1px solid #e4e4e4; border-top: 1px solid #e4e4e4;"></th>
        </tr>
        </thead>
        <tbody>
            <?php foreach ($this->savedorders as $key => $order) { ?>
            <tr>
		<td><?php echo $this->Date($order['company_name'], 'slash'); ?></td>
                <td><?php echo $this->Date($order['date'], 'slash'); ?></td>
                <td style="text-align: center;"><?php echo count($order) - 1; ?></td>
                <td style="text-align: center;" class="order-more"><a href="/control/history/savedorder/<?php echo $key; ?>/">Подробнее</a></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php } ?>
    <?php if (sizeof($this->orders)) { ?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="order-history">
        <tr>
            <th colspan="5">
        <p>Заказы принятые поставщиком</p>
        </th>
        </tr>
        <tr>
            <th>Номер заказа</th>
            <th>Заказчик</th>
            <th>Дата заказа</th>
            <th>Статус</th>
            <?php /* <th>Склад</th> */ ?>
            <th>Комментарий</th>
            <th>Дата отправки</th>
            <th></th>
        </tr>
        <?php foreach ($this->orders as $order) { ?>
        <tr>
            <td width="20%">№&nbsp;<?php echo $order['id']; ?></td>
		<td width="20%">№&nbsp;<?php echo $order['company_name']; ?></td>
            <td width="20%"><?php echo $this->Date($order['date'], 'slash'); ?></td>
            <td style="text-align: center;" width="25%">
                <?php echo $this->statusList[$order['status_id']]['name']; ?>
            </td>
            <?php /* <td style="text-align: center;">
                <?php if ($order['warehouse_type'] == "1") { echo "Тверская 18"; } else if ($order['warehouse_type'] == "2") { echo "Томскснаб"; } else if ($order['warehouse_type'] == "3") { echo "Томскснаб-Фильтра"; }?>
            </td> */ ?>
	    <td style="text-align: left;"><?php echo $order['comment']; ?></td>
            <td style="text-align: center;" width="10%"></td>
            <td style="text-align: center;" width="12%" class="order-more"><a href="/control/history/<?php echo $order['id']; ?>/">Подробнее</a></td>
        </tr>
        <?php } ?>
    </table>
    <?php /* <div class="page-razd"></div> */ ?>
<style>
.clearhistory div {
    font-size: 0;
    border: 0px;
    cursor: pointer;
    width: 152px;
    height: 31px;
    margin: 30px 0 0 0px;
    background: url(/themes/default/images/newdesign/clearhistory.png) 0px 0px no-repeat;
}
.clearhistory:hover div {
    background: url(/themes/default/images/newdesign/clearhistoryh.png) 0px 0px no-repeat;
}
</style>
    <a href="/control/history/clear" class="clearhistory" style="margin:15px 0 0;"><div></div></a>
    <?php } else { ?>
    <p>История заказов пуста.</p>
    <?php } ?>
    <div class="back history-back"><a href="/control/">Вернуться</a></div>
</div>