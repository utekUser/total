<?php
class Services_Controllers_AdminServicesController extends Core_Controller_Action_Admin {
    
    public function indexAction() {
        $request = $this->getRequest(); // получение объекта запроса Engine_Controller_Request_Http
        
        $array = array('name');
        $form = new Services_Form_Services();
        $form->setTitle($array);
        $this->view->titles = $form->getTitle();
        if ($request->isPost()) { // если был POST запрос
            $request = $request->getPost();
            $model = new Services_Models_Services();
            $model->listAction($request['type'], $request['submit_mult']);
        }
        
        $ttt = new Services_Models_Services();
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
        
        $form = new Services_Form_Services();
        if ($request->isPost()) { // если был POST запрос
            if ($form->isValid($request->getPost())) {
                $model = new Services_Models_Services();
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
        $model = new Services_Models_Services();
        $rrr = $model->getRecord($pageId);

        $form = new Services_Form_Services();
        foreach ($form->getElements() as $value) {
            $nnn = $value->getName();
            $value->setValue($rrr->$nnn);
        }
        
        if ($request->isPost()) { // если был POST запрос
            if ($form->isValid($request->getPost())) {
                $model = new Services_Models_Services();
                $model->save($form->getElements(), $pageId);
                
                $this->_redirector->gotoActionUrl('/admin/', $pageId);
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
        
        $model = new Services_Models_Services();
        $model->listAction($pageId, 'delete');
        
        $this->_redirector->gotoActionUrl('/admin/services/');
        
    }
}