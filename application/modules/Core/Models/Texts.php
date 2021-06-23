<?php
class Texts_Models_Texts extends Engine_Model_Abstract {
    protected $_dbTableName = 'Texts_Models_DbTable_Texts';
    
    protected $_formTableName = 'Texts_Form_Texts';
    
    protected $_orderBy = 'pos DESC';
    
    public function getContent($id) {
        $table  = $this->getDbTable();
        
        $select = $table->select()
                        ->where('`id` = ?', $id)
                        ->where('`display` = 1')
                        ->limit('1');
                        
        $result = $table->fetchRow($select);
        
        if ($result) {
            return $result['text'];    
        } else {
            return false;     
        }
    }
}