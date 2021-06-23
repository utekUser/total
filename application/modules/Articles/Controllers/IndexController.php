<?php
/**
 * Работа со статьями
 *
 */
class Articles_controllers_IndexController extends Core_Controller_Action_User {
    /**
     * Инициализация
     *
     */
    public function init() {
        $this->pageId = $this->_getUrl('urlToInt', 1);
        $this->url = $this->_getUrl('url', 0);
        
        if ($this->pageId) {
            Core_Controller_Action_User::setViewMain('view');
            Core_Controller_Action_User::setDefaultParseUrlAction('view');
        }
    }
    
    /**
     * Список статей
     *
     */
    public function indexAction() {
        $section = new Articles_Models_ArticlesSection();
        $article = new Articles_Models_ArticlesArticle();
		$sectionName = null;
        // если выбран раздел
        if ($this->url) {
            $sectionName = $section->getSectionName($this->url);
            $this->view->sectionName = $sectionName['name'];
        }
        $this->view->section = $section->getSectionCount();		
        $this->view->paginator = $article->getArticle($sectionName['id']);
    }
    
    /**
     * Выбранная статья
     *
     */
    public function viewAction() {
        // вывод текущего комментария
        $ttt = new Articles_Models_ArticlesArticle();
        $ttt->addView($this->pageId);
        $this->view->currentArticle = $ttt->getCurrentArticle($this->pageId);
        
        // установка комментариев
//        if (Comments_Models_Comments::commentWork('articles', $this->pageId)) {
//            $this->_redirector->gotoReturn('#comments_block');    
//        }
//        $this->view->comments = Comments_Models_Comments::getStaticComments();
//        $this->view->commentsForm = Comments_Models_Comments::getForm();
        // установка комментариев
    }
}