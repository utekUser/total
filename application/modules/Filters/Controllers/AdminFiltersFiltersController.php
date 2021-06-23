<?php
class Filters_Controllers_AdminFiltersFiltersController extends Core_Controller_Action_Admin {
    /**
     * Редиректор - определен для полноты кода
     *
     * @var Zend_Controller_Action_Helper_Redirector
     */
    protected $_redirector = null;
    
    protected $_form = array(
        'Filters_Form_FiltersFilters'
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
        $request = $this->getRequest(); // получение объекта запроса Engine_Controller_Request_Http
        
        $array = array('name', 'active');
        $form = new Filters_Form_FiltersFilters();
        $form->setTitle($array);
        $this->view->titles = $form->getTitle();
        
        if ($request->isPost()) { // если был POST запрос
            $request = $request->getPost();
            $model = new Filters_Models_FiltersFilters();
            $model->listAction($request['type'], $request['submit_mult']);
            
            $this->_redirector->gotoActionUrl('/admin/');
        }
        
        $ttt = new Filters_Models_FiltersFilters();
        $this->view->add = $pageId = $this->_getParam('module');
        $this->view->paginator = $ttt->getAll();
    }
    
    /**
     * Добавление
     *
     */
    public function addAction() {
//        echo "!!!!!!";
        $pageId = $this->_getParam('pageId');
        
        $request = $this->getRequest(); // получение объекта запроса Engine_Controller_Request_Http
        
        $form = new Filters_Form_FiltersFilters();
        if ($request->isPost()) { // если был POST запрос
            if ($form->isValid($request->getPost())) {
                $model = new Filters_Models_FiltersFilters();
                $model->save($form->getElements(), $pageId);

//                $picture1 = $form->picture1->receive($model->getInsertId());
//                $model->updateRecord('picture1', $picture1, $model->getInsertId());
                
                $this->_redirector->gotoActionUrl('/admin/', $model->getInsertId());
            }
        }

        $this->view->elements = $form->getElements();
        $this->view->form = $form;
    }
    
    /**
     * Редактирование
     *
     */
    public function editAction() {
        $request = $this->getRequest(); // получение объекта запроса Engine_Controller_Request_Http
        
        $pageId = $this->_getParam('pageId');
        $model = new Filters_Models_FiltersFilters();
        $rrr = $model->getRecord($pageId);

        $form = new Filters_Form_FiltersFilters();

        foreach ($form->getElements() as $value) {
            $nnn = $value->getName();
            $value->setValue($rrr->$nnn);
        }
        
        if ($request->isPost()) { // если был POST запрос
            if ($form->isValid($request->getPost())) {
                $model = new Filters_Models_FiltersFilters();
                $model->save($form->getElements(), $pageId);
                
//                $picture1 = $form->picture1->receive($pageId);
//                $model->updateRecord('picture1', $picture1, $pageId);
                
                $this->_redirector->gotoActionUrl('/admin/', $pageId);
            }
        }
        $this->view->id = $pageId;
        $this->view->elements = $form->getElements();
        $this->view->form = $form;
    }
    
    /**
     * Удаление
     *
     */
    public function deleteAction() {
        $pageId = $this->_getParam('pageId');
        
        $model = new Filters_Models_FiltersFilters();
        $model->listAction($pageId, 'delete');
        echo "!!!"; exit;
        $this->_redirector->gotoActionUrl('/admin/');
    }
    

}