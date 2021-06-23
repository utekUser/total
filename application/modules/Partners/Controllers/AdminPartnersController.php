<?php
class Partners_Controllers_AdminPartnersController extends Core_Controller_Action_Admin {
    
    public function indexAction() {
        $request = $this->getRequest(); // получение объекта запроса Engine_Controller_Request_Http
        
        $array = array('name');
        $form = new Partners_Form_Partners();
        $form->setTitle($array);
        $this->view->titles = $form->getTitle();
        if ($request->isPost()) { // если был POST запрос
            $request = $request->getPost();
            $model = new Partners_Models_Partners();
            $model->listAction($request['type'], $request['submit_mult']);
        }
        
        $ttt = new Partners_Models_Partners();
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
        
        $form = new Partners_Form_Partners();
        if ($request->isPost()) { // если был POST запрос
            if ($form->isValid($request->getPost())) {
                $model = new Partners_Models_Partners();
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
        $model = new Partners_Models_Partners();
        $rrr = $model->getRecord($pageId);

        $form = new Partners_Form_Partners();
        foreach ($form->getElements() as $value) {
            $nnn = $value->getName();
            $value->setValue($rrr->$nnn);
        }
        
        if ($request->isPost()) { // если был POST запрос
            if ($form->isValid($request->getPost())) {
                $model = new Partners_Models_Partners();
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
        
        $model = new Partners_Models_Partners();
        $model->listAction($pageId, 'delete');
        
        $this->_redirector->gotoActionUrl('/admin/News/');
    }
}