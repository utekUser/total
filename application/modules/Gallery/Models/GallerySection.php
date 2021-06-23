<?php
class Gallery_Models_GallerySection extends Engine_Model_Abstract {
    protected $_dbTableName = 'Gallery_Models_DbTable_GallerySection';
    
    protected $_formTableName = 'Gallery_Form_GallerySection';
    
    protected $_orderBy = 'pos';
    
    public function getSection() {
        $table  = $this->getDbTable();
        
        $select = $table->select()
                        ->where('display = 1')
                        ->order('pos DESC');
        
        $result = $table->fetchAll($select);
        return $result; 
    }
    
    public function getSectionName($url) {
        $table  = $this->getDbTable();
        
        $select = $table->select()
                        ->where('url = ?', $url)
                        ->limit(1);
        $result = $table->fetchRow($select);
        return $result; 
    }
    
}