<?php
class Audio_Models_Audio extends Engine_Model_Abstract {
    protected $_dbTableName = 'Audio_Models_DbTable_Audio';
    
    protected $_formTableName = 'Audio_Form_Audio';
    
//    protected $_orderBy = 'pos';
    
    public function getAudio() {
        $http = new Engine_Controller_Request_Http();
        $page = $http->getParam('page');
        
        $table  = $this->getDbTable();
        
        $select = $table->select()
                        ->where('display = 1')
                        ->order('posted DESC');
        
        $adapter = new Zend_Paginator_Adapter_DbSelect(
            $select
        );
        
        $paginator = new Engine_Paginator($adapter);
        $paginator->setItemCountPerPage(10);
        $paginator->setCurrentPageNumber($page);
        
        return $paginator;
    }
    
    public function addView($id) {
        $table  = $this->getDbTable();
        
        $data = array(
            'view' => new Zend_Db_Expr('view + 1')
        );
        $table->update($data, array('id = ?' => $id));
    }
    
    public function getCurrentAudio($id) {
        $table  = $this->getDbTable();
        
        $select = $table->select()
                        ->where('`id` = ?', $id)
                        ->limit('1');
        $result = $table->fetchRow($select);
        return $result;
    }
    
}