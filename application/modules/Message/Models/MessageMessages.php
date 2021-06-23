<?php
class Message_Models_MessageMessages extends Engine_Model_Abstract {
    protected $_dbTableName = 'Message_Models_DbTable_MessageMessages';
    
    protected $_formTableName = 'Message_Form_MessageMessages';
    
//    protected $_orderBy = 'posted';
   
   
     
    public function getLastMessage($conversation_id) {
        $table = $this->getDbTable();
        $select = $table->select()
                        ->where('conversation_id = ?', $conversation_id)
                        ->order('message_id DESC')
                        ->limit('1');
        $result = $table->fetchRow($select);
        return $result;
    }

    
}