<?php
class Gallery_Models_GalleryAlbum extends Engine_Model_Abstract {
    protected $_dbTableName = 'Gallery_Models_DbTable_GalleryAlbum';
    
    protected $_formTableName = 'Gallery_Form_GalleryAlbum';
    
//    protected $_orderBy = 'posted';
    
    public function getAlbums($url = null) {
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
        $paginator->setItemCountPerPage(5);
        $paginator->setCurrentPageNumber($page);
        
        return $paginator;
    }

    /*public function _defaultDelete($data, $id) {
        $form = new Gallery_Form_GalleryAlbum();
        $elements = $form->getElements();
//        $elements['picture1']->delete($id);
        return true;
//        echo "<pre>";
//        print_r($elements['picture1']);
//        echo "</pre>";
//        echo $id;
        exit;    
    }*/
    public function getAlbum() {
        $table  = $this->getDbTable();
        
        $select = $table->select()
                        ->where('display = 1')
                        ->order('name DESC');
        
        $result = $table->fetchAll($select);
        return $result; 
    }
    
    
    public function addView($id) {
        $table  = $this->getDbTable();
        
        $data = array(
            'view' => new Zend_Db_Expr('view + 1')
        );
        $table->update($data, array('id = ?' => $id));
    }
    
    public function getCurrentAlbum($id) {
        $table  = $this->getDbTable();
        
        $select = $table->select()
                        ->where('`id` = ?', $id)
                        ->limit('1');
        $result = $table->fetchRow($select);
        return $result;
    }
    
}