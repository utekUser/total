<?php
class Articles_Models_DbTable_ArticlesSection extends Engine_Db_Table {
    protected $_name = 'articles_section';
    
    protected $_dependentTables = array('Articles_Models_DbTable_ArticlesArticle');
}