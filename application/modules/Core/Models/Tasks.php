<?php
class Core_Models_Tasks extends Engine_Model_Abstract {
    protected $_dbTableName = 'Core_Models_DbTable_Tasks';
    
    public function getTime($id) {
        $table  = $this->getDbTable();
        
        $select = $table->select()
                        ->where('`task_id` = ?', $id)
                        ->limit('1');
                        
        $result = $table->fetchRow($select);
        
        if ($result) {
            return $result['completed_last'];    
        } else {
            return false;     
        }
    }
}