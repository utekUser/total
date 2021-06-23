<?php
/* ВЫВЕСТ�? В Engine_Controller url и Layout как у Zend_Controller_action */
//class Texts_Controllers_AdminController extends Engine_Controller_Action_Admin {
class Core_Controllers_AdminController extends Core_Controller_Action_Admin {
    protected $_form = array(
        'Cms_Form_CmsUser'
    ); // Классы дял создания и/или обновления таблиц в БД
    /**
     * �?нициализация
     *
     */
    public function init() {
        if(isset($_GET['mode']) && $_GET['mode'] == 'logout') {
            $auth = Zend_Auth::getInstance();
            $auth->setStorage(new Engine_Auth_Storage());
            $auth->clearIdentity();
            
            $this->_redirect('/admin/'); 
//            $this->_redirect('/admin/'); 
        }
            
        $auth = Zend_Auth::getInstance();
        $auth->setStorage(new Engine_Auth_Storage());
        
        if ($auth->hasIdentity()) {
            Core_Controller_Action_User::setViewMain('welcome');
        }
//        Core_Controller_Action_User::setViewMain('welcome');
//        exit;    
    }
   
    /**
     * Главная, листинг
     *
     */
    public function indexAction() {
        $request = $this->getRequest(); // получение объекта запроса Engine_Controller_Request_Http
        
        if ($request->isPost()) { // если был POST запрос
            
            $username = $_POST['login'];
            $password = $_POST['password'];
            
            // Получение синглтон экземпляра Zend_Auth
            $auth = Zend_Auth::getInstance();
            $auth->setStorage(new Engine_Auth_Storage());
            
            // Установка адаптера
            $authAdapter = new Engine_AuthUserAdmin($username, $password);
            
            // Попытка аутентификации, сохранение результата
            $result = $auth->authenticate($authAdapter);

            if (!$result->isValid()) {
                $this->view->error = $result->getMessages();
            } else {
                $this->_redirect('/admin/');
            }
        }
//        $array = array('name', 'display');
//        $form = new Texts_Form_Texts();
//        $form->setTitle($array);
//        $this->view->titles = $form->getTitle();
//        
//        
//        
//        $ttt = new Texts_Models_Texts();
//        $this->view->rows = $ttt->getAll();
//        echo "<pre>";
//        print_r(new Texts_Models_DbTable_Texts());
//        echo "</pre>";

//        echo "<pre>";
//        print_r($ttt->getAll());
//        echo "</pre>";
//        exit;
//        $texts = new Texts_Models_Texts();
//        $this->view->entries = $texts->getAll();
    }
    
    public function restoreAction() {
//        if (Engine_Auth::getAuth()) {
//            $this->_redirect('/admin/');
//        }
    }
    
    /**
     * Добавление
     *
     */
    public function addAction() {
        $request = $this->getRequest(); // получение объекта запроса...
        $form = new Texts_Form_Texts();
        
        if ($request->isPost()) {
            echo "!!!!!!!!!!!!!!!!!";    
        }
        
        $this->view->elements = $form->getElements();
        echo "<pre>";
        print_r($_POST);
        echo "</pre>";
        return true;
        
//        echo "<pre>";
//        print_r($request);
//        echo "</pre>";
//        exit;
        
        
        
        
        
        $form = new Texts_Form_Texts();
        $this->view->elements = $form->getElements();
        
        ////////
        $request = $this->getRequest();
        $form    = new Application_Form_Guestbook();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $comment = new Application_Model_Guestbook($form->getValues());
                $mapper  = new Application_Model_GuestbookMapper();
                $mapper->save($comment);
                return $this->_helper->redirector('index');
            }
        }

        $this->view->form = $form;
        /////////
    }
    
    /**
     * �?зменение
     *
     */
    public function editAction() {
        $pageId = $this->_getParam('pageId');
        $model = new Texts_Models_Texts();
        $rrr = $model->getRecord($pageId);
//            echo "<pre>";
//            print_r($rrr);    
//            echo "</pre>";   
        $form = new Texts_Form_Texts();
//        $this->view->elements = $form->getElements();
        foreach ($form->getElements() as $value) {
            $nnn = $value->getName();
            $value->setValue($rrr->$nnn);
//            echo "<pre>";
//            print_r($value);    
//            echo "</pre>";    
        }
        $this->view->elements = $form->getElements();
//        exit;
//        for ($i=0; $i<count($this->fields);$i++) {
            // ��� ��� ���� ������ ��������������!
//            Engine_Vars::setRequest($this->fields[$i]->name, $row[$this->fields[$i]->name]);
//            echo $this->fields[$i]->name . ": " . $row[$this->fields[$i]->name] . "<br />";
//            $this->fields[$i]->value = $row[$this->fields[$i]->name];
//            $this->fields[$i]->exec();
//        }
        
//        echo "<pre>";
//        print_r($rrr);
//        echo "</pre>";
    }
    
    /**
     * Удаление
     *
     */
    public function deleteAction() {

    }
    
    public function logoutAction() {
        $auth = Zend_Auth::getInstance();
        $auth->setStorage(new Engine_Auth_Storage());
        echo "!!!"; exit;
        $auth->clearIdentity();
        
        $this->_redirect('/');
    }
}