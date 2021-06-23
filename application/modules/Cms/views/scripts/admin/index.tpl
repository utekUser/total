<div class="list-init">
    <table width="100%%" border="0" cellspacing="0" cellpadding="0">
    <caption>Статьи</caption>
    <?php foreach ($this->module as $key => $value) { ?>
      <tr>
        <th><a href="/admin/cms/<?php echo $key; ?>/"><?php echo $value; ?></a></th>
        <td><a href="/admin/cms/<?php echo $key; ?>/add">Добавить</a></td>
        <td><a href="/admin/cms/<?php echo $key; ?>/">Изменить</a></td>
      </tr>
    <?php } ?>
    </table>
</div>