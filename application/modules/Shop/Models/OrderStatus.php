<?php
class Shop_Models_OrderStatus extends Engine_Model_Abstract {
    protected $_dbTableName = 'Shop_Models_DbTable_OrderStatus';
    
    protected $_formTableName = 'Shop_Form_OrderStatus';
    
//    protected $_orderBy = 'posted';

    public function getStatus() {
        $table  = $this->getDbTable();
        
        $select = $table->select();
        
        $result = $table->fetchAll($select);
        return $result; 
    }
    
    
}