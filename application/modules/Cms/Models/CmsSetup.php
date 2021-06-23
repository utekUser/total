<?php
class Cms_Models_CmsSetup extends Engine_Model_Abstract {
    protected $_dbTableName = 'Cms_Models_DbTable_CmsSetup';
    
    protected $_formTableName = 'Cms_Form_CmsSetup';
    
    public function getValue($key) {
        $table  = $this->getDbTable();
        
        $select = $table->select()
                        ->from($table, array('value'))
                        ->where('`key` = ?', $key)
                        ->limit('1');
        
        return $table->fetchRow($select);
    }
    
    public function getSetValue($key) {
        $table  = $this->getDbTable();
        
        $select = $table->select()
                        ->from($table, array('value'))
                        ->where('`key` = ?', $key)
                        ->limit('1');
                        
        $result = $table->fetchRow($select);

        return $result['value'];
    }
}