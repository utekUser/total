<?php
class Efeles_Models_EfeleSection extends Engine_Model_Abstract {
    protected $_dbTableName = 'Efeles_Models_DbTable_EfeleSection';
    
    protected $_formTableName = 'Efeles_Form_EfeleSection';
    
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
                        array('a' => $this->_tablePrefix . 'efele_articles_section'),
                        array('*')
                      )
                    ->joinLeft(
                        array('b' => $this->_tablePrefix . 'efele_articles'),
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