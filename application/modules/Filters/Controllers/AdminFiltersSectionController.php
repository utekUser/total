<?php
class Filters_Controllers_AdminFiltersSectionController extends Core_Controller_Action_Admin {
    protected $_path = array(
        'filters' => 'Фильтра',
        'section' => 'Типы фильтров'
    );
    
    public function indexAction() {
        $request = $this->getRequest();
        
        $array = array('name', 'display');
        $form = new Filters_Form_FiltersSection();
        $form->setTitle($array);
        $this->view->titles = $form->getTitle();
        
        if ($request->isPost()) { 
            $request = $request->getPost();
            $model = new Filters_Models_FiltersSection();
            $model->listAction($request['type'], $request['submit_mult']);
        }
        
        $ttt = new Filters_Models_FiltersSection();
        $this->view->paginator = $ttt->getAll();
    }
    
    public function addAction() {
        $pageId = $this->_getParam('pageId');
        
        $request = $this->getRequest(); 
        
        $form = new Filters_Form_FiltersSection();
        if ($request->isPost()) { 
            if ($form->isValid($request->getPost())) {
                $model = new Filters_Models_FiltersSection();
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
        $model = new Filters_Models_FiltersSection();
        $rrr = $model->getRecord($pageId);

        $form = new Filters_Form_FiltersSection();

        foreach ($form->getElements() as $value) {
            $nnn = $value->getName();
            $value->setValue($rrr->$nnn);
        }
        
        if ($request->isPost()) { 
            if ($form->isValid($request->getPost())) {
                $model = new Filters_Models_FiltersSection();
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
        
        $model = new Filters_Models_FiltersSection();
        $model->listAction($pageId, 'delete');
        
        $this->_redirector->gotoActionUrl('/admin/texts/');
    }
}