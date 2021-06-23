<?php

class Basket_Models_ShopSavedorder extends Engine_Model_Abstract {

    protected $_dbTableName = 'Basket_Models_DbTable_ShopSavedorder';
    protected $_formTableName = 'shop_savedorder';
    protected $_orderBy = 'id DESC';

    public function saveOrder($data) {
        $auth = Zend_Auth::getInstance()->setStorage(new Zend_Auth_Storage_Session('Zend_Auth_User'));
        $set = array(
            'date' => date('Y-m-d H:i:s', time()),
            'user_id' => $auth->getIdentity(),
            'base_id' => $data['base_id'],
            'type' => $data['type'],
            'base_id_count' => $data['base_id_count'],
            'session_id' => session_id(),
        );
        $this->getDbTable()->insert($set);
    }

    public function changeOrder($data) {
        $auth = Zend_Auth::getInstance()->setStorage(new Zend_Auth_Storage_Session('Zend_Auth_User'));
        $set = array(
            'date' => date('Y-m-d H:i:s', time()),
            'user_id' => $auth->getIdentity(),
            'base_id' => $data['base_id'],
            'type' => $data['type'],
            'base_id_count' => $data['base_id_count'],
            'session_id' => session_id(),
        );
        $this->getDbTable()->update($set, array(
            "user_id = ?" => $auth->getIdentity(),
            "type = ?" => $data['type'],
            "base_id = ?" => $data['base_id'],
            "session_id = ?" => session_id(),
        ));
    }

    public function deleteOrder($data) {
        $auth = Zend_Auth::getInstance()->setStorage(new Zend_Auth_Storage_Session('Zend_Auth_User'));
        $set = array(
            'isdeleted' => 1,
        );
        $this->getDbTable()->update($set, array(
            "user_id = ?" => $auth->getIdentity(),
            "type = ?" => $data['type'],
            "base_id = ?" => $data['base_id'],
            "session_id = ?" => session_id(),
        ));
    }
	
	public function getUserIDsSaveOrder() {
		$table = $this->getDbTable();
        $select = $table->select()
			->distinct()
			->from(array('t' => 'total_shop_savedorder'), 'user_id')
			->where('istimeout = 0')
			->where('isdeleted = 0')
			->where('isemailsend = 0')
			->group('session_id')
			->order('user_id ASC');
		$result = $table->fetchAll($select);
		$set = array(
			'isemailsend' => 1,
		);
		$this->getDbTable()->update($set, array(
			"istimeout = ?" => 0,
			"isdeleted = ?" => 0,
			"isemailsend = ?" => 0,
		));
		return $result;
		/*SELECT DISTINCT(`user_id`) FROM `total_shop_savedorder` WHERE `isdeleted`= 0 AND `istimeout` = 0 AND `isemailsend`= 0 GROUP BY `session_id` ORDER BY `total_shop_savedorder`.`user_id` ASC*/
	} 
	
	public function putToTheBasketIfExist() {
		$auth = Zend_Auth::getInstance()->setStorage(new Zend_Auth_Storage_Session('Zend_Auth_User'));
        $table = $this->getDbTable();
        $select = $table->select()
				->where('user_id = ?', $auth->getIdentity())				
				->where('istimeout = 0')
				->where('isdeleted = 0')
                ->where('date = (select max(date) from total_shop_savedorder)')
				->order('id DESC');						
		$result = $table->fetchAll($select);	
		if (count($result) > 0) {
			if ((time() - strtotime($result[0]['date'])) / 86400 > 3) {
				$set = array(
					'istimeout' => 1,
				);
				$this->getDbTable()->update($set, array(
					"user_id = ?" => $auth->getIdentity(),
					"session_id = ?" => $result[0]['session_id'],
				));
				return 0;
			} else { 
				$this->putToTheBasketOnLoad($result[0]['session_id']);
				return 1;
			}	
		}
		/*SELECT * FROM `total_shop_savedorder` WHERE `isdeleted` = 0 and `istimeout` = 0 and `user_id` = 606 and `date` = (select max(`date`) from `total_shop_savedorder`)*/		
	}
	
	public function putToTheBasketOnLoad($data) {
        $auth = Zend_Auth::getInstance()->setStorage(new Zend_Auth_Storage_Session('Zend_Auth_User'));
        $table = $this->getDbTable();
        $select = $table->select()
                ->where('user_id = ?', $auth->getIdentity())
                //->where('isdeleted != 1')
                ->where('session_id = ?', $data)
                ->order('id DESC');
        $result = $table->fetchAll($select);
        foreach ($result as $key => $value) {
            $_SESSION['basket'][$value['type']][$value['base_id']] = $value['base_id_count'];
            $orderData = array(
                "base_id" => $value['base_id'],
                "base_id_count" => $value['base_id_count'],
                "type" => $value['type'],
            );
            //$this->saveOrder($orderData);
        }
		//$this->deleteForewer($data);		
    }
	
    public function putToTheBasket($data) {
        $auth = Zend_Auth::getInstance()->setStorage(new Zend_Auth_Storage_Session('Zend_Auth_User'));
        $table = $this->getDbTable();
        $select = $table->select()
                ->where('user_id = ?', $auth->getIdentity())
                ->where('isdeleted != 1')
                ->where('session_id = ?', $data)
                ->order('id DESC');
        $result = $table->fetchAll($select);
        foreach ($result as $key => $value) {
            $_SESSION['basket'][$value['type']][$value['base_id']] = $value['base_id_count'];
            $orderData = array(
                "base_id" => $value['base_id'],
                "base_id_count" => $value['base_id_count'],
                "type" => $value['type'],
            );
            $this->saveOrder($orderData);
        }
		$this->deleteForewer($data);		
    }

