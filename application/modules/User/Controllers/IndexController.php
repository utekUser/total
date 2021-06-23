<?php
class User_controllers_IndexController extends Core_Controller_Action_User {
    public function init() {
        $auth = Zend_Auth::getInstance()->setStorage(new Zend_Auth_Storage_Session('Zend_Auth_User'));
        
        if (!$auth->hasIdentity()) {
            $this->_redirect('/account/login/');    
        }
        
        $this->view->id = $this->view->user = $auth->getIdentity();
        
//        $this->pageId = $this->_getUrl('urlToInt', 1);
//        $this->url = $this->_getUrl('url', 0);
//        
//        if ($this->pageId) {
//            Core_Controller_Action_User::setViewMain('view');
//            Core_Controller_Action_User::setDefaultParseUrlAction('view');
//        }
        
    }
    
    public function indexAction() {
//    	$model = new User_Models_User();
    	$form = new User_Form_User();
    	
		$this->view->elements = $form->getElements();
    }
    
    public function profileAction() {
        $model = new User_Models_User();
        $this->view->user = $model->getUser($this->view->id);
    }
    
    public function changepasswordAction() {
        $request = $this->getRequest();
        $user_id = $request->getPost('user_id');
        $email = $request->getPost('new_email');
        if ($user_id && $email) {
            $model = new User_Models_User();
            $model->updateProfile($user_id, $email);
        }
    }
	
}