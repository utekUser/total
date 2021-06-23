<div class="path">
	<a href="/"><img alt="" src="/themes/default/images/house.png" /></a>
	<a href="/control/profile/">Личный кабинет</a>
	<span>Уведомления</span>
</div>
<h2>Уведомления</h2>
<?php if (count($this->messages)) { ?>
<table width="100%" class="msg">
    <tbody>
    <?php foreach ($this->messages as $message) { ?>
        <tr <?php echo ($message['view'] ? '' : ' style="background:#eee;"'); ?>>
            <td width="100px"><?php echo $this->Date($message['posted']); ?></td>
            <td><a href="/control/notice/<?php echo $message['id']; ?>"><?php echo ($message['view'] ? $message['name'] : '<b>' . $message['name'] . '</b>'); ?></a></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<?php } ?>