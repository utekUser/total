<?php
class Message_Models_MessageConversations extends Engine_Model_Abstract {
    protected $_dbTableName = 'Message_Models_DbTable_MessageConversations';
    
    protected $_formTableName = 'Message_Form_MessageConversations';
    
//    protected $_orderBy = 'pos DESC';

    public function getInboxPaginator(Zend_Auth $user) {
        $paginator = new Zend_Paginator_Adapter_DbTableSelect($this->getInboxSelect($user));
        $paginator->setRowCount($this->getInboxCountSelect($user));
        return new Engine_Paginator($paginator);
    }
    
    public function getInboxSelect(Zend_Auth $user) {
        $recipients = new Message_Models_MessageRecipients();
        $rName = $recipients->getDbTable()->info('name');
//        $rName = Engine_Api::_()->getDbtable('recipients', 'messages')->info('name');
        $cName = $this->getDbTable()->info('name');
        $select = $this->getDbTable()->select()
        ->from($cName)
        ->joinRight($rName, "`{$rName}`.`conversation_id` = `{$cName}`.`conversation_id`", null)
        ->where("`{$rName}`.`user_id` = ?", $user->getIdentity())
        ->where("`{$rName}`.`inbox_deleted` = ?", 0)
        ->order(new Zend_Db_Expr('inbox_updated DESC'));
        ;
//        echo $select;
        return $select;
    }
    
    public function getInboxCountSelect(Zend_Auth $user) {
        $recipients = new Message_Models_MessageRecipients();
        $rName = $recipients->getDbTable()->info('name');
//        $rName = Engine_Api::_()->getDbtable('recipients', 'messages')->info('name');
        $cName = $this->getDbTable()->info('name');
        $select = new Zend_Db_Select($this->getDbTable()->getAdapter());
        $select
        ->from($cName, new Zend_Db_Expr('COUNT(1) AS zend_paginator_row_count'))
        ->joinRight($rName, "`{$rName}`.`conversation_id` = `{$cName}`.`conversation_id`", null)
        ->where("`{$rName}`.`user_id` = ?", $user->getIdentity())
        ->where("`{$rName}`.`inbox_deleted` = ?", 0);
        return $select;
    }
    
    public function getInboxCount() {
            
    }
    
    public function getOutboxPaginator(Zend_Auth $user) {
        $paginator = new Zend_Paginator_Adapter_DbTableSelect($this->getOutboxSelect($user));
        $paginator->setRowCount($this->getOutboxCountSelect($user));
        return new Engine_Paginator($paginator);
    }
    
    public function getOutboxSelect(Zend_Auth $user) {
        $recipients = new Message_Models_MessageRecipients();
        $rName = $recipients->getDbTable()->info('name');
//        $rName = Engine_Api::_()->getDbtable('recipients', 'messages')->info('name');
        $cName = $this->getDbTable()->info('name');
        $select = $this->getDbTable()->select()
                                     ->from($cName)
                                     ->joinRight($rName, "`{$rName}`.`conversation_id` = `{$cName}`.`conversation_id`", null)
                                     ->where("`{$rName}`.`user_id` = ?", $user->getIdentity())
                                     ->where("`{$rName}`.`outbox_deleted` = ?", 0)
                                     ->order(new Zend_Db_Expr('outbox_updated DESC'));
//                                     echo $select;
        return $select;
    }
    
    public function getOutboxCountSelect(Zend_Auth $user) {
        $recipients = new Message_Models_MessageRecipients();
        $rName = $recipients->getDbTable()->info('name');
//        $rName = Engine_Api::_()->getDbtable('recipients', 'messages')->info('name');
        $cName = $this->getDbTable()->info('name');
        $select = new Zend_Db_Select($this->getDbTable()->getAdapter());
        $select
          ->from($cName, new Zend_Db_Expr('COUNT(1) AS zend_paginator_row_count'))
          ->joinRight($rName, "`{$rName}`.`conversation_id` = `{$cName}`.`conversation_id`", null)
          ->where("`{$rName}`.`user_id` = ?", $user->getIdentity())
          ->where("`{$rName}`.`outbox_deleted` = ?", 0);
        return $select;
    }
    
    public function getOutboxMessage($user, $conversation_id) {
//        echo "!" . $user . " - " . $conversation_id; exit;
        $recipient = $this->getRecipientInfo($user, $conversation_id);
        if( empty($recipient->outbox_message_id) || $recipient->outbox_message_id == 'NULL' ) {
            return null;
        }
//        echo $recipient->outbox_message_id . '!!!'; exit;
        $module = new Message_Models_DbTable_MessageMessages();
        return $module->find($recipient->outbox_message_id)->current();
//        return Engine_Api::_()->getItem('messages_message', $recipient->outbox_message_id);
    }
    
