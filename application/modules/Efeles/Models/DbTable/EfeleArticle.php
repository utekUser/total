<?php
class Efeles_Models_DbTable_EfeleArticle extends Engine_Db_Table {
    protected $_name = 'efele_articles';
    
    protected $_referenceMap    = array(
        'Efeles_Models_DbTable_EfeleSection' => array(
            'columns'           => array('section_id'),
            'refTableClass'     => 'Efeles_Models_DbTable_EfeleSection',
            'refColumns'        => array('id'),
            'onDelete'          => self::CASCADE
        )
    );
}