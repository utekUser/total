<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Документ без названия</title>
</head>

<body>
<h1>Масла</h1>
<h2>Нету базовой цены</h2>
<?php if (count($this->oilsBaseNone)) { ?>
<table border="1" cellpadding="5" cellspacing="0">
  <tr>
    <th scope="col">Артикул в 1C</th>
    <th scope="col">Наименование</th>
    <th scope="col">Наличие</th>
    <th scope="col">Базовая цена</th>
    <th scope="col">Рекомендуемая цена</th>
  </tr>
  <?php foreach($this->oilsBaseNone as $value) { ?>
  <tr>
    <td><?php echo $value['base_id']; ?></td>
    <td><?php echo $value['invoice_name']; ?></td>
    <td><?php echo $value['env']; ?></td>
    <td><?php echo $value['price_base']; ?></td>
    <td><?php echo $value['price_rec']; ?></td>
  </tr>
  <?php } ?>
</table>
<?php } else { ?>
	<p>Все ок.</p>
<?php } ?>
<h2>Нету рекомендуемой цены</h2>
<?php if (count($this->oilsRecNone)) { ?>
<table border="1" cellpadding="5" cellspacing="0">
  <tr>
    <th scope="col">Артикул в 1C</th>
    <th scope="col">Наименование</th>
    <th scope="col">Наличие</th>
    <th scope="col">Базовая цена</th>
    <th scope="col">Рекомендуемая цена</th>
  </tr>
  <?php foreach($this->oilsRecNone as $value) { ?>
  <tr>
    <td><?php echo $value['base_id']; ?></td>
    <td><?php echo $value['invoice_name']; ?></td>
    <td><?php echo $value['env']; ?></td>
    <td><?php echo $value['price_base']; ?></td>
    <td><?php echo $value['price_rec']; ?></td>
  </tr>
  <?php } ?>
</table>
<?php } else { ?>
	<p>Все ок.</p>
<?php } ?>
<h1>Фильтра</h1>
<h2>Нету базовой цены</h2>
<?php if (count($this->filtersBaseNone)) { ?>
<table border="1" cellpadding="5" cellspacing="0">
  <tr>
    <th scope="col">Артикул в 1C</th>
    <th scope="col">Наименование</th>
    <th scope="col">Наличие</th>
    <th scope="col">Базовая цена</th>
    <th scope="col">Рекомендуемая цена</th>
  </tr>
  <?php foreach($this->filtersBaseNone as $value) { ?>
  <tr>
    <td><?php echo $value['base_id']; ?></td>
    <td><?php echo $value['invoice_name']; ?></td>
    <td><?php echo $value['env']; ?></td>
    <td><?php echo $value['price_base']; ?></td>
    <td><?php echo $value['price_rec']; ?></td>
  </tr>
  <?php } ?>
</table>
<?php } else { ?>
	<p>Все ок.</p>
<?php } ?>
<h2>Нету рекомендуемой цены</h2>
<?php if (count($this->filtersRecNone)) { ?>
<table border="1" cellpadding="5" cellspacing="0">
  <tr>
    <th scope="col">Артикул в 1C</th>
    <th scope="col">Наименование</th>
    <th scope="col">Наличие</th>
    <th scope="col">Базовая цена</th>
    <th scope="col">Рекомендуемая цена</th>
  </tr>
  <?php foreach($this->filtersRecNone as $value) { ?>
  <tr>
    <td><?php echo $value['base_id']; ?></td>
    <td><?php echo $value['invoice_name']; ?></td>
    <td><?php echo $value['env']; ?></td>
    <td><?php echo $value['price_base']; ?></td>
    <td><?php echo $value['price_rec']; ?></td>
  </tr>
  <?php } ?>
</table>
<?php } else { ?>
	<p>Все ок.</p>
<?php } ?>
</body>
</html>