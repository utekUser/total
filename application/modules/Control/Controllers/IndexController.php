<?php

class Control_controllers_IndexController extends Core_Controller_Action_User {

    public function init() {
        $auth = Zend_Auth::getInstance()->setStorage(new Zend_Auth_Storage_Session('Zend_Auth_User'));

        if (!$auth->hasIdentity()) {
            $this->_redirect('/account/login/');
        }
        $this->view->id = $auth->getIdentity();
        $this->view->userType = Engine_AuthUser::getUserType();
        $this->view->userLogin = Engine_AuthUser::getLogin();
        $this->view->userEmail = Engine_AuthUser::getEmail();


        $this->orderId = $this->_getUrl('url', 1);
        $module = $this->_getUrl('url', 0);
        if ($this->_getUrl('url', 3) == "tobasket" || $this->_getUrl('url', 3) == "delete") {
            $actionOH = $this->_getUrl('url', 3);
            $shopSaveOrder = new Basket_Models_ShopSavedorder();
            if($actionOH == "tobasket") {
                $shopSaveOrder->putToTheBasket($this->_getUrl('url', 2));
            } else {
                $shopSaveOrder->deleteForewer($this->_getUrl('url', 2));
            }
            echo $this->basketaction;
            $this->_redirector->gotoUrl('/control/history/');
        } elseif (strlen($this->_getUrl('url', 2))) {
            $this->sessId = $this->_getUrl('url', 2);
            Core_Controller_Action_User::setViewMain('history-savedorder');
            Core_Controller_Action_User::setDefaultParseUrlAction('savedorder');
        } elseif ($this->orderId == 'clear' && $module == 'history') {
//            Core_Controller_Action_User::setViewMain('history-view');
            Core_Controller_Action_User::setDefaultParseUrlAction('clear');
        } elseif (intval($this->orderId) && $module == 'history') {
            Core_Controller_Action_User::setViewMain('history-view');
            Core_Controller_Action_User::setDefaultParseUrlAction('view');
        } elseif (intval($this->orderId) && $module == 'notice') {
            Core_Controller_Action_User::setViewMain('notice-view');
            Core_Controller_Action_User::setDefaultParseUrlAction('noticeview');
        }
        $userModel = new User_Models_UserUser();
        $this->view->isManager = $userModel->isManager($auth->getIdentity());
    }

    public function indexAction() {
		$shopSaveOrder = new Basket_Models_ShopSavedorder();
		$this->view->isOrderMessageShow = $shopSaveOrder->putToTheBasketIfExist();
        /*
          $model = new Report_Models_Report();
          $form = new Report_Form_Report();
          $request = $this->getRequest();
          if ($request->isPost()) {
          if ($form->isValid($request->getPost())) {
          $model->saveNew($form->getElements());

          $elements = $form->getElements();

          $mailReplay = Engine_Cms::setupValue('mes');
          if ($mailReplay != ''){
          $mailSend = explode(',', $mailReplay);

          //                    $patterns[0] = '/{site}/';
          //                    $patterns[1] = '/{id}/';
          $patterns[0] = '/{posted}/';
          $patterns[1] = '/{author}/';
          $patterns[2] = '/{mail}/';
          $patterns[3] = '/{message}/';
          $patterns[4] = '/{ip}/';
          $patterns[5] = '/{site}/';


          //                    $replacements[0] = $_SERVER['HTTP_HOST'];
          //                    $replacements[1] = $id;
          $replacements[0] = Engine_View_Helper_Date::getDateAndTime(date('Y-m-d H:i:s'));
          $replacements[1] = htmlspecialchars($elements['author']->getValue());
          $replacements[2] = htmlspecialchars($elements['email']->getValue());
          $replacements[3] = htmlspecialchars($elements['message']->getValue());
          $replacements[4] = $_SERVER['REMOTE_ADDR'];
          $replacements[5] = $_SERVER['HTTP_HOST'];
          //                    $replacements[7] = 'guestbook';

          $letter = file_get_contents(APPLICATION_PATH . '/public/templates/message.txt');

          $letter = preg_replace($patterns, $replacements, $letter);

          $subject = iconv('utf8', 'cp1251', 'Сообщение от пользователя на сайте http://' . $replacements[5] . '/');
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
          $this->_redirector->gotoUrl('/control/?success=1');
          }
          }
          if ($request->getQuery('success') == 1) $this->view->success = 1; else $this->view->success = 0;
          $this->view->elements = $form->getElements();
         */
    }

