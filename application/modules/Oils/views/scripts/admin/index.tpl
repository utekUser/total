<div class="path-l">
	<div class="path-r">
		<div class="path-m">
			<div class="path">
                <?php echo $this->path; ?>
			</div>
			<div class="module-name">
                <?php echo $this->header; ?>
			</div>
		</div>
	</div>
</div>

<div class="list-init">
    <table width="100%%" border="0" cellspacing="0" cellpadding="0">
    <caption>Статьи</caption>
    <?php foreach ($this->module as $key => $value) { ?>
      <tr>
        <th><a href="/admin/oils/<?php echo $key; ?>/"><?php echo $value; ?></a></th>
        <td><a href="/admin/oils/<?php echo $key; ?>/add">Добавить</a></td>
        <td><a href="/admin/oils/<?php echo $key; ?>/">Изменить</a></td>
      </tr>
    <?php } ?>
    </table>
</div>


<div style="margin: 40px 0 0 0; padding: 10px 10px 20px 10px; background: #F9F9F9; border-radius: 5px; moz-border-radius: 5px; webkit-border-radius: 5px; width: 500px; border: 1px solid #D4D4D4;">
<h4>Отчеты о поиске масел</h4>
<form method="post" action="/admin/oils/searchoilreport/" target="_blank">
	<input type="text" placeholder="Дата начала периода: 2015-10-01" name="startdate" style="width: 300px; margin: 0 0 15px 0; padding: 4px 10px; background: #ffffff;" /> <br/>
	<input type="text" placeholder="Дата окончания периода: 2015-10-31" name="enddate" style="width: 300px; margin: 0 0 15px 0; padding: 4px 10px; background: #ffffff;" /> <br/>
	<input type="hidden" name="typesearch" value="oils" />
        <p style="font-size: 20px; font-weight: bold; margin: 0 0 20px 0;">Формат ввода даты: <br/> ГОД-МЕСЯЦ-ДЕНЬ (2015-10-31)</p>
	<input type="submit" style="padding: 4px 10px;" value="Сформировать отчет" />
</form>
</div>