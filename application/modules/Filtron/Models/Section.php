<?php
class Filtron_Models_Section extends Engine_Model_Abstract {
    protected $_dbTableName = 'Filtron_Models_DbTable_Section';
    
    protected $_formTableName = 'Filtron_Form_Section';
    
    protected $_orderBy = 'pos DESC';
    
    public function getSection() {
        $table  = $this->getDbTable();
        
        $select = $table->select()
                        ->where('display = 1')
                        ->order('pos ASC');
        
        $result = $table->fetchAll($select);
        return $result; 
    }
    
    public function getSectionCount() {
        $registry = Engine_Api::getInstance();
        $db = $registry->getContainer()->db;
        $this->_tablePrefix = $registry->getContainer()->tablePrefix;
        
        $select = $db->select()
                    ->from(
                        array('a' => $this->_tablePrefix . 'filtron_section'),
                        array('*')
                      )
                    ->joinLeft(
                        array('b' => $this->_tablePrefix . 'filtron_articles'),
                        'b.section_id = a.id AND b.active = 1',
                        array('COUNT(b.id) AS amount')
                      )
                    ->group('a.id')
                    ->where('a.display = 1');
        $result = $db->fetchAll($select);
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