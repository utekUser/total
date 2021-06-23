<?php
class Gallery_controllers_IndexController extends Core_Controller_Action_User {
    public function init() {
        $this->pageId = $this->_getUrl('urlToInt', 1);
        $this->url = $this->_getUrl('url', 0);
        
        if ($this->pageId) {
            Core_Controller_Action_User::setViewMain('view');
            
            Core_Controller_Action_User::setDefaultParseUrlAction('view');
        }
    }

    public function indexAction() {
        $section = new Gallery_Models_GallerySection();
        $album = new Gallery_Models_GalleryAlbum();
        
        // если выбран раздел
        if ($this->url) {
            $sectionName = $section->getSectionName($this->url);
            $this->view->sectionName = $sectionName['name'];
        }
        
        $this->view->section = $section->getSection();
        $this->view->paginator = $album->getAlbums($sectionName['id']);
        
    }
    
    public function viewAction() {
        $id = $this->_getParam('urlToInt');
        $ttt = new Gallery_Models_GalleryAlbum();
        $ttt->addView($id);
        
        $this->view->currentAlbum = $ttt->getCurrentAlbum($this->pageId);
        
        $mmm = new Gallery_Models_GalleryPhoto();
        $this->view->albumPhoto = $mmm->getPhoto($this->pageId);
        
        
        $section = new Gallery_Models_GallerySection();
        $sectionName = $section->getSectionName($this->url);
        $this->view->sectionName = $sectionName['name'];
        $this->view->sectionUrl = $sectionName['url'];
    }
}