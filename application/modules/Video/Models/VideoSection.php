<?php
class Video_Models_VideoSection extends Engine_Model_Abstract {
    protected $_dbTableName = 'Video_Models_DbTable_VideoSection';
    
    protected $_formTableName = 'Video_Form_VideoSection';
    
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
    
    public function getSectionCount() {
        $registry = Engine_Api::getInstance();
        $db = $registry->getContainer()->db;
        $this->_tablePrefix = $registry->getContainer()->tablePrefix;
        
        $select = $db->select()
                    ->from(
                        array('a' => $this->_tablePrefix . 'video_section'),
                        array('*')
                      )
                    ->joinLeft(
                        array('b' => $this->_tablePrefix . 'video'),
                        'b.section_id = a.id',
                        array('COUNT(b.id) AS amount')
                      )
                    ->group('a.id')
                    ->where('a.display = 1');
        $result = $db->fetchAll($select);
        return $result;
    }
}