<?php if (/*$_SERVER['REMOTE_ADDR'] == '78.140.9.206' ||*/ $_SERVER['REMOTE_ADDR'] == '46.161.158.155' || $_SERVER['REMOTE_ADDR'] == '88.204.72.104' || $_SERVER['REMOTE_ADDR'] == '95.170.159.81') { ?>
<style>
    .messages-info a.add-messageN {
        margin: 0;
    }
    .add-messageN {
        background: url(/themes/default/images/newdesign/write.png) 0px 0px no-repeat;
        width: 152px;
        height: 31px;
        display: block;
        float: right;
        font-size: 0;     
        margin: -35px 0 0 0;
    }
    .add-messageN:hover {
        background: url(/themes/default/images/newdesign/writeH.png) 0px 0px no-repeat;
    }
    .messages-actionsN {
        color: #00aaf0;
        margin: 12px 0 12px 0;
    }
    .messages-actionsN span {
        color: #00aaf0;
        font-family: Arial;
        font-size: 12px;
        text-decoration: underline;
    }
    .messages-actionsN span:hover {
        color: #03597d;
    }
    .sendb {
        background: url(/themes/default/images/newdesign/send.png);
        width: 96px;
        height: 31px;
        border: 0px;
        font-size: 0px;
    }
    .sendb:hover {
        background: url(/themes/default/images/newdesign/sendh.png);
    }
    .messageText {
        color: #8b8c8d;
        font-family: Arial;        
    }
    a.mesLink {
        font-size: 12px;
        text-decoration: underline;
        color: #00aaf0;
    }
    a.mesLink:hover {
        color: #03597d;
    }
    .messageText .message-text {
        font-size: 12px;
    }
</style>
<?php if (!$this->isManager) { ?>
<a href="/messages/send/" class="add-messageN"></a>
<?php } ?>
<?php /* <div class="messages-info">
У вас <?php echo $this->unread ? '<b>' . $this->unread . '</b> ' : 'нет '; 
echo Engine_Cms::declension($this->unread, array('новое сообщение', 'новых сообщения', 'новых сообщений'), true); ?> 
<?php if (!$this->isManager) { ?>
<a href="/messages/send/" class="add-messageN"></a>
<?php } ?>
</div> */ ?>
<form action="/messages/mailbox/" method="post">
    <?php if (sizeof($this->paginator)) { ?>
    <?php
    $conversation = new Message_Models_MessageConversations();
    $messageModel = new Message_Models_MessageMessages();
    $messageRes = new Message_Models_MessageRecipients();
    foreach ($this->paginator as $item) {
    $lastMessage = $messageModel->getLastMessage($item['conversation_id']);
    $mesRead = $messageRes->getMessageReadStatus($lastMessage['conversation_id'], $this->user_id);

    $message = $conversation->getOutboxMessage($item['user_id'], $item['conversation_id']);

    foreach ($conversation->getRecipients($item['conversation_id']) as $tmpUser) {
    if ($tmpUser['id'] != $item['user_id'] ) {
    $sender = $tmpUser; // должна храниться уже информация о пользователе!!!
    break;
    }
    }
    ?>
    <div class="message message-first" style="margin: 35px 0;">
        <table width="100%" cellspacing="0" cellpadding="0" border="0" class="msg" style="border: 0px;">
            <tbody>
                <tr>
                    <td valign="middle" align="left" style="width: 25px; padding: 10px;">
                        <input type="checkbox" value="<?php echo $item['conversation_id']; ?>" name="type[]" />
                    </td>
                    <?php /* <td width="150px">
                    <div style="width:140px;">
                    <div>
                    <b><?php echo htmlspecialchars($sender['name']); ?></b>
                    </div>
            <div class="message-timestamp">
                <?php echo $this->timestamp($message->date) ?>
                <?php /*01 ноября, 2011 ?php echo $message->date;* ?>
            </div>
    </div>
</td> */ ?>
<td class="messageText" style="border-left: 1px solid #ffe735;">
    <a class="mesLink" href="/messages/view/<?php echo $item['conversation_id']; ?>"><?php echo $item['title']; ?></a>
    <div class="message-text <?php echo ($mesRead ? '' : 'mes-unread'); ?>" style="padding: 5px 0;">
        <?php echo $lastMessage['body']; ?>
    </div>
</td>
</tr>
</tbody>
</table>
</div>
<?php } ?>
<?php } else { ?>
<p>У Вас нет сообщений.</p>
<?php } ?>
<div class="messages-actionsN">
    <span onclick="$('input[type=checkbox]').attr('checked', true);" style="cursor:pointer;">Отметить все</span>  /  <span onclick="$('input[type=checkbox]').attr('checked', false);" style="cursor:pointer;">Снять выделение</span>
</div>
<div class="message-deleteN">
    <input type="submit" class="sendb" name="button" id="button" />
</div>
</form>
<?php } else { ?>
<div class="path">
    <a href="/"><img alt="" src="/themes/default/images/house.png" /></a>
    <a href="/control/">Личный кабинет</a>
    <span>Сообщения</span>
</div>
<h2>Мои сообщения:</h2>
<div class="messages-info">
    <?php /*?><a href="/messages/inbox/">Входящие</a><span>|</span><a href="/messages/outbox/">Отправленные</a><?php*/ ?>
    У вас <?php echo $this->unread ? '<b>' . $this->unread . '</b> ' : 'нет '; 
    echo Engine_Cms::declension($this->unread, array('новое сообщение', 'новых сообщения', 'новых сообщений'), true); ?> 
    <?php if (!$this->isManager) { ?>
    <a href="/messages/send/" class="add-message">Написать сообщение</a>
    <?php } ?>
</div>
<div class="page-razd"></div>
<form action="/messages/mailbox/" method="post">
    <?php if (sizeof($this->paginator)) { ?>
    <?php
    $conversation = new Message_Models_MessageConversations();
    $messageModel = new Message_Models_MessageMessages();
    $messageRes = new Message_Models_MessageRecipients();
    foreach ($this->paginator as $item) {
    $lastMessage = $messageModel->getLastMessage($item['conversation_id']);
    $mesRead = $messageRes->getMessageReadStatus($lastMessage['conversation_id'], $this->user_id);

    $message = $conversation->getOutboxMessage($item['user_id'], $item['conversation_id']);

    foreach ($conversation->getRecipients($item['conversation_id']) as $tmpUser) {
    if ($tmpUser['id'] != $item['user_id'] ) {
    $sender = $tmpUser; // должна храниться уже информация о пользователе!!!
    break;
    }
    }

    /*if( (!isset($sender) || !$sender) ) {
    echo $sender . " - " . $item['user_id'];
    if( $item['user_id'] !== $item['user_id'] ){
    $moduleUser = new User_Models_UserUser();  
    exit;
    $sender = $moduleUser->getUserNew($item['user_id']);
    } else {
    $sender = $this->viewer();
    }
    }*/
    ?>
    <div class="message message-first">
        <table width="100%" cellspacing="0" cellpadding="0" border="0" class="msg">
            <tbody>
                <tr>
                    <td width="40px" valign="middle" align="left">
                        <input type="checkbox" value="<?php echo $item['conversation_id']; ?>" name="type[]" />
                    </td>
                    <?php /*?>
                    <td width="80px">
                        <img alt="" src="/themes/default/images/semens.png" />
                    </td>
                    <?php */?>
                    <td width="150px">
                        <div style="width:140px;">
                            <div>
                                <b><?php echo htmlspecialchars($sender['name']); ?></b>
                            </div>
                            <div class="message-timestamp">
                                <?php echo $this->timestamp($message->date) ?>
                                <?php /*01 ноября, 2011 ?php echo $message->date;*/ ?>
                            </div>
                        </div>
                    </td>
                    <td>
                        <p><a href="/messages/view/<?php echo $item['conversation_id']; ?>"><b><?php echo $item['title']; ?></b></a></p>
                        <div class="message-text <?php echo ($mesRead ? '' : 'mes-unread'); ?>">
                            <?php echo $lastMessage['body']; ?>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <?php } ?>
    <?php } else { ?>
    <p>У Вас нет сообщений.</p>
    <?php } ?>

    <div class="page-razd"></div>
    <div class="messages-actions">
        <span onclick="$('input[type=checkbox]').attr('checked', true);" style="cursor:pointer;">Отметить все</span> / <span onclick="$('input[type=checkbox]').attr('checked', false);" style="cursor:pointer;">Снять выделение</span>
        <?php /*<a href="#">Отметить все</a><span>/</span><a href="#">Снять выделение</a> */ ?>
    </div>
    <div class="message-delete">
        <input type="submit" name="button" id="button" value="Удалить сообщения" />
        <?php /* <!--<button class="inputbutton">Удалить сообщения</button>-->
        <!--<a href="#">Удалить сообщения</a>-->*/ ?>
    </div>
</form>
<div class="page-razd"></div>
<div class="back"><a href="/control/">Вернуться</a></div>
<?php } ?>