<?php
class Cms_Models_CmsOptimization extends Engine_Model_Abstract {
    protected $_dbTableName = 'Cms_Models_DbTable_CmsOptimization';
    
    protected $_formTableName = 'Cms_Form_CmsOptimization';
    
    public function saveOptimization($data) {
        $table  = $this->getDbTable();
        
        $select = $table->select()
                        ->limit(1);
        
        $row = $table->fetchRow($select);
        
        if ($row) {
            $table->update($data, array('id = ?' => $row['id']));
        } else {
            $table->insert($data);
        }
    }
    
    public function getOptimization() {
        $table  = $this->getDbTable();
        
        $select = $table->select()
                        ->limit(1);
        
        return $table->fetchRow($select);
    }
}