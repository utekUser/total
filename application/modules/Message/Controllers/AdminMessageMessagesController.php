<?php
class Message_Controllers_AdminMessageMessagesController extends Core_Controller_Action_Admin {
    /**
     * Редиректор - определен для полноты кода
     *
     * @var Zend_Controller_Action_Helper_Redirector
     */
    protected $_redirector = null;
    
    protected $_form = array(
        'Message_Form_MessageMessages'
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
        
        $array = array('user_id', 'title');
        $form = new Message_Form_MessageMessages();
        $form->setTitle($array);
        $this->view->titles = $form->getTitle();
        
        if ($request->isPost()) { // если был POST запрос
            $request = $request->getPost();
            $model = new Message_Models_MessageMessages();
            $model->listAction($request['type'], $request['submit_mult']);
            
            $this->_redirector->gotoActionUrl('/admin/');
        }
        
        $ttt = new Message_Models_MessageMessages();
        $this->view->add = $pageId = $this->_getParam('module');
        $this->view->paginator = $ttt->getAll();
    }
    
    /**
     * Добавление
     *
     */
    public function addAction() {
        $pageId = $this->_getParam('pageId');
        
        $request = $this->getRequest(); 
        
        $form = new Message_Form_MessageMessages();
        if ($request->isPost()) { 
            if ($form->isValid($request->getPost())) {
                $model = new Message_Models_MessageMessages();
                $model->save($form->getElements(), $pageId);
                $this->_redirector->gotoActionUrl('/admin/', $model->getInsertId());
            }
        }
        $this->view->elements = $form->getElements();
        $this->view->form = $form;
    }
    
    /**
     * Редактирование
     *
     */
    public function editAction() {
        $request = $this->getRequest(); 
        
        $pageId = $this->_getParam('pageId');
        $model = new Message_Models_MessageMessages();
        $rrr = $model->getRecord($pageId);

        $form = new Message_Form_MessageMessages();

        foreach ($form->getElements() as $value) {
            $nnn = $value->getName();
            $value->setValue($rrr->$nnn);
        }
        
        if ($request->isPost()) { 
            if ($form->isValid($request->getPost())) {
                $model = new Message_Models_MessageMessages();
                $model->save($form->getElements(), $pageId);
                $this->_redirector->gotoActionUrl('/admin/', $pageId);
            }
        }
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
        
        $model = new Message_Models_MessageMessages();
        $model->listAction($pageId, 'delete');
        $this->_redirector->gotoActionUrl('/admin/message/');
    }
    

}