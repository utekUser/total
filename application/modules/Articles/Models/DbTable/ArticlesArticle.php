<?php
class Articles_Models_DbTable_ArticlesArticle extends Engine_Db_Table {
    protected $_name = 'articles';
    
    protected $_referenceMap    = array(
        'Articles_Models_DbTable_ArticlesSection' => array(
            'columns'           => array('section_id'),
            'refTableClass'     => 'Articles_Models_DbTable_ArticlesSection',
            'refColumns'        => array('id'),
            'onDelete'          => self::CASCADE
        )
    );
}