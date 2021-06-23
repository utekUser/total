<?php
class Services_Models_Services extends Engine_Model_Abstract {
    protected $_dbTableName = 'Services_Models_DbTable_Services';
    
    protected $_formTableName = 'Services_Form_Services';
    
    protected $_orderBy = 'pos';
    
    public function getServices($parent = 0) {
        $http = new Engine_Controller_Request_Http();
        $page = $http->getParam('page');
        
        $table  = $this->getDbTable();
        
        $select = $table->select()
                        ->where('display = 1')
                        ->where('parent = ?', $parent)
                        ->order('pos');
        
        $adapter = new Zend_Paginator_Adapter_DbSelect($select);
        
        $paginator = new Engine_Paginator($adapter);
        $paginator->setItemCountPerPage(10);
        $paginator->setCurrentPageNumber($page);
        
        return $paginator;
    }
    
    public function getCurrentService($id) {
        $table  = $this->getDbTable();
        
        $select = $table->select()
                        ->where('`id` = ?', $id)
                        ->limit('1');
        $result = $table->fetchRow($select);
        return $result;
    }
    
    /**
     * Получаем список разделов
     *
     * @return unknown
     */
    public function getSection() {
        $table  = $this->getDbTable();
        $select = $table->select();
        $select->order('pos');
        return $table->fetchAll($select); 
    }
}