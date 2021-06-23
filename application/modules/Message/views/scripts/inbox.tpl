<div class="path">
	<a href="/"><img alt="" src="/themes/default/images/house.png" /></a>
	<a href="/control/">Личный кабинет</a>
	<span>Сообщения</span>
</div>
<h2>Мои сообщения:</h2>
<div class="messages-info">
	<?php /*?><a href="/messages/inbox/">Входящие</a><span>|</span><a href="/messages/outbox/">Отправленные</a><?php*/ ?>
	У вас <?php echo $this->unread ? '<b>' . $this->unread . '</b>' : 'нет' ; ?> новых сообщений <a href="/messages/send/" class="add-message">Написать сообщение</a>
</div>
<div class="page-razd"></div>
<form action="" method="post">
<?php if (sizeof($this->paginator)) { ?>
    <?php
    $conversation = new Message_Models_MessageConversations();
    $messageModel = new Message_Models_MessageMessages();
    foreach ($this->paginator as $item) {
        $lastMessage = $messageModel->getLastMessage($item['conversation_id']);
        
        $message = $conversation->getOutboxMessage($item['user_id'], $item['conversation_id']);
        foreach( $conversation->getRecipients($item['conversation_id']) as $tmpUser ) {
            if( $tmpUser['id'] != $item['user_id'] ) {
                $sender = $tmpUser; // должна храниться уже информация о пользователе!!!
                break;
            }
        }
        if( (!isset($sender) || !$sender) ) {
            echo $sender . " - " . $item['user_id'];
            if( $item['user_id'] !== $item['user_id'] ) {
                $moduleUser = new User_Models_UserUser();  
                exit;
                $sender = $moduleUser->getUserNew($item['user_id']);
            } else {
                $sender = $this->viewer();
            }
        }
    ?>
    <div class="message message-first">
    	<table width="100%" cellspacing="0" cellpadding="0" border="0" class="msg">
    		<tbody>
    			<tr>
    				<td width="40px" valign="middle" align="left">
        				<input type="checkbox" value="<?php echo $item['conversation_id']; ?>" name="type[]">
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
            			<div class="message-text <?php //echo ($message->) ?>">
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
    <span onclick="$('input[type=checkbox]').attr('checked',true);" style="cursor:pointer;">Отметить все</span> / <span onclick="$('input[type=checkbox]').attr('checked',false);" style="cursor:pointer;">Снять выделение</span>
<?php /*<a href="#">Отметить все</a><span>/</span><a href="#">Снять выделение</a> */  ?>
</div>
<div class="message-delete">
<input type="submit" name="button" id="button" value="Удалить сообщения" />
<?php /*
<!--<button class="inputbutton">Удалить сообщения</button>-->
<!--<a href="#">Удалить сообщения</a>-->
*/  ?>
</div>
</form>
<div class="page-razd"></div>
<div class="back"><a href="/account/">Вернуться</a></div>