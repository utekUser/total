<?php
class Sitemap_Models_Sitemap extends Engine_Model_Abstract {
    protected $_dbTableName = 'Sitemap_Models_DbTable_Sitemap';
    
    protected $_formTableName = 'Sitemap_Form_Sitemap';
    
    protected $_orderBy = 'pos DESC';
    
    /**
     * Получаем список разделов
     *
     * @return unknown
     */
    public function getSection() {
        $table  = $this->getDbTable();
        $select = $table->select();
//        $select->order('pos');
        return $table->fetchAll($select); 
    }
    
    /**
     * Сохранение, изменение данных
     *
     * @param unknown_type $texts
     * @param unknown_type $id
     */
    public function savePage($texts, $id = null) {
        $form = $this->_getForm(); // модель
        $pos = $form->getPosition(); // получение позиции
        
        // первый вариант записи
        $data = array();
        foreach ($texts as $key => $value) {
            if (!$value->getIgnore()) {
//            if (!$value->getIgnore()) {
                $thisValue = $value->getValue();
                $data[$key] = $thisValue;
            }
        }
        
        if (null === $id) {
            if ($pos) {
                $data[$pos] = $this->_getPosNumber($pos);
            }
            $this->getDbTable()->insert($data);
            $id = $this->getDbTable()->getAdapter()->lastInsertId();
            $this->_insertId = $id;
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
        
        $s = $texts['text']->getValue();
        
        preg_match_all('/\[module=\"(.*)\"\]/im', $s, $matches, PREG_PATTERN_ORDER);
        if (isset($matches[1]) && count($matches[1])) {
            $findModule = $matches[1][0];

            $data = array(
                'included_modules' => strtolower($findModule)
            );
            
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }

        $f = fopen(APPLICATION_PATH . '/temporary/cache/sitemap-' . $id, 'w');
        fwrite($f, $s);
        fclose($f);
    }
    
    private static function parseModule($matches){ 
        return $matches[1];
    }
     
    public function getPage($page) {
        $table  = $this->getDbTable();
        
        $select = $table->select()
                    ->where('`url` = ?', $page)
                     ->limit('1');
        $result = $table->fetchAll($select);
        
        $rowCount = count($result);

        if ($rowCount == 1) {
            $path = $result[0]['id'];
        } else {
            $select = $table->select()
                        ->where('`id` = ?', $page)
                         ->limit('1');
            $result = $table->fetchAll($select);
            $rowCount = count($result);

            if ($rowCount == 1) {
                $path = $result[0]['id'];
            } else {
                $urlError = true;
            }
        }
        
        return $this->getContent($path); 
    }
    
    public function getContent($id) {
        return file_get_contents(APPLICATION_PATH . '/temporary/cache/sitemap-' . $id);   
    }
    
    /**
     * Удаление по умолчанию
     *
     */
    protected function _defaultDelete($data, $id) {
        $filename = APPLICATION_PATH . '/temporary/cache/sitemap-' . $id;
        if (file_exists($filename)) {
            unlink($filename);
        } 
    }
    
    public function getTopMenu() {
        $table  = $this->getDbTable();
        
        $select = $table->select()
                        ->where('display = ?', 1)
                        ->where('topmenu = ?', 1)
                        ->order('pos ASC');
        
        $result = $table->fetchAll($select);
        return $result; 
    }
    
    public function getLeftMenu() {
        $table  = $this->getDbTable();
        
        $select = $table->select()
                        ->where('display  = ?', 1)
                        ->where('leftmenu = ?', 1)
                        ->order('pos ASC');
        $result = $table->fetchAll($select);
        return $result; 
    }
}