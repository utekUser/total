<?php
/**
 * Сообщения
 *
 */
class Message_controllers_IndexController extends Core_Controller_Action_User {
    public function init() {
        if (!$this->_getUrl('action')) {
            $this->_redirect('/messages/mailbox/');        
        }
        $this->pageId = $this->_getUrl('urlToInt', 1);
        $this->url = $this->_getUrl('url', 0);
        
        if ($this->pageId) {
            Core_Controller_Action_User::setViewMain('view');
            Core_Controller_Action_User::setDefaultParseUrlAction('view');
        }
        
        $auth = Zend_Auth::getInstance()->setStorage(new Zend_Auth_Storage_Session('Zend_Auth_User'));
        if (!$auth->hasIdentity()) {
            $this->_redirect('/account/login/');    
        }
        
        $this->view->user_id = $auth->getIdentity();
//        echo $auth->getIdentity();
        $userModel = new User_Models_UserUser();
        $this->view->isManager = $userModel->isManager($auth->getIdentity());		
    }

    public function indexAction() {
		$viewer = Zend_Auth::getInstance()->setStorage(new Zend_Auth_Storage_Session('Zend_Auth_User')); // пользователь
        $conversation = new Message_Models_MessageConversations();
        $this->view->paginator = $paginator = $conversation->getInboxPaginator($viewer);
        $paginator->setCurrentPageNumber($this->_getParam('page'));
        $recipients = new Message_Models_MessageRecipients();
        $this->view->unread = $recipients->getUnreadMessageCount($viewer);		
    }
    
    public function mailboxAction() {
        $request = $this->getRequest();        
        $this->view->form = $form = new Message_Form_MessageMessages();        
        if ($request->isPost()) {
            $recipients = new Message_Models_MessageRecipients();
            $recipients->delete($request->getPost('type'));            
            $this->_redirector->gotoUrl('/messages/mailbox/');
        }        
        $viewer = Zend_Auth::getInstance()->setStorage(new Zend_Auth_Storage_Session('Zend_Auth_User')); // пользователь
        $conversation = new Message_Models_MessageConversations();
		$paginator = $conversation->getInboxPaginator($viewer);
		$paginator->setCurrentPageNumber($this->_getParam('page')); 
        $recipients = new Message_Models_MessageRecipients();       
		$this->view->unread = $recipients->getUnreadMessageCount($viewer);
		$this->view->paginator = $paginator;     
    }
    
    public function inboxAction() {
        $request = $this->getRequest();
        
        $this->view->form = $form = new Message_Form_MessageMessages();
        
        if ($request->isPost()) {
            $recipients = new Message_Models_MessageRecipients();
            $recipients->delete($request->getPost('type'));
            
            $this->_redirector->gotoUrl('/messages/inbox/');
        }
        
        // Get navigation
//        $this->view->navigation = Engine_Api::_()->getApi('menus', 'core')
//        ->getNavigation('messages_main');
//        
//        $viewer = Engine_Api::_()->user()->getViewer();
//        $this->view->paginator = $paginator = Engine_Api::_()->getItemTable('messages_conversation')
//        ->getInboxPaginator($viewer);
//        $paginator->setCurrentPageNumber($this->_getParam('page'));
//        $this->view->unread = Engine_Api::_()->messages()->getUnreadMessageCount($viewer);
        
        $viewer = Zend_Auth::getInstance()->setStorage(new Zend_Auth_Storage_Session('Zend_Auth_User')); // пользователь
        $conversation = new Message_Models_MessageConversations();
//        if ($this->view->isManager) {
//            $this->view->paginator = $paginator = $conversation->getInboxPaginator($viewer);
//        }

//    $this->view->ssss = $conversation->getMessagesSelect($viewer);


        $this->view->paginator = $paginator = $conversation->getInboxPaginator($viewer);
//        echo '<pre>';
//        print_r($this->view->paginator);
//        echo '</pre>';
        
        $paginator->setCurrentPageNumber($this->_getParam('page'));
        
        $recipients = new Message_Models_MessageRecipients();
        
        $this->view->unread = $recipients->getUnreadMessageCount($viewer);
    }

    public function outboxAction() {
        $viewer = Zend_Auth::getInstance()->setStorage(new Zend_Auth_Storage_Session('Zend_Auth_User')); // пользователь
        $conversation = new Message_Models_MessageConversations();
        $this->view->paginator = $paginator = $conversation->getOutboxPaginator($viewer);
        
        $paginator->setCurrentPageNumber($this->_getParam('page'));
        
        $recipients = new Message_Models_MessageRecipients();
        
        $this->view->unread = $recipients->getUnreadMessageCount($viewer);
    }
    
