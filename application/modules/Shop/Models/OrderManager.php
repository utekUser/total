<?php
class Shop_Models_OrderManager extends Engine_Model_Abstract {
    protected $_dbTableName = 'Shop_Models_DbTable_OrderManager';
    
    protected $_formTableName = 'Shop_Form_OrderManager';
    
    protected $_orderBy = 'id DESC';
    
    
    public function getManager() {
        $http = new Engine_Controller_Request_Http();
        $page = $http->getParam('page');
        
        $table  = $this->getDbTable();
        
        $select = $table->select()
                        ->where('deleted = ?', 0)
                        ->order('id DESC');
        $adapter = new Zend_Paginator_Adapter_DbSelect(
            $select
        );
        
        $paginator = new Engine_Paginator($adapter);
        $paginator->setItemCountPerPage(30);
        $paginator->setCurrentPageNumber($page);
        
        return $paginator;
    }
	
	//Получить менеджера по id
    public function getManagerById($id) {
        $table  = $this->getDbTable();        
        $select = $table->select()
                        ->where('`id` = ?', $id);
        $result = $table->fetchRow($select);
        return $result;    
    }
	
	public function getManagers() {
        $table  = $this->getDbTable();        
        $select = $table->select()
                        ->order('manager_name ASC');        
        $result = $table->fetchAll($select);
        return $result; 
    }
    
	/**
     * Оформление нового заказа
     *
     * @param array $data
     */
	public function saveManager($data) {
        $set = array(
            'manager_name' => $data['manager_name'],
            'manager_phone'       => $data['manager_phone'],
        );
        $this->getDbTable()->insert($set);
    }    
    
}