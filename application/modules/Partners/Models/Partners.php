<?php
class Partners_Models_Partners extends Engine_Model_Abstract {
    protected $_dbTableName = 'Partners_Models_DbTable_Partners';
    
    protected $_formTableName = 'Partners_Form_Partners';
    
    protected $_orderBy = 'pos DESC';
    
    public function getPartners() {
        $http = new Engine_Controller_Request_Http();
        $page = $http->getParam('page');
        
        $table  = $this->getDbTable();
        
        $select = $table->select()
                        ->where('display = 1');
        
        $adapter = new Zend_Paginator_Adapter_DbSelect(
            $select
        );
        
        $paginator = new Engine_Paginator($adapter);
        $paginator->setItemCountPerPage(10);
        $paginator->setCurrentPageNumber($page);
        
        return $paginator;
    }
    
    
    public function getCurrentPartner($id) {
        $table  = $this->getDbTable();
        
        $select = $table->select()
                        ->where('`id` = ?', $id)
                        ->limit('1');
        $result = $table->fetchRow($select);
        return $result;
    }
    
    public function getPartnerMain() {
        $table  = $this->getDbTable();
        
        $select = $table->select()
                        ->where('display = 1')
                        ->where("picture != ''")
                        ->order('pos DESC')
                        ->limit('5');
        $result = $table->fetchAll($select);
        return $result;
    }
}