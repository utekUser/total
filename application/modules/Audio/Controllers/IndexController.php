<?php
class Audio_controllers_IndexController extends Core_Controller_Action_User {
    public function init() {
        $pageId = $this->_getParam('urlToInt');
        if ($pageId) {
            Core_Controller_Action_User::setViewMain('view');
            
            Core_Controller_Action_User::setDefaultParseUrlAction('view');
        }
    }

    public function indexAction() {
        $model = new Audio_Models_Audio();
        $this->view->paginator = $model->getAudio();
    }
    
    public function viewAction() {
        $id = $this->_getParam('urlToInt');
//        $action = $this->_getParam('action');
        
        $ttt = new Audio_Models_Audio();
        $ttt->addView($id);
        
        $this->view->currentAudio = $ttt->getCurrentAudio($id);
    }
}