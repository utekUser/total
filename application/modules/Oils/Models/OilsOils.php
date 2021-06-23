<?php

class Oils_Models_OilsOils extends Engine_Model_Abstract {

	protected $_dbTableName = 'Oils_Models_DbTable_OilsOils';
	protected $_formTableName = 'Oils_Form_OilsOils';
	protected $_orderBy = 'id DESC';

	public function getAllOils($where) {
		$table = $this->getDbTable();
		$select = $table->select()->where('display = ?', 1);
		return $table->fetchAll($select);
	}

	public function getOils($subsections = null) {
		$http = new Engine_Controller_Request_Http();
		$page = $http->getParam('page');
		$table = $this->getDbTable();

		if ($subsections !== null) {
			
			$filter = '';
			foreach ($subsections as $key => $value) {
				$filter .= trim($value) . ', ';
			}
			//print_r($filter);
			$filter = substr($filter, 0, strlen($filter) - 4);
			//print_r($filter); die;
			$select = $table->select()
				->where('display = ?', 1)
				->where('`id` IN (SELECT DISTINCT `item_id` FROM `total_oils_connection` WHERE `section_id` IN (' . $filter . '))')
				->order('pos DESC');
		} else {
			$select = $table->select()
				->where('display = ?', 1)
				->order('pos DESC');
		}
		$massWhereString = "";
		/* if ($_SERVER['REMOTE_ADDR'] == '46.161.158.155' || $_SERVER['REMOTE_ADDR'] == '88.204.72.104') { */
		if (isset($_GET['filters'])) {
			if (isset($_GET['filters']['brands'])) {
				$whereBrand = "";
				if (count($_GET['filters']['brands']) == 1) {
					$whereBrand = '`invoice_name` LIKE "% ' . $_GET['filters']['brands'][0] . ' %"';
				} else {
					foreach ($_GET['filters']['brands'] as $key => $value) {
						if ($key == 0) {
							$whereBrand = '`invoice_name` LIKE "% ' . $value . ' %"';
						} else {
							$whereBrand .= ' OR `invoice_name` LIKE "% ' . $value . ' %"';
						}
					}
				}
				$select = $select->where($whereBrand);
			}
			if (isset($_GET['filters']['price'])) {
				$wherePrice = "";
				if (((int) $_GET['filters']['price']['GTE'] > 0) && ((int) $_GET['filters']['price']['LTE'] > 0)) {
					$wherePrice = 'CAST(`price_base` AS UNSIGNED) > "' . $_GET['filters']['price']['GTE'] . '" AND CAST(`price_base` AS UNSIGNED) < "' . $_GET['filters']['price']['LTE'] . '"';
				} elseif ((int) $_GET['filters']['price']['GTE'] > 0) {
					$wherePrice = 'CAST(`price_base` AS UNSIGNED) > "' . $_GET['filters']['price']['GTE'] . '"';
				} elseif ((int) $_GET['filters']['price']['LTE'] > 0) {
					$wherePrice = 'CAST(`price_base` AS UNSIGNED) < "' . $_GET['filters']['price']['LTE'] . '"';
				}
				if (strlen($wherePrice) > 0) {
					$select = $select->where($wherePrice);
				}
			}
			if (isset($_GET['filters']['capacity'])) {
				$whereType = "";
				if (count($_GET['filters']['capacity']) == 1) {
					$whereType = '`litr` ="' . $_GET['filters']['capacity'][0] . '%"';
				} else {
					foreach ($_GET['filters']['capacity'] as $key => $value) {
						if ($key == 0) {
							$whereType = '`litr` LIKE "' . $value . '"';
						} else {
							$whereType .= ' OR `litr` LIKE "' . $value . '"';
						}
					}
				}
				$select = $select->where($whereType);
			}
			if (isset($_GET['filters']['type'])) {
				$whereType = "";
				if (count($_GET['filters']['type']) == 1) {
					if ($_GET['filters']['type'][0] == "смазка") {
						$whereType = '`invoice_name` LIKE "%' . $_GET['filters']['type'][0] . '%"';
					} else {
						$whereType = '`invoice_name` LIKE "% ' . $_GET['filters']['type'][0] . '%"';
					}
				} else {
					foreach ($_GET['filters']['type'] as $key => $value) {
						if ($key == 0) {
							$whereType = '`invoice_name` LIKE "% ' . $value . '%"';
						} else {
							$whereType .= ' OR `invoice_name` LIKE "% ' . $value . '%"';
						}
						//echo $whereType; die; exit;
					}
				}
				$select = $select->where($whereType);
			}
			if (isset($_GET['filters']['oil_type'])) {
				$whereOilType = "";
				if (count($_GET['filters']['oil_type']) == 1) {
					if ($_GET['filters']['oil_type'][0] == 'полусинтетическое') {
						$oilType = "полусинт";
					} else {
						$oilType = $_GET['filters']['oil_type'][0];
					}
					$whereOilType = '`invoice_name` LIKE "%' . $oilType . '%"';
				} else {
					foreach ($_GET['filters']['oil_type'] as $key => $value) {
						if ($value == 'полусинтетическое') {
							$oilType = "полусинт";
						} else {
							$oilType = $value;
						}
						if ($key == 0) {
							$whereOilType = '`invoice_name` LIKE "%' . $oilType . '%"';
						} else {
							$whereOilType .= ' OR `invoice_name` LIKE "%' . $oilType . '%"';
						}
					}
				}
				$select = $select->where($whereOilType);
			}
			if (isset($_GET['filters']['viscosity'])) {
				$whereViscosity = "";
				if (count($_GET['filters']['viscosity']) == 1) {
					if ($_GET['filters']['viscosity'][0] != "SAE30") {
						$viscosity = $this->getMasViscosity($_GET['filters']['viscosity'][0]);
						$whereViscosity = '`invoice_name` LIKE "% ' . $viscosity[0] . ' %" OR `invoice_name` LIKE "% ' . $viscosity[1] . ' %" OR `invoice_name` LIKE "% ' . $viscosity[2] . ' %" OR `invoice_name` LIKE "% ' . $viscosity[3] . ' %"';
					} else {
						$whereViscosity = '`invoice_name` LIKE "% ' . $_GET['filters']['viscosity'][0] . ' %"';
					}
				} else {
					foreach ($_GET['filters']['viscosity'] as $key => $value) {
						if ($key == 0) {
							if ($value != "SAE30") {
								$viscosity = $this->getMasViscosity($value);
								$whereViscosity = '`invoice_name` LIKE "% ' . $viscosity[0] . ' %" OR `invoice_name` LIKE "% ' . $viscosity[1] . ' %" OR `invoice_name` LIKE "% ' . $viscosity[2] . ' %" OR `invoice_name` LIKE "% ' . $viscosity[3] . ' %"';
							} else {
								$whereViscosity = '`invoice_name` LIKE "%' . $value . '%"';
							}
						} else {
							if ($value != "SAE30") {
								$viscosity = $this->getMasViscosity($value);
								$whereViscosity .= ' OR `invoice_name` LIKE "% ' . $viscosity[0] . ' %" OR `invoice_name` LIKE "% ' . $viscosity[1] . ' %" OR `invoice_name` LIKE "% ' . $viscosity[2] . ' %" OR `invoice_name` LIKE "% ' . $viscosity[3] . ' %"';
							} else {
								$whereViscosity .= ' OR `invoice_name` LIKE "%' . $value . '%"';
							}
						}
					}
				}
				$select = $select->where($whereViscosity);
			}
		}
		//echo "<pre>"; print_r($select); die;
		/* } */
		$adapter = new Zend_Paginator_Adapter_DbSelect($select);

		$paginator = new Engine_Paginator($adapter);
		$paginator->setItemCountPerPage(10);
		$paginator->setCurrentPageNumber($page);
		if ((!sizeof($paginator)) && (isset($_GET['filters']))) {
			$oilsearch = new Oils_Models_OilsSearch();
			if (isset($_GET['filters']['brands'])) {
				foreach ($_GET['filters']['brands'] as $key => $value) {
					$brands = $value . "###";
				}
			}
			if (isset($_GET['filters']['price'])) {
				$price = $_GET['filters']['price']['GTE'] . "###" . $_GET['filters']['price']['LTE'];
			}
			if (isset($_GET['filters']['capacity'])) {
				foreach ($_GET['filters']['capacity'] as $key => $value) {
					$capacity = $value . "###";
				}
			}
			if (isset($_GET['filters']['type'])) {
				foreach ($_GET['filters']['type'] as $key => $value) {
					$type = $value . "###";
				}
			}
			if (isset($_GET['filters']['viscosity'])) {
				foreach ($_GET['filters']['viscosity'] as $key => $value) {
					$viscosity = $value . "###";
				}
			}
			$auth = Zend_Auth::getInstance()->setStorage(new Zend_Auth_Storage_Session('Zend_Auth_User'));
			if ($auth->hasIdentity()) {
				$modelUser = new User_Models_UserUser();
				$user = $modelUser->getUser($auth->getIdentity());
				$login = $user['login'];
			} else {
				$login = "Неавторизованный пользователь";
			}
			$data555['login'] = $login;
			$data555['brands'] = $brands;
			$data555['price'] = $price;
			$data555['type'] = $type;
			$data555['capacity'] = $capacity;
			$data555['viscosity'] = $viscosity;
			$data555['archive'] = 0;
			$data555['date'] = date("Y-m-d h:i:s", time());
			$data555['searchtype'] = 'oils';
			$oilsearch->saveSearch($data555);
			//echo '<pre>'; print_r($paginator); die; exit;
		}
		return $paginator;
	}

