<?php
class Message_Controllers_AdminMessageRecipientsController extends Core_Controller_Action_Admin {
    protected $_path = array(
        'message' => 'Сообщения',
        'recipients' => 'Recipients'
    );
    
    public function indexAction() {
        $request = $this->getRequest();
        
        $array = array('user_id', 'conversation_id');
        $form = new Message_Form_MessageRecipients();
        $form->setTitle($array);
        $this->view->titles = $form->getTitle();
        
        if ($request->isPost()) { 
            $request = $request->getPost();
            $model = new Message_Models_MessageRecipients();
            $model->listAction($request['type'], $request['submit_mult']);
        }
        $ttt = new Message_Models_MessageRecipients();
        $this->view->paginator = $ttt->getAll();
    }
    
    public function addAction() {
        $pageId = $this->_getParam('pageId');
        
        $request = $this->getRequest(); 
        
        $form = new Message_Form_MessageRecipients();
        if ($request->isPost()) { 
            if ($form->isValid($request->getPost())) {
                $model = new Message_Models_MessageRecipients();
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
        $model = new Message_Models_MessageRecipients();
        $rrr = $model->getRecord($pageId);

        $form = new Message_Form_MessageRecipients();

        foreach ($form->getElements() as $value) {
            $nnn = $value->getName();
            $value->setValue($rrr->$nnn);
        }
        
        if ($request->isPost()) { 
            if ($form->isValid($request->getPost())) {
                $model = new Message_Models_MessageRecipients();
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
        
        $model = new Message_Models_MessageRecipients();
        $model->listAction($pageId, 'delete');
        
        $this->_redirector->gotoActionUrl('/admin/message/');
    }
}