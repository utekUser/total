<?php
class Partners_controllers_IndexController extends Core_Controller_Action_User {
    public function init() {
        $pageId = $this->_getParam('urlToInt');
        if ($pageId) {
            Core_Controller_Action_User::setViewMain('view');
            
            Core_Controller_Action_User::setDefaultParseUrlAction('view');
        }
    }

    public function indexAction() {
        $model = new Partners_Models_Partners();
        $this->view->paginator = $model->getPartners();
    }
    
    public function viewAction() {
        $id = $this->_getParam('urlToInt');
        $ttt = new Partners_Models_Partners();
        $this->view->currentPartner = $ttt->getCurrentPartner($id);
    }
}