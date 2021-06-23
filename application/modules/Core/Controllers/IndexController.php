<?php

/* ВЫВЕСТ�? В Engine_Controller url и Layout как у Zend_Controller_action */

//class Texts_Controllers_AdminController extends Engine_Controller_Action_Admin {
class Core_Controllers_IndexController extends Core_Controller_Action_User {

    protected $_pageId;
    protected $_form = array(
//        'Texts_Form_Texts'
    ); // Классы дял создания и/или обновления таблиц в БД

    /**
     * �?нициализация
     *
     */

    public function init() { 
        exit;
    }

    public function setId($id) {
        $this->_pageId = $id;
    }

    /**
     * Главная, листинг
     *
     */
    public function indexAction() {		
        if (isset($_GET['callme']) && (count($_POST) > 0)) {			
			if (isset($_POST['callmechartotalby'])) { 	
				//print_r($_POST); echo mb_strlen($_POST['callmechartotalby']); die;	
				$url = 'https://www.google.com/recaptcha/api/siteverify';
				$secret = '6LfqKxQUAAAAAJny0CZpvW6-t-pRtxxoujwoZf-u';
				if (isset($_POST['g-recaptcha-response'])) {
					$recaptcha = $_POST['g-recaptcha-response'];
				}
				$ip = $_SERVER['REMOTE_ADDR'];			
				$url_data = $url . '?secret=' . $secret . '&response=' . $recaptcha . '&remoteip=' . $ip;
				$curl = curl_init();			
				curl_setopt($curl, CURLOPT_URL, $url_data);
				curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);			
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);			
				$res = curl_exec($curl);
				curl_close($curl);			
				$res = json_decode($res);
			
				if($res->success) {
					if (mb_strlen($_POST['callmechartotalby']) == 2) {
						//echo "lol"; die;
						if ((strlen($_POST['antispam']) == 0) && ($_POST['callmephonetotalby'] != "123456")) {
							
							$mod = new Callme_Models_Callme();
							$data['name'] = $_POST['callmenametotalby'];
							$data['phone'] = $_POST['callmephonetotalby'];
							$data['comment'] = $_POST['callmecommenttotalby'];
							$mod->saveCallorder($data);

							$headers = "MIME-Version: 1.0\r\n";
							$headers .= "Content-type: text/html; charset=utf-8\r\n";
							$headers .= "From: Total - Заказать обратный звонок <no-reply@total.tomsk.ru>\r\n";
							$subject = "Письмо с сайта Total - Заказать обратный звонок";
							$message = '<html><head><title>' . $subject . '</title></head><body>
							<p>Уважаемый, Администратор!</p>
							<p>В раздел "Заказать обратный звонок" поступила новая заявка:</p>
							<strong>Контактное лицо: </strong> ' . $data['name'] . '<br>
							<strong>Телефон:</strong> ' . $data['phone'] . '<br>
							<strong>Сообщение:</strong> ' . $data['comment'] . '<br>
							<p>____________________________________________</p>				
							</body></html>';
							$mailReplay = Engine_Cms::setupValue('callme');        
							$to = explode(',', $mailReplay);
							//$to = array('turkov.dm@yandex.ru');

							if (!is_array($to)) {
								$to = array($to);
							}
							foreach ($to as $email) {
								mail($email, $subject, $message, mb_convert_encoding($headers, 'windows-1251', mb_detect_encoding($headers)));
							}
						}
					}
				
				}
			}
        }
        $get = new Sitemap_Models_Sitemap();
        $this->view->text = $get->getContent($this->_pageId);
    }

    /**
     * Добавление
     *
     */
    public function addAction() {
        $request = $this->getRequest(); // получение объекта запроса...
        $form = new Texts_Form_Texts();

        if ($request->isPost()) {
            echo "!!!!!!!!!!!!!!!!!";
        }

        $this->view->elements = $form->getElements();
        echo "<pre>";
        print_r($_POST);
        echo "</pre>";
        return true;

//        echo "<pre>";
//        print_r($request);
//        echo "</pre>";
//        exit;





        $form = new Texts_Form_Texts();
        $this->view->elements = $form->getElements();

        ////////
        $request = $this->getRequest();
        $form = new Application_Form_Guestbook();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $comment = new Application_Model_Guestbook($form->getValues());
                $mapper = new Application_Model_GuestbookMapper();
                $mapper->save($comment);
                return $this->_helper->redirector('index');
            }
        }

        $this->view->form = $form;
        /////////
    }

    public function errorAction() {
        
    }

    /**
     * �?зменение
     *
     */
    public function editAction() {
        $pageId = $this->_getParam('pageId');
        $model = new Texts_Models_Texts();
        $rrr = $model->getRecord($pageId);
//            echo "<pre>";
//            print_r($rrr);    
//            echo "</pre>";   
        $form = new Texts_Form_Texts();
//        $this->view->elements = $form->getElements();
        foreach ($form->getElements() as $value) {
            $nnn = $value->getName();
            $value->setValue($rrr->$nnn);
//            echo "<pre>";
//            print_r($value);    
//            echo "</pre>";    
        }
        $this->view->elements = $form->getElements();
//        exit;
//        for ($i=0; $i<count($this->fields);$i++) {
        // ��� ��� ���� ������ ��������������!
//            Engine_Vars::setRequest($this->fields[$i]->name, $row[$this->fields[$i]->name]);
//            echo $this->fields[$i]->name . ": " . $row[$this->fields[$i]->name] . "<br />";
//            $this->fields[$i]->value = $row[$this->fields[$i]->name];
//            $this->fields[$i]->exec();
//        }
//        echo "<pre>";
//        print_r($rrr);
//        echo "</pre>";
    }

    /**
     * Удаление
     *
     */
    public function deleteAction() {
        
    }

}
