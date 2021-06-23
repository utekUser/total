<?php
class Efeles_Controllers_AdminEfelesSectionController extends Core_Controller_Action_Admin {
    protected $_path = array(
        'efele' => 'Статьи',
        'efelesection' => 'Разделы статей'
    );
    
    public function indexAction() {
        $request = $this->getRequest();
        
        $array = array('name', 'display');
        $form = new Efeles_Form_EfeleSection();
        $form->setTitle($array);
        $this->view->titles = $form->getTitle();
        
        if ($request->isPost()) { // если был POST запрос
            $request = $request->getPost();
            $model = new Efeles_Models_EfeleSection();
            $model->listAction($request['type'], $request['submit_mult']);
        }
        
        $ttt = new Efeles_Models_EfeleSection();
//        $this->view->add  = $pageId = $this->_getParam('module');
        $this->view->paginator = $ttt->getAll();
    }
    
    public function addAction() {
        $pageId = $this->_getParam('pageId');
        
        $request = $this->getRequest(); // получение объекта запроса Engine_Controller_Request_Http
        
        $form = new Efeles_Form_EfeleSection();
        if ($request->isPost()) { // если был POST запрос
            if ($form->isValid($request->getPost())) {
                $model = new Efeles_Models_EfeleSection();
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
        $model = new Efeles_Models_EfeleSection();
        $rrr = $model->getRecord($pageId);

        $form = new Efeles_Form_EfeleSection();

        foreach ($form->getElements() as $value) {
            $nnn = $value->getName();
            $value->setValue($rrr->$nnn);
        }
        
        if ($request->isPost()) { // если был POST запрос
            if ($form->isValid($request->getPost())) {
                $model = new Efeles_Models_EfeleSection();
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
        
        $model = new Efeles_Models_EfeleSection();
        $model->listAction($pageId, 'delete');
        
        $this->_redirector->gotoActionUrl('/admin/texts/');
    }
}