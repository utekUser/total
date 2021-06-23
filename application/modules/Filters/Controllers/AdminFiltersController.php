<?php
class Filters_Controllers_AdminFiltersController extends Core_Controller_Action_Admin {
    protected $_path = array(
        'filters' => 'Фильтра'
    );
    /**
     * Редиректор - определен для полноты кода
     *
     * @var Zend_Controller_Action_Helper_Redirector
     */
    protected $_redirector = null;
    
    protected $_form = array(
        'Filters_Form_FiltersFilters',
        'Filters_Form_FiltersSection',
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
            'section' => 'Типы фильтров',
            'filters' => 'Фильтра'
        );
        
        $this->view->module = $module;
    }
  
}