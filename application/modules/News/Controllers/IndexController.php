<?php
class News_controllers_IndexController extends Core_Controller_Action_User {
    public function init() {
        $this->pageId = $this->_getUrl('urlToInt');
		//echo $this->pageId; die;
        if ($this->pageId) {
            Core_Controller_Action_User::setViewMain('view');
            Core_Controller_Action_User::setDefaultParseUrlAction('view');
        }
    }
    
    public function indexAction() {
        $model = new News_Models_News();
        $this->view->paginator = $model->getNews();
    }
    
    public function viewAction() {
        $id = $this->_getUrl('urlToInt');
        $action = $this->_getUrl('action');
        
        $ttt = new News_Models_News();
        $ttt->addView($id);
        
        $this->view->currentNew = $ttt->getCurrentNew($id);
    }
}