    public function getItem($id) {
        return $this->getDbTable()->find($id)->current();
    }
    
    
/*    public function getMessagesPaginator(Zend_Auth $user) {
        $paginator = new Zend_Paginator_Adapter_DbTableSelect($this->getMessagesSelect($user));
        $paginator->setRowCount($this->getInboxCountSelect($user));
        return new Engine_Paginator($paginator);
    }
    
    public function getMessagesSelect(Zend_Auth $user) {
        $recipients = new Message_Models_MessageRecipients();
        $rName = $recipients->getDbTable()->info('name');
        $cName = $this->getDbTable()->info('name');
        $select = $this->getDbTable()->select()
            ->from($cName)
            ->joinRight(
                $rName, 
                "`{$rName}`.`conversation_id` = `{$cName}`.`conversation_id`", 
                null
            )
            ->where("`{$rName}`.`user_id` = ?", $user->getIdentity())
            ->where("`{$rName}`.`inbox_deleted` = ?", 0)
            ->order(new Zend_Db_Expr('inbox_updated DESC'));
        ;
//        echo $select;
        return $select;
    }
    
    public function getMessagesCountSelect(Zend_Auth $user) {
        $recipients = new Message_Models_MessageRecipients();
        $rName = $recipients->getDbTable()->info('name');
//        $rName = Engine_Api::_()->getDbtable('recipients', 'messages')->info('name');
        $cName = $this->getDbTable()->info('name');
        $select = new Zend_Db_Select($this->getDbTable()->getAdapter());
        $select
        ->from($cName, new Zend_Db_Expr('COUNT(1) AS zend_paginator_row_count'))
        ->joinRight($rName, "`{$rName}`.`conversation_id` = `{$cName}`.`conversation_id`", null)
        ->where("`{$rName}`.`user_id` = ?", $user->getIdentity())
        ->where("`{$rName}`.`inbox_deleted` = ?", 0);
        return $select;
    }*/
    
//    public function getOutboxMessage($user) {
//        $recipient = $this->getRecipientInfo($user);
////        if( empty($recipient->outbox_message_id) || $recipient->outbox_message_id == 'NULL' ) {
////            return null;
////        }
//        echo "!!!!!!!!";
//        $table = new Message_Models_MessageMessages();
//        print_r($table->getDbTable()->find($user)->current());
//        return $this->getDbTable()->find($user)->current();
//        
////        return Engine_Api::_()->getItem('messages_message', $recipient->outbox_message_id);
//    }
    
  public function getRecipientInfo($user, $conversation_id) {
//      echo "<pre>";
//      print_r($this->getRecipientsInfo($conversation_id));
//echo "<pre>";
//print_r($this->getRecipientsInfo($conversation_id)->getRowMatching('user_id', $user));
//exit;
    return $this->getRecipientsInfo($conversation_id)->getRowMatching('user_id', $user);
  }
  
  public function getRecipientsInfo($conversation_id) {
//    if( empty($this->store()->recipientsInfo) )
//    {
    $module = new Message_Models_MessageRecipients();
    $table = $module->getDbTable();
    
//      $table = Engine_Api::_()->getDbtable('recipients', 'messages');
      $select = $table->select()
                                    ->where('conversation_id = ?', $conversation_id);
//                                    echo $select;
//                                    exit;
//      $this->store()->recipientsInfo = $table->fetchAll($select);
      $recipientsInfo = $table->fetchAll($select);
//    }
//echo "<pre>";
//print_r($recipientsInfo);
//echo "</pre>";

//    return $this->store()->recipientsInfo;
    return $recipientsInfo;
  }
  
