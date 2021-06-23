<?php
class Plug_Models_Plug extends Engine_Model_Abstract {
    protected $_dbTableName = 'Plug_Models_DbTable_Plug';
    protected $_formTableName = 'Plug_Form_Plug';
    protected $_orderBy = 'id DESC';
    
    public function issetPlug($base_id) {
        $table  = $this->getDbTable();
        $select = $table->select()
                        ->where('base_id = ?', $base_id)
                        ->limit('1');
        $result = $table->fetchRow($select);
        
        if (is_iterable($result)) {
            return $result['id'];    
        } else {
            return false;
        }
    }
    
    public function savePlug($data, $id = null) {
        if (null === $id) { //вставка новой записи
            $this->getDbTable()->insert($data);
        } else { //для существующей записи
            $this->getDbTable()->update($data, array('base_id = ?' => $id));
        }
    }
    
    public function getPlugs($filter = null) {
        $http = new Engine_Controller_Request_Http();
        $page = $http->getParam('page');
        
        $table  = $this->getDbTable();
        $select = $table->select()
                        ->where('display = ?', 1);
        if ($filter !== null) {
            $select->where($filter);
        }
        $adapter = new Zend_Paginator_Adapter_DbSelect(
            $select
        );
        
        $paginator = new Engine_Paginator($adapter);
        $paginator->setItemCountPerPage(30);
        $paginator->setCurrentPageNumber($page);
        
        return $paginator;
    }
    
    public function getCurrentPlug(array $items) {
        $table  = $this->getDbTable();
        $select = $table->select()
                        ->where('id IN (?)', $items);
        $result = $table->fetchAll($select);
        return $result;
    }
    
    public function deactivate() {
        $this->getDbTable()->update(array('active' => 0), '');
    }
}