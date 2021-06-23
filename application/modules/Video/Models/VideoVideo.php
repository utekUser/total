<?php
class Video_Models_VideoVideo extends Engine_Model_Abstract {
    protected $_destination = 'public/video';
    
    protected $_dbTableName = 'Video_Models_DbTable_VideoVideo';
    
    protected $_formTableName = 'Video_Form_VideoVideo';
    
    protected $_orderBy = 'posted';
    
    public function getVideo($url = null) {
        $http = new Engine_Controller_Request_Http();
        $page = $http->getParam('page');
        
        $table  = $this->getDbTable();
        
        $select = $table->select()
                        ->where('display = ?', 1)
                        ->order('posted DESC');
        if ($url !== null) {
            $select->where('section_id = ?', $url);
        }
        
        $adapter = new Zend_Paginator_Adapter_DbSelect(
            $select
        );
        
        $paginator = new Engine_Paginator($adapter);
        $paginator->setItemCountPerPage(5);
        $paginator->setCurrentPageNumber($page);
        
        return $paginator;
    }
    

    public function _defaultDelete($data, $id) {
        $form = new Video_Form_VideoVideo();
        $elements = $form->getElements();
        return true;
        exit;    
    }
    
    public function addView($id) {
        $table  = $this->getDbTable();
        
        $data = array(
            'view' => new Zend_Db_Expr('view + 1')
        );
        $table->update($data, array('id = ?' => $id));
    }
    
    public function getCurrentVideo($id) {
        $table  = $this->getDbTable();
        
        $select = $table->select()
                        ->where('`id` = ?', $id)
                        ->limit('1');
        $result = $table->fetchRow($select);
        return $result;
    }
    
    public function getLastVideo() {
//        $table  = $this->getDbTable();
//        
//        $select = $table->select()
//                        ->where('display = 1')
//                        ->order('posted DESC')
//                        ->limit('2');
//        $result = $table->fetchAll($select);
//        return $result;

        $registry = Engine_Api::getInstance();
        $db = $registry->getContainer()->db;
        $this->_tablePrefix = $registry->getContainer()->tablePrefix;
        
        $select = $db->select()
                    ->from(
                        array('a' => 'pilot_video'),
                        array('*')
                      )
                    ->joinLeft(
                        array('b' => 'pilot_video_section'),
                        'a.section_id = b.id',
                        array('url AS section_url')
                      )
                    ->where('a.display = 1')
                    ->where('a.status = 1')
                    ->order('posted DESC')
                    ->limit('2');
        
        $result = $db->fetchAll($select);
        return $result;
        
    }
    
    public function putFile($file, $param) {
//        echo $file;
//        print_r($param);
        
        
        $path = $this->generate($param['parent_id']);
//        echo APPLICATION_PATH . DS . $path . DS . $param['parent_id'] . '.flv';
        $this->_mkdir(APPLICATION_PATH . DS . $path);
        
        copy($file, APPLICATION_PATH . DS . $path . DS . $param['parent_id'] . '.flv');
        
        $table  = $this->getDbTable();
        
        $data = array(
            'file' => $path . DS . $param['parent_id'] . '.flv'
        );
        $table->update($data, array('id = ?' => $param['parent_id']));
        
        return true;
    }
    
    protected function generate($id) {
        if ($this->_maxGenerate) {
            $subdir1 = ( (int) $id + 999999 - ( ( (int) $id - 1 ) % 1000000) );
            $subdir2 = ( (int) $id + 999    - ( ( (int) $id - 1 ) % 1000   ) );
            return $this->_destination . '/'
//            . strtolower($this->_folderTarget) . '/'
            . $subdir1 . '/'
            . $subdir2 . '/'
            . $id;
//            . $id . '/'
//            . $this->_fileId . '.'
//            . strtolower($this->_extension);
        } else {
            $subdir1 = ( (int) $id + 999    - ( ( (int) $id - 1 ) % 1000   ) );
            return $this->_destination . '/'
//            . strtolower($this->_folderTarget) . '/'
            . $subdir1 . '/'
            . $id;
//            . $id . '/'
//            . $this->_fileId . '.'
//            . strtolower($this->_extension);
        }
    }
    
    protected function _mkdir($path, $mode = 0777) {
        if( is_dir($path) ) {
          @chmod($path, $mode);
          return;
        }
        if( !@mkdir($path, $mode, true) ) {
            echo ("Ошибка");
        }
    }
    
    public function putFileImage($file, $param) {
        $path = $this->generate($param['parent_id']);
        $this->_mkdir(APPLICATION_PATH . DS . $path);
        
        copy($file, APPLICATION_PATH . DS . $path . DS . $param['parent_id'] . '.jpg');
        
        $table  = $this->getDbTable();
        
        $data = array(
            'picture' => $path . DS . $param['parent_id'] . '.jpg'
        );
        $table->update($data, array('id = ?' => $param['parent_id']));
        
        return true;
    }
}