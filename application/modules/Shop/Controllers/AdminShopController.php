<?php
class Shop_Controllers_AdminShopController extends Core_Controller_Action_Admin {
    protected $_path = array(
        'shop' => 'Магазин'
    );
    /**
     * Редиректор - определен для полноты кода
     *
     * @var Zend_Controller_Action_Helper_Redirector
     */
    protected $_redirector = null;
    
    protected $_form = array(
        'Shop_Form_Order',
        'Shop_Form_OrderComposition',
        'Shop_Form_OrderStatus',
        'Shop_Form_OrderTransaction'
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
            'order'    => 'Заказы',
            'settings' => 'Настройки магазина',
            'catalog' => 'Торговый каталог',
            'manager' => 'Менеджеры',
        );
        
        $this->view->module = $module;
    }
        
}