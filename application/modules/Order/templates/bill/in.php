<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Документ без названия</title>

		<style type="text/css">
			body,td,th {
				font-size: 13px;
				font-family: Arial, Helvetica, sans-serif;
			}

			table {
				border: none;
				border-collapse: collapse;
			}
			th, td {
				border:solid #000 !important;
				border-width: 1px !important;
			}
			table.order td,
			table.order th{
				font-size: 13px;
			}
			table.bordernone {
				border: none;
			}
			table.bordernone th, table.bordernone td {
				border: none;
			}
		</style>
	</head>

	<body>
		<!--img src="var:myvariable" /-->
		<img src="/media/filebrowser/templates/bill/header.jpg" />
		<p>г. Томск, ул.Тверская, 18, Оптовый отдел: (3822) 266-933, (3822) 266-866. Розница: 266-687. http://total.tomsk.ru/</p>
		<hr>
		<p style="font-size: 16px; margin: 0"><strong><?php echo $this->typeOrder; ?> от <?php echo date('d.m.Y'); ?></strong> <?php echo date('H:i'); ?></p>
		<p style="font-size: 12px">Поставщик: ООО &quot;Томавтотрейд Плюс&quot; ИНН 7017222702 КПП 701701001<br>
			Заказчик: <?php echo ($this->orderData['company_name'] ? $this->orderData['company_name'] : $this->orderData['customer_name']); ?><?php echo ( $this->orderData['company_inn'] ? ' ИНН ' . $this->orderData['company_inn'] : ''); ?><?php echo ( $this->orderData['company_kpp'] ? ' КПП ' . $this->orderData['company_kpp'] : ''); ?></p>
		<?php
		$summ = number_format($this->totalSum, 2, ',', ' ');
		$summArray = explode(",", $summ);

		$nds = number_format($this->totalSum - $this->totalSum / 1.18, 2, ',', ' ');
		?>
		<table class="order" width="100%" border="1" cellspacing="0" cellpadding="5">
			<tr>
				<th width="30" align="center" scope="col">№ п/п</th>
				<th colspan="2" scope="col">Наименование товара</th>
				<th align="center" scope="col">Кол-во</th>
				<th scope="col">Цена, руб.</th>
				<th width="80" scope="col">Сумма, руб.</th>
			</tr>
			<?php foreach ($this->items as $key => $value) { ?>
				<tr>
					<td align="center"><?php echo $key + 1; ?></td>
					<?php /*
					  <td width="160">
					  <?php if ($value['type'] == 'filter') { ?>
					  Фильтры MANN
					  <?php } ?>
					  <?php if ($value['type'] == 'oil') { ?>
					  Масла Total, ELF
					  <?php } ?>
					  <?php if ($value['type'] == 'plug') { ?>
					  Свечи NGK
					  <?php } ?>
					  </td>
					  <?php */ ?>
					<td width="50"><?php echo $value['base_id']; ?></td>
					<td><?php echo $value['name']; ?></td>
					<td align="center"><?php echo $value['amount']; ?></td>
					<td><?php echo number_format($value['price'], 2, ',', ' '); ?></td>
					<td><?php echo number_format($value['price'] * $value['amount'], 2, ',', ' '); ?></td>
				</tr>
			<?php } ?>
		</table>
		<table class="bordernone" width="100%" border="0" cellspacing="0" cellpadding="5">
			<tr>
				<td rowspan="2" align="left">
					<p>Всего наименований <?php echo count($this->items); ?>, на сумму <?php echo $summArray[0]; ?> руб. <?php echo $summArray[1]; ?> копеек.<br>
						<strong><?php echo Engine_Cms::mb_ucfirst(Engine_Cms::num2str($this->totalSum)); ?>.</strong></p>
				</td>
				<td style="border-left: none; border-right: none; border-bottom: none;" align="right"><strong>Итого</strong></td>
				<td width="80" style="border-left: none; border-right: none; border-bottom: none;"><strong><?php echo $summ; ?></strong></td>
			</tr>
			<tr>
				<td style="border-left: none; border-right: none; border-top: none;" align="right"><strong>В том числе НДС</strong></td>
				<td style="border-left: none; border-right: none; border-top: none;"><strong><?php echo $nds; ?></strong></td>
			</tr>
		</table>

		<?php if (count($this->desiredItems)) { ?>
			<h2>Желаемый продукт</h2>
			<table class="order" width="100%" border="1" cellspacing="0" cellpadding="5">
				<tr>
					<th>Наименование желаемого товара для заказа</th>
				</tr>
				<?php foreach ($this->desiredItems as $key => $value) { ?>
		            <tr>
		                <td><?php echo $value['name']; ?></td>
		            </tr>
				<?php } ?>
			</table>
		<?php } ?>

		<hr>
		<table class="bordernone" width="100%" border="0" cellspacing="0" cellpadding="5">
			<tr>
				<td><strong>Тип учетной записи:</strong> <?php echo $this->type; ?></td>
				<td><strong>Логин:</strong> <?php echo $this->user->login; ?></td>
			</tr>
			<tr>
				<td><strong>Название компании:</strong> <?php echo $this->userInfo->title; ?></td>
				<td><strong>Контактное лицо:</strong> <?php echo $this->userInfo->name; ?></td>
			</tr>
			<tr>
				<td colspan="2"><strong>Юридический адрес:</strong> <?php echo $this->userInfo->ur_address; ?></td>
			</tr>
			<tr>
				<td><strong>E-mail:</strong> <?php echo $this->user->email; ?></td>
				<td><strong>Телефон:</strong> <?php echo $this->phone; ?></td>
			</tr>
		</table>
		<hr>
		<table class="bordernone" width="100%" border="0" cellspacing="0" cellpadding="5">
			<tr>
				<td width="50%"><strong>Доставка:</strong> <?php echo $this->delivery; ?></td>
				<td width="50%"><strong>Оплата:</strong> <?php echo $this->payment; ?></td>
			</tr>
			<tr>
				<td colspan="2"><strong>Комментарии к заказу:</strong><br><?php echo $this->comment; ?></td>
			</tr>
		</table>
	</body>
</html>