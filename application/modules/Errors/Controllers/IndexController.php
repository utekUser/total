<?php
class Errors_controllers_IndexController extends Core_Controller_Action_User {
    public function init() {
    	$http = new Engine_Controller_Request_Http();
    	if ($http->getParam('code') != 'fI4g34tn5') {
    		die('Access denied!');
    	}
    }
    
    public function indexAction() {
    	$oilsModel = new Oils_Models_OilsOils();
    	$this->view->oilsBaseNone = $oilsModel->getBaseNone();
    	$this->view->oilsRecNone = $oilsModel->getRecNone();
    	
    	$filter = new Filters_Models_FiltersFilters();
    	$this->view->filtersBaseNone = $filter->getBaseNone();
    	$this->view->filtersRecNone = $filter->getRecNone();
    	
    	$content = $this->view->render('index.tpl');
    	echo $content; exit;
    }
    
    public function viewAction() {
        $id = $this->_getParam('urlToInt');
        $action = $this->_getParam('action');
        
        $ttt = new News_Models_News();
        $ttt->addView($id);
        
        $this->view->currentNew = $ttt->getCurrentNew($id);
    }
}