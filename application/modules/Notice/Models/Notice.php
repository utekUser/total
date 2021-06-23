<?php
class Notice_Models_Notice extends Engine_Model_Abstract {
    protected $_dbTableName = 'Notice_Models_DbTable_Notice';
    protected $_formTableName = 'Notice_Form_Notice';
    protected $_orderBy = 'posted DESC';
    
    public function getUserNotices($user_id) {
        $registry = Engine_Api::getInstance();
        $db = $registry->getContainer()->db;
        
        $select = $db->select()
                    ->from(
                        array('a' => 'total_notice'),
                        array('*')
                      )
                    ->joinLeft(
                        array('b' => 'total_notice_connection'),
                        'a.id = b.message_id',
                        array('user_id', 'view')
                      )
                    ->where('b.user_id = ?', $user_id)
                    ->order('a.posted DESC');
        $result = $db->fetchAll($select);
        return $result;
    }
    
    public function getNotice($notice_id) {
        $table  = $this->getDbTable();
        $select = $table->select()
                        ->where('id = ?', $notice_id);
        $result = $table->fetchRow($select);
        return $result;
    }
}