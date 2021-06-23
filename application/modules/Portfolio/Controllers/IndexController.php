<?php
class Portfolio_controllers_IndexController extends Core_Controller_Action_User {

    public function indexAction() {
        $gallery = new Gallery_Models_GallerySection();
        $this->view->gallerySection = $gallery->getSection();
        
        $video = new Video_Models_VideoSection();
        $this->view->videoSection = $video->getSection();
        
    }

}