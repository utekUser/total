<?php

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
			$ch = curl_init("https://sms.ru/sms/send");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_TIMEOUT, 30);
			$message = "ИД: " . $order['id'] . ". Сумма: " .  $order['total_sum'] . "руб. Компания: " . $order['company_name'] . "; " . $order['comment'];
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
				"api_id" => "C86FACF4-2343-2EFD-6706-92724FB2CEF8",
				"to" => $manager['manager_phone'],/*79234061564*/
				"msg" => $message,
				"json" => 1
			)));			
			$body = curl_exec($ch);
			curl_close($ch);			
			$json = json_decode($body);
			if ($json) {
				//echo "<pre>";
				//print_r($json);
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
/*$ch = curl_init("https://sms.ru/sms/send");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
    "api_id" => "C86FACF4-2343-2EFD-6706-92724FB2CEF8",
    "to" => "79234061564", // До 100 штук до раз
    "msg" => "Привет!", //iconv("windows-1251", "utf-8", "Привет!"), // Если приходят крякозябры, то уберите iconv и оставьте только "Привет!",
    /*
    // Если вы хотите отправлять разные тексты на разные номера, воспользуйтесь этим кодом. В этом случае to и msg нужно убрать.
    "multi" => array( // до 100 штук за раз
        "79610979207"=> iconv("windows-1251", "utf-8", "Привет 1"), // Если приходят крякозябры, то уберите iconv и оставьте только "Привет!",
        "74993221627"=> iconv("windows-1251", "utf-8", "Привет 2") 
    ),
    */
    /*"json" => 1 // Для получения более развернутого ответа от сервера
)));
$body = curl_exec($ch);
curl_close($ch);

$json = json_decode($body);
if ($json) { // Получен ответ от сервера
    print_r($json); // Для дебага
    if ($json->status == "OK") { // Запрос выполнился
        foreach ($json->sms as $phone => $data) { // Перебираем массив СМС сообщений
            if ($data->status == "OK") { // Сообщение отправлено
                echo "Сообщение на номер $phone успешно отправлено. ";
                echo "ID сообщения: $data->sms_id. ";
                echo "";
            } else { // Ошибка в отправке
                echo "Сообщение на номер $phone не отправлено. ";
                echo "Код ошибки: $data->status_code. ";
                echo "Текст ошибки: $data->status_text. ";
                echo "";
            }
        }
        echo "Баланс после отправки: $json->balance руб.";
        echo "";
    } else { // Запрос не выполнился (возможно ошибка авторизации, параметрах, итд...)
        echo "Запрос не выполнился. ";      
        echo "Код ошибки: $json->status_code. ";
        echo "Текст ошибки: $json->status_text. ";
    }
} else { 
    echo "Запрос не выполнился. Не удалось установить связь с сервером. ";
}*/

?>