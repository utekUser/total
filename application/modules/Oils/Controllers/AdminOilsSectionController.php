<?php
class Oils_Controllers_AdminOilsSectionController extends Core_Controller_Action_Admin {
    protected $_path = array(
        'Oils' => 'Статьи',
        'section' => 'Разделы статей'
    );
    
    public function indexAction() {
        $request = $this->getRequest();
        
        $array = array('name');
        $form = new Oils_Form_OilsSection();
        $form->setTitle($array);
        $this->view->titles = $form->getTitle();
        
        if ($request->isPost()) { // если был POST запрос
            $request = $request->getPost();
            $model = new Oils_Models_OilsSection();
            $model->listAction($request['type'], $request['submit_mult']);
        }
        
        $ttt = new Oils_Models_OilsSection();
         
        if ($request->getQuery('section') && intval($request->getQuery('section'))) {
            
            $this->view->paginator = $ttt->getSectionPaginator($request->getQuery('section'));
        } else {
            $this->view->paginator = $ttt->getSectionPaginator();
        }
        
        
    }
    
    public function addAction() {
        $pageId = $this->_getParam('pageId');
        
        $request = $this->getRequest(); 
        
        $form = new Oils_Form_OilsSection();
        if ($request->isPost()) { 
            if ($form->isValid($request->getPost())) {
                $model = new Oils_Models_OilsSection();
                $model->save($form->getElements(), $pageId);
                $this->_redirector->gotoActionUrl('/admin/', $model->getInsertId());
            }
        }

        $this->view->elements = $form->getElements();
        $this->view->form = $form;
    }
    
    public function editAction() {
        $request = $this->getRequest(); 
        
        $pageId = $this->_getParam('pageId');
        $model = new Oils_Models_OilsSection();
        $rrr = $model->getRecord($pageId);

        $form = new Oils_Form_OilsSection();

        foreach ($form->getElements() as $value) {
            $nnn = $value->getName();
            $value->setValue($rrr->$nnn);
        }
        
        if ($request->isPost()) { 
            if ($form->isValid($request->getPost())) {
                $model = new Oils_Models_OilsSection();
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
        
        $model = new Oils_Models_OilsSection();
        $model->listAction($pageId, 'delete');
        
        $this->_redirector->gotoActionUrl('/admin/texts/');
    }
}