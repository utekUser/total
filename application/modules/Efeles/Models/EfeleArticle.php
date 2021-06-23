<?php
class Efeles_Models_EfeleArticle extends Engine_Model_Abstract {
    protected $_dbTableName = 'Efeles_Models_DbTable_EfeleArticle';
    
    protected $_formTableName = 'Efeles_Form_EfeleArticle';
    
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
    
    

    public function _defaultDelete($data, $id) {
        $form = new Efeles_Form_EfeleArticle();
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
                        array('a' => $this->_tablePrefix .'efele_articles'),
                        array('*')
                      )
                    ->joinLeft(
                        array('b' => $this->_tablePrefix . 'efele_articles_section'),
                        'a.section_id = b.id',
                        array('url AS section_url')
                      )
                    //->order('posted DESC')
                    ->where('a.active = 1')
                    ->limit($limit);
        
        $result = $db->fetchAll($select);
        return $result;
    }
    
	public function getCurrentEfeles(array $items) {
        $table  = $this->getDbTable();
        $select = $table->select()
                        ->where('id IN (?)', $items);
        $result = $table->fetchAll($select);
        return $result;
    }
	
	public function deactivate() {
		$this->getDbTable()->update(array('active' => 0), '');
	}
	
	public function issetEfele($id) {
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
	
	public function saveEfele($data, $updateType, $id = null) {

		if (null === $id) { //вставка новой записи
			$this->getDbTable()->insert($data);
		} else { //для существующей записи
			$this->getDbTable()->update($data, array('base_id = ?' => $id));
		}
	}
}