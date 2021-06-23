<?php
class Guestbook_Controllers_AdminGuestbookController extends Core_Controller_Action_Admin {
    /**
     * Редиректор - определен для полноты кода
     *
     * @var Zend_Controller_Action_Helper_Redirector
     */
    protected $_redirector = null;
    
    protected $_form = array(
        'Guestbook_Form_Guestbook'
    ); // Классы для создания и/или обновления таблиц в БД
    
    /**
     * Инициализация
     *
     */
    public function init() {
        $this->_redirector = $this->_helper->getHelper('Redirector');
    }
   
    /**
     * Главная, листинг
     *
     */
    public function indexAction() {
        $request = $this->getRequest(); // получение объекта запроса Engine_Controller_Request_Http

        $array = array('posted', 'posted_answer', 'author', 'email', 'ip', 'display');
        $form = new Guestbook_Form_Guestbook();
        $form->setTitle($array);
        $this->view->titles = $form->getTitle();

        if ($request->isPost()) { // если был POST запрос
            $request = $request->getPost();
            $model = new Guestbook_Models_Guestbook();
            $model->listAction($request['type'], $request['submit_mult']);
        }

        $ttt = new Guestbook_Models_Guestbook();
        $this->view->module = $this->_getParam('module');
        $this->view->add = $this->_getParam('module');
        $this->view->paginator = $ttt->getAll();
    }
    
    /**
     * Добавление
     *
     */
    public function addAction() {
        $pageId = $this->_getParam('pageId');
        
        $request = $this->getRequest(); // получение объекта запроса Engine_Controller_Request_Http
        
        $form = new Guestbook_Form_Guestbook();
        if ($request->isPost()) { // если был POST запрос
            if ($form->isValid($request->getPost())) {
                $model = new Guestbook_Models_Guestbook();
                $model->save($form->getElements(), $pageId);
                
                $this->_redirector->gotoActionUrl('/admin/', $model->getInsertId());
            }
        }
        
        $this->view->module = $this->_getParam('module');
        $this->view->elements = $form->getElements();
        $this->view->form = $form;
    }
    
    /**
     * Редактирование
     *
     */
    public function editAction() {
        $request = $this->getRequest(); // получение объекта запроса Engine_Controller_Request_Http
        
        $pageId = $this->_getParam('pageId');
        $model = new Guestbook_Models_Guestbook();
        
        $rrr = $model->getRecord($pageId);

        $form = new Guestbook_Form_Guestbook();
        foreach ($form->getElements() as $value) {
            $nnn = $value->getName();
            $value->setValue($rrr->$nnn);
        }
        
        if ($request->isPost()) { // если был POST запрос
            if ($form->isValid($request->getPost())) {
                $model = new Guestbook_Models_Guestbook();
                $model->save($form->getElements(), $pageId);
                
                $this->_redirector->gotoActionUrl('/admin/', $model->getInsertId());
            }
        }
        
        $this->view->module = $this->_getParam('module');
        $this->view->id = $pageId;
        $this->view->elements = $form->getElements();
        $this->view->form = $form;
    }
    
    /**
     * Удаление
     *
     */
    public function deleteAction() {
        $pageId = $this->_getParam('pageId');
        
        $model = new Guestbook_Models_Guestbook();
        $model->listAction($pageId, 'delete');
        
        $this->_redirector->gotoActionUrl('/admin/sitemap/');
    }
}