    /**
     * Отправка сообщений
     *
     */
    public function sendAction() {
        $request = $this->getRequest();
        $this->view->form = $form = new Message_Form_MessageMessages();
        
        if ($request->isPost() && $form->isValid($request->getPost())) {
            $maxRecipients = 10;
            
            $viewer = Zend_Auth::getInstance()->setStorage(new Zend_Auth_Storage_Session('Zend_Auth_User'));
            $values = $form->getValues(); // значения формы
            
//            echo '<pre>';
//            print_r($values);
//            echo '</pre>';
//            exit;
            
            $userModel = new User_Models_UserUser();
            $userManager = $userModel->getManager();
            $values['toValues'] = $userManager['id']; // Кому отправляем. ID пользователя
            
            $sender = $userModel->getUser($viewer->getIdentity());
            
            $recipients = preg_split('/[,. ]+/', $values['toValues']);
            $recipients = array_unique($recipients);
            $recipients = array_slice($recipients, 0, $maxRecipients);
            
            // Отправка сообщений
            $conversation = new Message_Models_MessageConversations();
            $conversation->send(
                $viewer,
                $recipients,
                $values['title'],
                $values['body'],
                $attachment
            );
            
            $mailReplay = Engine_Cms::setupValue('mes');
            if ($mailReplay != '') {
                $mailSend = explode(',', $mailReplay);
                
                $patterns[0] = '/{posted}/';
                $patterns[1] = '/{author}/';
                $patterns[2] = '/{theme}/';
                $patterns[3] = '/{message}/';
                $patterns[4] = '/{ip}/';
                $patterns[5] = '/{site}/';
                    
                $replacements[0] = Engine_View_Helper_Date::getDateAndTime(date('Y-m-d H:i:s'));
                $replacements[1] = $sender['login'];
                $replacements[2] = $values['title'];
                $replacements[3] = $values['body'];
                $replacements[4] = $_SERVER['REMOTE_ADDR'];
                $replacements[5] = $_SERVER['HTTP_HOST'];

                $letter = file_get_contents(APPLICATION_PATH . '/public/templates/message.txt');
                $letter = preg_replace($patterns, $replacements, $letter);
                
                $subject = iconv('utf8', 'cp1251', $sender['login'] . ' прислал новое сообщение');
                $letter = iconv('utf8', 'cp1251', $letter);
                $fromName = iconv('utf8', 'cp1251', $replacements[1]);
                $toName = iconv('utf8', 'cp1251', 'Администратору');
                
                
                foreach ($mailSend as $key => $value) {
                    $emailPost = trim($value);
                    if ($emailPost != '') {
                    	$mail = new Zend_Mail('windows-1251');
                    	$mail->setBodyHtml($letter);
//                        	$mail->setFrom($replacements[2], $fromName);
                    	$mail->setFrom("message@total.tomauto.ru");
                    	$mail->addTo($emailPost, $toName);
                    	$mail->setSubject($subject);
                    	$mail->send();
                    }
                }
            }
            
            $this->_redirector->gotoUrl('/messages/success/');
        }
    }
    
