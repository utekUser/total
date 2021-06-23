<?php
class Cms_Models_CmsModule extends Engine_Model_Abstract {
    protected $_dbTableName = 'Cms_Models_DbTable_CmsModule';
    
    protected $_formTableName = 'Cms_Form_CmsModule';
    
    protected $_orderBy = 'pos';
    
    public function getModule() {
        $table  = $this->getDbTable();
        
        $select = $table->select()
                        ->where('display = 1')
                        ->order('pos ASC');
        
        $result = $table->fetchAll($select);
        return $result; 
    }
}