<?php
class Shop_Controllers_AdminShopSettingsPricesController extends Core_Controller_Action_Admin {
    public function init() {
        $this->_redirector = $this->_helper->getHelper('Redirector');

    }
    
    public function indexAction() {
        $request = $this->getRequest(); 
        
        $array = array('name', 'code');
        $form = new Shop_Form_OrderPrices();
        $form->setTitle($array);
        $this->view->titles = $form->getTitle();
        
        if ($request->isPost()) { 
            $request = $request->getPost();
            $model = new Shop_Models_OrderPrices();
            $model->listAction($request['type'], $request['submit_mult']);
            
            $this->_redirector->gotoActionUrl('/admin/');
        }
        
        $ttt = new Shop_Models_OrderPrices();
        $this->view->add = $pageId = $this->_getParam('module');
        $this->view->paginator = $ttt->getAll();
    }
    
    public function addAction() {
        $pageId = $this->_getParam('pageId');
        
        $request = $this->getRequest(); 
        
        $form = new Shop_Form_OrderPrices();
        if ($request->isPost()) { 
            if ($form->isValid($request->getPost())) {
                $model = new Shop_Models_OrderPrices();
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
        $model = new Shop_Models_OrderPrices();
        $rrr = $model->getRecord($pageId);

        $form = new Shop_Form_OrderPrices();

        foreach ($form->getElements() as $value) {
            $nnn = $value->getName();
            $value->setValue($rrr->$nnn);
        }
        
        if ($request->isPost()) { 
            if ($form->isValid($request->getPost())) {
                $model = new Shop_Models_OrderPrices();
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
        $model = new Shop_Models_OrderPrices();
        $model->listAction($pageId, 'delete');
        $this->_redirector->gotoActionUrl('/admin/');
    }
    
}