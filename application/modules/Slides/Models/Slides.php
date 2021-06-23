<?php
class Slides_Models_Slides extends Engine_Model_Abstract {
    protected $_dbTableName = 'Slides_Models_DbTable_Slides';
    
    protected $_formTableName = 'Slides_Form_Slides';
    
    protected $_orderBy = 'pos';
    
    public function getSlides() {
        $table  = $this->getDbTable();
        
        $select = $table->select()
//    					->from($table, array('id', 'text'))
                        ->where('display = 1')
                        ->order('pos ASC');
                        
        return $table->fetchAll($select);
    }
}