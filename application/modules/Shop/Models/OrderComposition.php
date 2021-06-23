<?php
class Shop_Models_OrderComposition extends Engine_Model_Abstract {
    protected $_dbTableName = 'Shop_Models_DbTable_OrderComposition';
    
    protected $_formTableName = 'Shop_Form_OrderComposition';
    
//    protected $_orderBy = 'posted';

    public function getOrderComposition($order_id) {
        $table  = $this->getDbTable();
        
        $select = $table->select()
                        ->where('order_id = ?', $order_id);
        
        $result = $table->fetchAll($select);
        return $result; 
    }
    
    public function saveComposition($order_id, $items) {
        
        foreach ($items as $item) {
            $set = array(  
                'order_id'   => $order_id,
                'base_id'    => $item['base_id'],
                'name'       => $item['name'],
                'price'      => $item['price'],
                'amount'     => $item['amount'],
                'price_type' => $item['price_type']
            );
            $this->getDbTable()->insert($set);
        }
    }
}