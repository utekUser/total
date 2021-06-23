<?php
class Filters_controllers_IndexController extends Core_Controller_Action_User
{
    public function init()
    {
        $this->pageId = $this->_getUrl('urlToInt', 1);
        $this->url = $this->_getUrl('url', 0);
        
        if ($this->pageId) {
            Core_Controller_Action_User::setViewMain('view');
            Core_Controller_Action_User::setDefaultParseUrlAction('view');
        }
        
        $auth = Zend_Auth::getInstance()->setStorage(new Zend_Auth_Storage_Session('Zend_Auth_User'));
        if ($auth->hasIdentity()) {
            $userModel = new User_Models_UserInfo();
            $user = $userModel->getUserInfo($auth->getIdentity());
            if($user['price_type'] == 1) {
                $this->view->priceType = 'recom';
            } elseif ($user['price_type'] == 0) {
                $this->view->priceType = 'base';
            }
        } else {
            $this->view->priceType = 'base';
        }
        
    }

    public function indexAction() {
        $http = new Engine_Controller_Request_Http();
        $this->view->page = $http->getParam('page');
        
        $auth = Zend_Auth::getInstance()->setStorage(new Zend_Auth_Storage_Session('Zend_Auth_User'));
        $this->view->user = $this->view->auth_id = $auth->getIdentity();
        if ($auth->hasIdentity()) {
            $desired = new Shop_Models_DesiredProduct();
            $this->view->desired = $desired->getProduct($this->view->user);
        }
        $section = new Filters_Models_FiltersSection();
        $filter = new Filters_Models_FiltersFilters();
        
        $this->view->filterDescr = 1;
        $sectionName = null;
        // если выбран раздел
        if ($this->url) {
            $sectionName = $section->getSectionName($this->url);
            $this->view->sectionName = $sectionName['name'];
            $this->view->sectionInfo = $sectionName['text'];
            $this->view->filterDescr = 0;
        }
        
        $request = $this->getRequest();
        if ($request->getQuery('code')) {
            $code = $request->getQuery('code');
            $this->view->code = $code;
            $this->view->paginator = $filter->getFilterByCode($code);
        } elseif ($request->getQuery('codeOpt')) {
            $codeOpt = array();
            $codeOptOriginal = array();
            $filterType = '';
            $codeFilter = '';
    
            foreach ($request->getQuery('codeOpt') as $key => $value) {
                if (trim($value) != '') {
                    $codeOpt[] = $value;
                    $codeOptOriginal[] = $value;
                    $value = preg_replace("/[^a-zA-Zа-яА-Я0-9]/u", "", trim($value));
                    $filterType .= 'name_search LIKE "%' . $value . '%" OR ';
                }
        	}



        	$codeFilter .= substr($filterType, 0, - 4);
            // name_search LIKE "%MH50%" OR name_search LIKE "%MH55%"
        	if (sizeof($codeOpt)) {
        	    $this->view->paginator = $filter->getFilterByCodeOpt($codeFilter);
        	    $this->view->codeOpt = $codeOpt;
        	} else {
        	    $this->view->paginator = $filter->getFilter($sectionName['fk_id']);
        	}
//        	echo $codeFilter;
//        	echo '<pre>'; print_r($codeOpt); echo '</pre>';

            $history = new Search_Models_History();
            $history->saveRequest(
                date("Y-m-d H:i:s"),
                implode("###", $codeOptOriginal),
                'filters',
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
			$data555['searchtype'] = 'filters';
			$oilsearch->saveSearch($data555);
        } else {
            $this->view->paginator = $filter->getFilter($sectionName['fk_id']);
        }
        $this->view->section = $section->getSection();
        
        $tasks = new Core_Models_Tasks();
        $tasks->getTime(1);
        $this->view->task = $tasks->getTime(1);




    }


}