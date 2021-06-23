<?php

class Basket_controllers_IndexController extends Core_Controller_Action_User {

    public function init() {
        $pageId = $this->_getParam('urlToInt');
        if ($pageId) {
            Engine_Controller_Action_User::setViewMain('view');

            Engine_Controller_Action_User::setDefaultParseUrlAction('view');
        }
        $auth = Zend_Auth::getInstance()->setStorage(new Zend_Auth_Storage_Session('Zend_Auth_User'));
        if ($auth->hasIdentity()) {
            $userModel = new User_Models_UserInfo();
            $user = $userModel->getUserInfo($auth->getIdentity());
//            echo '<pre>';
//            print_r($user);
//            echo '</pre>';
            if ($user['price_type'] == 1) {
                $this->view->priceType = 'recom';
            } elseif ($user['price_type'] == 0) {
                $this->view->priceType = 'base';
            }
            $this->view->user = $auth->getIdentity();
        } else {
            $this->view->priceType = 'base';
        }
    }

    public function indexAction() {       
        $request = $this->getRequest();
        $orderTemp = new Basket_Models_ShopSavedorder();
        if ($request->isPost()) {             
            foreach ($_POST['filter'] as $key => $value) {
                $orderData = array(
                    "base_id" => $key,
                    "base_id_count" => $value,
                    "type" => 'filter',
                );
                $orderTemp->changeOrder($orderData);
                $_SESSION['basket']['filter'][$key] = $value;
            }
            foreach ($_POST['oil'] as $key => $value) {
                $orderData = array(
                    "base_id" => $key,
                    "base_id_count" => $value,
                    "type" => 'oil',
                );
                $orderTemp->changeOrder($orderData);                
                $_SESSION['basket']['oil'][$key] = $value;
            }
            foreach ($_POST['plug'] as $key => $value) {
                $orderData = array(
                    "base_id" => $key,
                    "base_id_count" => $value,
                    "type" => 'plug',
                );                
                $orderTemp->changeOrder($orderData);
                $_SESSION['basket']['plug'][$key] = $value;
            }
			foreach ($_POST['coolstream'] as $key => $value) {
                $orderData = array(
                    "base_id" => $key,
                    "base_id_count" => $value,
                    "type" => 'coolstream',
                );                
                $orderTemp->changeOrder($orderData);
                $_SESSION['basket']['coolstream'][$key] = $value;
            }
			foreach ($_POST['autoparts'] as $key => $value) {
                $orderData = array(
                    "base_id" => $key,
                    "base_id_count" => $value,
                    "type" => 'autoparts',
                );                
                $orderTemp->changeOrder($orderData);
                $_SESSION['basket']['autoparts'][$key] = $value;
            }
			foreach ($_POST['efele'] as $key => $value) {
                $orderData = array(
                    "base_id" => $key,
                    "base_id_count" => $value,
                    "type" => 'efele',
                );                
                $orderTemp->changeOrder($orderData);
                $_SESSION['basket']['efele'][$key] = $value;
            }
			foreach ($_POST['filtron'] as $key => $value) {
                $orderData = array(
                    "base_id" => $key,
                    "base_id_count" => $value,
                    "type" => 'filtron',
                );                
                $orderTemp->changeOrder($orderData);
                $_SESSION['basket']['filtron'][$key] = $value;
            }
            $this->_redirect('/basket/');
        }
        $items = array();
        $filterModel = new Filters_Models_FiltersFilters();
        $oilModel = new Oils_Models_OilsOils();
        $plugModel = new Plug_Models_Plug(); 
		$coolstreamModel = new Coolstream_Models_Coolstream(); 	
		$autopartsModel = new Autoparts_Models_Autoparts(); 	
		$efeleModel = new Efeles_Models_EfeleArticle(); 	
		$filtronModel = new Filtron_Models_Article();
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
						'type' => 'filter',
						'name' => $value['invoice_name'],
						'warehouse_tver' => $value['warehouse_tver'],
						'warehouse_snab' => $value['warehouse_snab'],
						'warehouse_snabfilt' => $value['warehouse_snabfilt'],
						'price' => $price,
						'amount' => $_SESSION['basket']['filter'][$value['id']]
					);
				}
			}
		}
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
						'type' => 'oil',
						'name' => $value['invoice_name'],
						'warehouse_tver' => $value['warehouse_tver'],
						'warehouse_snab' => $value['warehouse_snab'],
						'warehouse_snabfilt' => $value['warehouse_snabfilt'],
						'price' => $price,
						'amount' => $_SESSION['basket']['oil'][$value['id']]
					);
				}
			}
		}
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
						'type' => 'plug',
						'name' => $value['invoice_name'],
						'warehouse_tver' => $value['warehouse_tver'],
						'warehouse_snab' => $value['warehouse_snab'],
						'warehouse_snabfilt' => $value['warehouse_snabfilt'],
						'price' => $price,
						'amount' => $_SESSION['basket']['plug'][$value['id']]
					);
				}
			}
		}
		if (isset($_SESSION['basket']['coolstream'])) {
			if (count($_SESSION['basket']['coolstream'])) {
				$coolstream = $coolstreamModel->getCurrentCoolstream(array_keys($_SESSION['basket']['coolstream']));
				foreach ($coolstream as $key => $value) { //echo $this->view->priceType;
					if ($this->view->priceType == 'recom') {
						$price = $value['total1'];                    
					} elseif ($this->view->priceType == 'base' && $value['price_base'] != 0.00) {
						$price = $value['price_base'];
					}
					$items[] = array(
						'id' => $value['id'],
						'type' => 'coolstream',
						'name' => $value['invoice_name'],
						'warehouse_tver' => $value['warehouse_tver'],
						'warehouse_snab' => $value['warehouse_snab'],
						'warehouse_snabfilt' => $value['warehouse_snabfilt'],
						'price' => $price,
						'amount' => $_SESSION['basket']['coolstream'][$value['id']]
					);
				}
			}
		}
		if (isset($_SESSION['basket']['autoparts'])) {
			if (count($_SESSION['basket']['autoparts'])) {
				$autoparts = $autopartsModel->getCurrentAutoparts(array_keys($_SESSION['basket']['autoparts']));
				foreach ($autoparts as $key => $value) { //echo $this->view->priceType;
					/*if ($this->view->priceType == 'recom') {
						$price = $value['total1'];                    
					} elseif ($this->view->priceType == 'base' && $value['price_base'] != 0.00) {*/
						$price = $value['price_base'];
					/*}*/
					$items[] = array(
						'id' => $value['id'],
						'type' => 'autoparts',
						'name' => $value['invoice_name'],
						'warehouse_tver' => $value['warehouse_tver'],
						'warehouse_snab' => $value['warehouse_snab'],
						'warehouse_snabfilt' => $value['warehouse_snabfilt'],
						'warehouse_skl1' => $value['warehouse_skl1'],
						'warehouse_skl3' => $value['warehouse_skl3'],
						'price' => $price,
						'amount' => $_SESSION['basket']['autoparts'][$value['id']]
					);
				}
			}
		}		
		if (isset($_SESSION['basket']['efele'])) {
			if (count($_SESSION['basket']['efele'])) {
				$efeles = $efeleModel->getCurrentEfeles(array_keys($_SESSION['basket']['efele']));
				foreach ($efeles as $key => $value) {
					if ($this->view->priceType == 'recom') {
						$price = $value['price_rec'];                    
					} elseif ($this->view->priceType == 'base' && $value['price_base'] != 0.00) {
						$price = $value['price_base'];
					}
					$items[] = array(
						'id' => $value['id'],
						'type' => 'efele',
						'name' => $value['invoice_name'],
						'warehouse_tver' => $value['warehouse_tver'],
						'warehouse_snab' => $value['warehouse_snab'],
						'warehouse_snabfilt' => $value['warehouse_snabfilt'],						
						'price' => $price,
						'amount' => $_SESSION['basket']['efele'][$value['id']]
					);
				}
			}
		}
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
						'type' => 'filtron',
						'name' => $value['invoice_name'],
						'warehouse_tver' => $value['warehouse_tver'],
						'warehouse_snab' => $value['warehouse_snab'],
						'warehouse_snabfilt' => $value['warehouse_snabfilt'],						
						'price' => $price,
						'amount' => $_SESSION['basket']['filtron'][$value['id']]
					);
				}
			}
		}
		
        $desired = new Shop_Models_DesiredProduct();
        $this->view->desired = $desired->getProduct($this->view->user);

        $this->view->items = $items;
    }

    public function viewAction() {
        
    }

    public function itemAction() {
        $request = $this->getRequest();

        if ($request->isPost()) {
            if ($id = intval($_POST['id'])) {
                $type = $_POST['type'];
                $amount = intval($_POST['amount']);

                $orderData = array(
                    "base_id" => $id,
                    "base_id_count" => $amount,
                    "type" => $type,
                );
                $orderTemp = new Basket_Models_ShopSavedorder();
                $orderTemp->saveOrder($orderData);
				//if (isset($_SESSION['basket'][$type][$id])) {
					$_SESSION['basket'][$type][$id] = $_SESSION['basket'][$type][$id] + $amount;
				//}
            }
        }
        exit;
    }

    public function changeAction() {
        $request = $this->getRequest();

        if ($request->isPost()) {
            if ($id = intval($_POST['id'])) {
                $type = $_POST['type'];
                $amount = intval($_POST['amount']);

                $orderData = array(
                    "base_id" => $id,
                    "base_id_count" => $amount,
                    "type" => $type,
                );
                $orderTemp = new Basket_Models_ShopSavedorder();
                $orderTemp->changeOrder($orderData);

                $_SESSION['basket'][$type][$id] = $amount;
            }
        }
        exit;
    }

    public function basketAction() {
        echo Basket_Models_Control::getCount();
        exit;
    }

    public function deleteAction() {
        $request = $this->getRequest();

        if ($request->isPost()) {
            if ($id = intval($_POST['id'])) {
                $type = $_POST['type'];

                $orderData = array(
                    "base_id" => $id,
                    "type" => $type,
                );
                $orderTemp = new Basket_Models_ShopSavedorder();
                $orderTemp->deleteOrder($orderData);

                unset($_SESSION['basket'][$type][$id]);

                $total_sum = 0;
                if (count($_SESSION['basket']['filter'])) {
                    $filterModel = new Filters_Models_FiltersFilters();
                    $filter = $filterModel->getCurrentFilter(array_keys($_SESSION['basket']['filter']));
                    foreach ($filter as $key => $value) {
                        $total_sum += $value['price_base'] * $_SESSION['basket']['filter'][$value['id']];
                    }
                }
                if (count($_SESSION['basket']['oil'])) {
                    $oilModel = new Oils_Models_OilsOils();
                    $oil = $oilModel->getCurrentOil(array_keys($_SESSION['basket']['oil']));
                    foreach ($oil as $key => $value) {
                        $total_sum += $value['price_base'] * $_SESSION['basket']['oil'][$value['id']];
                    }
                }
                echo json_encode(array("result" => true, "total_sum" => $total_sum));
//                echo 1;
            }
        }

        exit;
    }

}
