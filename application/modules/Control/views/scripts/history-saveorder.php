<div class="path">
    <a href="/"><img alt="" src="/themes/default/images/house.png" /></a>
    <a href="/control/">Личный кабинет</a>
    <a href="/control/history/">История заказов</a>
    <span>Заказ от <?php echo $this->orderinfo['date']; ?></span>
</div>
<br/>
<h2 class="h2-black">Заказ от <?php echo $this->orderinfo['date']; ?></h2>
<table width="100%" cellspacing="0" class="order-properties">
    <thead>
        <tr>
            <th colspan="2">
                Наименование товара
            </th>
            <th>
                Количество
            </th>
        </tr>
    </thead>
    <tbody>
		<?php getOrderInfo($this->orderinfo["oils"], "Масла"); ?>
		<?php getOrderInfo($this->orderinfo["filters"], "Фильтра"); ?>
		<?php getOrderInfo($this->orderinfo["plugs"], "Свечи зажигания"); ?>
		<?php getOrderInfo($this->orderinfo["autoparts"], "Автозапчасти"); ?>
		<?php getOrderInfo($this->orderinfo["moto"], "Мото"); ?>
		<?php getOrderInfo($this->orderinfo["coolstream"], "Coolstream"); ?>
		<?php getOrderInfo($this->orderinfo["efele"], "Efele"); ?>
		<?php getOrderInfo($this->orderinfo["filtron"], "Filtron"); ?>	
    </tbody>
</table>
<a style="float: left; margin-right: 25px;" class="add-to-bask" href="/control/history/savedorder/<?php echo $this->sessId; ?>/tobasket/">Поместить предзаказ в корзину</a>
<a style="float: left;" class="delete-item" href="/control/history/savedorder/<?php echo $this->sessId; ?>/delete/">Удалить предзаказ</a>

<?php function getOrderInfo($data, $title) {
	$return = "";
	if (count($data) > 0) {
		$return .= '<tr>';
			$return .= '<th class="field-title" colspan="3">' . $title . '</th>';
		$return .= '</tr>';
		foreach($data as $key => $value) {
			$return .= '<tr>';
				$return .= '<td colspan="2">' . $value['name'] . '</td>';
				$return .= '<td>' . $value['count'] . '</td>';
			$return .= '</tr>';
		}
	}
	echo $return;
} ?>