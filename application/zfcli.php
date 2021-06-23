<?php

// Constants
define('_ENGINE', TRUE);
define('DS', DIRECTORY_SEPARATOR);
define('PS', PATH_SEPARATOR);

// Define full application path, environment, and name
defined('APPLICATION_PATH') || define('APPLICATION_PATH', realpath(dirname(dirname(__FILE__)))); // путь с главной категории
defined('APPLICATION_PATH_CORE') || define('APPLICATION_PATH_CORE', realpath(dirname(__FILE__))); // это с application
// Define application environment
// Определение текущего режима работы приложения
defined('APPLICATION_ENV') || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'development'));
//defined('APPLICATION_ENV') || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

ini_set('display_errors', 1); // Включаем вывод ошибок
error_reporting(E_ALL ^ E_NOTICE); // Уровень протоколирования ошибок
// Setup required include paths; optimized for Zend usage. Most other includes
// will use an absolute path
set_include_path(
	APPLICATION_PATH . DS . 'application' . DS . 'libraries' . PS .
	APPLICATION_PATH . DS . 'application' . DS . 'libraries' . DS . 'Zend' . PS .
	APPLICATION_PATH . DS . 'application' . DS . 'modules' . PS .
	APPLICATION_PATH . '/vendor/webtomsk/' .
	'.' // get_include_path()
);

require APPLICATION_PATH . '/vendor/autoload.php';

// Application
require_once APPLICATION_PATH . '/vendor/webtomsk/Engine/Loader.php';
require_once APPLICATION_PATH . '/vendor/webtomsk/Engine/Application.php';

$includePaths = array(dirname(dirname(__FILE__)) . '/vendor/zendframework/zendframework1/library');
array_push($includePaths, get_include_path());
set_include_path(join(PATH_SEPARATOR, $includePaths));

Engine_Loader::getInstance()
	// Libraries
	->register('Zend', APPLICATION_PATH . DS . 'application' . DS . 'libraries' . DS . 'Zend')
	->register('Zend', dirname(dirname(__FILE__)) . '/vendor/zendframework/zendframework1/library' . DS . 'Zend')
	->register('Engine', APPLICATION_PATH . '/vendor/webtomsk/Engine')
	->register('Module', APPLICATION_PATH . DS . 'application' . DS . 'modules')
;

Engine_Api::getInstance()->run();

if (PHP_SAPI === 'cli') {
	try {
		$opts = new Zend_Console_Getopt(
			array(
			'h' => 'This help',
			'a=s' => 'update',
			't=s' => 'disable | keep',
			)
		);
		$options = $opts->parse();
	} catch (Zend_Console_Getopt_Exception $e) {
		echo $e->getUsageMessage() . "!!!";
		exit;
	}
// Если вызвана справка
	if (isset($opts->h)) {
		echo $opts->getUsageMessage();
		exit;
	}

	$action = $opts->a;
	$type = $opts->t;
} else {
	$action = '';
	$type = '';

	if (isset($_GET['action'])) {
		$action = $_GET['action'];
	}
	if (isset($_GET['type'])) {
		$type = $_GET['type'];
	}
}

switch ($action) {
	case 'update':
		$status = false;

		try {
			$task = new Core_Plugin_Task_Shop();
			$task->execute($type);

			// Ok
			$status = true;
		} catch (Engine_Exception $e) {
			echo $e->getMessage() . "\n";
			// Log exception
			//            $this->getLog()->log($e->__toString(), Zend_Log::ERR);
			$status = false;
		}

		// Update task and release semaphore
		$statusKey = ($status ? 'success' : 'failure');
		$tasks = new Core_Models_DbTable_Tasks();
		$affected = $tasks->update(array(
			'semaphore' => new Zend_Db_Expr('semaphore - 1'),
			'completed_last' => time(),
			'completed_count' => new Zend_Db_Expr('completed_count + 1'),
			$statusKey . '_last' => time(),
			$statusKey . '_count' => new Zend_Db_Expr($statusKey . '_count + 1'),
			), array(
			//          'task_id = ?' => $task->task_id,
			'task_id = ?' => 1,
			//          'semaphore > ?' => 0,
		));
		break;
	case 'parse_oil':
		$oilsModel = new Oils_Models_OilsOils();
		$oils = $oilsModel->getAllOils();
		$oilsCount = count($oils);

		$countBrand = 0;
		$countViscosity = 0;
		$countCapacity = 0;
		$countType = 0;
		$countOilType = 0;

		foreach ($oils as $row) {
			$data = array();

			echo $row['id'] . ' - ' . $row['invoice_name'] . "\n";

			// Поиск бренда
			if (preg_match('/ (Elf|Total) /', $row['invoice_name'], $matches)) {
				$countBrand++;
				$data['brand'] = trim($matches[1]);
			}

			// Класс вязкости
			if (preg_match('/ (\d+w-?\d+) /Ui', $row['invoice_name'], $matches)) {
				$countViscosity++;
				$data['viscosity_grade'] = trim($matches[1]);
				//                var_dump($matches);
				//                exit;
			} else {
				//                echo $row['id'] . ' - ' . $row['invoice_name'] . "\n";
			}

			// Объем
			if (preg_match('/ (\d+) ?л\.?/Ui', $row['invoice_name'], $matches)) {
				$countCapacity++;
				$data['litr'] = trim($matches[1]);
			} else {
				//                echo $row['id'] . ' - ' . $row['invoice_name'] . "\n";
			}

			// Тип
			if (preg_match('/Масло ([\x{0410}-\x{042F}]+) (Total|Elf)/Uui', $row['invoice_name'], $matches)) {
				$countType++;
				$data['type'] = trim($matches[1]);
			} else {
				//                echo $row['id'] . ' - ' . $row['invoice_name'] . "\n";
			}

			// Тип масла
			if (preg_match('/(полусинт.|синт.|минер.|синтетическое  )/Ui', $row['invoice_name'], $matches)) {
				$countOilType++;
				$data['oil_type'] = trim($matches[1]);
			} else {
				//                echo $row['id'] . ' - ' . $row['invoice_name'] . "\n";
			}

			if (!empty($data)) {
				$oilsModel->getDbTable()->update($data, array('id = ?' => $row['id']));
			}
		}
		echo "Найдено брендов $countBrand из $oilsCount" . " (не найдено: " . ($oilsCount - $countBrand) . ")" . "\n";
		echo "Найдено вязкость $countViscosity из $oilsCount" . " (не найдено: " . ($oilsCount - $countViscosity) . ")" . "\n";
		echo "Найдено объем $countCapacity из $oilsCount" . " (не найдено: " . ($oilsCount - $countCapacity) . ")" . "\n";
		echo "Найдено тип $countType из $oilsCount" . " (не найдено: " . ($oilsCount - $countType) . ")" . "\n";
		echo "Найдено тип масла $countOilType из $oilsCount" . " (не найдено: " . ($oilsCount - $countOilType) . ")" . "\n";
		break;
	default:
		echo date('Y-m-d H:i:s') . ": action not found!\n";
}




