<?php
class Filters_Models_FiltersFilters extends Engine_Model_Abstract {
    protected $_dbTableName = 'Filters_Models_DbTable_FiltersFilters';
    
    protected $_formTableName = 'Filters_Form_FiltersFilters';
    
    protected $_orderBy = 'id DESC';
    
    
    public function getFilter($url = null) {
        $http = new Engine_Controller_Request_Http();
        $page = $http->getParam('page');
        
        $table  = $this->getDbTable();
        
        $select = $table->select()
                        ->where('display = ?', 1)
                        ->order('pos DESC');
        if ($url !== null) {
            $select->where('section_id = ?', $url);
        }
        $adapter = new Zend_Paginator_Adapter_DbSelect(
            $select
        );
        $paginator = new Engine_Paginator($adapter);
        $paginator->setItemCountPerPage(30);
        $paginator->setCurrentPageNumber($page);
        
        return $paginator;
    }
    
    /**
     * Поиск фильтра по Артикулу
     *
     * @param string $code
     * @return object
     */
    public function getFilterByCode($code) {
        $http = new Engine_Controller_Request_Http();
        $page = $http->getParam('page');
        
        $table  = $this->getDbTable();
        $code = preg_replace("/[^a-zA-Zа-яА-Я0-9]/u", "", trim($code));
        
        $select = $table->select()
                        ->where('display = ?', 1)
                        ->where('name_search LIKE "%' . $code . '%"');
                        
        $adapter = new Zend_Paginator_Adapter_DbSelect(
            $select
        );
        $paginator = new Engine_Paginator($adapter);
        $paginator->setItemCountPerPage(30);
        $paginator->setCurrentPageNumber($page);
        
        return $paginator;
    }
    
    public function getFilterByCodeOpt($filter = null) {
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
    
    public function getCurrentFilter(array $items) {
        $table  = $this->getDbTable();
        
        $select = $table->select()
                        ->where('id IN (?)', $items);
                        
        $result = $table->fetchAll($select);
        return $result;
    }
    
    public function deactivate() {
        $set = array('active' => 0);
        $this->getDbTable()->update($set, '');
    }
    
    public function issetFilter($id) {
        $table  = $this->getDbTable();
        
        $select = $table->select()
                        ->where('`base_id` = ?', $id)
                        ->limit('1');
        $result = $table->fetchRow($select);
        
        if (is_iterable($result)) {
            return $result['id'];    
        } else {
            return false;
        }
    }
    
    public function saveFilter($data, $updateType, $id = null) {
        
//        echo '<pre>'; print_r($data); echo '</pre>';exit;
        if (null === $id) { //вставка новой записи
            $this->getDbTable()->insert($data);
        } else { //для существующей записи
            $this->getDbTable()->update($data, array('base_id = ?' => $id));
        }
        
    }
    
    public function getBaseNone()
    {
        $table  = $this->getDbTable();
        
        $select = $table->select()
                        ->where('price_base = 0');
        $result = $table->fetchAll($select);
        return $result;
    }
    
    public function getRecNone()
    {
        $table  = $this->getDbTable();
        
        $select = $table->select()
                        ->where('price_rec = 0');
        $result = $table->fetchAll($select);
        return $result;	
    }
}