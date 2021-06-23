<?php
class Filters_Models_FiltersSection extends Engine_Model_Abstract {
    protected $_dbTableName = 'Filters_Models_DbTable_FiltersSection';
    
    protected $_formTableName = 'Filters_Form_FiltersSection';
    
    protected $_orderBy = 'pos DESC';  
    
    public function getSection() {
        $table  = $this->getDbTable();
        
        $select = $table->select()
                        ->where('display = 1')
                        ->order('pos ASC');
        
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