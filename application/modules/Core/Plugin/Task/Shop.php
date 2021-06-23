<?php

/**
 * Обновление базы магазина с 1С
 *
 * Выгрузка с 1С осуществляется с Пн по Вс с 7:00 до 19:00 каждые 2 часа.
 * (7:00, 9:00, 11:00, 13:00, 15:00, 17:00, 19:00)
 */
class Core_Plugin_Task_Shop extends Core_Plugin_Task_Abstract {

	/**
	 * Выбор действия и запуск задачи
	 *
	 * @param string $t
	 * @return Core_Plugin_Job_Abstract|void
	 * @throws Engine_Exception
	 */
	public function execute($t = 'keep') {
		ini_set('max_execution_time', 600);
		header("Content-Type: text/html; charset=utf-8");
		/**
		 *        echo "Импорт товаров с 1С.\n";
		 *
		 *        $ftp_server = "217.18.133.15";
		 *        $ftp_user   = "wt4014953";
		 *        $ftp_pass   = "BoqHhLu3";

		  ini_set("display_errors","1");
		  ini_set("display_startup_errors","1");
		  ini_set('error_reporting', E_ALL); */
		echo "Импорт товаров с 1С.\n";
		$ftp_server = "109.197.127.101";
		$ftp_user = "total";
		$ftp_pass = "9.6%~2)?O]kCQ:.7WF]N";
		echo "Соединение с $ftp_server... ";
		if (!$conn_id = ftp_connect($ftp_server, 21, 30)) {
			//mail("info@helpdesk70.ru", "Сервер выгрузки 1С недоступен!", "Сервер выгрузки 1С недоступен!");
			throw new Engine_Exception("Couldn't connect to $ftp_server");
		} else {
			echo "подключен.\n";
		}
		echo "Вход на $ftp_user@$ftp_server... ";
		// try to login
		if (@ftp_login($conn_id, $ftp_user, $ftp_pass)) {
			echo "успешно.\n";
		} else {
			//mail("info@helpdesk70.ru", "Сервер выгрузки 1С недоступен (try to login)!", "Сервер выгрузки 1С недоступен (try to login)!");
			throw new Engine_Exception("Couldn't connect as $ftp_user");
		}
		// define some variables
		$local_file = APPLICATION_PATH . '/temporary/catalog/temp.xml';
		$server_file = 'ostatki_na_sklade_v8.xml'; // его копируем
		$timeModifyFile = ftp_mdtm($conn_id, $server_file);
		/* if ($timeModifyFile) {
		  // Изменялся ли файл?
		  $fileCounter = APPLICATION_PATH . '/temporary/catalog/' . 'catalog.counter';
		  if (!file_exists($fileCounter)) {
		  if (is_writable(dirname($fileCounter))) {
		  $handle = fopen($fileCounter, 'w+');
		  }
		  } else {
		  $handle = fopen($fileCounter, 'r+');
		  $data = fread($handle, filesize($fileCounter));
		  echo "$data\n";
		  echo "$timeModifyFile\n";
		  fseek($handle, 0);


		  echo "Последние изменения файла... ";
		  if ($data == $timeModifyFile) {
		  //mail("info@helpdesk70.ru", "Изменений в выгружаемом файле не было!", "Изменений в выгружаемом файле не было!");
		  echo "не было.\n";
		  throw new Engine_Exception("Couldn't connect as $ftp_user");
		  } else {
		  echo "изменен.\n";
		  }
		  }

		  fwrite($handle, $timeModifyFile);
		  fclose($handle);

		  // More 3 hours
		  if ((time() - $timeModifyFile) > 10800) {
		  //mail("info@helpdesk70.ru", "Дата последней модификации файла $server_file : больше 3х часов!", "Дата последней модификации файла $server_file : больше 3х часов!");
		  throw new Engine_Exception("There was a problem\n");
		  }
		  } else {
		  //mail("info@helpdesk70.ru", "Не удалось выполнить mdtime!", "Не удалось выполнить mdtime!");
		  throw new Engine_Exception("There was a problem\n");
		  } */
		echo "Загрузка и сохранение удаленного файла... ";
		if (ftp_get($conn_id, $local_file, $server_file, FTP_BINARY)) {
			echo "готово.\n";
		} else {
			mail("pom001@yandex.ru", "Отсутствует или не читается файл выгрузки 1С!", "Отсутствует или не читается файл выгрузки 1С!");
			throw new Engine_Exception("There was a problem\n");
		}
		// close the connection
		ftp_close($conn_id);

		echo "Действие с товарами, которых нет в файле данных: ";
		if ($t == 'keep') {
			$updateType = 'leave'; // Оставить как есть
			echo "оставить как есть.\n";
		} else {
			$updateType = 'deact'; // Деактивировать
			echo "деактивировать.\n";
		}
		echo "Импорт товаров... ";
		$xml = APPLICATION_PATH . '/temporary/catalog/temp.xml';
		if (file_exists($xml)) {
			$xml = simplexml_load_file($xml);
			if (!$xml) {
				echo "XML файл скорее всего поврежден!\n";
				exit;
			}
			$oilModel = new Oils_Models_OilsOils();
			$filterModel = new Filters_Models_FiltersFilters();
			$plugModel = new Plug_Models_Plug();
			$coolstreamModel = new Coolstream_Models_Coolstream();
			$autopartsModel = new Autoparts_Models_Autoparts();
			$efeleModel = new Efeles_Models_EfeleArticle();
			$filtronModel = new Filtron_Models_Article();
			if ($updateType == 'deact') {
				$oilModel->deactivate();
				$filterModel->deactivate();
				$plugModel->deactivate();
				$coolstreamModel->deactivate();
				$autopartsModel->deactivate();
				//$efeleModel->deactivate();
				//$filtronModel->deactivate();
			}
			$k = 0;
			foreach ($xml->Root->items as $key => $value) {
				foreach ($value->attributes() as $attributeskey => $attributesvalue) {
					for ($i = 0; $i < sizeof($value->item); $i++) {
						$k++;
						$base_id = (string) $value->item[$i]->Id;
						$tver = "55555";
						$snab = "55555";
						$snabfilt = "55555";
						$skl1Rozn = "0.0";
						$skl3Zapc = "0.0";
						foreach ($value->item[$i]->Warehouses as $keyWare => $valueWare) {  //echo sizeof($valueWare->Warehouse); die;	
							for ($kk = 0; $kk < sizeof($valueWare->Warehouse); $kk++) {
								//echo $valueWare->Warehouse[$kk]->Code . "<br>";
								if ((string) $valueWare->Warehouse[$kk]->Code == "e56f8fe0-554b-11e2-97c2-902b3434345c") {
									$tver = (string) $valueWare->Warehouse[$kk]->Quantity;
								} elseif ((string) $valueWare->Warehouse[$kk]->Code == "d88799bb-554b-11e2-97c2-902b3434345c") {
									$snab = (string) $valueWare->Warehouse[$kk]->Quantity;
								} elseif ((string) $valueWare->Warehouse[$kk]->Code == "0adc142a-554b-11e2-97c2-902b3434345c") {
									//echo (string) $valueWare->Warehouse[$k]->Quantity; die;
									$skl1Rozn = (string) $valueWare->Warehouse[$kk]->Quantity;
								} elseif ((string) $valueWare->Warehouse[$kk]->Code == "d2375321-554b-11e2-97c2-902b3434345c") {
									$skl3Zapc = (string) $valueWare->Warehouse[$kk]->Quantity;
								} else {
									$snabfilt = (string) $valueWare->Warehouse[$kk]->Quantity;
								}
							}
						} //die;
						$data = array(
							'base_id' => $base_id,
							'active' => 1,
							'display' => 1,
							'name' => (string) $value->item[$i]->Name,
							'full_name' => (string) $value->item[$i]->FullName,
							'invoice_name' => (string) $value->item[$i]->InvoiceName,
							'name_search' => preg_replace("/[^a-zA-Zа-яА-Я0-9]/u", "", (string) $value->item[$i]->InvoiceName),
							//'env'          => (string) $value->item[$i]->env,
							'price_base' => $this->xml_attribute($value->item[$i]->Prices->Price, 'Base'),
							'warehouse_tver' => $tver,
							'warehouse_snab' => $snab,
							'warehouse_snabfilt' => $snabfilt,
						);
						if ($attributesvalue == 'Масла ELF' || $attributesvalue == 'Масла TOTAL') {
							$data['price_rec'] = $this->xml_attribute($value->item[$i]->Prices->Price, 'Total1');
							if ($oilModel->issetOil($base_id)) {
								$oilModel->saveOil($data, $updateType, $base_id);
							} else {
								$oilModel->saveOil($data, $updateType);
							}
						} elseif ($attributesvalue == 'MANN фильтры.') {
							$data['price_rec'] = $this->xml_attribute($value->item[$i]->Prices->Price, 'Mannрекомен');
							$data['mann1'] = $this->xml_attribute($value->item[$i]->Prices->Price, 'MannIколруб');
							$data['code'] = (string) $value->item[$i]->Name;
							if ($filterModel->issetFilter($base_id)) {
								$filterModel->saveFilter($data, $updateType, $base_id);
							} else {
								$filterModel->saveFilter($data, $updateType);
							}
						} elseif ($attributesvalue == 'МОТОГАММА') { //} elseif ($attributesvalue == 'Свечи') { //($attributesvalue == 'Свечи NGK') {				
							$data['total1'] = $this->xml_attribute($value->item[$i]->Prices->Price, 'Total1');
							/* $data['price_ngk1'] = $this->xml_attribute($value->item[$i]->Prices->Price, 'NGK1');
							  $data['price_ngk2'] = $this->xml_attribute($value->item[$i]->Prices->Price, 'NGK2');
							  $data['price_ngk3'] = $this->xml_attribute($value->item[$i]->Prices->Price, 'NGK3'); */
							if ($plugModel->issetPlug($base_id)) {
								$plugModel->savePlug($data, $base_id);
							} else {
								$plugModel->savePlug($data);
							}
						} elseif ($attributesvalue == 'COOLStream ОЖ') {
							$data['articlesaler'] = (string) $value->item[$i]->Art;
							$data['total1'] = $this->xml_attribute($value->item[$i]->Prices->Price, 'Total1');
							if ($coolstreamModel->issetCoolstream($base_id)) {
								$coolstreamModel->saveCoolstream($data, $base_id);
							} else {
								$coolstreamModel->saveCoolstream($data);
							}
						} elseif ($attributesvalue == 'АВТОЗАПЧАСТИ') {
							$data['warehouse_skl1'] = $skl1Rozn;
							$data['warehouse_skl3'] = $skl3Zapc;
							$data['articlesaler'] = (string) $value->item[$i]->Art;
							$data['total1'] = $this->xml_attribute($value->item[$i]->Prices->Price, 'Total1');
							if ($autopartsModel->issetAutoparts($base_id)) {
								$autopartsModel->saveAutoparts($data, $base_id);
							} else {
								$autopartsModel->saveAutoparts($data);
							}
						} elseif ($attributesvalue == 'EFELE') {
							$data['price_rec'] = $this->xml_attribute($value->item[$i]->Prices->Price, 'Total1');
							if ($efeleModel->issetEfele($base_id)) {
								$efeleModel->saveEfele($data, $updateType, $base_id);
							} else {
								$efeleModel->saveEfele($data, $updateType);
							}
						} elseif ($attributesvalue == 'FILTRON') {
							$data['price_rec'] = $this->xml_attribute($value->item[$i]->Prices->Price, 'Mannрекомен');
							if ($filtronModel->issetFiltron($base_id)) {
								$filtronModel->saveFiltron($data, $updateType, $base_id);
							} else {
								$filtronModel->saveFiltron($data, $updateType);
							}
						}	
						echo $base_id . " ";
					}					
				}
			}
			if ($updateType == 'deact') {
				$oilModel->getDbTable()->update(array('display' => new Zend_Db_Expr('`active`')), '');
				$filterModel->getDbTable()->update(array('display' => new Zend_Db_Expr('`active`')), '');
				$plugModel->getDbTable()->update(array('display' => new Zend_Db_Expr('`active`')), '');
			}
			//mail("turkov.dm@yandex.ru", "Обновление: успешно. Обработано записей: $k", "Обновление: успешно. Обработано записей: $k");
			echo "выполнено. ";
			echo "Обработано записей: $k\n";
		} else {
			
		}
	}

	/**
	 * Получение значение атрибута и с конвертирование его в строку
	 *
	 * @param object $object
	 * @param string $attribute
	 *
	 * @return string
	 */
	public function xml_attribute($object, $attribute) {
		if (isset($object[$attribute])) {
			return (string) $object[$attribute];
		}
	}

}
