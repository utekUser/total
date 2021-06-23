<?php
class Cms_Controllers_AdminCmsTasksController extends Core_Controller_Action_Admin {
    public function indexAction() {
        // Make select
//        $tasksTable = Engine_Api::_()->getDbtable('tasks', 'core');
        $tasksTable = new Core_Models_DbTable_Tasks();
        $tasksTable = new Core_Models_DbTable_Tasks();
        $select = $tasksTable->select()
          ->where('module IN(?)', array('core'));
//          echo $select;
//    echo "!!!"; exit;
        // Make select - order
        if( empty($values['order']) ) {
          $values['order'] = 'task_id';
        }
        if( empty($values['direction']) ) {
          $values['direction'] = 'ASC';
        }
        $select->order($values['order'] . ' ' . $values['direction']);
        unset($values['order']);
        unset($values['direction']);
    
        // Make select - where
        if( isset($values['moduleName']) ) {
          $values['module'] = $values['moduleName'];
          unset($values['moduleName']);
        }
        foreach( $values as $key => $value ) {
          $select->where($tasksTable->getAdapter()->quoteIdentifier($key) . ' = ?', $value);
        }
    
        // Make paginator
        $this->view->tasks = $tasks = Zend_Paginator::factory($select);
        $tasks->setItemCountPerPage(25);
        $tasks->setCurrentPageNumber($this->_getParam('page'));
        
//        echo "<pre>";
//        print_r($this->view->tasks);
//        echo "</pre>";
    }
}