  public function getRecipients($conversation_id) {
//    if( empty($this->store()->recipients) )
//    {
      $ids = array();
      foreach( $this->getRecipientsInfo($conversation_id) as $row )
      {
        $ids[] = $row->user_id;
      }
//      echo "<pre>";
//      print_r($ids);
//      echo "</pre>";

        $registry = Engine_Api::getInstance();
        $db = $registry->getContainer()->db;
        $this->_tablePrefix = $registry->getContainer()->tablePrefix;
//        print_r($ids);
        $select = $db->select()
                    ->from(
                        array('a' => $this->_tablePrefix .'user'),
                        array('*')
                      )
                    ->joinLeft(
                        array('b' => $this->_tablePrefix . 'user_info'),
                        'a.id = b.user_id',
                        array('name')
                      )
//                    ->order('posted DESC')
                    ->where('a.id IN (?)', $ids)
                    ->limit('1');
                    
        $result = $db->fetchAll($select);
        return $result;
                    echo $select; exit;


            $module = new User_Models_DbTable_UserUser();
            
            
            $userInfo = new User_Models_UserInfo();
            $user = new User_Models_UserUser();
            $table  = $user->getDbTable();
//            echo $cName = $table->info('name');
//            echo "<pre>";
//            print_r($table);
//            echo "</pre>";
            $select = $table->select()
                            ->from(
                                array('a' => $table->info('name')),
                                array('*')
                            )
                            ->join(
                                array('b' => $userInfo->getDbTable()->info('name')),
                                'a.id = b.user_id'
                              );
                              echo $select . "!!!";
//            echo "<pre>";
//            print_r($module->find($ids));
//            exit;
//!!!!!!!!!!!!!!
//        $table  = $this->getDbTable();
//        
//        $select = $table->select()
//                        ->where('`id` = ?', $id)
//                        ->limit('1');
//        $result = $table->fetchRow($select);
//        return $result;
//!!!!!!!!!!!!!!!!!!!   
        
            return $module->find($ids);
//      $this->store()->recipients = Engine_Api::_()->getItemMulti('user', $ids);
//    }

    return $this->store()->recipients;
  }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
  
  
  
  
  
  
  
  
  
  
    public function getCurrentConversation($id) {
        $table  = $this->getDbTable();
        
        $select = $table->select()
                        ->where('conversation_id = ?', $id)
                        ->limit('1');
        $result = $table->fetchRow($select);
        return $result;
    }
    
    public function getConversations($user_id) {
        $registry = Engine_Api::getInstance();
        $db = $registry->getContainer()->db;
        $this->_tablePrefix = $registry->getContainer()->tablePrefix;
        
        $select = $db->select()
                    ->from(
                        array('a' => $this->_tablePrefix . 'message_conversations'),
                        array('*')
                    )
                    ->joinRight(
                        array('b' => $this->_tablePrefix . 'message_recipients'),
                        'a.conversation_id = b.conversation_id',
                        array('conversation_id AS fconversation', 'outbox_message_id AS foutbox_message_id')
                    )
                    ->where('b.user_id = ?', $user_id)
                    ->where('b.inbox_deleted = 0')
                    ->order('inbox_updated DESC');
        $result = $db->fetchAll($select);
        return $result;
    }
    

    /**
     * Отправка сообщений
     *
     * @param Zend_Auth $user
     * @param unknown_type $recipients
     * @param unknown_type $title
     * @param unknown_type $body
     * @param unknown_type $attachment
     */
    public function send(Zend_Auth $user, $recipients, $title, $body, $attachment = null) {
        $resource = null;    

        $conversation  = $this->getDbTable();
        
//        echo 'user_from' . $user->getIdentity();
//        echo '<pre>';
//        print_r($recipients);
//        echo '</pre>';
        
        // Создание переписки
        $data = array(
            'user_id' => $user->getIdentity(),
            'title' => $title,
            'recipients' => count($recipients),
            'modified' => date('Y-m-d H:i:s'),
            'locked' => ( $resource ? true : false ),
//            'resource_type' => ( !$resource ? null : $resource->getType() ),
//            'resource_id' => ( !$resource ? 0 : $resource->getIdentity() ),
        );
        $conversation->insert($data);
        $conversationId = $conversation->getAdapter()->lastInsertId();
        
        // Создание сообщения
        $model = new Message_Models_MessageMessages();
        $message  = $model->getDbTable();
        $data = array(
          'conversation_id' => $conversation->getAdapter()->lastInsertId(),
          'user_id' => $user->getIdentity(),
          'title' => $title,
          'body' => $body,
          'date' => date('Y-m-d H:i:s'),
          'attachment_type' => ( $attachment ? $attachment->getType() : '' ),
          'attachment_id' => ( $attachment ? $attachment->getIdentity() : 0 ),
        );
        $message->insert($data);
        $messageId = $message->getAdapter()->lastInsertId();
        
//        echo $messageId; exit;
        $model = new Message_Models_MessageRecipients();
        $recipient = $model->getDbTable();
        
        // Создаем отправителю исходящее
        $data = array(
          'user_id' => $user->getIdentity(),
          'conversation_id' => $conversationId,
          'outbox_message_id' => $messageId,
          'outbox_updated' => date('Y-m-d H:i:s'),
          'outbox_deleted' => 0,
          'inbox_deleted' => 0,
//          'inbox_deleted' => 1,
          'inbox_read' => 1
        );
        $recipient->insert($data);
        
        // Создаем получателям входящее
        foreach( $recipients as $recipient_id ) {
            $recipient->insert(array(
                'user_id' => $recipient_id,
                'conversation_id' => $conversationId,
                'inbox_message_id' => $messageId,
                'inbox_updated' => date('Y-m-d H:i:s'),
                'inbox_deleted' => 0,
                'inbox_read' => 0,
                'outbox_message_id' => 0,
                'outbox_deleted' => 0,
//                'outbox_deleted' => 1,
            ));
        }
    }
    
