<?php
class Message_Controllers_AdminMessageConversationsController extends Core_Controller_Action_Admin {
    protected $_path = array(
        'message' => 'Сообщения',
        'conversations' => 'conversations'
    );
    
    public function indexAction() {
        $request = $this->getRequest();
        
        $array = array('title', 'modified');
        $form = new Message_Form_MessageConversations();
        $form->setTitle($array);
        $this->view->titles = $form->getTitle();
        
        if ($request->isPost()) { 
            $request = $request->getPost();
            $model = new Message_Models_MessageConversations();
            $model->listAction($request['type'], $request['submit_mult']);
        }
        $ttt = new Message_Models_MessageConversations();
        $this->view->paginator = $ttt->getAll();
    }
    
    public function addAction() {
        $pageId = $this->_getParam('pageId');
        
        $request = $this->getRequest(); 
        
        $form = new Message_Form_MessageConversations();
        if ($request->isPost()) { 
            if ($form->isValid($request->getPost())) {
                $model = new Message_Models_MessageConversations();
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
        $model = new Message_Models_MessageConversations();
        $rrr = $model->getRecord($pageId);

        $form = new Message_Form_MessageConversations();

        foreach ($form->getElements() as $value) {
            $nnn = $value->getName();
            $value->setValue($rrr->$nnn);
        }
        
        if ($request->isPost()) { 
            if ($form->isValid($request->getPost())) {
                $model = new Message_Models_MessageConversations();
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
        
        $model = new Message_Models_MessageConversations();
        $model->listAction($pageId, 'delete');
        
        $this->_redirector->gotoActionUrl('/admin/message/');
    }
}