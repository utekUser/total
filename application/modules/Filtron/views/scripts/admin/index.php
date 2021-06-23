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
        <th><a href="/admin/filtron/<?php echo $key; ?>/"><?php echo $value; ?></a></th>
        <td><a href="/admin/filtron/<?php echo $key; ?>/add">Добавить</a></td>
        <td><a href="/admin/filtron/<?php echo $key; ?>/">Изменить</a></td>
      </tr>
    <?php } ?>
    </table>
</div>