  public function reply(Zend_Auth $user, $body, $attachment) {
//      echo '!!!!!'; exit;
//    $notInConvo = true;
//    $recipients = $this->getRecipients();
//    $recipientsInfo = $this->getRecipientsInfo();
//    foreach( $recipients as $recipient )
//    {
//      if( $recipient->isSelf($user) )
//      {
//        $notInConvo = false;
//      }
//    }
//
//    if( $notInConvo )
//    {
//      throw new Messages_Model_Exception('Specified user not in convo');
//    }

//    $convoTable = $this->getTable();
//    $messagesTable = Engine_Api::_()->getItemTable('messages_message');

//    $conversations = new Message_Models_MessageConversations();
    $messagesTable = new Message_Models_DbTable_MessageMessages();
    $recipients = new Message_Models_DbTable_MessageRecipients();
    
    // Update this
    $this->getDbTable()->update(
        array('modified' => date('Y-m-d H:i:s')), 
        array('conversation_id = ?' => $id = Engine_Controller_Action::getStatParam("id"))
    );
//    $this->modified = date('Y-m-d H:i:s');
//    $this->save();

    $title = 'Re: ' . $this->getMessages($user, $id)->current()->title;
//echo $title; exit;
    // Insert message
    $message = $messagesTable->createRow();
    $message->setFromArray(array(
      'conversation_id' => $id,
//      'conversation_id' => $this->getIdentity(),
      'user_id' => $user->getIdentity(),
      'title' => '', //$title,
      'body' => $body,
      'date' => date('Y-m-d H:i:s'),
//      'attachment_type' => ( $attachment ? $attachment->getType() : '' ),
//      'attachment_id' => ( $attachment ? $attachment->getIdentity() : 0 ),
    ));
    $message->save();
//    echo $message->message_id . "!!!";
    
    $messageId = $message->message_id;
//    echo '<pre>';
//    print_r($messagesTable->getAdapter());
//    echo '</pre>';
//    echo 'id='.$id;
//    echo "<pre>";
//    print_r($message);
//    exit;
//echo $message->getIdentity() . "!!!"; exit;
    // Update sender's outbox
    $recipients->update(array(
//      'outbox_message_id' => $message->getIdentity(),
      'outbox_message_id' => $messageId,
      'outbox_updated' => date('Y-m-d H:i:s'),
      'outbox_deleted' => 0
    ), array(
      'user_id = ?' => $user->getIdentity(),
      'conversation_id = ?' => $id,
//      'conversation_id = ?' => $this->getIdentity(),
    ));

    // Update recipients' inbox
    $recipients->update(array(
//      'inbox_message_id' => $message->getIdentity(),
      'inbox_message_id' => $messageId,
      'inbox_updated' => date('Y-m-d H:i:s'),
      'inbox_deleted' => 0,
      'inbox_read' => 0
    ), array(
      'user_id != ?' => $user->getIdentity(),
      'conversation_id = ?' => $id,
    ));

    unset($this->store()->messages);

    return $message;
  }
    
  public function getMessages(Zend_Auth $user, $id) {
//    if( empty($this->store()->messages) ) {
      if( !$this->hasRecipient($user, $id) )
      {
        throw new Messages_Model_Exception('Specified user not in convo');
      }
      $message = new Message_Models_MessageMessages();
      $table = $message->getDbTable();
//      $table = Engine_Api::_()->getItemTable('messages_message');
      $select = $table->select()
        ->where('conversation_id = ?', $id)
        ->order('message_id');
        ;

    $this->store()->messages = $table->fetchAll($select);
//    }

    return $this->store()->messages;
  }
  
  public function setAsRead(Zend_Auth $user, $id) {
    $recipients = new Message_Models_MessageRecipients();
    $table = $recipients->getDbTable();
    $table->update(array(
      'inbox_read' => 1
    ), array(
      'user_id = ?' => $user->getIdentity(),
      'conversation_id = ?' => $id
    ));

    return $this;
  }
  
  public function hasRecipient(Zend_Auth $user, $id) {
      $recipients = new Message_Models_MessageRecipients();
    $table = $recipients->getDbTable();
    $select = $table->select()
      ->where('user_id = ?', $user->getIdentity())
      ->where('conversation_id = ?', $id)
      ->limit(1);
    $row = $table->fetchRow($select);
    return ( null !== $row );
  }
}