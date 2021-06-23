<?php
class News_Models_News extends Engine_Model_Abstract {
    protected $_dbTableName = 'News_Models_DbTable_News';
    
    protected $_formTableName = 'News_Form_News';
    
    protected $_orderBy = 'posted DESC';
    
    public function getNews() {
        $http = new Engine_Controller_Request_Http();
        $page = $http->getParam('page');
        
        $table  = $this->getDbTable();
        
        $select = $table->select()
                        ->where('display = 1')
                        ->where('posted < ?', date('Y-m-d H:i:s'))
                        ->order('posted DESC');
        
        //
        $auth = Zend_Auth::getInstance()->setStorage(new Zend_Auth_Storage_Session('Zend_Auth_User'));
        $userType = Engine_AuthUser::getUserType();
        if ($auth->hasIdentity()) {
            if (!$userType) { // физ. лицо
                $select = $select->where('type != 2');
            } else { // юрид. лицо
                $select = $select->where('type != 1');
            }
        } else {
            $select = $select->where('type = 0');
        }
        //
        
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
    
    public function getCurrentNew($id) {
        $table  = $this->getDbTable();
        
        $select = $table->select()
                        ->where('`id` = ?', $id)
                        ->limit('1');
        //
        $auth = Zend_Auth::getInstance()->setStorage(new Zend_Auth_Storage_Session('Zend_Auth_User'));
        $userType = Engine_AuthUser::getUserType();
        if ($auth->hasIdentity()) {
            if (!$userType) { // физ. лицо
                $select = $select->where('type != 2');
            } else { // юрид. лицо
                $select = $select->where('type != 1');
            }
        } else {
            $select = $select->where('type = 0');
        }
        //
        
        $result = $table->fetchRow($select);
        return $result;
    }
    
    public function getLastNews($limit) {
        $table  = $this->getDbTable();
        
        $select = $table->select()
                        ->where('display = 1')
                        ->where('posted < ?', date('Y-m-d H:i:s'));
        
        //
        $auth = Zend_Auth::getInstance()->setStorage(new Zend_Auth_Storage_Session('Zend_Auth_User'));
        $userType = Engine_AuthUser::getUserType();
        if ($auth->hasIdentity()) {
            if (!$userType) { // физ. лицо
                $select = $select->where('type != 2');
            } else { // юрид. лицо
                $select = $select->where('type != 1');
            }
        } else {
            $select = $select->where('type = 0');
        }
        //
        
        $select->order('posted DESC')->limit($limit);
        $result = $table->fetchAll($select);
        return $result;
    }
    
    
}