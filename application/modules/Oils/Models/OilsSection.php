<?php
class Oils_Models_OilsSection extends Engine_Model_Abstract {
    protected $_dbTableName = 'Oils_Models_DbTable_OilsSection';
    
    protected $_formTableName = 'Oils_Form_OilsSection';
    
//    protected $_orderBy = 'id DESC';
    protected $_options = array();
    protected $_tree = array();
    
    public function getSectionPaginator($parent = null) {
        $http = new Engine_Controller_Request_Http();
        $page = $http->getParam('page');
        
        $table  = $this->getDbTable();
        
        $select = $table->select()
                        ->where('display = ?', 1);
        if ($parent !== null) {
            $select->where('parent = ?', $parent);
        } else {
            $select->where('parent = ?', 0);
        }
        
//        echo $select;
        $adapter = new Zend_Paginator_Adapter_DbSelect(
            $select
        );
        
        $paginator = new Engine_Paginator($adapter);
        $paginator->setItemCountPerPage(10);
        $paginator->setCurrentPageNumber($page);
        
        return $paginator;
    }
    
    public function getSection() {
        $table  = $this->getDbTable();
        
        $select = $table->select()
                        ->where('display = 1');
        
        $result = $table->fetchAll($select);
        return $result; 
    }   
    
    /**
     * Возвращает раздел с данным url
     *
     * @param unknown_type $url
     * @return unknown
     */
    public function getSectionByUrl($url) {
        $table  = $this->getDbTable();
        
        $select = $table->select()
                        ->where('url = ?', $url)
                        ->limit(1);
        $result = $table->fetchRow($select);
        return $result; 
    } 
    
    /**
     * Возвращает иерархическое дерево в виде вложенных html-списков
     *
     * @param array $tree
     * @param int $pid
     * @param string $active_url
     * @return unknown
     */
    public function getSectionTree($tree, $pid, $active_url = '') {
        $html = '';
//        echo $active_url;
//        $class = '';
        foreach ($tree as $row) {
            
            if ($row['pid'] == $pid) {
                if ($pid == 0) { 
                    $html .= '<ul>';
                    $first = 'li-first';
                } else {
                    $first = '';
                }
                
                if ($active_url != '' && $row['url'] == $active_url) {
                    $active = ' active';
                } else {
                    $active = '';
                }
                $html .= '<li class="' . $first . $active . '">';
                $html .= '<div><a href="/oils/' . $row['url'] . '/">' . $row['name'] . '</a></div>';
                $html .= $this->getSectionTree($tree, $row['id'], $active_url);
                $html .= '</li>';
                if ($pid == 0) $html .= '</ul>';
                
            }
            
        }
        if ($pid == 0) return $html ? '<div class="oil-main-section">' . $html . '</div>' : '';
        else return $html ? '<ul>' . $html . '</ul>' : '';
    } 
    
    /**
     * Возвращает все включенные подразделы данного раздела
     *
     * @param array $tree
     * @param int $section_id
     */
    public function getSubSections($tree, $section_id) {
//        $sections = array();
//        $this->_tree = $section_id;
        foreach ($tree as $row) {
            if ($row['pid'] == $section_id) {
                $this->_tree[] = $row['id'];
                $this->getSubSections($tree, $row['id']);
            }
        }
//        $this->_tree = $section_id;
//        echo '<pre>'; print_r($this->_tree); echo '</pre>'; 
        return $this->_tree;
    }
    
}