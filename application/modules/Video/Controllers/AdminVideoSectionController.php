<?php
class Video_Controllers_AdminVideoSectionController extends Core_Controller_Action_Admin {
    protected $_path = array(
        'video' => 'Видео',
        'section' => 'Разделы видео'
    );
    
    public function indexAction() {
        $request = $this->getRequest();
        
        $array = array('name', 'display');
        $form = new Video_Form_VideoSection();
        $form->setTitle($array);
        $this->view->titles = $form->getTitle();
        
        if ($request->isPost()) { // если был POST запрос
            $request = $request->getPost();
            $model = new Video_Models_VideoSection();
            $model->listAction($request['type'], $request['submit_mult']);
        }
        
        $ttt = new Video_Models_VideoSection();
        $this->view->paginator = $ttt->getAll();
    }
    
    public function addAction() {
        $pageId = $this->_getParam('pageId');
        
        $request = $this->getRequest(); // получение объекта запроса Engine_Controller_Request_Http
        
        $form = new Video_Form_VideoSection();
        if ($request->isPost()) { // если был POST запрос
            if ($form->isValid($request->getPost())) {
                $model = new Video_Models_VideoSection();
                $model->save($form->getElements(), $pageId);
                
                $this->_redirector->gotoActionUrl('/admin/', $model->getInsertId());
            }
        }

        $this->view->elements = $form->getElements();
        $this->view->form = $form;
    }
    
    public function editAction() {
        $request = $this->getRequest(); // получение объекта запроса Engine_Controller_Request_Http
        
        $pageId = $this->_getParam('pageId');
        $model = new Video_Models_VideoSection();
        $rrr = $model->getRecord($pageId);

        $form = new Video_Form_VideoSection();

        foreach ($form->getElements() as $value) {
            $nnn = $value->getName();
            $value->setValue($rrr->$nnn);
        }
        
        if ($request->isPost()) { // если был POST запрос
            if ($form->isValid($request->getPost())) {
                $model = new Video_Models_VideoSection();
                $model->save($form->getElements(), $pageId);
                
                $this->_redirector->gotoActionUrl('/admin/', $model->getInsertId());
            }
        }
        $this->view->id = $pageId;
        $this->view->elements = $form->getElements();
        $this->view->form = $form;
    }
    
    public function deleteAction() {
        $pageId = $this->_getParam('pageId');
        
        $model = new Video_Models_VideoSection();
        $model->listAction($pageId, 'delete');
        
        $this->_redirector->gotoActionUrl('/admin/video/');
    }
}