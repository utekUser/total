<?php

class Oils_controllers_IndexController extends Core_Controller_Action_User {

	public function init() {
		$this->pageId = $this->_getUrl('urlToInt', 0);
		$this->url = $this->_getUrl('url', 0);
		if ($this->pageId) {
			Core_Controller_Action_User::setViewMain('view');
			Core_Controller_Action_User::setDefaultParseUrlAction('view');
		}
		$auth = Zend_Auth::getInstance()->setStorage(new Zend_Auth_Storage_Session('Zend_Auth_User'));
		if ($auth->hasIdentity()) {
			$userModel = new User_Models_UserInfo();
			$user = $userModel->getUserInfo($auth->getIdentity());
			if ($user['price_type'] == 1) {
				$this->view->priceType = 'recom';
			} elseif ($user['price_type'] == 0) {
				$this->view->priceType = 'base';
			}
		} else {
			$this->view->priceType = 'base';
		}
	}

	public function indexAction() {
		$this->view->filters = $filters = array(
			// Бренд
			'brands' => array(
				'name' => 'Бренд',
				'type' => 'checkbox',
				'values' => array(
					'Total' => 'Total',
					'Elf' => 'Elf',
				)
			),
			// Цена
			'price' => array(
				'name' => 'Цена',
				'type' => 'range',
				'from' => 'GTE',
				'to' => 'LTE',
				'value' => 'руб.',
			),
			// Тип
			'type' => array(
				'name' => 'Тип',
				'type' => 'checkbox',
				'values' => array(
					'вакуумное' => 'вакуумное',
					'гидравлическое' => 'гидравлическое',
					'компрессорное' => 'компрессорное',
					'многофункциональное' => 'многофункциональное',
					'моторное' => 'моторное',
					'редукторное' => 'редукторное',
					'смазка' => 'смазка',
					'теплоноситель' => 'теплоноситель',
					'трансмиссионное' => 'трансмиссионное',
					'турбинное' => 'турбинное',
				)
			),
			// Тип масла
			/* 'oil_type' => array(
			  'name' => 'Тип масла',
			  'type' => 'checkbox',
			  'values' => array(
			  'минеральное' => 'минеральное',
			  'полусинтетическое' => 'полусинтетическое',
			  'синтетическое' => 'синтетическое',
			  'универсальное' => 'универсальное',
			  'промывочное' => 'промывочное',
			  'гидрокрекинговое' => 'гидрокрекинговое',
			  /* 1 => 'минеральное',
			  2 => 'полусинтетическое',
			  3 => 'синтетическое',
			  4 => 'универсальное',
			  5 => 'промывочное',
			  6 => 'гидрокрекинговое', */
			/* 	)
			  ), */
			// Класс вязкости
			'viscosity' => array(
				'name' => 'Класс вязкости',
				'type' => 'checkbox',
				'values' => array(
					/* '0' => '0',
					  '00' => '00',
					  '000' => '000',
					  '1' => '1',
					  '2' => '2',
					  '3' => '3',
					  '5' => '5',
					  '10' => '10', */
					'15' => '15',
					'22' => '22',
					'32' => '32',
					'46' => '46',
					'68' => '68',
					'100' => '100',
					'150' => '150',
					'220' => '220',
					'320' => '320',
					'460' => '460',
					'680' => '680',
					'1000' => '1000',
					'0W20' => '0W20',
					'0W30' => '0W30',
					'0W40' => '0W40',
					'5W20' => '5W20',
					'5W30' => '5W30',
					'5W40' => '5W40',
					'5W50' => '5W50',
					'10W30' => '10W30',
					'10W40' => '10W40',
					'10W50' => '10W50',
					'10W60' => '10W60',
					'15W40' => '15W40',
					'15W50' => '15W50',
					'20W20' => '20W20',
					'20W40' => '20W40',
					'20W50' => '20W50',
					'20W60' => '20W60',
					'25W40' => '25W40',
					'SAE30' => 'SAE30',
				)
			),
			// Объем
			'capacity' => array(
				'name' => 'Объем',
				'type' => 'checkbox',
				'values' => array(
					'1' => '1',
					'2' => '2',
					'4' => '4',
					'5' => '5',
					'20' => '20',
					'60' => '60',
					'208' => '208',
				)
			),
		);
		//print_r($request); die;
		$http = new Engine_Controller_Request_Http();
		$this->view->page = $http->getParam('page');
		$auth = Zend_Auth::getInstance()->setStorage(new Zend_Auth_Storage_Session('Zend_Auth_User'));
		$this->view->user = $this->view->auth_id = $auth->getIdentity();
		if ($auth->hasIdentity()) {
			$desired = new Shop_Models_DesiredProduct();
			$this->view->desired = $desired->getProduct($this->view->user);
		} 
		$oilsModel = new Oils_Models_OilsOils();
		$sectionModel = new Oils_Models_OilsSection();
		$this->view->oilDescr = 1;
		$subsections = null;
		if ($this->url) {
			$section = $sectionModel->getSectionByUrl($this->url);
			$tree = array();
			$select = $sectionModel->getSection();
			foreach ($select as $value) {
				$tree[] = array(
					'id' => $value->id,
					'pid' => $value->parent
				);
			}

			$subsections = $sectionModel->getSubSections($tree, $section['id']);
			$subsections[] = $section['id'];

			$this->view->sectionName = $section['name'];
			$this->view->sectionInfo = $section['info'];
			$this->view->oilDescr = 0;
		} 
		$request = $this->getRequest();		
		if ($request->getQuery('oil')) { 
			$oil = $request->getQuery('oil');
			$this->view->oil = $oil;
			$this->view->paginator = $oilsModel->searchOils($oil);
			$this->view->paginator->pageParam = $this->view->pageParam . 123123123;
			$this->view->paginator->getView()->pageParam = $this->view->pageParam . 123123123;
			$this->view->paginator->getView()->view->pageParam = $this->view->pageParam . 123123123;

			$history = new Search_Models_History();
			$history->saveRequest(
				date("Y-m-d H:i:s"), $oil, 'oil', $this->view->paginator->getTotalItemCount(), $this->view->auth_id
			);
		} else {			
			$this->view->paginator = $oilsModel->getOils($subsections);			
		} 
		$tasks = new Core_Models_Tasks();
		//$tasks->getTime(1);
		$this->view->task = $tasks->getTime(1);
	}

	public function viewAction() {
		$auth = Zend_Auth::getInstance()->setStorage(new Zend_Auth_Storage_Session('Zend_Auth_User'));
		$this->view->auth_id = $auth->getIdentity();
		$id = $this->_getParam('urlToInt');
		$ttt = new Oils_Models_OilsOils();
		$this->view->oil = $ttt->getOilById($id);
		if ($auth->hasIdentity()) {
			$userModel = new User_Models_UserInfo();
			$user = $userModel->getUserInfo($auth->getIdentity());
			if ($user['price_type'] == 1) {
				$this->view->priceType = 'recom';
			} elseif ($user['price_type'] == 0) {
				$this->view->priceType = 'base';
			}
		} else {
			$this->view->priceType = 'base';
		}
	}

}
