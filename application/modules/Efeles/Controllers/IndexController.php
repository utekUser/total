<?php
/**
 * Работа со статьями
 *
 */
class Efeles_controllers_IndexController extends Core_Controller_Action_User {
    /**
     * Инициализация
     *
     */
    public function init() {
        /*$this->pageId = $this->_getUrl('urlToInt', 1);
        $this->url = $this->_getUrl('url', 0);
        
        if ($this->pageId) {
            Core_Controller_Action_User::setViewMain('view');
            Core_Controller_Action_User::setDefaultParseUrlAction('view');
        }*/
		$this->pageId = $this->_getUrl('urlToInt', 0);
		$this->url = $this->_getUrl('url', 0);
		if ($this->pageId) {
			Core_Controller_Action_User::setViewMain('view');
			Core_Controller_Action_User::setDefaultParseUrlAction('view');
		}
		$auth = Zend_Auth::getInstance()->setStorage(new Zend_Auth_Storage_Session('Zend_Auth_User'));
		if ($auth->hasIdentity()) {
			$userModel = new User_Models_UserInfo();
			$user = $userModel->getUserInfo($auth->getIdentity());
			if ($user['price_type'] == 1) {
				$this->view->priceType = 'recom';
			} elseif ($user['price_type'] == 0) {
				$this->view->priceType = 'base';
			}
		} else {
			$this->view->priceType = 'base';
		}
    }
    
    /**
     * Список статей
     *
     */
    public function indexAction() {
		$http = new Engine_Controller_Request_Http();
		$this->view->page = $http->getParam('page');
		
		$auth = Zend_Auth::getInstance()->setStorage(new Zend_Auth_Storage_Session('Zend_Auth_User'));
		$this->view->user = $this->view->auth_id = $auth->getIdentity();
		if ($auth->hasIdentity()) {
			$desired = new Shop_Models_DesiredProduct();
			$this->view->desired = $desired->getProduct($this->view->user);
		} 
		
		
		
        $section = new Efeles_Models_EfeleSection();
        $article = new Efeles_Models_EfeleArticle();
		$sectionName = null;
        // если выбран раздел
        if ($this->url) {
            $sectionName = $section->getSectionName($this->url);
            $this->view->sectionName = $sectionName['name'];
        }
        $this->view->section = $section->getSectionCount();		
        $this->view->paginator = $article->getArticle($sectionName['id']);
    }
    
    /**
     * Выбранная статья
     *
     */
    public function viewAction() {
        // вывод текущего комментария
        /*$ttt = new Efeles_Models_EfeleArticle();
        $ttt->addView($this->pageId);
        $this->view->currentArticle = $ttt->getCurrentArticle($this->pageId);
        */
		//echo "lol"; die;
		$auth = Zend_Auth::getInstance()->setStorage(new Zend_Auth_Storage_Session('Zend_Auth_User'));
		$this->view->auth_id = $auth->getIdentity();
		$id = $this->_getParam('urlToInt');
		$ttt = new Efeles_Models_EfeleArticle();
		$this->view->oil = $ttt->getCurrentArticle($id);
		if ($auth->hasIdentity()) {
			$userModel = new User_Models_UserInfo();
			$user = $userModel->getUserInfo($auth->getIdentity());
			if ($user['price_type'] == 1) {
				$this->view->priceType = 'recom';
			} elseif ($user['price_type'] == 0) {
				$this->view->priceType = 'base';
			}
		} else {
			$this->view->priceType = 'base';
		}
    }
}