    public function viewAction() {
        $id = $this->_getParam('id');
        $viewer = Zend_Auth::getInstance()->setStorage(new Zend_Auth_Storage_Session('Zend_Auth_User'));
        
//        if (!$this->view->isManager) {
//            $model = new User_Models_UserInfo();
//            $this->view->userInfo = $model->getUserInfo($this->view->user_id);
//        }
        
        
//      Get conversation info
        $conversation = new Message_Models_MessageConversations();
        $this->view->messages = $messages = $conversation->getMessages($viewer, $id);
        $conversation->setAsRead($viewer, $id);

        $this->view->conversation = $conversation = $conversation->getItem($id);

//       Process form
        $this->view->form = $form = new Message_Form_MessageMessages();
        $form->title->setRequired(false);
        if ($this->getRequest()->isPost() && $form->isValid($this->getRequest()->getPost())) {
            $messages = new Message_Models_DbTable_MessageMessages();
            $db = $messages->getAdapter();
            $db->beginTransaction();
            try {
                $values = $form->getValues();
                
                $values['conversation'] = (int) $id;
              
                $conversation = new Message_Models_MessageConversations();  
                    $conversation->reply(
                    $viewer,
                    $values['body'],
                    $attachment
                );
                
                $userModel = new User_Models_UserUser();
                if ($userModel->isManager($viewer->getIdentity())) { //менеджер отвечает пользователю
//                    $mailReplay = Engine_Cms::setupValue('mes');
                    $user = $userModel->getUser($viewer->getIdentity());
                    $mailReplay = $user['email'];
                    
                    if ($mailReplay != '') {
                        $mailSend = explode(',', $mailReplay);
                        
                        $patterns[0] = '/{message}/';
                        $patterns[1] = '/{link}/';
                        $patterns[2] = '/{site}/';
                        
                        $replacements[0] = $values['body'];
                        $replacements[1] = 'http://' . $_SERVER['HTTP_HOST'] . '/messages/';
                        $replacements[2] = $_SERVER['HTTP_HOST'];
                        
                        $letter = file_get_contents(APPLICATION_PATH . '/public/templates/message-manager.txt');
                        $letter = preg_replace($patterns, $replacements, $letter);
                        
                        $subject = iconv('utf8', 'cp1251', 'Ответ на ваше сообщение на сайте http://' . $replacements[2] . '/');
                        $letter = iconv('utf8', 'cp1251', $letter);
                        $fromName = iconv('utf8', 'cp1251', 'Администратор');
                        $toName = iconv('utf8', 'cp1251', $user['login']);
                        
                        foreach ($mailSend as $key => $value) {
                            $emailPost = trim($value);
                            if ($emailPost != '') {
                            	$mail = new Zend_Mail('windows-1251');
                            	$mail->setBodyHtml($letter);
                            	$mail->setFrom("message@total.tomauto.ru");
                            	$mail->addTo($emailPost, $toName);
                            	$mail->setSubject($subject);
                            	$mail->send();
                            }
                        }
                        
                    }
                    
                    
                } else {
                    $sender = $userModel->getUser($viewer->getIdentity());
                    $convModel = new Message_Models_MessageConversations();
                    $theme = $convModel->getCurrentConversation($values['conversation'] );
                    
                    $mailReplay = Engine_Cms::setupValue('mes');
                    if ($mailReplay != '') {
                        $mailSend = explode(',', $mailReplay);
                        
                        $patterns[0] = '/{posted}/';
                        $patterns[1] = '/{author}/';
                        $patterns[2] = '/{theme}/';
                        $patterns[3] = '/{message}/';
                        $patterns[4] = '/{ip}/';
                        $patterns[5] = '/{site}/';
                            
                        $replacements[0] = Engine_View_Helper_Date::getDateAndTime(date('Y-m-d H:i:s'));
                        $replacements[1] = $sender['login'];
                        $replacements[2] = $theme['title'];
                        $replacements[3] = $values['body'];
                        $replacements[4] = $_SERVER['REMOTE_ADDR'];
                        $replacements[5] = $_SERVER['HTTP_HOST'];
        
                        $letter = file_get_contents(APPLICATION_PATH . '/public/templates/message.txt');
                        $letter = preg_replace($patterns, $replacements, $letter);
                        
                        $subject = iconv('utf8', 'cp1251', $sender['login'] . ' прислал новое сообщение');
                        $letter = iconv('utf8', 'cp1251', $letter);
                        $fromName = iconv('utf8', 'cp1251', $replacements[1]);
                        $toName = iconv('utf8', 'cp1251', 'Администратору');
                        
                        
                        foreach ($mailSend as $key => $value) {
                            $emailPost = trim($value);
                            if ($emailPost != '') {
                            	$mail = new Zend_Mail('windows-1251');
                            	$mail->setBodyHtml($letter);
        //                        	$mail->setFrom($replacements[2], $fromName);
                            	$mail->setFrom("message@total.tomauto.ru");
                            	$mail->addTo($emailPost, $toName);
                            	$mail->setSubject($subject);
                            	$mail->send();
                            }
                        }
                    }
                    
                }
            
                $db->commit();
            } catch (Exception $e) {
                $db->rollBack();
                throw $e;
            }
            $this->_redirector->gotoUrl('/messages/view/' . $id);
        }

        $recipients = new Message_Models_MessageRecipients();
        $this->view->unread = $recipients->getUnreadMessageCount($viewer);
  }
    
    public function successAction() {
    
    }
    
    public function deleteAction() {
        $id = $this->_getParam('id');
        $recipients = new Message_Models_MessageRecipients();
        $recipients->delete($id);
        
        $this->_redirector->gotoUrl('/messages/inbox/');
    }
}