<?php
class Oils_Models_OilsConnection extends Engine_Model_Abstract {
    protected $_dbTableName = 'Oils_Models_DbTable_OilsConnection';
    
    protected $_formTableName = 'Oils_Form_OilsConnection';
    
    public function saveTable($id, $array) {
        if(is_array($array)){
            
            $where = "`item_id` = $id AND `section_id` NOT IN (";
            foreach ($array as $key) {
                $where .= $key . ',';
            }
            $where = substr($where, 0, -1) . ')';
            
            //Удаляем разделы, которые не были переданы
            $registry = Engine_Api::getInstance();
            $db = $registry->getContainer()->db;
            $this->_tablePrefix = $registry->getContainer()->tablePrefix;
            $delete = $db->delete($this->_tablePrefix.'oils_connection', $where);
        
//            echo '<pre>'; print_r($array); echo '</pre>'; exit;
            $checkSection = array();
            $sections = $this->getSectionsByItem($id);
            foreach ($sections as $value){
                $checkSection[] = $value->section_id;
            }
//            echo '<pre>'; print_r($checkSection); echo '</pre>'; exit;

            foreach ($array as $key) {
                if(!in_array($key, $checkSection)) {
//                    $maxPos = mysql_fetch_assoc(mysql_query("
//                        SELECT MAX(`pos`) AS pos
//                        FROM `tokm_catalog_sections_catalog`
//                        LIMIT 1
//                    "));
//                    $maxPos = $maxPos['pos'] + 1;
//                    mysql_query("
//                        INSERT INTO `tokm_catalog_sections_catalog` (
//                            `id` ,
//                            `parent` ,
//                            `catalog_id` ,
//                            `display` ,
//                            `pos` 
//                        )
//                            VALUES (
//                            NULL , '$key', '$insertId', '1', '$maxPos'
//                        );
//                    ");
                $this->saveConnection($id, $key);
                }
			}
            			
        }
    }
    
    public function getTable($id) {
        $table  = $this->getDbTable();
        
        $select = $table->select()
                        ->from($table, 'section_id')
                        ->where('item_id = ?', $id);
                        
        $result = $table->fetchAll($select);
        
        return $result;
    }
    
    public function saveConnection($item_id, $section_id) {
        $data = array(
            'item_id'    => $item_id,
            'section_id' => $section_id
        );
        $this->getDbTable()->insert($data);
    }
    
    
    public function getSectionsByItem($item_id) {
        $table  = $this->getDbTable();
        
        $select = $table->select()
                        ->from($table, array('section_id'))
                        ->where('item_id = ?', $item_id);
        $result = $table->fetchAll($select);
        return $result;
    }
    
    
}