    public function deleteForewer($data) {
        $auth = Zend_Auth::getInstance()->setStorage(new Zend_Auth_Storage_Session('Zend_Auth_User'));
        $set = array(
            'isdeleted' => 1,
        );
        $this->getDbTable()->update($set, array(
            "user_id = ?" => $auth->getIdentity(),
            "session_id = ?" => $data,
        ));
    }

    public function getUserSaveOrders() {
        $auth = Zend_Auth::getInstance()->setStorage(new Zend_Auth_Storage_Session('Zend_Auth_User'));
        $table = $this->getDbTable();
        $select = $table->select()
                ->where('user_id = ?', $auth->getIdentity())
                ->where('isdeleted != 1')
                ->order('id DESC');
        $result = $table->fetchAll($select);
        $res = array();
        $sess = "";
        $i = 0;
        foreach ($result as $key => $value) {
            if ($key == 0) {
                $sess = $value['session_id'];
            } elseif ($sess != $value['session_id']) {
                $sess = $value['session_id'];
            }
            $res[$sess]['date'] = $value['date'];
            $res[$sess][$i]['id'] = $value['id'];
            $res[$sess][$i]['type'] = $value['type'];
            $res[$sess][$i]['base_id'] = $value['base_id'];
            $i++;
        }
        return $res;
    }

    public function getUserOrderBySessionId($sessId) {
        $auth = Zend_Auth::getInstance()->setStorage(new Zend_Auth_Storage_Session('Zend_Auth_User'));
        $table = $this->getDbTable();
        $select = $table->select()
                //->where('user_id = ?', $auth->getIdentity())
                ->where('session_id = ?', $sessId)
                ->where('isdeleted != 1')
                ->order('id DESC');
        $result = $table->fetchAll($select);
        $res = array();
        $filterModel = new Filters_Models_FiltersFilters();
        $oilModel = new Oils_Models_OilsOils();
        $plugModel = new Plug_Models_Plug();
        $autopartsModel = new Autoparts_Models_Autoparts();
        $coolstreamModel = new Coolstream_Models_Coolstream();
        $efelesModel = new Efeles_Models_EfeleArticle();
        $filtronModel = new Filtron_Models_Article();
        $fs = array();
        $os = array();
        $ps = array();
        $as = array();
        $cs = array();
        $es = array();
        $fils = array();
        $i = 0;
        $j = 0;
        $k = 0;		
        foreach ($result as $key => $value) {
            $res['date'] = $value['date'];
            if ($value['type'] == 'oil') {		
                $oil = $oilModel->getCurrentOil(array("0" => $value['base_id']));
                foreach ($oil as $oilkey => $oilvalue) {
                    $os[$i]['name'] = $oilvalue['invoice_name'];
                    $os[$i]['count'] = $value['base_id_count'];
                }
                $i++;
            } elseif ($value['type'] == 'filter') {
                $filter = $filterModel->getCurrentFilter(array("0" => $value['base_id']));
                foreach ($filter as $oilkey => $filtervalue) {
                    $fs[$j]['name'] = $filtervalue['invoice_name'];
                    $fs[$j]['count'] = $value['base_id_count'];
                }
                $j++;
            } elseif ($value['type'] == 'plug') {
                $plug = $plugModel->getCurrentPlug(array("0" => $value['base_id']));
                foreach ($plug as $oilkey => $plugvalue) {
                    $ps[$k]['name'] = $plugvalue['invoice_name'];
                    $ps[$k]['count'] = $value['base_id_count'];
                }
                $k++;
            } elseif ($value['type'] == 'autoparts') {
                $autoparts = $autopartsModel->getCurrentAutoparts(array("0" => $value['base_id']));
                foreach ($autoparts as $oilkey => $plugvalue) {
                    $as[$k]['name'] = $plugvalue['invoice_name'];
                    $as[$k]['count'] = $value['base_id_count'];
                }
                $k++;
            } elseif ($value['type'] == 'coolstream') {
                $coolstream = $coolstreamModel->getCurrentCoolstream(array("0" => $value['base_id']));
                foreach ($coolstream as $oilkey => $plugvalue) {
                    $cs[$k]['name'] = $plugvalue['invoice_name'];
                    $cs[$k]['count'] = $value['base_id_count'];
                }
                $k++;
            } elseif ($value['type'] == 'efele') {
                $efele = $efelesModel->getCurrentEfeles(array("0" => $value['base_id']));
                foreach ($efele as $oilkey => $plugvalue) {
                    $es[$k]['name'] = $plugvalue['invoice_name'];
                    $es[$k]['count'] = $value['base_id_count'];
                }
                $k++;
            } elseif ($value['type'] == 'filtron') {
                $filtron = $filtronModel->getCurrentFiltron(array("0" => $value['base_id']));
                foreach ($filtron as $oilkey => $plugvalue) {
                    $fils[$k]['name'] = $plugvalue['invoice_name'];
                    $fils[$k]['count'] = $value['base_id_count'];
                }
                $k++;
            }
            if ($key == 0) {
                $sess = $value['session_id'];
            } elseif ($sess != $value['session_id']) {
                $sess = $value['session_id'];
            }
        }
        $res['oils'] = $os;
        $res['filters'] = $fs;
        $res['plugs'] = $ps;
        $res['autoparts'] = $as;
        $res['coolstream'] = $cs;
        $res['efele'] = $es;
        $res['filtron'] = $fils;
        return $res;
    }

}
