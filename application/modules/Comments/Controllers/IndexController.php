<?php
class Comments_controllers_IndexController extends Core_Controller_Action_User {
    public function init() {
        $pageId = $this->_getParam('urlToInt');
        if ($pageId) {
            Core_Controller_Action_User::setViewMain('view');
            
            Core_Controller_Action_User::setDefaultParseUrlAction('view');
        }
    }
    
    public function indexAction() {
        
    }
    
    public function viewAction() {
        
    }
}