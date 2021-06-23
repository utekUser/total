<?php
class Plug_Controllers_AdminPlugController extends Core_Controller_Action_Admin {

    protected $_redirector = null;
    
    protected $_form = array(
        'Plug_Form_Plug'
    ); 
    
    public function init() {
        $this->_redirector = $this->_helper->getHelper('Redirector');
    }
   

    public function indexAction() {
        $request = $this->getRequest();
        
        $array = array('name');
        $form = new Plug_Form_Plug();
        $form->setTitle($array);
        $this->view->titles = $form->getTitle();
        
        if ($request->isPost()) {
            $request = $request->getPost();
            $model = new Plug_Models_Plug();
            $model->listAction($request['type'], $request['submit_mult']);
            
            $this->_redirector->gotoActionUrl('/admin/');
        }
        
        $ttt = new Plug_Models_Plug();
        $this->view->add = $pageId = $this->_getParam('module');
        $this->view->paginator = $ttt->getAll();
		$this->view->itIsPlugs = 1;
    }
    
    /**
     * Добавление
     *
     */
//    public function addAction() {
//        echo "!!!!!!";exit;
//        $pageId = $this->_getParam('pageId');
//        
//        $request = $this->getRequest(); // получение объекта запроса Engine_Controller_Request_Http
//        
//        $form = new Plug_Form_Plug();
//        if ($request->isPost()) { // если был POST запрос
//            if ($form->isValid($request->getPost())) {
//                $model = new Plug_Models_Plug();
//                $model->save($form->getElements(), $pageId);
//
////                $picture1 = $form->picture1->receive($model->getInsertId());
////                $model->updateRecord('picture1', $picture1, $model->getInsertId());
//                
//                $this->_redirector->gotoActionUrl('/admin/', $model->getInsertId());
//            }
//        }
//
//        $this->view->elements = $form->getElements();
//        $this->view->form = $form;
//    }
    
    /**
     * Редактирование
     *
     */
    public function editAction() {
        $request = $this->getRequest();
        
        $pageId = $this->_getParam('pageId');
        $model = new Plug_Models_Plug();
        $rrr = $model->getRecord($pageId);

        $form = new Plug_Form_Plug();

        foreach ($form->getElements() as $value) {
            $nnn = $value->getName();
            $value->setValue($rrr->$nnn);
        }
        
        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                $model = new Plug_Models_Plug();
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
        $model = new Plug_Models_Plug();
        $model->listAction($pageId, 'delete');
        $this->_redirector->gotoActionUrl('/admin/plug/');
    }


}