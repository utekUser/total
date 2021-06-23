<?php
class Report_Controllers_AdminReportController extends Core_Controller_Action_Admin {
    /**
     * Редиректор - определен для полноты кода
     *
     * @var Zend_Controller_Action_Helper_Redirector
     */
    protected $_redirector = null;
    
    protected $_form = array(
        'Report_Form_Report'
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

        $array = array('posted', 'author', 'email', 'ip');
        $form = new Report_Form_Report();
        $form->setTitle($array);
        $this->view->titles = $form->getTitle();

        if ($request->isPost()) { // если был POST запрос
            $request = $request->getPost();
            $model = new Report_Models_Report();
            $model->listAction($request['type'], $request['submit_mult']);
        }

        $ttt = new Report_Models_Report();
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
        
        $form = new Report_Form_Report();
        if ($request->isPost()) { // если был POST запрос
            if ($form->isValid($request->getPost())) {
                $model = new Report_Models_Report();
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
        $model = new Report_Models_Report();
        
        $rrr = $model->getRecord($pageId);

        $form = new Report_Form_Report();
        foreach ($form->getElements() as $value) {
            $nnn = $value->getName();
            $value->setValue($rrr->$nnn);
        }
        
        if ($request->isPost()) { // если был POST запрос
            if ($form->isValid($request->getPost())) {
                $model = new Report_Models_Report();
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
        
        $model = new Report_Models_Report();
        $model->listAction($pageId, 'delete');
        
        $this->_redirector->gotoActionUrl('/admin/sitemap/');
    }
}