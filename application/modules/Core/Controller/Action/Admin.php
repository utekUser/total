<?php
abstract class Core_Controller_Action_Admin extends Core_Controller_Action_User {
    protected $_controllerModelName; // При установки имя модели в ручную
    protected $_controllerModel;
    
    protected $_path = array();
    
    protected $_modulePath;
    protected $_moduleHeader;
        
    protected $_fields;
    protected $_table;
    protected $_listTables;
    protected $_nameTable;
    
    protected $_db;
    
    protected $_tablePrefix;
    
    public function __construct() {
        parent::__construct();
        
        $this->initContent();
        
        $registry = Engine_Api::getInstance();
        $this->_listTables = $registry->getContainer()->listTables;
        
        $this->_db = $registry->getContainer()->db;
        
        $this->_tablePrefix = $registry->getContainer()->tablePrefix;
        
        $this->_checkFrom();
    }
    
    public function initContent() {
        $options = $this->getContentAreas();
        
        if (!empty($options['path'])) {
            $this->_path = $options['path'];
        }
        
        if (!empty($options['form'])) {
            $this->_form = $options['form'];
        }
    }
    
    public function getContentAreas() {
        $contentAreas = array();
        
        // From modules
        $contentManifestFile = $this->getModuleDirectory() . '/settings/content.php';
        if (!file_exists($contentManifestFile)) {
            //continue;
        }
        $ret = include $contentManifestFile;

        $contentAreas = array_merge($contentAreas, (array) $ret);
        
        return $contentAreas;
    }
    
    protected function _initManifest() {
        $data = array();
        
        $file = $this->getModuleDirectory() . '/settings/manifest.php';

        if(file_exists($file))   {
            $data = include($file);
        } else {
            $data = array();
        }
        $manifest = $data;
        
//        echo "<pre>";
//        print_r($manifest);
//        echo "</pre>";
        
        return $data;
    }
    
    /**
     * Установка модели текущего модуля
     *
     * @param unknown_type $model
     * @return unknown
     */
    final public function _setModel($model) {
        if (is_string($model)) {
            $model = new $model();
        }
        if (!$model instanceof Engine_Model_Abstract) {
            throw new Exception('Invalid model data gateway provided');
        }
        $this->_controllerModel = $model;
        return $this;
    }
    
    /**
     * Возвращение модели текущего модуля
     *
     * @return unknown
     */
    final public function _getModel() {
        if (null === $this->_controllerModel) {
            if (!$this->_controllerModelName) {
                $model = $this->_getModule() . '_Models_' . $this->_getModulePrefix();
                $this->_setModel($model);    
            } else {
                $this->_setModel($this->_controllerModelName);
            }
        }
        return $this->_controllerModel;
    }
    
    public function render() {
        $this->view->control  = $this->_getParam('control');
                $this->_builtPath();

        
        $this->view->path    = $this->_modulePath;
        $this->view->header  = $this->_moduleHeader;
        

        
        $layout = new Zend_Layout();
        $layout->setLayoutPath($this->_layoutPath);
        $layout->setViewSuffix('tpl');

        if ($this->_action == 'add' || $this->_action == 'edit') {
            $tplAction = 'form';
        } else {
            $tplAction = $this->_action;
        }
        if (!file_exists($this->_moduleDirectory . '/views/scripts/admin/' . $this->_skin . '/' . $tplAction . '.tpl')) {
            $this->view->setScriptPath(APPLICATION_PATH . '/application/themes/admin-action/views/scripts');
        } else {
            $sss = true;    
        }
        
        $viewMain = self::getViewMain();
        if ($viewMain) {
            $tplAction = $viewMain;
        }

        if ($this->_side) {
            if ($sss) {
                $layout->content = $this->view->render('admin/' . $this->_skin . '/' . $tplAction . '.tpl');
            } else {
                $layout->content = $this->view->render('admin/' . $tplAction . '.tpl');    
            }
        } else {
            $layout->content = $this->view->render($tplAction . '.tpl');
        }
        
        $cmsModule = new Cms_Models_CmsModule();
        $this->view->leftmenu = $cmsModule->getModule();
        $this->view->setScriptPath(APPLICATION_PATH . '/application/themes/admin/default');
        $this->view->leftmenuselect = strtolower($this->_getParam('action'));
        $layout->leftmenu = $this->view->render('leftmenu.tpl');
        
        $layout->setLayout('index');
        
        echo $layout->render();    
    }
    
