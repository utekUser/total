<?php

/**
 * Ordering
 * Ordering and sending messages to the recipient.
 *
 */
class Order_controllers_IndexController extends Core_Controller_Action_User {

	public function indexAction() {
		//echo ini_get("mbstring.func_overload");
		$auth = Zend_Auth::getInstance()->setStorage(new Zend_Auth_Storage_Session('Zend_Auth_User'));
		if (!$auth->hasIdentity()) {
			$this->_redirect('/account/login/');
		} else {
			$desired = new Shop_Models_DesiredProduct();
			$this->view->desired = $desired->getProduct($auth->getIdentity());

			$userUser = new User_Models_UserUser();
			$userInfo = new User_Models_UserInfo();

			$viewUser = $userUser->getUser($auth->getIdentity());
			$viewUserInfo = $userInfo->getUserInfo($auth->getIdentity());

			if ($viewUserInfo['price_type'] == 1) {
				$this->view->priceType = 'recom';
			} elseif ($viewUserInfo['price_type'] == 0) {
				$this->view->priceType = 'base';
			}
		}

		$userLogin = Engine_AuthUser::getLogin(); // Login of user.
		$userType = Engine_AuthUser::getUserType(); // The legal form: 0 - individual. 1 - organization.
		$this->view->userType = $userType;

		$items = array();

		$filterModel = new Filters_Models_FiltersFilters();
		$oilModel = new Oils_Models_OilsOils();
		$plugModel = new Plug_Models_Plug();
		$coolstreamModel = new Coolstream_Models_Coolstream();
		$autopartsModel = new Autoparts_Models_Autoparts();
		$efelesModel = new Efeles_Models_EfeleArticle();
		$filtronModel = new Filtron_Models_Article();

		// Фильтрый
		if (isset($_SESSION['basket']['filter'])) {
			if (count($_SESSION['basket']['filter'])) {
				$filter = $filterModel->getCurrentFilter(array_keys($_SESSION['basket']['filter']));
				foreach ($filter as $key => $value) {
					if ($this->view->priceType == 'recom') {
						if ($value['price_rec'] != 0) {
							$price = $value['price_rec'];
						} elseif ($value['price_rec'] == 0 && $value['env'] > 0) {
							$price = $value['price_base'];
						}
					} elseif ($this->view->priceType == 'base') {
						$price = $value['price_base'];
					}
					$items[] = array(
						'id' => $value['id'],
						'base_id' => $value['base_id'],
						'type' => 'filter',
						'name' => $value['invoice_name'],
						'price' => $price,
						'amount' => $_SESSION['basket']['filter'][$value['id']],
						'price_type' => $this->view->priceType
					);
				}
			}
		}
		// Масла
		if (isset($_SESSION['basket']['oil'])) {
			if (count($_SESSION['basket']['oil'])) {
				$oil = $oilModel->getCurrentOil(array_keys($_SESSION['basket']['oil']));
				foreach ($oil as $key => $value) {
					if ($this->view->priceType == 'recom') {
						if ($value['price_rec'] != 0) {
							$price = $value['price_rec'];
						} elseif ($value['price_rec'] == 0 && $value['env'] > 0) {
							$price = $value['price_base'];
						}
					} elseif ($this->view->priceType == 'base') {
						$price = $value['price_base'];
					}
					$items[] = array(
						'id' => $value['id'],
						'base_id' => $value['base_id'],
						'type' => 'oil',
						'name' => $value['invoice_name'],
						'price' => $price,
						'amount' => $_SESSION['basket']['oil'][$value['id']],
						'price_type' => $this->view->priceType
					);
				}
			}
		}
		// Свечи
		if (isset($_SESSION['basket']['plug'])) {
			if (count($_SESSION['basket']['plug'])) {
				$plug = $plugModel->getCurrentPlug(array_keys($_SESSION['basket']['plug']));
				foreach ($plug as $key => $value) {
					if ($this->view->priceType == 'recom') {
						if ($value['price_ngk1'] != 0.00) {
							$price = $value['price_ngk1'];
						} elseif ($value['price_base'] != 0.00) {
							$price = $value['price_base'];
						}
					} elseif ($this->view->priceType == 'base' && $value['price_base'] != 0.00) {
						$price = $value['price_base'];
					}
					$items[] = array(
						'id' => $value['id'],
						'base_id' => $value['base_id'],
						'type' => 'plug',
						'name' => $value['invoice_name'],
						'price' => $price,
						'amount' => $_SESSION['basket']['plug'][$value['id']],
						'price_type' => $this->view->priceType
					);
				}
			}
		}
		// Охлаждающие жидкости
		if (isset($_SESSION['basket']['coolstream'])) {
			if (count($_SESSION['basket']['coolstream'])) {
				$coolstream = $coolstreamModel->getCurrentCoolstream(array_keys($_SESSION['basket']['coolstream']));
				foreach ($coolstream as $key => $value) {
					if ($this->view->priceType == 'recom') {
						$price = $value['total1'];
					} elseif ($this->view->priceType == 'base' && $value['price_base'] != 0.00) {
						$price = $value['price_base'];
					}
					$items[] = array(
						'id' => $value['id'],
						'base_id' => $value['base_id'],
						'type' => 'coolstream',
						'name' => $value['invoice_name'],
						'price' => $price,
						'amount' => $_SESSION['basket']['coolstream'][$value['id']],
						'price_type' => $this->view->priceType
					);
				}
			}
		}
		// Автомобильные запчасти
		if (isset($_SESSION['basket']['autoparts'])) {
			if (count($_SESSION['basket']['autoparts'])) {
				$autoparts = $autopartsModel->getCurrentAutoparts(array_keys($_SESSION['basket']['autoparts']));
				foreach ($autoparts as $key => $value) {
					/* if ($this->view->priceType == 'recom') { 
					  $price = $value['total1'];
					  } elseif ($this->view->priceType == 'base' && $value['price_base'] != 0.00) { */
					$price = $value['price_base'];
					/* } */
					$items[] = array(
						'id' => $value['id'],
						'base_id' => $value['base_id'],
						'type' => 'autoparts',
						'name' => $value['invoice_name'],
						'price' => $price,
						'amount' => $_SESSION['basket']['autoparts'][$value['id']],
						'price_type' => $this->view->priceType
					);
				}
			}
		}
		// Смазочные материалы
		if (isset($_SESSION['basket']['efele'])) {
			if (count($_SESSION['basket']['efele'])) {
				$efeles = $efelesModel->getCurrentEfeles(array_keys($_SESSION['basket']['efele']));
				foreach ($efeles as $key => $value) {
					if ($this->view->priceType == 'recom') {
						$price = $value['price_rec'];
					} elseif ($this->view->priceType == 'base' && $value['price_base'] != 0.00) {
						$price = $value['price_base'];
					}
					$items[] = array(
						'id' => $value['id'],
						'base_id' => $value['base_id'],
						'type' => 'efele',
						'name' => $value['invoice_name'],
						'price' => $price,
						'amount' => $_SESSION['basket']['efele'][$value['id']],
						'price_type' => $this->view->priceType
					);
				}
			}
		}
		// Товары Filtron
		if (isset($_SESSION['basket']['filtron'])) {
			if (count($_SESSION['basket']['filtron'])) {
				$filtrons = $filtronModel->getCurrentFiltron(array_keys($_SESSION['basket']['filtron']));
				foreach ($filtrons as $key => $value) {
					if ($this->view->priceType == 'recom') {
						$price = $value['price_rec'];
					} elseif ($this->view->priceType == 'base' && $value['price_base'] != 0.00) {
						$price = $value['price_base'];
					}
					$items[] = array(
						'id' => $value['id'],
						'base_id' => $value['base_id'],
						'type' => 'filtron',
						'name' => $value['invoice_name'],
						'price' => $price,
						'amount' => $_SESSION['basket']['filtron'][$value['id']],
						'price_type' => $this->view->priceType
					);
				}
			}
		}
		$error = array();
		$request = $this->getRequest();
		if ($request->isPost()) {
			/* if ($_SERVER['REMOTE_ADDR'] == '88.204.72.138') { 
			  echo '<pre>';
			  print_r($_POST);
			  echo '</pre>';
			  die;
			  exit;
			  } */
			if (!$userType) {
				if ($request->getPost('name') == '')
					$error['name'] = 'Поле <b>Ф.И.О.</b> является обязательным для заполения.';
				if ($request->getPost('email') == '')
					$error['email'] = 'Поле <b>E-Mail</b> является обязательным для заполения.';
				if ($request->getPost('phone') == '')
					$error['phone'] = 'Поле <b>Телефон</b> является обязательным для заполения.';
			} else {
				if ($request->getPost('title') == '')
					$error['title'] = 'Поле <b>Название компании</b> является обязательным для заполения.';
				if ($request->getPost('name') == '')
					$error['name'] = 'Поле <b>Контактное лицо</b> является обязательным для заполения.';
				if ($request->getPost('email') == '')
					$error['email'] = 'Поле <b>E-Mail</b> является обязательным для заполения.';
			}

			if (count($items) == 0)
				$error['items_count'] = 'Необходимо добавить в корзину хотя бы один товар.';
			if ($request->getPost('delivery_type') == '')
				$error['delivery_type'] = 'Необходимо указать способ доставки.';
			if ($request->getPost('payment_type') == '')
				$error['payment_type'] = 'Необходимо указать способ оплаты.';
			//if ($request->getPost('warehouse_type') == '') $error['warehouse_type'] = 'Необходимо указать склад вывоза.';

			if (empty($error)) {
				$orderData = array(
					'date' => date('Y-m-d H:i:s'),
					'customer_name' => $request->getPost('name'),
					'customer_login' => $userLogin,
					'customer_type' => $userType,
					'customer_phone' => $request->getPost('phone'),
					'customer_email' => $request->getPost('email'),
					'total_sum' => $request->getPost('total_sum'),
					'comment' => $request->getPost('comment'),
					'delivery_type' => $request->getPost('delivery_type'),
					'payment_type' => $request->getPost('payment_type'),
					'warehouse_type' => '0', //$request->getPost('warehouse_type'),
				);
				if ($userType) {
					$orderData['company_name'] = $request->getPost('title');
					$orderData['company_address'] = $request->getPost('ur_address');
					$orderData['company_inn'] = $request->getPost('inn');
					$orderData['company_kpp'] = $request->getPost('kpp');
				}

				$order = new Shop_Models_OrderOrder();
				$order->saveOrder($orderData);
				$order_id = $order->getDbTable()->getAdapter()->lastInsertId();
				$composition = new Shop_Models_OrderComposition();
				$composition->saveComposition($order_id, $items);


				$mailReplay = Engine_Cms::setupValue('order');
				//$mailReplay .= ", turkov.dm@ya.ru";
				if ($mailReplay != '') {
					$mailSend = explode(',', $mailReplay);

					$patterns[0] = '/{site}/';
					$patterns[1] = '/{user_type}/';
					$patterns[2] = '/{login}/';
					$patterns[3] = '/{name}/';
					$patterns[4] = '/{email}/';
					$patterns[5] = '/{phone}/';
					$patterns[6] = '/{items}/';
					$patterns[7] = '/{total_sum}/';
					$patterns[8] = '/{comment}/';
					$patterns[9] = '/{order_id}/';
					$patterns[10] = '/{order_date}/';
					$patterns[11] = '/{company_info}/';
					$patterns[12] = '/{delivery}/';
					$patterns[13] = '/{payment}/';
					$patterns[14] = '/{order_name}/';
					//$patterns[15] = '/{warehouse_type}/';

					$items_list = '';
					foreach ($items as $item) {
						$items_list .= '<tr>' .
							'<td>' . $item['base_id'] . '</td>' .
							'<td>' . $item['name'] . '</td>' .
							'<td>' . $item['price'] . '</td>' .
							'<td>' . $item['amount'] . '</td>' .
							'<td>' . $item['price'] * $item['amount'] . '</td>' .
							'</tr>';
					}

					$replacements[0] = $_SERVER['HTTP_HOST'];
					$userTypes = array('0' => 'Физическое лицо', '1' => 'Юридическое лицо');
					$replacements[1] = $userTypes[$orderData['customer_type']];
					$replacements[2] = $orderData['customer_login'];

					$replacements[3] = $orderData['customer_name'];
					$replacements[4] = $orderData['customer_email'];
					$replacements[5] = $orderData['customer_phone'];

					$replacements[6] = $items_list;
					$replacements[7] = $orderData['total_sum'];
					$replacements[8] = $orderData['comment'];

					$replacements[9] = $order_id;
					$replacements[10] = $orderData['date']; //Engine_View_Helper_Date::getDateNumeric($orderData['date']);

					if ($userType) {
						$replacements[11] = '<tr><td>Название компании:</td><td>' . $orderData['company_name'] . '</td></tr>' .
							'<tr><td>Юридический адрес:</td><td>' . $orderData['company_address'] . '</td></tr>' .
							'<tr><td>ИНН:</td><td>' . $orderData['company_inn'] . '</td></tr>' .
							'<tr><td>КПП:</td><td>' . $orderData['company_kpp'] . '</td></tr>';
					} else {
						$replacements[11] = '';
					}

					$form = new Shop_Form_Order(); // Форма заказа
					$delivery = $form->delivery_type->getMultiOptions();
					$payment = $form->payment_type->getMultiOptions();
					$warehouse = $form->warehouse_type->getMultiOptions();
					$replacements[12] = $delivery[$orderData['delivery_type']];
					$replacements[13] = $payment[$orderData['payment_type']];

					// Название заказа
					if ($orderData['customer_type'] == 0) {
						$replacements[14] = "Розничный заказ";
						$typeOrder = 'Розничный заказ № ' . $order_id;
//                     	$subject = 'Розничный заказ № ' . $order_id . ' на http://' . $_SERVER['HTTP_HOST'] . '/';
						$subject = 'Розничный заказ № ' . $order_id . '.' . ($orderData['company_name'] ? ' ' . $orderData['company_name'] . '.' : ($orderData['customer_name'] ? ' ' . $orderData['customer_name'] . '.' : ''));
					} else {
						$replacements[14] = "Оптовый заказ";
						$typeOrder = 'Оптовый заказ № ' . $order_id;
// 						$subject = 'Оптовый заказ № ' . $order_id . ' на http://' . $_SERVER['HTTP_HOST'] . '/';
						$subject = 'Оптовый заказ № ' . $order_id . '.' . ($orderData['company_name'] ? ' ' . $orderData['company_name'] . '.' : ($orderData['customer_name'] ? ' ' . $orderData['customer_name'] . '.' : ''));
					}
					//$replacements[15] = $warehouse[$orderData['warehouse_type']];
//                    $letter = file_get_contents(APPLICATION_PATH . '/public/templates/order.txt');
//                    $letter = preg_replace($patterns, $replacements, $letter);
//                    $subjectUtf8 = $subject;
					$subject = iconv('utf8', 'cp1251', $subject);
//                    $letter = iconv('utf8', 'cp1251', $letter);
//                    $fromName = iconv('utf8', 'cp1251', 'Томавтотрейд');
					$toName = iconv('utf8', 'cp1251', 'Администратору');

					// Формирование документа            
					$view = new Zend_View();
					$view->items = $items;

					$desired = new Shop_Models_DesiredProduct();
					$view->desiredItems = $desired->getProduct($auth->getIdentity());

					$view->totalSum = $orderData['total_sum'];
					$view->user = $viewUser;
					$view->userInfo = $viewUserInfo;

					$view->orderData = $orderData;

					$view->delivery = $replacements[12];
					$view->payment = $replacements[13];
					$view->comment = $orderData['comment'];

					$view->phone = $orderData['customer_phone'];
					$view->type = $userTypes[$orderData['customer_type']];

					$view->typeOrder = $typeOrder;

					$view->setScriptPath(APPLICATION_PATH . DS . 'application' . DS . 'modules' . DS . 'Order/templates/bill/');
					$contents = $view->render('in.php');

					//$mpdf = new mPDF('ru-RU', 'A4', '', '', 5, 5, 5, 5, 0, 0);
					$mpdf = new Mpdf\Mpdf();
					//$mpdf->myvariable = file_get_contents(APPLICATION_PATH . DS . 'application' . DS . 'modules' . DS . 'Order/templates/bill/images/header.jpg');
					$mpdf->WriteHTML($contents);
					$content = $mpdf->Output('', 'S');

					$desired->isOrder($auth->getIdentity(), $order_id);

					// save in file
					$pdfPath = APPLICATION_PATH . DS . 'media' . DS . 'order';
					if (is_writable($pdfPath)) {
						$mkdir = $pdfPath . DS . substr($order_id, -1) . DS . substr($order_id, -2, 1) . DS . $order_id;
						mkdir($mkdir, 0777, true);
						$mpdf->Output($mkdir . DS . 'order.pdf', 'F');
					}

					//echo $typeOrder . " от " . date('d.m.Y') .". " . ($view->userInfo->title ? $view->userInfo->title : $view->userInfo->name) . ".pdf") . '<br/>'; 
					$nameOfFile = iconv('utf8', 'cp1251', $typeOrder . " от " . date('d.m.Y') . ". " . ($view->userInfo->title ? $view->userInfo->title : $view->userInfo->name) . ".pdf"); //  mb_convert_encoding($typeOrder . " от " . date('d.m.Y') .". " . ($view->userInfo->title ? $view->userInfo->title : $view->userInfo->name) . ".pdf", "utf-8", "cp1251");
					//echo $nameOfFile . '<br/>'; die; exit;
					if ($_SERVER['REMOTE_ADDR'] == '46.161.158.155') {//'78.140.8.31') {
						$ttt = 'public/order/' . $order_id . '/' . $nameOfFile;
						mkdir(APPLICATION_PATH . '/public/order/' . $order_id . '/');
						$mpdf->Output(APPLICATION_PATH . '/' . $ttt, 'F');

						$table = $order->getDbTable();
						$table->update(array('pdf' => $ttt), array('id = ?' => $order_id));
						//exit;
					}
					foreach ($mailSend as $key => $value) {
						$emailPost = trim($value);
						if ($emailPost != '') {
							$mailtr = new Zend_Mail_Transport_Sendmail();
							Zend_Mail::setDefaultTransport($mailtr);

							$mail = new Zend_Mail('windows-1251');

							$mail->addHeader('MIME-Version', '1.0');
							$mail->addHeader('Content-Type', 'text/html');
							$mail->addHeader('Content-Transfer-Encoding', '8bit');
							$mail->addHeader('X-Mailer:', 'PHP/' . phpversion());

//                        	$mail->setBodyHtml($letter);
							$mail->setFrom(($viewUser->email ? $viewUser->email : "order@total.tomauto.ru"), iconv('utf8', 'cp1251', trim($viewUserInfo->name)));
							$mail->setReplyTo($viewUser->email ? $viewUser->email : "order@total.tomauto.ru", iconv('utf8', 'cp1251', 'Томавтотрейд'));

							$mail->addTo($emailPost, $toName);
							$mail->setBodyHtml(iconv('utf8', 'cp1251', "<p>Данные заказа в прикреплении письма в формате PDF.</p>"));
							$mail->setSubject($subject);

							$file = new Zend_Mime_Part($content);
							$file->type = 'application/pdf';
							$file->disposition = Zend_Mime::DISPOSITION_ATTACHMENT;
							$file->encoding = Zend_Mime::ENCODING_BASE64;
							$file->filename = $nameOfFile;
							$mail->addAttachment($file);

							$mail->send();


//                         	if ($_SERVER['REMOTE_ADDR'] == '78.140.8.31') {
//                         		echo "<pre>";
//                         		print_r($items);
//                         		exit;
//                         	}
						}
					}
				}

				unset($_SESSION['basket']);
				$this->_redirect('/order/success/?order=' . $order_id);
			}
		}
		$shopSaveOrder = new Basket_Models_ShopSavedorder();
		$shopSaveOrder->deleteForewer(session_id());
		$this->view->items = $items;
		$this->view->error = $error;
		$this->view->user = $userUser->getUser($auth->getIdentity());
		$this->view->userInfo = $viewUserInfo;
	}

	/**
	 * Successfully.
	 */
	public function successAction() {
		$auth = Zend_Auth::getInstance()->setStorage(new Zend_Auth_Storage_Session('Zend_Auth_User'));
		if (!$auth->hasIdentity()) {
			$this->_redirect('/account/login/');
		}
		$userLogin = Engine_AuthUser::getLogin();

		$request = $this->getRequest();
		if ($request->getQuery('order') && intval($request->getQuery('order'))) {
			$order_id = $request->getQuery('order');
			$orderModel = new Shop_Models_OrderOrder();
			$this->view->orderInfo = $orderModel->getOrderDateAndId($order_id, $userLogin);
		}
	}

}
