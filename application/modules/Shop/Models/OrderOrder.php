<?php
class Shop_Models_OrderOrder extends Engine_Model_Abstract {
    protected $_dbTableName = 'Shop_Models_DbTable_OrderOrder';
    
    protected $_formTableName = 'Shop_Form_OrderOrder';
    
    protected $_orderBy = 'id DESC';
    
    
    public function getOrder() {
        $http = new Engine_Controller_Request_Http();
        $page = $http->getParam('page');
        
        $table  = $this->getDbTable();
        
        $select = $table->select()
                        ->where('active = ?', 1)
                        ->order('id DESC');
        $adapter = new Zend_Paginator_Adapter_DbSelect(
            $select
        );
        
        $paginator = new Engine_Paginator($adapter);
        $paginator->setItemCountPerPage(30);
        $paginator->setCurrentPageNumber($page);
        
        return $paginator;
    }
    
    
    /**
     * Изменение статуса заказа
     *
     * @param int $order_id
     * @param int $status_id
     * @param datetime $date
     */
    public function updateStatus($order_id, $status_id, $date) {
        $table  = $this->getDbTable();
        
        $set = array (
            'status_id' => $status_id,
            'status_modified' => $date,
            'modified' => $date
        );
        $select = $table->update($set, array('id = ?' => $order_id));
    }
    
    /**
     * Изменение активности заказа
     *
     * @param int $order_id
     */
    public function deactivateOrder($order_id) {
        $table  = $this->getDbTable();
        
        $set = array ('active' => 0);
        $select = $table->update($set, array('id = ?' => $order_id));
    }
    
    /**
     * Изменение свойства заказа "отменен"
     *
     * @param int $order_id
     * @param string $reason
     * @param datetime $date
     * @param int $rejected
     */
    public function changeCancel($order_id, $reason, $date, $rejected) {
        $table  = $this->getDbTable();
        
        $set = array (
            'rejection_reason' => $reason,
            'rejection_date' => $date,
            'modified' => $date,
            'rejected' => $rejected
        );
        $select = $table->update($set, array('id = ?' => $order_id));
    }
    
    /**
     * Изменение свойства заказа "Оплачен"
     *
     * @param int $order_id
     * @param datetime $date
     * @param string $payment_doc
     * @param int $payment
     */
    public function changePayment($order_id, $date, $payment_doc, $payment_doc_date, $payment) {
        $table  = $this->getDbTable();
        
        $set = array (
            'payment' => $payment,
            'payment_date' => $date,
            'payment_doc' => $payment_doc,
            'payment_doc_date' => $payment_doc_date,
            'modified' => $date
        );
        $select = $table->update($set, array('id = ?' => $order_id));
    }
    
    /**
     * Оформление нового заказа
     *
     * @param array $data
     */
    public function saveOrder($data) {
        $set = array(
            'date'            => $data['date'],
            'modified'        => $data['date'],
            'status_id'       => 1,
            'active'          => 1,
            //'deleted'          => 0,
            'status_modified' => $data['date'],
            'total_sum'       => $data['total_sum'],
            'customer_name'   => $data['customer_name'],
            'customer_login'  => $data['customer_login'],
            'customer_phone'  => $data['customer_phone'],
            'customer_email'  => $data['customer_email'],
            'customer_type'   => $data['customer_type'],
            'delivery_type'   => $data['delivery_type'],
            'payment_type'    => $data['payment_type'],
            'warehouse_type'    => $data['warehouse_type'],
            'comment'         => $data['comment']
        );
        if ($data['customer_type']) {
            $set['company_name']    = $data['company_name'];
            $set['company_address'] = $data['company_address'];
            $set['company_inn']     = $data['company_inn'];
            $set['company_kpp']     = $data['company_kpp'];
        }
        $this->getDbTable()->insert($set);
    }
    
    /**
     * Получить дату и номер заказа (используется при выдаче сообщения при оформлении заказа)
     *
     * @param int $order_id
     * @param string $user_login
     * @return unknown
     */
    public function getOrderDateAndId($order_id, $user_login) {
        $table  = $this->getDbTable();
        
        $select = $table->select()
                        ->where('id = ?', $order_id)
                        ->where('customer_login = ?', $user_login);
        $result = $table->fetchRow($select);
        return $result; 
    }
    
    /**
     * Все заказы данного пользователя
     *
     * @param string $user_login
     * @return unknown
     */
    public function getUserOrders($user_login) {
        $table  = $this->getDbTable();
        
        $select = $table->select()
                        ->where('customer_login = ?', $user_login)
                        ->where('deleted = 0')
                        ->order('id DESC');
        $result = $table->fetchAll($select);
        return $result; 
    }
    
    /**
     * Информация по конкретному заказу данного пользователя
     *
     * @param string $user_login
     * @param int $order_id
     * @return unknown
     */
    public function getCurrentOrder($user_login, $order_id) {
        $table  = $this->getDbTable();
        
        $select = $table->select()
                        ->where('id = ?', $order_id)
                        ->where('customer_login = ?', $user_login);
        $result = $table->fetchRow($select);
        return $result; 
    }
	
	/**
     * Получить все заказы, по которым не отправлены смс менеджерам
     *
     * @return unknown
     */
    public function getOrdersWhereSmsNotSend() {
        $table  = $this->getDbTable();        
        $select = $table->select()
                        ->where('send = ?', 0);
        $result = $table->fetchAll($select);
        return $result; 
    }
	
	/**
     * Выставить статус об отправке смс
     *
     * @param int $order_id
     */
    public function setSmsStatus($order_id) {
        $table  = $this->getDbTable();        
        $set = array (
            'send' => 1,
        );
        $select = $table->update($set, array('id = ?' => $order_id));
    }

    public function deleteOrder($login)
    {
        $table = $this->getDbTable();
        $where = $table->getAdapter()->quoteInto('customer_login = ?' , $login);

        $table->delete($where);
    }

    /**
     * Clear order history for user
     *
     * @param $user_login
     */
    public function clearHistory($user_login) {
        $select = $this->getDbTable()->update(
            array('deleted' => 1),
            array('customer_login = ?' => $user_login)
        );
    }
}