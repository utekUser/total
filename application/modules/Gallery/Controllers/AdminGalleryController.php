<?php
class Gallery_Controllers_AdminGalleryController extends Core_Controller_Action_Admin {
    protected $_path = array(
        'gallery' => 'Фото'
    );
    /**
     * Редиректор - определен для полноты кода
     *
     * @var Zend_Controller_Action_Helper_Redirector
     */
    protected $_redirector = null;
    
    protected $_form = array(
        'Gallery_Form_GalleryAlbum',
        'Gallery_Form_GallerySection',
        'Gallery_Form_GalleryPhoto'
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
            'section' => 'Разделы фото',
            'album' => 'Альбомы',
            'photo' => 'Фотографии'
        );
        $this->view->module = $module;
    }
    /*
    

    public function addAction() {
        $pageId = $this->_getParam('pageId');
        
        $request = $this->getRequest(); // получение объекта запроса Engine_Controller_Request_Http
        
        $form = new Gallery_Form_Gallery();
        if ($request->isPost()) { // если был POST запрос
            if ($form->isValid($request->getPost())) {
                $model = new Gallery_Models_Gallery();
                $model->save($form->getElements(), $pageId);
                
//                $form->filename->receive();
                
                $this->_redirector->gotoActionUrl('/admin/', $model->getInsertId());
            }
        }

        $this->view->elements = $form->getElements();
    }
    

    public function editAction() {
        $request = $this->getRequest(); // получение объекта запроса Engine_Controller_Request_Http
        
        $pageId = $this->_getParam('pageId');
        $model = new Gallery_Models_Gallery();
        $rrr = $model->getRecord($pageId);

        $form = new Gallery_Form_Gallery();

        foreach ($form->getElements() as $value) {
            $nnn = $value->getName();
            $value->setValue($rrr->$nnn);
        }
        
        if ($request->isPost()) { // если был POST запрос
            if ($form->isValid($request->getPost())) {
                $model = new Gallery_Models_Gallery();
                $model->save($form->getElements(), $pageId);
                
                $this->_redirector->gotoActionUrl('/admin/', $model->getInsertId());
            }
        }
        $this->view->id = $pageId;
        $this->view->elements = $form->getElements();
    }
    

    public function deleteAction() {
        $pageId = $this->_getParam('pageId');
        
        $model = new Gallery_Models_Gallery();
        $model->listAction($pageId, 'delete');
        
        $this->_redirector->gotoActionUrl('/admin/Gallery/');
    }*/
}