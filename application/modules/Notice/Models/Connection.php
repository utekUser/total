<?php
class Notice_Models_Connection extends Engine_Model_Abstract {
    protected $_dbTableName = 'Notice_Models_DbTable_Connection';
    protected $_formTableName = 'Notice_Form_Connection';
    
    function getUserUnread($user_id) {
        $table  = $this->getDbTable();
        $select = $table->select()
                        ->from($table, 'COUNT(`id`) as count')
                        ->where('user_id = ?', $user_id)
                        ->where('view = ?', 0);
        $result = $table->fetchRow($select);
        return $result['count'];
    }
    
    public function checkViewed($message_id, $user_id) {
        $table  = $this->getDbTable();
        $select = $table->select()
                        ->where('user_id = ?', $user_id)
                        ->where('message_id = ?', $message_id);
        $result = $table->fetchRow($select);
        return $result['view'];
    }
    
    public function setViewed($message_id, $user_id) {
        $table  = $this->getDbTable();
        $set = array (
            'view' => 1,
            'viewed' => date('Y-m-d H:i:s'),
        );
        $select = $table->update($set, array('message_id = ?' => $message_id, 'user_id = ?' => $user_id));
    }
    
    public function deleteNotice($notice_id) {
        $registry = Engine_Api::getInstance();
        $db = $registry->getContainer()->db;
        $this->_tablePrefix = $registry->getContainer()->tablePrefix;
        
        $where = $db->quoteInto('`message_id` = ?', $notice_id);
        $delete = $db->delete($this->_tablePrefix . 'notice_connection', $where);
    }
}