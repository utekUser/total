<?php
class Shop_Models_OrderTransaction extends Engine_Model_Abstract {
    protected $_dbTableName = 'Shop_Models_DbTable_OrderTransaction';
    
    protected $_formTableName = 'Shop_Form_OrderTransaction';
    
    
    public function getOrderTransactions($order_id) {
        $table  = $this->getDbTable();
        
        $select = $table->select()
                        ->where('order_id = ?', $order_id)
                        ->order('date');
        
        $result = $table->fetchAll($select);
        return $result; 
    }
    
    
    /**
     * Enter description here...
     *
     * @param int $order_id
     * @param datetime $date
     * @param string $sum
     */
    public function addTransaction($order_id, $date, $sum, $payment) {
        if ($payment) {
            $set = array (
                'order_id'    => $order_id,
                'date'        => $date,
                'sum'         => '+' . $sum,
                'description' => 'Внесение денег'
            );
            $set2 = array (
                'order_id'    => $order_id,
                'date'        => $date,
                'sum'         => '-' . $sum,
                'description' => 'Оплата заказа'
            );
            
            $this->getDbTable()->insert($set);
            $this->getDbTable()->insert($set2);
        } else {
            $set = array (
                'order_id'    => $order_id,
                'date'        => $date,
                'sum'         => '+' . $sum,
                'description' => 'Отмена оплаченности заказа'
            );
            $this->getDbTable()->insert($set);
        }
        
    }
}