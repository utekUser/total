<?php
class Articles_Models_ArticlesSection extends Engine_Model_Abstract {
    protected $_dbTableName = 'Articles_Models_DbTable_ArticlesSection';
    
    protected $_formTableName = 'Articles_Form_ArticlesSection';
    
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
                        array('a' => $this->_tablePrefix . 'articles_section'),
                        array('*')
                      )
                    ->joinLeft(
                        array('b' => $this->_tablePrefix . 'articles'),
                        'b.section_id = a.id',
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