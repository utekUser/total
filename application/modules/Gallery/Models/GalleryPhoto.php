<?php
class Gallery_Models_GalleryPhoto extends Engine_Model_Abstract {
    protected $_dbTableName = 'Gallery_Models_DbTable_GalleryPhoto';
    
    protected $_formTableName = 'Gallery_Form_GalleryPhoto';
    
//    protected $_orderBy = 'posted';
    
    /*public function getPhoto() {
        $http = new Engine_Controller_Request_Http();
        $page = $http->getParam('page');
        
        $table  = $this->getDbTable();
        
        $select = $table->select()
                        ->where('display = ?', 1);
        
        $adapter = new Zend_Paginator_Adapter_DbSelect(
            $select
        );
        
        $paginator = new Engine_Paginator($adapter);
        $paginator->setItemCountPerPage(5);
        $paginator->setCurrentPageNumber($page);
        
        return $paginator;
    }*/

    /*public function _defaultDelete($data, $id) {
        $form = new Gallery_Form_GalleryPhoto();
        $elements = $form->getElements();
//        $elements['picture1']->delete($id);
        return true;
//        echo "<pre>";
//        print_r($elements['picture1']);
//        echo "</pre>";
//        echo $id;
        exit;    
    }*/
    
    /*public function addView($id) {
        $table  = $this->getDbTable();
        
        $data = array(
            'view' => new Zend_Db_Expr('view + 1')
        );
        $table->update($data, array('id = ?' => $id));
    }
    */
    public function getPhoto($album_id) {
        $table  = $this->getDbTable();
        
        $select = $table->select()
                        ->where('`album_id` = ?', $album_id);
        $result = $table->fetchAll($select);
        return $result;
    }
    
}