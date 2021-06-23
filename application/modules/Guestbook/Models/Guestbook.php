<?php
class Guestbook_Models_Guestbook extends Engine_Model_Abstract {
    protected $_dbTableName = 'Guestbook_Models_DbTable_Guestbook';
    
    protected $_formTableName = 'Guestbook_Form_Guestbook';
    
    protected $_orderBy = 'posted';
    
    public function getBook() {
        $http = new Engine_Controller_Request_Http();
        $page = $http->getParam('page');
        
        $table  = $this->getDbTable();
        
        $select = $table->select()
                        ->where('display = ?', 1)
                        ->order('posted DESC');
        
//        $result = $table->fetchAll($select);
//        return $result;
        
        $adapter = new Zend_Paginator_Adapter_DbSelect(
            $select
        );
        
        $paginator = new Engine_Paginator($adapter);
        $paginator->setItemCountPerPage(10);
        $paginator->setCurrentPageNumber($page);
        
        return $paginator;
        
        
    }
    
   
    
    public function saveBook($texts, $id = null) {
        
        $data = array(
            'author'   => $texts['author']->getValue(),
            'email' => $texts['email']->getValue(),
            'question' => $texts['question']->getValue(),
            'posted' => date('Y-m-d H:i:s'),
            'ip' => $_SERVER['REMOTE_ADDR']
        );
        
        $this->getDbTable()->insert($data);
//            $id = $this->getDbTable()->getAdapter()->lastInsertId();
//            $this->_insertId = $id;

    }
}