<?php
class Video_controllers_IndexController extends Core_Controller_Action_User {
    public function init() {
        $this->pageId = $this->_getUrl('urlToInt', 1);
        $this->url = $this->_getUrl('url', 0);
        if ($this->pageId) {
            Core_Controller_Action_User::setViewMain('view');
            Core_Controller_Action_User::setDefaultParseUrlAction('view');
        }
    }
    
    public function indexAction() {
        $section = new Video_Models_VideoSection();
        $video = new Video_Models_VideoVideo();

        // если выбран раздел
        if ($this->url) {
            $sectionName = $section->getSectionName($this->url);
            $this->view->sectionName = $sectionName['name'];
        }
        $this->view->section = $section->getSectionCount();
        $this->view->paginator = $video->getVideo($sectionName['id']);
    }

    public function viewAction() {
        $ttt = new Video_Models_VideoVideo();
        $ttt->addView($this->pageId);
        
        $this->view->currentVideo = $ttt->getCurrentVideo($this->pageId);
        
        $section = new Video_Models_VideoSection();
        $sectionName = $section->getSectionName($this->url);
        $this->view->sectionName = $sectionName['name'];
        $this->view->sectionUrl = $sectionName['url'];
        
        // установка комментариев
//        if (Comments_Models_Comments::commentWork('video', $this->pageId)) {
//            $this->_redirector->gotoReturn('#comments_block');    
//        }
//        $this->view->comments = Comments_Models_Comments::getStaticComments();
//        $this->view->commentsForm = Comments_Models_Comments::getForm();
        // установка комментариев
    }
}