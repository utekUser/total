<?php
class User_Controllers_AdminUserController extends Core_Controller_Action_Admin
{
    public function indexAction()
    {
        $request = $this->getRequest(); // получение объекта запроса Engine_Controller_Request_Http
        if ($request->getQuery('forbid') && intval($request->getQuery('forbid'))) {
            $id = $request->getQuery('forbid');
            $userModel = new User_Models_UserUser();
            $userModel->deleteUserAccess($id);
            $this->_redirect('/admin/user/');
        }
        if ($request->getQuery('access') && intval($request->getQuery('access'))) {
            $id = $request->getQuery('access');
            $userModel = new User_Models_UserUser();
            $userModel->setUserAccess($id);
                        
			$uInfo = $userModel->getUser($id); 
			//echo '<pre>' . $uInfo[login] . " --- " . $uInfo[email]; die; exit;
			$mail = new Zend_Mail('windows-1251');
			$messag = "<p>Здравствуйте, " . $uInfo[login] . "</p>\n\r";
			$messag .= "<p>Ваш профиль на сайте <a href='http://total.tomsk.ru' target='_blank'>total.tomsk.ru</a> активирован." . "</p>\n\r";
			$mail->setBodyHtml(iconv('utf8', 'cp1251', $messag));
            $mail->setFrom("no-reply@total.tomsk.ru");
            $mail->addTo($uInfo[email] /*"turkov.dm@yandex.ru"*/, iconv('utf8', 'cp1251', $uInfo[login]));
            $mail->setSubject(iconv('utf8', 'cp1251', "Ваш профиль активирован."));
            $mail->send();
            $this->_redirect('/admin/user/');
        }
        $form = new User_Form_UserUser();
        $form->addElement(
            'Text',
            'name',
            array(
                'label' => 'Контактное лицо'
            )
        );
        $form->addElement(
            'Text',
            'title',
            array(
                'label' => 'Наименование организации'
            )
        );
        $form->setTitle(array(
            'login',
            'type',
            'title',
            'name',
            'email',
            'creation_date',
            'lastlogin_date',
            'access',
            'manager_id'
        ));
        $this->view->titles = $form->getTitle();
		/*$page = $http->getParam('page');
        $account = $http->getParam('account');	*/	
        if ($request->isPost()) { // если был POST запрос
            $request = $request->getPost();
            $model = new User_Models_UserUser();
            $model->listAction($request['type'], $request['submit_mult']);	
			//echo $request['account'] . "fff"; die;
        }		
        $ttt = new User_Models_UserUser();
        $this->view->userForm = $form;
        $this->view->managerForm = new Shop_Form_OrderManager();;
        $this->view->module = $this->_getParam('module');
        $this->view->add = $this->_getParam('module');
        $this->view->paginator = $ttt->getAll();
    }
    
    public function editAction()
    {
        // TODO: $md5Password = md5(md5(strtolower(trim($this->_username)) . trim($this->_password)) . $result['salt'] . 'user'); 		
        $request = $this->getRequest();
        $pageId = $user_id = $this->_getParam('pageId'); 
        /*echo "<pre>ooo";
		print_r($_POST); die;*/
        $model = new User_Models_UserUser(); 
        $rrr = $model->getRecord($pageId); 
        $form = new User_Form_UserUser(); 
        foreach ($form->getElements() as $value) {
            $nnn = $value->getName();
            $value->setValue($rrr->$nnn);
        }
        $modelInfo = new User_Models_UserInfo();
        $ooo = $modelInfo->getUserInfo($pageId);
        $formInfo = new User_Form_UserInfo();
        $formInfo->removeElement('vip');
        foreach ($formInfo->getElements() as $value) {
            $nnn = $value->getName();
            $value->setValue($ooo->$nnn);
        }
        /*$form->email->addValidator(new Zend_Validate_Db_NoRecordExists(
            array(
                'table' => 'total_user',
                'field' => 'email',
                'exclude' => array(
                    'field' => 'id',
                    'value' => $user_id
                )
            )
        ));*/		
		$uLogin = $form->login->getValue();
        $form->removeElement('password');
        $form->removeElement('verifypassword');
        $form->removeElement('salt');
        $form->removeElement('creation_date');
        $form->removeElement('login');
        $form->removeElement('manager');
        $form->removeElement('user_hash');
        if ($request->isPost()) {			
            if ($form->isValid($request->getPost())) {
                $form->type->setValue($rrr->type);				
                $model->save($form->getElements(), $pageId);
                $formInfo->removeElement('user_id');
                $formInfo->populate($request->getPost());
                $modelInfo->save($formInfo->getElements(), $ooo->id/*$pageId*/);
				if ($_POST['manager_id'] != "") {
					//echo $form->login->getValue(); die;
					$modelOrder = new Shop_Models_OrderOrder();
					$orders = $modelOrder->getUserOrders($uLogin);
					foreach ($orders as $order) {
						$modelOrder->setSmsStatus($order['id']);
					}
				}
				$accHref = "?";
				if (isset($_GET['account'])) 
					$accHref .= "account=" . $_GET['account'];
				if (isset($_GET['page'])) 
					$accHref .= "&page=" . $_GET['page'];
				if(isset($_POST['_continue'])) {
					$this->_redirector->gotoActionUrl('/admin/', $pageId . $accHref);
				} else {					
					$this->_redirect('/admin/user/' . $accHref);				
				}					
            }
        }
        $this->view->module = $this->_getParam('module');
        $this->view->id = $pageId;
        $this->view->elements = $form->getElements();
        $this->view->form = $form;
        $this->view->elementsInfo = $formInfo->getElements();
    }

    public function deleteAction()
    {
        $userID = $this->_getParam('pageId');
        $model = new User_Models_UserUser();
        $userData = $model->getUser($userID);
        $login = $userData['login'];
        $model->deleteUser($userID);
        /*$modelInfo = new User_Models_UserInfo();
        $modelInfo->deleteUserInfo($userID);
        $modelShopOrder = new Shop_Models_OrderOrder();
        $modelShopOrder->deleteOrder($login);*/
        $this->_redirect('/admin/user/');
    }

    public function edittypeAction()
    {
        $accountType = $_POST['account'];
        $userID = $_POST['userID'];
        $model = new User_Models_UserUser();
        $modelInfo = new User_Models_UserInfo();
        $model->setType($userID, $accountType);
        $modelInfo->setPriceType($userID, $accountType);
        header('Content-Type: application/json');
        echo json_encode(array('status' => 'ok'));
        exit;
    }
	
}