<?php
class Gallery_Controllers_AdminGallerySectionController extends Core_Controller_Action_Admin {
    protected $_path = array(
        'album' => 'Альбомы',
        'section' => 'Разделы'
    );
    
    public function indexAction() {
        $request = $this->getRequest();
        
        $array = array('name', 'display');
        $form = new Gallery_Form_GallerySection();
        $form->setTitle($array);
        $this->view->titles = $form->getTitle();
        
        if ($request->isPost()) { // если был POST запрос
            $request = $request->getPost();
            $model = new Gallery_Models_GallerySection();
            $model->listAction($request['type'], $request['submit_mult']);
        }
        
        $ttt = new Gallery_Models_GallerySection();
        $this->view->paginator = $ttt->getAll();
    }
    
    public function addAction() {
        $pageId = $this->_getParam('pageId');
        
        $request = $this->getRequest(); // получение объекта запроса Engine_Controller_Request_Http
        
        $form = new Gallery_Form_GallerySection();
        if ($request->isPost()) { // если был POST запрос
            if ($form->isValid($request->getPost())) {
                $model = new Gallery_Models_GallerySection();
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
        $model = new Gallery_Models_GallerySection();
        $rrr = $model->getRecord($pageId);

        $form = new Gallery_Form_GallerySection();

        foreach ($form->getElements() as $value) {
            $nnn = $value->getName();
            $value->setValue($rrr->$nnn);
        }
        
        if ($request->isPost()) { // если был POST запрос
            if ($form->isValid($request->getPost())) {
                $model = new Gallery_Models_GallerySection();
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
        
        $model = new Gallery_Models_GallerySection();
        $model->listAction($pageId, 'delete');
        
        $this->_redirector->gotoActionUrl('/admin/Gallery/');
    }
}