	/**
	 * Поиск масел по наименованию и описанию
	 *
	 * @param string $oil
	 * @return object
	 */
	public function searchOils($oil) {
		$http = new Engine_Controller_Request_Http();
		$page = $http->getParam('page');

		$table = $this->getDbTable();
		$oil = preg_replace("/[^a-zA-Zа-яА-Я0-9]/u", "", trim($oil));

		$select = $table->select()
			->where('display = ?', 1)
			->where('name_search LIKE "%' . $oil . '%" OR id LIKE "%' . ($oil - 60000) . '%"')
			->order('warehouse_snab DESC')
			->order('warehouse_tver DESC');
		$adapter = new Zend_Paginator_Adapter_DbSelect(
			$select
		);

		$paginator = new Engine_Paginator($adapter);
		$paginator->setItemCountPerPage(30);
		$paginator->setCurrentPageNumber($page);

		return $paginator;
	}

	public function getCurrentOil(array $items) {
		$table = $this->getDbTable();

		$select = $table->select()
			->where('id IN (?)', $items);
		//var_dump($select); die; exit;
		$result = $table->fetchAll($select);
		return $result;
	}

	public function issetOil($id) {
		$table = $this->getDbTable();

		$select = $table->select()
			->where('`base_id` = ?', $id)
			->limit('1');
		$result = $table->fetchRow($select);

		if (is_iterable($result)) {
			return $result['id'];
		} else {
			return false;
		}
	}