    protected function _builtPath() {
        $path = '';
        $path .= '<a href="/admin/">Главная</a>';
        $url = '/admin/';
        foreach ($this->_path as $key => $value) {
            $url .= $key . '/';
            $path .= ' > <a href="' . $url . '">' . $value . '</a>';
            
            $lastUlr = $url;
            $lastheader = $value; 
        }
        $this->_modulePath = $path;
        $this->_moduleHeader = '<a href="' . $lastUlr . '">' . $lastheader .'</a>';
    }
    
    protected function _checkFrom() {
        if (!empty($this->_form)) {
            foreach ($this->_form as $value) {
                
                $tempClass = new $value();
                
                $this->checkTable($tempClass);
                $this->updateTable($tempClass);
            }
        } else {
//            echo "-";
        }
    }
    
    protected function  checkTable($tempClass) {
        $this->_table = $tempClass;

        $this->_nameTable = $this->_tablePrefix . $tempClass->getTableName();
//        echo $this->_nameTable . "<br />";
        // Создание таблицы
        if (!in_array($this->_nameTable, $this->_listTables)) {
            $commentForTable = $this->_table->getTableComment();      

            $sql = "CREATE TABLE IF NOT EXISTS `" . $this->_tablePrefix . $this->_table->getTableName() . "` (\n";
            
//            $sql .= $this->_table->getPrimaty();
            
//            foreach ($this->_table->fields as $key => $fields) {
            foreach ($this->_table->getElements() as $key => $fields) {
                $dbObject[] = $fields->getName();
                
                $sql .= "  `" . $fields->getName() . "` " . $fields->getFieldType() . $fields->getFieldDefault() . $fields->getAutoIncrement() . $fields->getFieldComment();
                
                if (!$this->table->withoutRrimary) {
                    $sql .= ",\n";
                } else {
                    if (!(isset($this->table->fieldsIndex) && $this->table->fieldsIndex || isset($this->table->fieldsUnique) && $this->table->fieldsUnique)) {
                        if ($key < count($this->table->fields) - 1) {
                            $sql .= ",\n";
                        } else {
                            $sql .= "\n";
                        }
                    } else {
                        $sql .= ",\n";
                    }
                }
            }
            
            $fP = $this->_table->getPrimary();
            $fI = $this->_table->getIndex();
            $fU = $this->_table->getUnique();
            $fF = $this->_table->getFulltext();
//            echo "<pre>";
//            print_r($this->_table);
//            echo "</pre>";
            foreach ($fI as $value) {
                $sql .= " KEY " . $value . ",\n";    
            }
            
            foreach ($fU as $value) {
                $sql .= " UNIQUE KEY ".$value.",\n";    
            }
            
            foreach ($fF as $value) {
                $sql .= " FULLTEXT " . $value . ",\n";    
            }
            
            if ($fP) {
                $sql .= " PRIMARY KEY (" . $fP . "),\n";        
            }
            
//            if (isset($fI) && $fI || isset($fU) && $fU) {
//                if (!$this->table->withoutRrimary) {
//                    $sql .= "  PRIMARY KEY (`" . $this->_table->getPrimatyId() . "`),\n";
//                }
//                
//                $indexCount = count($fI);
//                
//                $thisIndexCount = 0;
//                
//                foreach ($fI as $indexValue) {
//                    if ($indexValue) {
//                        $thisIndexCount++;
//                        if ($indexCount != $thisIndexCount || count($fU)) {
//                            $sql .= "  KEY ".$indexValue.",\n";    
//                        } else {
//                            $sql .= "  KEY ".$indexValue."\n";    
//                        }
//                    }
//                }
//                
//                $uniqueCount = count($fU);
//                $thisUniqueCount = 0;
//                
//                foreach ($fU as $uniqueValue) {
//                    if ($uniqueValue) {
//                        $thisUniqueCount++;
//                        if ($uniqueCount != $thisUniqueCount) {
//                            $sql .= "  UNIQUE KEY ".$uniqueValue.",\n";    
//                        } else {
//                            $sql .= "  UNIQUE KEY ".$uniqueValue."\n";    
//                        }
//                    }
//                }
//            } else {
//                if (!$this->table->withoutRrimary) {
//                    $sql .= "  PRIMARY KEY (`". $this->_table->getPrimatyId() . "`)\n";
//                }
//            }
            $sql = preg_replace("/(.*).$/", "\\1", $sql);
            $sql .= ") ENGINE=MyISAM DEFAULT CHARSET=utf8$commentForTable;";
            
            
            
            echo "<pre>".$sql."</pre>";
//            exit;
            $this->_db->query($sql);
            
            $insertRow = $this->_table->getForFirstCreate();
//            echo $insertRow . "!!!"; exit;
            if ($insertRow) {
                $this->_db->query($insertRow);            
            }
        } 
    }
    
