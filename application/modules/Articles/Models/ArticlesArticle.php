<?php
class Articles_Models_ArticlesArticle extends Engine_Model_Abstract {
    protected $_dbTableName = 'Articles_Models_DbTable_ArticlesArticle';
    
    protected $_formTableName = 'Articles_Form_ArticlesArticle';
    
    protected $_orderBy = 'posted DESC';
    
    
    public function getArticle($url = null) {
        $http = new Engine_Controller_Request_Http();
        $page = $http->getParam('page');
        
        $table  = $this->getDbTable();
        
        $select = $table->select()
                        ->where('display = ?', 1)
                        ->order('posted DESC');
        if ($url !== null) {
            $select->where('section_id = ?', $url);
        }
        
        $adapter = new Zend_Paginator_Adapter_DbSelect(
            $select
        );
        
        $paginator = new Engine_Paginator($adapter);
        $paginator->setItemCountPerPage(10);
        $paginator->setCurrentPageNumber($page);
        
        return $paginator;
    }
    
    

    public function _defaultDelete($data, $id) {
        $form = new Articles_Form_ArticlesArticle();
        $elements = $form->getElements();
        $elements['picture1']->delete($id);
        return true;
        echo "<pre>";
        print_r($elements['picture1']);
        echo "</pre>";
        echo $id;
        exit;    
    }
    
    public function addView($id) {
        $table  = $this->getDbTable();
        
        $data = array(
            'view' => new Zend_Db_Expr('view + 1')
        );
        $table->update($data, array('id = ?' => $id));
    }
    
    public function getCurrentArticle($id) {
        $table  = $this->getDbTable();
        
        $select = $table->select()
                        ->where('`id` = ?', $id)
                        ->limit('1');
        $result = $table->fetchRow($select);
        return $result;
    }
    
    public function getLastArticles($limit) {
        $registry = Engine_Api::getInstance();
        $db = $registry->getContainer()->db;
        $this->_tablePrefix = $registry->getContainer()->tablePrefix;
        
        $select = $db->select()
                    ->from(
                        array('a' => $this->_tablePrefix .'articles'),
                        array('*')
                      )
                    ->joinLeft(
                        array('b' => $this->_tablePrefix . 'articles_section'),
                        'a.section_id = b.id',
                        array('url AS section_url')
                      )
                    ->order('posted DESC')
                    ->where('a.display = 1')
                    ->limit($limit);
        
        $result = $db->fetchAll($select);
        return $result;
    }
    
}