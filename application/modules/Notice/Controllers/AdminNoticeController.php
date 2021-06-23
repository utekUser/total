<?php
class Notice_Controllers_AdminNoticeController extends Core_Controller_Action_Admin {
    
    public function indexAction() {
        $request = $this->getRequest();
        
        $array = array('name', 'posted');
        $form = new Notice_Form_Notice();
        $form->setTitle($array);
        $this->view->titles = $form->getTitle();
        
        if ($request->isPost() && $request->getPost('submit_mult') == 'delete') { // если был POST запрос
            foreach ($request->getPost('type') as $value) {
                $model = new Notice_Models_Notice();
                $model->listAction($value, 'delete');
                $modelConn = new Notice_Models_Connection();
                $modelConn->deleteNotice($value);
                $this->_redirector->gotoActionUrl('/admin/', $model->getInsertId());
            }
        }
        
        $ttt = new Notice_Models_Notice();
        $this->view->module = $this->_getParam('module');
        $this->view->add = $this->_getParam('module');
        
        $this->view->paginator = $ttt->getAll();
    }
    
    /**
     * Добавление
     *
     */
    public function addAction() {
        $request = $this->getRequest(); // получение объекта запроса Engine_Controller_Request_Http
        
        $form = new Notice_Form_Notice();
        if ($request->isPost()) { // если был POST запрос
            if ($form->isValid($request->getPost())) {
                $model = new Notice_Models_Notice();
                $elements = $form->getElements();
                $model->save($elements);
                
                $id = Engine_Application::getInsertId();
                
                $userModel = new User_Models_UserUser();
                $users = $userModel->getActiveUsers($elements['type']->getValue());
                
                $modelConn = new Notice_Models_Connection();
                foreach ($users as $user) {
                    $data = array(
                        'message_id' => $id,
                        'user_id' => $user['id'],
                        'view' => 0,
                        'viewed' => '0000-00-00 00:00:00',
                    );
                    $modelConn->getDbTable()->insert($data);
                }
                $this->_redirector->gotoActionUrl('/admin/', $model->getInsertId());
            }
        }
        
        $this->view->module = $this->_getParam('module');
        $this->view->elements = $form->getElements();
        $this->view->form = $form;
    }
    
    /**
     * Редактирование
     *
     */
    public function editAction() {
        $request = $this->getRequest(); // получение объекта запроса Engine_Controller_Request_Http
        
        $pageId = $this->_getParam('pageId');
        $model = new Notice_Models_Notice();
        $rrr = $model->getRecord($pageId);

        $form = new Notice_Form_Notice();
        foreach ($form->getElements() as $value) {
            $nnn = $value->getName();
            $value->setValue($rrr->$nnn);
        }
        
        if ($request->isPost()) { // если был POST запрос
            if ($form->isValid($request->getPost())) {
                $model = new Notice_Models_Notice();
                $model->save($form->getElements(), $pageId);
                
                $this->_redirector->gotoActionUrl('/admin/', $pageId);
            }
        }
        
        $this->view->module = $this->_getParam('module');
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
        
        $model = new Notice_Models_Notice();
        $model->listAction($pageId, 'delete');
        
        $this->_redirector->gotoActionUrl('/admin/notice/');
    }
}