    /**
     * Обновление таблицы
     *
     * @param string $tempClass
     */
    protected function updateTable($tempClass) {
        $this->_table = $tempClass;
        $this->_nameTable = $this->_tablePrefix . $tempClass->getTableName();
        
        $pos = $this->_table->getPosition();

        $sql  = "SHOW COLUMNS FROM " . $this->_nameTable;

        $result = $this->_db->fetchAll($sql);
        
        foreach ($result as $value) {
            $columns[$value['Field']]['Field'] = $value['Field'];
            $columns[$value['Field']]['Type']  = $value['Type'];
        }
        
        foreach ($this->_table->getElements() as $key => $fields) {
            $fieldsName = $fields->getName();
            $fieldsType = $fields->getFieldType();

            $dbObject[] = $fieldsName;
            if (!$columns[$fieldsName]['Field']) {

                echo "Добавляем поле!!!<br />";
                
                $sql = "ALTER TABLE `" . $this->_nameTable . "` ADD `" . $fields->getName() . "` " . $fields->getFieldType() . $fields->getFieldDefault() . $fields->getFieldComment();
                $this->_db->query($sql);
                echo "Добавляем поле:<br><pre>".$sql."</pre>";
                if ($pos == $fields->getName()) {
                    $registry = Engine_Api::getInstance();
                    $db = $registry->getContainer()->db;
                    $tablePrefix = $registry->getContainer()->tablePrefix;
            
                    $sql = "
                        UPDATE `" . $this->_nameTable . "`
                        SET `" . $pos . "` = `" . $this->_table->getPrimary() . "`
                    ";
                    $this->_db->query($sql);
                }
            } else {
                $tf = false;
                
                if (preg_match('/varchar/', strtolower($columns[$fieldsName]['Type']))) {
                    if (strtolower($fieldsType) != strtolower($columns[$fieldsName]['Type']) && strtolower($fieldsType)!=str_replace('varchar','char',strtolower($columns[$fieldsName]['Type']))) {
                        $tf = true;   
                    }
                } elseif(preg_match('/char/', strtolower($columns[$fieldsName]['Type']))) {
                    if (strtolower($fieldsType) != strtolower($columns[$fieldsName]['Type']) && strtolower($fieldsType)!=str_replace('char','varchar',strtolower($columns[$fieldsName]['Type']))) {
                        $tf = true;
                    }
                } elseif(strtolower($fieldsType)!=strtolower($columns[$fieldsName]['Type'])) {
                    $tf = true;
                }
                if ($tf) {
                    $sql = "ALTER TABLE `" . $this->_nameTable . "` CHANGE `" . $fieldsName . "` `" . $fieldsName . "` " . $fieldsType . $fields->getFieldDefault() . $fields->getFieldComment();
                    echo "Изменяем тип поля:<br><pre>" . $sql . "</pre>";
                    
                    $this->_db->query($sql);
                }
            }
        }
        
        if ($this->_table->getPrimatyId()) {
            $dbObject[] = $this->_table->getPrimatyId();
        }
        
//        if (false) {
            foreach ($result as $value) {
                if (!in_array($value['Field'], $dbObject)) {
                    echo "Удаляем поле:<br />";
                    $this->_db->query($sql = "
                        ALTER TABLE `" . $this->_nameTable ."` DROP `" . $value['Field'] . "`
                    "); 
                    echo "<pre>" . $sql . "</pre>"; 
                }
            }
//        }
    }
    
    /**
     * Поднимает запись вверх
     *
     */
    final public function upAction() {
        $id = $this->_getParam('pageId');
        $model = $this->_getModel();
        $model = new $model();
        $model->upRecord($id);
        
        $this->_redirector->gotoModule();
    }
    
    /**
     * Опускает запись вниз
     *
     */
    final public function downAction() {
        $id = $this->_getParam('pageId');
        
        $model = $this->_getModel();
        $model = new $model();
        $model->downRecord($id);
        
        $this->_redirector->gotoModule();
    }
    
    /**
     * Отображает запись
     *
     */
    final public function displayAction() {
        $id = $this->_getParam('pageId');
        $model = $this->_getModel();
        $model->displayRecord($id);
        
        $this->_redirector->gotoModule();
    }
    
    /**
     * Скрывает запись
     *
     */
    final public function hideAction() {
        $id = $this->_getParam('pageId');
        $model = $this->_getModel();
        $model->hideRecord($id);
        
        $this->_redirector->gotoModule();
    }
}