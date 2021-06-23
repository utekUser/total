<?php
class User_Controllers_AdminUserMaildeliveryController extends Core_Controller_Action_Admin
{
    
	public function indexAction() {
		$request = $this->getRequest();
		$userModel = new User_Models_UserUser();
		if ($request->getQuery('emailto') == "0" || $request->getQuery('emailto') == "1") {
			$users = $userModel->getUsersByType($request->getQuery('emailto'));					
			//$mailSend = array("turkov.dm@ya.ru", "balbec90@gmail.com", "tda@2i.tusur.ru", "www.turkov@mail.ru");
			//$toName = "Туркову Д.А.";
			$letter = str_replace("../../..", "http://total.tomsk.ru", $request->getQuery('emailtext'));
			$lettertext = iconv('utf8', 'cp1251', $letter);
			foreach ($users as $key => $value) {
                $emailPost = trim($value['email']);
				$toName = $value['login'];				
                if ($emailPost != '') {
 					$subject = iconv('utf8', 'cp1251', $request->getQuery('emailtheme'));
					$message = '
						<html>
						<head>
						  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
						  <title>' . $request->getQuery('emailtheme') . '</title>
						</head>
						<body>' . $lettertext . '</body></html>';
					$headers  = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type: text/html; charset=cp1251' . "\r\n";
					//$headers .= 'To: ' . $toName . ' <' . $emailPost . '>' . "\r\n";
					$headers .= 'From: ' . iconv('utf8', 'cp1251', 'Рассылка TOTAL Томск') . ' <no-reply@total.tomsk.ru>' . "\r\n";
					mail($emailPost, $subject, $message, $headers);
                }        
            }
		} else {
			
		}		
    }
	
}