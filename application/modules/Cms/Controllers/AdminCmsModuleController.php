<?php
class Cms_Controllers_AdminCmsModuleController extends Core_Controller_Action_Admin {
    public function indexAction() {
        $request = $this->getRequest(); // получение объекта запроса Engine_Controller_Request_Http
        
        $array = array('name', 'path', 'display');
        $form = new Cms_Form_CmsModule();
        $form->setTitle($array);
        $this->view->titles = $form->getTitle();
        if ($request->isPost()) { // если был POST запрос
            $request = $request->getPost();
            $model = new Cms_Models_CmsModule();
            $model->listAction($request['type'], $request['submit_mult']);
        }
        
        $ttt = new Cms_Models_CmsModule();
        
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
        
        $form = new Cms_Form_CmsModule();
        if ($request->isPost()) { // если был POST запрос
            if ($form->isValid($request->getPost())) {
                $model = new Cms_Models_CmsModule();
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
        $model = new Cms_Models_CmsModule();
        $rrr = $model->getRecord($pageId);

        $form = new Cms_Form_CmsModule();
        foreach ($form->getElements() as $value) {
            $nnn = $value->getName();
            $value->setValue($rrr->$nnn);
        }
        
        if ($request->isPost()) { // если был POST запрос
            if ($form->isValid($request->getPost())) {
                $model = new Cms_Models_CmsModule();
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
        
        $model = new Cms_Models_CmsModule();
        $model->listAction($pageId, 'delete');
        
        $this->_redirector->gotoActionUrl('/admin/sitemap/');
    }
}