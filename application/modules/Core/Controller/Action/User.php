<?php
class Core_Controller_Action_User extends Core_Controller_Action_Standard
{
    public function __construct()
    {
		
        $auth = Zend_Auth::getInstance()->setStorage(new Zend_Auth_Storage_Session('Zend_Auth_User'));
        // Если не авторизован: сессия
        if (!$auth->hasIdentity()) {
            if (isset($_COOKIE['nid']) && isset($_COOKIE['hhash']) && intval($_COOKIE['nid']) && $_COOKIE['hhash'] != '') {
                $registry = Engine_Api::getInstance();
                $db = $registry->getContainer()->db;
                $tablePrefix = $registry->getContainer()->tablePrefix;
    
                $sql = "
                    SELECT `id`, `login`, `password`, `salt`, `access`, `type`, `email`, `user_hash`
                    FROM `" . $tablePrefix . "user`
                    WHERE `id` = " . intval($_COOKIE['nid']) . "
                    LIMIT 1
                ";
                $result = $db->fetchRow($sql);
                if ($result) {
                    if ($result['user_hash'] == $_COOKIE['hhash']) {
                        $session = new Zend_Session_Namespace('Zend_Auth_User');
                        $session->login = $result['login'];
                        $session->userType = $result['type'];
                        $session->email = $result['email'];
                        $auth->getStorage()->write($result['id']);
                        
                        $db->update($tablePrefix . 'user', array('lastlogin_date' => date('Y-m-d H:i:s')), 'id = ' . $result['id']);
                        
                        //TODO reload cookie
                        $hash = md5(md5((string) rand(1000000, 9999999) . 'authash'));
                        $success = $db->update($tablePrefix . 'user', array('user_hash' => $hash), 'id = ' . $result['id']);
                        
                        if ($success) {
                            setcookie("nid", $result['id'], time() + 60 * 60 * 24 * 30, "/"); // 1 месяц
                            setcookie("hhash", $hash, time() + 60 * 60 * 24 * 30, "/");
                        }
                    } else {
                        setcookie("nid", "", time() - 3600 * 24 * 30 * 12, "/");
                        setcookie("hhash", "", time() - 3600 * 24 * 30 * 12, "/");
                        
                        $success = $db->update($tablePrefix . 'user', array('user_hash' => ''), 'id = ' . intval($_COOKIE['nid']));
                    }
                }
            }
        } 
        parent::__construct();    
    }
    
    public function render($action = null, $name = null, $noController = false)
    { 
		/*echo "<pre>";
        print_r($this->getStatParam("module"));//_parseUrl);
        echo "555</pre>";
        exit;
		
		$this->*/
		
        $layout = new Zend_Layout();
        $layout->setLayoutPath($this->_layoutPath);
        $layout->setViewSuffix('tpl');
        
        $this->view->setScriptPath($this->_moduleDirectory . '/views/scripts');
//echo $this->_moduleDirectory . '/views/scripts';
        $viewMain = self::getViewMain();
        if (!$viewMain) {
            if (file_exists($this->_moduleDirectory . '/views/scripts' . '/' . $this->_action . '.phtml')) {
                $layout->content = $this->view->render($this->_action . '.phtml');
            } else {
                $layout->content = $this->view->render($this->_action . '.tpl');
            }
        } else {
            $layout->content = $this->view->render($viewMain . '.tpl');    
        }
        
        $cmsModule = new Sitemap_Models_Sitemap();
        $this->view->topmenu = $cmsModule->getTopMenu();
        $this->view->leftmenu = $cmsModule->getLeftMenu();
        
        $this->view->setScriptPath(APPLICATION_PATH . '/themes/default');
        //$this->view->menuselect = $this->_getParam('action');
        $this->view->menuselect = $this->_getUrl('action');
        $layout->topmenu  = $this->view->render('topmenu.tpl');
        $layout->leftmenu = $this->view->render('leftmenu.tpl');
        
        $auth = Zend_Auth::getInstance()->setStorage(new Zend_Auth_Storage_Session('Zend_Auth_User'));
        if ($auth->hasIdentity()) {
            $userInfo = new User_Models_UserInfo();
            $layout->userInfo = $userInfo->getUserInfo($auth->getIdentity());
            
            $userModel = new User_Models_UserUser();
            $layout->isManager = $userModel->isManager($auth->getIdentity());
            
            $recipients = new Message_Models_MessageRecipients();
            $layout->unread = $recipients->getUnreadMessageCount($auth);
        }
        $layout->module = $this->_parseUrl['module'];
        //echo $layout->module; die;
        //Каталог фильтров
        if ($this->_parseUrl['module'] == 'filters') {
            $filters = new Filters_Models_FiltersSection();
            $layout->filterSection = $filters->getSection();
            $layout->sectionUrl = $this->_parseUrl['parseUrl'][0];
        }
        //Каталог масел
        if ($this->_parseUrl['module'] == 'oils') {
            $tree = array();
            $table = new Oils_Models_OilsSection();
            $select = $table->getSection();
            foreach ($select as $value){
                $tree[] = array(
                    'name' => $value->name,
                    'url'  => $value->url,
                    'id'   => $value->id,
                    'pid'  => $value->parent
                );
            }
            $sectionUrl = $this->_parseUrl['parseUrl'][0];
            $this->view->oilsTree = $table->getSectionTree($tree, 0, $sectionUrl);
            $layout->oilsMenu  = $this->view->render('oilsMenu.phtml');
//            $layout->sectionUrl = $this->_parseUrl['parseUrl'][0];
        }
        
        
        // Слайдер
        $models = new Slides_Models_Slides();
        $layout->slides = $models->getSlides();
        
        //Последние статьи
        $artModel = new Articles_Models_ArticlesArticle();
        $layout->articles = $artModel->getLastArticles(4);
        
        //Последние новости
        $newModel = new News_Models_News();
        $layout->news = $newModel->getLastNews(5);
        
        // Непрочитанные сообщения
        $viewer = Zend_Auth::getInstance()->setStorage(new Zend_Auth_Storage_Session('Zend_Auth_User')); // пользователь
        if ($viewer->hasIdentity()) {
            $recipients = new Message_Models_MessageRecipients();
            $layout->unread = $recipients->getUnreadMessageCount($viewer);
        }

        
        // Входящие
//        $viewer = Zend_Auth::getInstance()->setStorage(new Zend_Auth_Storage_Session('Zend_Auth_User')); // пользователь
//        $conversations = new Message_Models_MessageConversations();
//        $layout->inbox = $conversations->getInboxCountSelect($viewer);
        
        $layout->setLayout('index');
        
        echo $layout->render();    
    }
}