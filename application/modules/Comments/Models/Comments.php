<?php
class Comments_Models_Comments extends Engine_Model_Abstract {
    protected $_dbTableName = 'Comments_Models_DbTable_Comments';
    
    protected $_formTableName = 'Comments_Form_Comments';
    
    protected $_orderBy = 'creation_date';
    
    protected static $_commentFrom = null;
    protected static $_commentType = null;
    protected static $_commentId = null;
    
    public function getComments($type, $id) {
        $http = new Engine_Controller_Request_Http();
        $page = $http->getParam('page');
        
        $table  = $this->getDbTable();
        
        $select = $table->select()
                        ->where('resource_type = ?', $type)
                        ->where('resource_id = ?', $id)
                        ->order('creation_date DESC');

        $adapter = new Zend_Paginator_Adapter_DbSelect(
            $select
        );
        
        $paginator = new Engine_Paginator($adapter);
        if ($page != 'all') {
            $paginator->setItemCountPerPage(10);
        } else {
            $paginator->setItemCountPerPage(-1);    
        }
        $paginator->setCurrentPageNumber($page);
        
        return $paginator;
    }
    
    public function saveComment($data) {
        $this->getDbTable()->insert($data);    
    }
    
    /**
     * !!!
     *
     */
    public static function commentWork($type, $id) {
        self::$_commentType = $type;
        self::$_commentId = $id;
    
        $request = new Engine_Controller_Request_Http(); // получение объекта запроса Engine_Controller_Request_Http

        $resourceType = $type;
//        echo $type; exit;
        $form = new Comments_Form_Comments();
        
        self::$_commentFrom = $form;
        
        $form->addElement(new Engine_Form_Element_Captcha('captcha')); // Добавляем капчу
        if ($request->isPost()) { // если был POST запрос
            if ($form->isValid($request->getPost())) {
                $elements = $form->getElements();
                $elements['resource_type']->setValue($resourceType);
                $elements['resource_id']->setValue($id);
                $elements['poster_type']->setValue('user');
                $elements['poster_id']->setValue(0);
                
                $elements['creation_date']->setValue(date('Y-m-d H:i:s'));
                $elements['remote_address']->setValue($_SERVER['REMOTE_ADDR']);
                
                $elements['display_email']->setIgnore(true);
                
                
                $data = $form->getValues();
                
                $comments = new Comments_Models_Comments();
                $comments->saveComment($data);
                
//                $redirector = new Engine_Controller_Action_Helper_Redirector();
//                
//                $redirector->gotoUrl('/articles/' . $id . '.html');
                
                return true;
//                $this->_redirector->gotoUrl('/articles/' . $id . '.html');
            }
        }
        
        return false;
    }
    
    public static function getForm() {
        return self::$_commentFrom;
    }
    
    public static function getStaticComments() {
        $article = new Comments_Models_Comments();
        return $article->getComments(self::$_commentType, self::$_commentId);    
    }
    
    /**
     * Обновление количества комментариев
     *
     * @param unknown_type $type
     * @param unknown_type $idComment
     */
    public function updateComments($type, $idComment) {
        $comment = new Comments_Models_Comments();
        $tableComment  = $comment->getDbTable();
        
        $table  = $this->getDbTable();

        $data = array(
            'comment'      => new Zend_Db_Expr('(' . 
                $tableComment->select()
                            ->from($tableComment, 'COUNT(`id`)')
                            ->where('resource_type = ?', $type)
                            ->where('resource_id = ?', $idComment)
            . ')')
        );
        
        $table->update($data, array('id = ?' => $idComment));
    }
}