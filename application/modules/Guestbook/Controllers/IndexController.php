<?php
class Guestbook_controllers_IndexController extends Core_Controller_Action_User {
    /**
     * Главная страница
     *
     */
    public function indexAction() {
        $model = new Guestbook_Models_Guestbook();
        
        $request = $this->getRequest(); // получение объекта запроса Engine_Controller_Request_Http
        
        $form = new Guestbook_Form_Guestbook();
        $form->addElement(new Engine_Form_Element_Captcha('captcha')); // Добавляем капчу
        
        
                
        if ($request->isPost()) { // если был POST запрос
            if ($form->isValid($request->getPost())) {
                $model = new Guestbook_Models_Guestbook();
                $model->saveBook($form->getElements());
                
                $elements = $form->getElements();
                $id = $model->getDbTable()->getAdapter()->lastInsertId();
                
                
                $mailReplay = Engine_Cms::setupValue('guestbook');
//                echo $mailReplay; exit;
                if ($mailReplay != ''){
                    $mailSend = explode(',', $mailReplay);
                    
                    $patterns[0] = '/{site}/';
                    $patterns[1] = '/{id}/';
                    $patterns[2] = '/{date}/';
                    $patterns[3] = '/{author}/';
                    $patterns[4] = '/{mail}/';
                    $patterns[5] = '/{message}/';
                    $patterns[6] = '/{ip}/';
                    
                    $patterns[7] = '/{module}/';
                    
                    $replacements[0] = $_SERVER['HTTP_HOST'];
                    $replacements[1] = $id;
                    $replacements[2] = Engine_View_Helper_Date::getDateAndTime(date('Y-m-d H:i:s'));
                    $replacements[3] = htmlspecialchars($elements['author']->getValue());
                    $replacements[4] = htmlspecialchars($elements['email']->getValue());
                    $replacements[5] = htmlspecialchars($elements['question']->getValue());
                    $replacements[6] = $_SERVER['REMOTE_ADDR'];
                    
                    $replacements[7] = 'guestbook';
                    
                    $letter = file_get_contents(APPLICATION_PATH . '/public/templates/book-mail.txt');
        
                    $letter = preg_replace($patterns, $replacements, $letter);
                    
                    $subject = iconv('utf8', 'cp1251', 'Сообщение с сайта http://' . $replacements[0] . '/');
                    $letter = iconv('utf8', 'cp1251', $letter);
                    $fromName = iconv('utf8', 'cp1251', 'Томавтотрейд');
                    $toName = iconv('utf8', 'cp1251', 'Администратору');
                    
                    
                    foreach ($mailSend as $key => $value) {
                        $emailPost = trim($value);
                        if ($emailPost != '') {
                        	$mail = new Zend_Mail('windows-1251');
                        	$mail->setBodyHtml($letter);
                        	$mail->setFrom("guestbook@total.tomauto.ru");
                        	$mail->addTo($emailPost, $toName);
                        	$mail->setSubject($subject);
                        	$mail->send();
                        }
                    }
                }
                
                $this->_redirector->gotoUrl('/guestbook/success/');
            }
        }
        
        $this->view->elements = $form->getElements();
        $this->view->paginator = $model->getBook();
        
        $this->view->form = $form;
    }
    
    /**
     * Успешно
     *
     */
    public function successAction() { }
}