    public function profileAction() {
        $modelUser = new User_Models_UserUser();
        $modelInfo = new User_Models_UserInfo();
        $this->view->user = $modelUser->getUser($this->view->id);
        $this->view->info = $modelInfo->getUserInfo($this->view->id);
        $request = $this->getRequest();
        $formInfo = new User_Form_UserInfo();
        $formUser = new User_Form_UserUser();
        if (!$this->view->user['type']) {
            $formInfo->fact_address->setRequired(false);
            $formInfo->ur_address->setRequired(false);
            $formInfo->inn->setRequired(false);
            $formInfo->title->setRequired(false);
        }
        $formUser->addSubForms(array(
            'information' => $formInfo
        ));
        $this->view->formUser = $modelUser;
        $this->view->formInfo = $modelInfo;

        $error = array();
        if ($request->isPost()) {
            if ($request->getPost('password') || $request->getPost('verifypassword')) {
                $password = $request->getPost('password');
                $verify = $request->getPost('verifypassword');
                $salt = Engine_Filter_Encrypt_Password::getSalt();
                Engine_Filter_Encrypt_Password::setUser($request->getPost('login'));
                if ($password != $verify) {
                    $error['password'] = 'Пароли не совпадают.';
                }
                if (empty($error)) {
                    $salt = Engine_Filter_Encrypt_Password::getSalt();
                    Engine_Filter_Encrypt_Password::setUser($request->getPost('login'));
                    $encrypt = new Engine_Filter_Encrypt_Password($options = '');
                    $newpass = $encrypt->filter($password);
                    $modelUser->changePassword($this->view->id, $newpass, $salt);
                    $this->_redirect('/control/profile/?pass=success');
                }
            } else { // Change information about user
                if ($formInfo->isValid($request->getPost())) {
                    $modelInfo->updateProfile($this->view->id, $formInfo->getElements(), $this->view->userType);
                    $this->_redirect('/control/profile/?change=success');
                } else {
                    
                }
            }
        } else { // TODO если не было отправки - надо присвоить
            $formInfo->setDefaults($this->view->info->toArray());
        }
        if ($request->getQuery('pass') == 'success') {
            $this->view->success = 'Пароль успешно изменен.';
        } elseif ($request->getQuery('change') == 'success') {
            $this->view->success = 'Данные успешно изменены.';
        }
        $this->view->error = array_merge($error, $formInfo->getMessages());
        $this->view->userA = $formUser;
        $this->view->infoA = $formInfo;
        $this->view->elementsUser = $formUser->getElements();
        $this->view->elementsInfo = $formInfo->getElements();
    }

    public function messagesAction() {
        
    }

    public function historyAction() {
        $userLogin = Engine_AuthUser::getLogin();
        $orderModel = new Shop_Models_OrderOrder();
        $this->view->orders = $orderModel->getUserOrders($userLogin);
        $shopSaveOrder = new Basket_Models_ShopSavedorder();
        $this->view->savedorders = $shopSaveOrder->getUserSaveOrders();
        $status = array();
        $table = new Shop_Models_OrderStatus();
        $select = $table->getStatus();
        foreach ($select as $value) {
            $status[$value->id]['name'] = $value->name;
            $status[$value->id]['code'] = $value->code;
        }
        $this->view->statusList = $status;
    }

    public function clearAction() {
        $userLogin = Engine_AuthUser::getLogin();
        $orderModel = new Shop_Models_OrderOrder();
        $orderModel->clearHistory($userLogin);
        $this->_redirector->gotoUrl('/control/history/');
    }

    public function viewAction() {
        $orderId = $this->orderId;
        $userLogin = Engine_AuthUser::getLogin();
        $orderModel = new Shop_Models_OrderOrder();
        $this->view->orderInfo = $orderModel->getCurrentOrder($userLogin, $orderId);

        $status = array();
        $table = new Shop_Models_OrderStatus();
        $select = $table->getStatus();
        foreach ($select as $value) {
            $status[$value->id]['name'] = $value->name;
            $status[$value->id]['code'] = $value->code;
        }
        $this->view->statusList = $status;

        $composition = new Shop_Models_OrderComposition();
        $this->view->items = $composition->getOrderComposition($orderId);
        $totalSum = 0;
        foreach ($this->view->items as $item) {
            $totalSum += $item['price'] * $item['amount'];
        }
        $this->view->totalSum = $totalSum;

        $userModel = new User_Models_UserUser();
        $this->view->user = $userModel->getUserByLogin($userLogin);
        $userInfo = new User_Models_UserInfo();
        $this->view->userInfo = $userInfo->getUserInfo($this->view->id);
    }

    public function savedorderAction() {
        $shopSaveOrder = new Basket_Models_ShopSavedorder();
        $this->view->orderinfo = $shopSaveOrder->getUserOrderBySessionId($this->sessId);
        $this->view->sessId = $this->sessId;
    }

    public function noticeAction() {
        $model = new Notice_Models_Notice();
        $this->view->messages = $messages = $model->getUserNotices($this->view->id);
    }

    public function noticeviewAction() {
        $notice_id = intval($this->_getUrl('url', 1));
        $user_id = $this->view->id;

        $model = new Notice_Models_Notice();
        $modelConn = new Notice_Models_Connection();
        $this->view->notice = $notice = $model->getNotice($notice_id);

        if (!$modelConn->checkViewed($notice_id, $user_id)) {
            $modelConn->setViewed($notice_id, $user_id);
        }
    }

}
