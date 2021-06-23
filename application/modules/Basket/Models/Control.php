<?php

class Basket_Models_Control {

    public static function getCount() {
        $i = 0;
        if (isset($_SESSION['basket'])) {
            foreach ($_SESSION['basket'] as $type) {
                foreach ($type as $key => $value) {
                    $i = $i + intval($value);
                }
            }
        }
        return '<a href="/basket/">Корзина (' . $i . ')</a>';
    }

    public static function getCountI() {
        $i = 0;
        if (isset($_SESSION['basket'])) {
            foreach ($_SESSION['basket'] as $type) {
                foreach ($type as $key => $value) {
                    $i = $i + intval($value);
                }
            }
        }
        return $i;
    }

    public static function getShopItems() {
        $priceAll = 0;
        $i = 0;
        $result = array();
        $userModel = new User_Models_UserInfo();
        $auth = Zend_Auth::getInstance()->setStorage(new Zend_Auth_Storage_Session('Zend_Auth_User'));
        $user = $userModel->getUserInfo($auth->getIdentity());
        if ($user['price_type'] == 1) {
            $priceType = 'recom';
        } elseif ($user['price_type'] == 0) {
            $priceType = 'base';
        }
        if (isset($_SESSION['basket'])) {
            $filterModel = new Filters_Models_FiltersFilters();
            $oilModel = new Oils_Models_OilsOils();
            $plugModel = new Plug_Models_Plug();
            $coolstreamModel = new Coolstream_Models_Coolstream();
			$autopartsModel = new Autoparts_Models_Autoparts();
			$efelesModel   = new Efeles_Models_EfeleArticle();
			$filtronModel   = new Filtron_Models_Article();
			if (isset($_SESSION['basket']['oil'])) {
				foreach ($_SESSION['basket']['oil'] as $key => $type) {
					$oil = $oilModel->getCurrentOil(array("0" => $key));
					if ($priceType == 'recom') {
						if ($oil[0]['price_rec'] != 0) {
							$price = $oil[0]['price_rec'];
						} else {
							$price = $oil[0]['price_base'];
						}
					} elseif ($priceType == 'base') {
						$price = $oil[0]['price_base'];
					}
					$priceAll += $price * $type;
					$result['items'][$i]['name'] = $oil[0]['invoice_name'];
					$result['items'][$i]['count'] = $type . ' шт.';
					$i++;
				}	
			}
			if (isset($_SESSION['basket']['filter'])) {
				foreach ($_SESSION['basket']['filter'] as $key => $type) {
					$filter = $filterModel->getCurrentFilter(array("0" => $key));
					if ($priceType == 'recom') {
						if ($filter[0]['price_rec'] != 0) {
							$price = $filter[0]['price_rec'];
						} else {
							$price = $filter[0]['price_base'];
						}
					} elseif ($priceType == 'base') {
						$price = $filter[0]['price_base'];
					}
					$priceAll += $price * $type;
					$result['items'][$i]['name'] = $filter[0]['invoice_name'];
					$result['items'][$i]['count'] = $type . ' шт.';
					$i++;
				}
			}
            if ($auth->hasIdentity()) {
                $userModel = new User_Models_UserInfo();
                $user = $userModel->getUserInfo($auth->getIdentity());
                if ($user['price_type'] == 1) {
                    $priceType = 'ngk1';
                } elseif ($user['price_type'] == 0) {
                    $priceType = 'base';
                }
            } else {
                $priceType = 'base';
            }
			if (isset($_SESSION['basket']['plug'])) {				
				foreach ($_SESSION['basket']['plug'] as $key => $type) {
					$plug = $plugModel->getCurrentPlug(array("0" => $key));
					if ($priceType != 'base') {
						if ($plug[0]['price_' . $priceType] != 0.00) {
							$price = $plug[0]['price_' . $priceType];
						} else {
							$price = $plug[0]['price_base'];
						}
					} else {
						$price = $plug[0]['price_base'];
					}
					$priceAll += $price * $type;
					$result['items'][$i]['name'] = $plug[0]['invoice_name'];
					$result['items'][$i]['count'] = $type . ' шт.';
					$i++;
				}
			}
			if (isset($_SESSION['basket']['coolstream'])) {
				foreach ($_SESSION['basket']['coolstream'] as $key => $type) {
					$coolstream = $coolstreamModel->getCurrentCoolstream(array("0" => $key));
					if ($priceType != 'base') {
						$price = $coolstream[0]['total1'];
					} else {
						$price = $coolstream[0]['price_base'];
					}
					$priceAll += $price * $type;
					$result['items'][$i]['name'] = $coolstream[0]['invoice_name'];
					$result['items'][$i]['count'] = $type . ' шт.';
					$i++;
				}
			}
			if (isset($_SESSION['basket']['autoparts'])) {
				foreach ($_SESSION['basket']['autoparts'] as $key => $type) {
					$autoparts = $autopartsModel->getCurrentAutoparts(array("0" => $key));
					if ($priceType != 'base') {
						$price = $autoparts[0]['total1'];
					} else {
						$price = $autoparts[0]['price_base'];
					}
					$priceAll += $price * $type;
					$result['items'][$i]['name'] = $autoparts[0]['invoice_name'];
					$result['items'][$i]['count'] = $type . ' шт.';
					$i++;
				}
			}
			if (isset($_SESSION['basket']['efele'])) {
				foreach ($_SESSION['basket']['efele'] as $key => $type) {
					$efeles = $efelesModel->getCurrentEfeles(array("0" => $key));
					if ($priceType != 'base') {
						$price = $efeles[0]['price_rec'];
					} else {
						$price = $efeles[0]['price_base'];
					}
					$priceAll += $price * $type;
					$result['items'][$i]['name'] = $efeles[0]['invoice_name'];
					$result['items'][$i]['count'] = $type . ' шт.';
					$i++;
				}
			}
			if (isset($_SESSION['basket']['filtron'])) {
				foreach ($_SESSION['basket']['filtron'] as $key => $type) {
					$filtrons = $filtronModel->getCurrentFiltron(array("0" => $key));
					if ($priceType != 'base') {
						$price = $filtrons[0]['price_rec'];
					} else {
						$price = $filtrons[0]['price_base'];
					}
					$priceAll += $price * $type;
					$result['items'][$i]['name'] = $filtrons[0]['invoice_name'];
					$result['items'][$i]['count'] = $type . ' шт.';
					$i++;
				}
			}
        }
        $result['totalprice'] = $priceAll . ' руб.';
        return $result;
    }

}