	public function saveOil($data, $updateType, $id = null) {

		if (null === $id) { //вставка новой записи
			$this->getDbTable()->insert($data);
		} else { //для существующей записи
			$this->getDbTable()->update($data, array('base_id = ?' => $id));
		}
	}

	public function deactivate() {
		$this->getDbTable()->update(array('active' => 0), '');
	}

	/**
	 * Поиск Масла по id
	 *
	 * @param int $id
	 * @return unknown
	 */
	public function getOilById($id) {
		$table = $this->getDbTable();

		$select = $table->select()
			->where('`id` = ?', $id)
			->limit('1');
		$result = $table->fetchRow($select);
		return $result;
	}

	public function getBaseNone() {
		$table = $this->getDbTable();

		$select = $table->select()
			->where('price_base = 0');
		$result = $table->fetchAll($select);
		return $result;
	}

	public function getRecNone() {
		$table = $this->getDbTable();

		$select = $table->select()
			->where('price_rec = 0');
		$result = $table->fetchAll($select);
		return $result;
	}

	public function getMasViscosity($param) {
		$viscosity = array(
			'0' => $param,
			'1' => substr($param, 0, strpos($param, 'W')) . "w" . substr($param, strpos($param, 'W') + 1),
			'2' => substr($param, 0, strpos($param, 'W')) . "w-" . substr($param, strpos($param, 'W') + 1),
			'3' => substr($param, 0, strpos($param, 'W')) . "W-" . substr($param, strpos($param, 'W') + 1)
		);
		return $viscosity;
	}

}
