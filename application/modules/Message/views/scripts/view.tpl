<div class="path">
	<a href="/"><img alt="" src="/themes/default/images/house.png" /></a>
	<a href="/control/">Личный кабинет</a>
	<a href="/messages/">Сообщения</a>
	<span><?php echo ($this->conversation['title'] ? $this->conversation['title'] : 'Без темы'); ?></span>
</div>
<h2>Мои сообщения:</h2>
<div class="messages-info">
	<?php /*?><a href="/messages/inbox/">Входящие</a><span>|</span><a href="/messages/outbox/">Отправленные</a><?php*/ ?>
	У вас <?php echo $this->unread ? '<b>' . $this->unread . '</b> ' : 'нет ' ; 
	echo Engine_Cms::declension($this->unread, array('новое сообщение', 'новых сообщения', 'новых сообщений'), true); ?>
	<?php if (!$this->isManager) { ?>
	<a href="/messages/send/" class="add-message">Написать сообщение</a>
	<?php } ?>
</div>
<div class="page-razd"></div>

<div style="margin:20px 0; font-size: 13px; font-weight:700;">
    <?php /*<div style="float:right;">
        <div class="message-delete"><a href="/messages/delete/<?php echo $this->conversation['conversation_id']; ?>">Удалить сообщениe</a></div>
    </div>*/?>
<?php echo ($this->conversation['title'] ? $this->conversation['title'] : 'Без темы'); ?>
</div>
<?php foreach ($this->messages as $value) { ?>
<?php $userModel = new User_Models_UserUser(); $userData = $userModel->getUserWithInfo($value['user_id']); ?>
        <?php /*<div class="messages-m">*/ ?>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="msg">
                <tr>
                    <?php /*?>
                    <td width="80">
                        <?php if ($userData['avatar']) { ?>
                        <a href="/players/<?php echo $userData['login']; ?>/"><img width="70" class="thumb_icon item_photo_user  thumb_icon" alt="" src="/<?php echo $userData['avatar']; ?>p.jpg"></a>
                        <?php } else { ?>
                        <a href="/players/<?php echo $userData['login']; ?>/"><img width="70" alt="" src="/images/noavatar.gif"></a>
                        <?php } ?>
                    </td>
                    <?php */?>
                    <td width="150">
                    <?php if ($this->isManager) { ?>
                        <?php echo $userData['login']; ?>
                    <?php } else { ?>
                        <?php if ($userData['manager']) { ?>
                            <b>Менеджер</b>
                        <?php } else { ?>
                            <?php echo $userData['name']; ?>
                        <?php } ?>
                    <?php } ?>
                        <?php /*?>
                        <div><a href="/players/<?php echo $userData['login']; ?>/"><?php echo $userData['login']; ?></a></div>
                        <?php */?>
                        <div  class="messages-timestamp">
                            <span title="<?php echo $this->Date($value['date'], 'date'); ?>"><?php echo $this->Date($value['date'], 'date'); ?></span>
                        </div>
                    </td>
                    <td>
                        <?php echo nl2br(htmlspecialchars($value['body'])); ?>
                    </td>
                </tr>
            </table>
        <?php /*</div>*/ ?>
<?php } ?>
<a name="form"></a>
<form method="post" action="/messages/view/<?php echo $this->conversation['conversation_id']; ?>">
    <div class="rform">
        <div class="rform-input-full" style="float:none; margin:0 auto;">
            <textarea name="body" cols="45" rows="5"></textarea>
        </div>
    </div>
    <div style="text-align: center;" class="rform">
        <input type="submit" value="Отправить ответ" id="button" name="button" class="inputbutton">
    </div>
</form>