$time = explode(":", date('H:i:s', time()));
if (($time[0] == "10") && ($time[1] == "30")) {
	$letter = "<h3>Уважаемый клиент!</h3><p>Напоминаем Вам, что у Вас имеются не оформленные заказы!</p>
		<p>Рекомендуем оформить заказ в течении трех дней.</p><p>По истечению данного срока выбранные Вами товары, будут удалены!</p>" . "<br>" . date('H:i:s', time());
	$subject = iconv('utf8', 'cp1251', 'Сообщение с сайта total.tomsk.ru');
	$toName = iconv('utf8', 'cp1251', 'Клиенту');
	$letter = iconv('utf8', 'cp1251', $letter);

	$shopSaveOrder = new Basket_Models_ShopSavedorder();
	$users = $shopSaveOrder->getUserIDsSaveOrder();
	$usInfo = new User_Models_UserUser();
	foreach ($users as $user) {
		$us = $usInfo->getUser($user['user_id']);
		$emails[] = $us['email'];
	}
	foreach ($emails as $email) {
		$emailPost = $email; //"turkov.dm@ya.ru"; 
		$mail = new Zend_Mail('windows-1251');
		$mail->setBodyHtml($letter);
		$mail->setFrom("no-reply@total.tomsk.ru");
		$mail->addTo($emailPost, $toName);
		$mail->setSubject($subject);
		$mail->send();
	}
}



/* SMS рассылка менеджерам */
$modelUser = new User_Models_UserUser();
$modelOrder = new Shop_Models_OrderOrder();
$modelManager = new Shop_Models_OrderManager();
$orders = $modelOrder->getOrdersWhereSmsNotSend();
foreach ($orders as $order) {
	$user = $modelUser->getUserByLogin($order['customer_login']);
	if ($user['manager_id'] != 0) {
		$manager = $modelManager->getManagerById($user['manager_id']);
		if (strlen($manager['manager_phone']) > 9) {

			//$message = "ИД: " . $order['id'] . ". Сумма: " . $order['total_sum'] . "руб. Компания: " . $order['company_name'] . "; " . $order['comment'];
			$message = $order['id'] . " на " . $order['total_sum'] . "р от " . $order['company_name'];

			$ch = curl_init("https://sms.ru/sms/send?json=1");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_TIMEOUT, 30);

			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

			curl_setopt($ch, CURLOPT_VERBOSE, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
				"api_id" => "C86FACF4-2343-2EFD-6706-92724FB2CEF8",
				"to" => $manager['manager_phone'],
				"msg" => $message, //iconv("windows-1251", "utf-8", "Привет!"),
			)));
			$body = curl_exec($ch);
			if ($body === FALSE) {
				$error = curl_error($ch);
			} else {
				$error = FALSE;
			}
			curl_close($ch);
			/*if ($error) {
				echo "<pre>";
				print_r($error);
				echo "</pre>";
				die;
			}*/
			$json = json_decode($body);
			if ($json) {
				if ($json->status == "OK") {
					foreach ($json->sms as $phone => $data) {
						if ($data->status == "OK") {
							$modelOrder->setSmsStatus($order['id']);
							//echo "Сообщение на номер $phone успешно отправлено. ";
							//echo "ID сообщения: $data->sms_id. ";
							//echo "";
						} else {
							//echo "Сообщение на номер $phone не отправлено. ";
							//echo "Код ошибки: $data->status_code. ";
							//echo "Текст ошибки: $data->status_text. ";
							//echo "";
						}
					}
					//echo "Баланс после отправки: $json->balance руб.";
					//echo "";
				} else {
					//echo "Запрос не выполнился. ";
					//echo "Код ошибки: $json->status_code. ";
					//echo "Текст ошибки: $json->status_text. ";
				}
				//echo "</pre>";
			} else {
				//echo "Смс запрос не выполнился. Не удалось установить связь с сервером. ";
			}
		}
	}
}
?>