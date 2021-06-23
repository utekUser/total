<?php
class Efeles_Models_DbTable_EfeleSection extends Engine_Db_Table {
    protected $_name = 'efele_articles_section';
    
    protected $_dependentTables = array('Efeles_Models_DbTable_EfeleArticle');
}