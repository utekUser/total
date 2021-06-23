<?php
class Filtron_Models_DbTable_Article extends Engine_Db_Table {
    protected $_name = 'filtron_articles';
    
    protected $_referenceMap    = array(
        'Filtron_Models_DbTable_Section' => array(
            'columns'           => array('section_id'),
            'refTableClass'     => 'Filtron_Models_DbTable_Section',
            'refColumns'        => array('id'),
            'onDelete'          => self::CASCADE
        )
    );
}