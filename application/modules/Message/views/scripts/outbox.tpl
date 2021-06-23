<div class="path">
	<a href="/"><img alt="" src="/themes/default/images/house.png" /></a>
	<a href="/profile/">Личный кабинет</a>
	<span>Сообщения</span>
</div>
<h2>Мои сообщения:</h2>
<div class="messages-info">
	<a href="/messages/inbox/">Входящие</a><span>|</span><a href="/messages/outbox/">Отправленные</a>У вас <?php echo $this->unread; ?> новых сообщений <a href="/messages/send/" class="add-message">Написать сообщение</a>
</div>
<div class="page-razd"></div>
<?php if (sizeof($this->paginator)) { ?>
    <?php
    $conversation = new Message_Models_MessageConversations();
    foreach ($this->paginator as $item) {
//        echo "<pre>";
//        print_r($item);
//        echo "</pre>";
//        echo $item['conversation_id'];
        $message = $conversation->getOutboxMessage($item['user_id'], $item['conversation_id']);
          foreach( $conversation->getRecipients($item['conversation_id']) as $tmpUser ) {
//              echo "<pre>";
//              print_r($tmpUser);
//              echo "</pre>";
//            if( $tmpUser->getIdentity() != $this->viewer()->getIdentity() ) {
//echo $tmpUser['id'] . "<br />";
            if( $tmpUser['id'] != $item['user_id'] ) {
              $sender = $tmpUser; // должна храниться уже информация о пользователе!!!
//              echo "<pre>";
//              print_r($tmpUser);
//              echo "</pre>";
              break;
            }
          }
//          echo $sender; exit;
        if( (!isset($sender) || !$sender) ){
            echo $sender . " - " . $item['user_id'];
          if( $item['user_id'] !== $item['user_id'] ){
            $moduleUser = new User_Models_UserUser();  
            exit;
            $sender = $moduleUser->getUserNew($item['user_id']);
//            $sender = Engine_Api::_()->user()->getUser($item['user_id']);
          } else {
            $sender = $this->viewer();
          }
        }
//        echo "<pre>";
//        print_r($message);
//        echo "</pre>";
//        echo $item['user_id'];        
    ?>
    <div class="message message-first">
    	<table width="100%" cellspacing="0" cellpadding="0" border="0">
    		<tbody>
    			<tr>
    				<td width="40px" valign="middle" align="left">
    					<input type="checkbox" />
    				</td>
<!--    				<td width="80px">
    					<img alt="" src="/themes/default/images/semens.png" />
    				</td>-->
    				<td width="150px">
        				<div style="width:140px;">
        					<div>
        						<b><?php echo htmlspecialchars($sender['name']); ?></b>
        					</div>
        					<div class="message-timestamp">
        					   <?php echo $this->timestamp($message->date) ?>
    <!--    						01 ноября, 2011 ?php echo $message->date; ?>-->
        					</div>
    					</div>
    				</td>
    				<td>
    					<p><a href="#"><b><?php echo $item['title']; ?></b></a></p>
            			<div class="message-text">
                            <?php echo $message->body ?>
    					</div>
    				</td>
    			</tr>
    		</tbody>
    	</table>
    </div>
    <?php } ?>
<?php } else { ?>
<p>У Вас нет входящих сообщений.</p>
<?php } ?>

<div class="page-razd"></div>
<div class="messages-actions">
    <span onclick="$('input[type=checkbox]').attr('checked',true);" style="cursor:pointer;">Отметить все</span> / <span onclick="$('input[type=checkbox]').attr('checked',false);" style="cursor:pointer;">Снять выделение</span>
<!--	<a href="#">Отметить все</a><span>/</span><a href="#">Снять выделение</a>-->
</div>
<div class="message-delete">
<input type="submit" name="button" id="button" value="Удалить сообщения" />
<!--<button class="inputbutton">Удалить сообщения</button>-->
<!--<a href="#">Удалить сообщения</a>-->
</div>
</form>
<div class="page-razd"></div>
<div class="back"><a href="/account/">Вернуться</a></div>