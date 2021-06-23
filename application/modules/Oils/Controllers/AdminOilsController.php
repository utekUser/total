<?php
class Oils_Controllers_AdminOilsController extends Core_Controller_Action_Admin {
    protected $_path = array(
        'Oils' => 'Автомасла'
    );
    /**
     * Редиректор - определен для полноты кода
     *
     * @var Zend_Controller_Action_Helper_Redirector
     */
    protected $_redirector = null;
    
    protected $_form = array(
        'Oils_Form_OilsSection',
        'Oils_Form_OilsOils'
    ); 
    
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
            'section' => 'Разделы',
            'oils' => 'Продукция'
        );
        $this->view->module = $module;
    }   
    
}