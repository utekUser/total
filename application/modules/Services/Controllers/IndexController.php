<?php
class Services_controllers_IndexController extends Core_Controller_Action_User {
    public function init() {
        $pageId = $this->_getParam('urlToInt');
        if ($pageId) {
            Core_Controller_Action_User::setViewMain('view');
            Core_Controller_Action_User::setDefaultParseUrlAction('view');
        }
    }

    public function indexAction() {
        $model = new Services_Models_Services();
        $this->view->paginator = $model->getServices();
    }
    
    public function viewAction() {
        $id = $this->_getParam('urlToInt');
        $action = $this->_getParam('action');
        
        $model = new Services_Models_Services();
        $this->view->currentService = $model->getcurrentService($id);
        
        $this->view->paginator = $model->getServices($id);
    }
}