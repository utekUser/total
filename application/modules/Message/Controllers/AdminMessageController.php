<?php
class Message_Controllers_AdminMessageController extends Core_Controller_Action_Admin {
    protected $_path = array(
        'message' => 'Сообщения'
    );
    /**
     * Редиректор - определен для полноты кода
     *
     * @var Zend_Controller_Action_Helper_Redirector
     */
    protected $_redirector = null;
    
    protected $_form = array(
        'Message_Form_MessageMessages',
        'Message_Form_MessageConversations',
        'Message_Form_MessageRecipients'
    ); // Классы для создания и/или обновления таблиц в БД
    
    /**
     * Инициализация
     *
     */
    public function init() {
        $this->_redirector = $this->_helper->getHelper('Redirector');
    }
   
    /**
     * Главная, листинг
     *
     */
    public function indexAction() {
        $module = array(
            'messages' => 'Сообщения',
            'conversations' => 'conversations',
            'recipients' => 'recipients'
        );
        
        $this->view->module = $module;
    }
    
    
}