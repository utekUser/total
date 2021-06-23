<?php
class Filtron_Controllers_AdminFiltronController extends Core_Controller_Action_Admin {
    protected $_path = array(
        'filtron' => 'Товары Filtron'
    );
    /**
     * Редиректор - определен для полноты кода
     *
     * @var Zend_Controller_Action_Helper_Redirector
     */
    protected $_redirector = null;
    
    protected $_form = array(
        'Filtron_Form_Article',
        'Filtron_Form_Section',
    ); // Классы для создания и/или обновления таблиц в БД
    
    /**
     * Инициализация
     */
    public function init() {
        $this->_redirector = $this->_helper->getHelper('Redirector');
    }
   
    /**
     * Главная, листинг
     */
    public function indexAction() {
        $module = array(
            'section' => 'Категории Filtron',
            'article' => 'Товары Filtron'
        );        
        $this->view->module = $module;
		$this->view->itIsFiltron = 1;
    }
    
    /**
     * Добавление
     */
    public function addAction() {
        $pageId = $this->_getParam('pageId');        
        $request = $this->getRequest(); // получение объекта запроса Engine_Controller_Request_Http
        
        $form = new Texts_Form_Texts();
        if ($request->isPost()) { // если был POST запрос
            if ($form->isValid($request->getPost())) {
                $model = new Texts_Models_Texts();
                $model->save($form->getElements(), $pageId);                
//              $form->filename->receive();                
                $this->_redirector->gotoActionUrl('/admin/', $model->getInsertId());
            }
        }
        $this->view->elements = $form->getElements();
    }
    
    /**
     * Редактирование
     */
    public function editAction() {
        $request = $this->getRequest(); // получение объекта запроса Engine_Controller_Request_Http
        
        $pageId = $this->_getParam('pageId');
        $model = new Texts_Models_Texts();
        $rrr = $model->getRecord($pageId);

        $form = new Texts_Form_Texts();

        foreach ($form->getElements() as $value) {
            $nnn = $value->getName();
            $value->setValue($rrr->$nnn);
        }        
        if ($request->isPost()) { // если был POST запрос
            if ($form->isValid($request->getPost())) {
                $model = new Texts_Models_Texts();
                $model->save($form->getElements(), $pageId);                
                $this->_redirector->gotoActionUrl('/admin/', $model->getInsertId());
            }
        }
        $this->view->id = $pageId;
        $this->view->elements = $form->getElements();
    }
    
    /**
     * Удаление
     */
    public function deleteAction() {
        $pageId = $this->_getParam('pageId');        
        $model = new Texts_Models_Texts();
        $model->listAction($pageId, 'delete');        
        $this->_redirector->gotoActionUrl('/admin/texts/');
    }
}