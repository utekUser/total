<?php
class Filtron_Models_Article extends Engine_Model_Abstract {
    protected $_dbTableName = 'Filtron_Models_DbTable_Article';
    
    protected $_formTableName = 'Filtron_Form_Article';
    
    //protected $_orderBy = 'posted DESC';
    
    
    public function getArticle($url = null) {
        $http = new Engine_Controller_Request_Http();
        $page = $http->getParam('page');
        
        $table  = $this->getDbTable();
        
        $select = $table->select()
                        ->where('active = ?', 1);
                        //->order('posted DESC');
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
    

    public function _defaultDelete($data, $id) {
        $form = new Filtron_Form_Article();
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
                        array('a' => $this->_tablePrefix .'filtron_articles'),
                        array('*')
                      )
                    ->joinLeft(
                        array('b' => $this->_tablePrefix . 'filtron_section'),
                        'a.section_id = b.id',
                        array('url AS section_url')
                      )
                    //->order('posted DESC')
                    ->where('a.active = 1')
                    ->limit($limit);
        
        $result = $db->fetchAll($select);
        return $result;
    }
    
	public function getCurrentFiltron(array $items) {
        $table  = $this->getDbTable();
        $select = $table->select()
                        ->where('id IN (?)', $items);
        $result = $table->fetchAll($select);
        return $result;
    }
	
	public function deactivate() {
		$this->getDbTable()->update(array('active' => 0), '');
	}
	
	public function issetFiltron($id) {
		$table = $this->getDbTable();

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
	
	public function saveFiltron($data, $updateType, $id = null) {

		if (null === $id) { //вставка новой записи
			$this->getDbTable()->insert($data);
		} else { //для существующей записи
			$this->getDbTable()->update($data, array('base_id = ?' => $id));
		}
	}
}