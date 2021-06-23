<?php
class Coolstream_controllers_IndexController extends Core_Controller_Action_User {
    public function init() {
        $auth = Zend_Auth::getInstance()->setStorage(new Zend_Auth_Storage_Session('Zend_Auth_User'));
        $this->view->user = $auth->getIdentity();
        if ($auth->hasIdentity()) {
            $desired = new Shop_Models_DesiredProduct();
            $this->view->desired = $desired->getProduct($this->view->user);

            $userModel = new User_Models_UserInfo();
            $user = $userModel->getUserInfo($auth->getIdentity());
            if ($user['price_type'] == 1) {
                $this->view->priceType = 'ngk1';
            } elseif ($user['price_type'] == 0) {
                $this->view->priceType = 'base';
            }
            $this->view->auth_id = $auth->getIdentity();
        } else {
            $this->view->priceType = 'base';
        }        
    }

    public function indexAction() {
        $tasks = new Core_Models_Tasks();
        $this->view->task = $tasks->getTime(1);        
        $plugModel = new Coolstream_Models_Coolstream();        
        $request = $this->getRequest();
        if ($request->getQuery('code')) {
            $code = array();
            $codeOptOriginal = array();
            $filterType = '';    
            foreach ($request->getQuery('code') as $key => $value) {
                if (trim($value) != '') {
                    $code[] = $value;
                    $codeOptOriginal[] = $value;
                    //$value = preg_replace("/[^a-zA-Zа-яА-Я0-9]/u", "", trim($value));
                    //$filterType .= 'name_search LIKE "%' . $value . '%" OR ';
                    $filterType .= 'name_search LIKE "%' . $value . '%" OR articlesaler LIKE "%' . $value . '%" OR ';
                }
        	}        	
        	$codePlug = substr($filterType, 0, - 4);
        	$this->view->code = $code;        	
        	if ($codePlug != '') {
        	    $this->view->paginator = $plugModel->getCoolstreams($codePlug);
        	} else {
    	       $this->view->paginator = $plugModel->getCoolstreams();
        	}
            $history = new Search_Models_History();
            $history->saveRequest(
                date("Y-m-d H:i:s"),
                implode("###", $codeOptOriginal),
                'coolstream',
                $this->view->paginator->getTotalItemCount(),
                $this->view->auth_id
            );			
			$oilsearch = new Oils_Models_OilsSearch();
			$auth = Zend_Auth::getInstance()->setStorage(new Zend_Auth_Storage_Session('Zend_Auth_User'));
			if ($auth->hasIdentity()) {
				$modelUser = new User_Models_UserUser();
				$user = $modelUser->getUser($auth->getIdentity());
				$login = $user['login'];
			} else {
				$login = "Неавторизованный пользователь";
			}
			$data555['login'] = $login;
			$data555['brands'] = implode("###", $codeOptOriginal);
			$data555['price'] = $this->view->paginator->getTotalItemCount();
			$data555['type'] = '';
			$data555['capacity'] = '';
			$data555['viscosity'] = '';
			$data555['archive'] = 0;
			$data555['date'] = date("Y-m-d h:i:s", time());
			$data555['searchtype'] = 'coolstreams';
			$oilsearch->saveSearch($data555);
        } else {        
            $this->view->paginator = $plugModel->getCoolstreams();            
        }
    }
}