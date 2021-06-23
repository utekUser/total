<?php
class Message_Models_MessageRecipients extends Engine_Model_Abstract {
    protected $_dbTableName = 'Message_Models_DbTable_MessageRecipients';
    
    protected $_formTableName = 'Message_Form_MessageRecipients';
    
//    protected $_orderBy = 'pos DESC';

  public function getUnreadMessageCount(Zend_Auth $user) {
    $identity = $user->getIdentity();
    
    $recipients = new Message_Models_MessageRecipients();
    $rName = $recipients->getDbTable()->info('name');
//    $rName = Engine_Api::_()->getDbtable('recipients', 'messages')->info('name');
    $select = $recipients->getDbTable()->select()
      ->setIntegrityCheck(false)
      ->from($rName, new Zend_Db_Expr('COUNT(conversation_id) AS unread'))
      ->where($rName.'.user_id = ?', $identity)
      ->where($rName.'.inbox_deleted = ?', 0)
      ->where($rName.'.inbox_read = ?', 0);
//echo $select;
//    $data = Engine_Api::_()->getDbtable('recipients', 'messages')->fetchRow($select);
    $data = $recipients->getDbTable()->fetchRow($select);
    return (int) $data->unread;
  }
  
    public function delete($type) {
        $viewer = Zend_Auth::getInstance()->setStorage(new Zend_Auth_Storage_Session('Zend_Auth_User')); // пользователь
        
        $this->getDbTable()->update(array(
            'inbox_deleted' => 1,
            'outbox_deleted' => 1
        ), array(
          'user_id = ?' => $viewer->getIdentity(),
          'conversation_id IN (?)' => $type
        ));
    }
        
    public function getMessageReadStatus($conversation_id, $user_id) {
        $table = $this->getDbTable();
        $select = $table->select()
                        ->where('conversation_id = ?', $conversation_id)
                        ->where('user_id = ?', $user_id);
        $result = $table->fetchRow($select);
        if ($result['inbox_read']) {
            return true;
        } else {
            return false;
        }
    }
    
}

