<?php
class Cms_Controllers_AdminCmsUserController extends Core_Controller_Action_Admin {
    
    /**
     * Редиректор - определен для полноты кода
     *
     * @var Zend_Controller_Action_Helper_Redirector
     */
    protected $_redirector = null;
    
    protected $_form = array(
        'Cms_Form_CmsUser'
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
        
        $array = array('name', 'login');
        $form = new Cms_Form_CmsUser();
        $form->setTitle($array);
        $this->view->titles = $form->getTitle();
        
        if ($request->isPost()) { // если был POST запрос
            $request = $request->getPost();
            $model = new Cms_Models_CmsUser();
            $model->listAction($request['type'], $request['submit_mult']);
        }
        
        $ttt = new Cms_Models_CmsUser();
        $this->view->module = $this->_getParam('module');
        $this->view->add = $this->_getParam('module');
        $this->view->paginator = $ttt->getAll();
    }
    
    /**
     * Добавление
     *
     */
    public function addAction() {
		$request = $this->getRequest(); // получение объекта запроса Engine_Controller_Request_Http		
        $pageId = $this->_getParam('pageId'); 
        $form = new Cms_Form_CmsUser();		
        if ($request->isPost()) { // если был POST запрос
			$request1 = $request->getPost();
			//echo "<pre>"; print_r($request1); die;
            if ($form->isValid($request1)) {
                $model = new Cms_Models_CmsUser();				
                $model->save($form->getElements(), $pageId);                
//                $form->filename->receive();                
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
        $model = new Cms_Models_CmsUser();
        $rrr = $model->getRecord($pageId);

        $form = new Cms_Form_CmsUser();

        foreach ($form->getElements() as $value) {
            $nnn = $value->getName();
            $value->setValue($rrr->$nnn);
        }
        
        if ($request->isPost()) { // если был POST запрос
            //if ($form->isValid($request->getPost())) {
                $model = new Cms_Models_CmsUser();
                $model->save($form->getElements(), $pageId);
                
                $this->_redirector->gotoActionUrl('/admin/', $model->getInsertId());
            //}
        }
        $this->view->id = $pageId;
        $this->view->elements = $form->getElements();
        
        $this->view->module = $this->_getParam('module');
        $this->view->form = $form;
    }
    
    /**
     * Удаление
     *
     */
    public function deleteAction() {
        $pageId = $this->_getParam('pageId');
        
        $model = new Cms_Models_CmsUser();
        $model->listAction($pageId, 'delete');
        
        $this->_redirector->gotoActionUrl('/admin/cms/user/');
        
    }
}