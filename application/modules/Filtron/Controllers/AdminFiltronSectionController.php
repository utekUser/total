<?php
class Filtron_Controllers_AdminFiltronSectionController extends Core_Controller_Action_Admin {
    protected $_path = array(
        'filtron' => 'Статьи',
        'filtronsection' => 'Разделы статей'
    );
    
    public function indexAction() {
        $request = $this->getRequest();
        
        $array = array('name', 'display');
        $form = new Filtron_Form_Section();
        $form->setTitle($array);
        $this->view->titles = $form->getTitle();
        
        if ($request->isPost()) { // если был POST запрос
            $request = $request->getPost();
            $model = new Filtron_Models_Section();
            $model->listAction($request['type'], $request['submit_mult']);
        }
        
        $ttt = new Filtron_Models_Section();
//        $this->view->add  = $pageId = $this->_getParam('module');
        $this->view->paginator = $ttt->getAll();
    }
    
    public function addAction() {
        $pageId = $this->_getParam('pageId');
        
        $request = $this->getRequest(); // получение объекта запроса Engine_Controller_Request_Http
        
        $form = new Filtron_Form_Section();
        if ($request->isPost()) { // если был POST запрос
            if ($form->isValid($request->getPost())) {
                $model = new Filtron_Models_Section();
                $model->save($form->getElements(), $pageId);
                
//                $form->filename->receive();
                
                $this->_redirector->gotoActionUrl('/admin/', $model->getInsertId());
            }
        }

        $this->view->elements = $form->getElements();
        $this->view->form = $form;
    }
    
    public function editAction() {
        $request = $this->getRequest(); // получение объекта запроса Engine_Controller_Request_Http
        
        $pageId = $this->_getParam('pageId');
        $model = new Filtron_Models_Section();
        $rrr = $model->getRecord($pageId);

        $form = new Filtron_Form_Section();

        foreach ($form->getElements() as $value) {
            $nnn = $value->getName();
            $value->setValue($rrr->$nnn);
        }
        
        if ($request->isPost()) { // если был POST запрос
            if ($form->isValid($request->getPost())) {
                $model = new Filtron_Models_Section();
                $model->save($form->getElements(), $pageId);
                
                $this->_redirector->gotoActionUrl('/admin/', $pageId);
            }
        }
        $this->view->id = $pageId;
        $this->view->elements = $form->getElements();
        $this->view->form = $form;
    }
    
    public function deleteAction() {
        $pageId = $this->_getParam('pageId');
        
        $model = new Filtron_Models_Section();
        $model->listAction($pageId, 'delete');
        
        $this->_redirector->gotoActionUrl('/admin/texts/');
    }
}