<?php
class Filters_Models_DbTable_FiltersFilters extends Engine_Db_Table {
    protected $_name = 'filters';
    
    protected $_referenceMap    = array(
        'Filters_Models_DbTable_FiltersSection' => array(
            'columns'           => array('section_id'),
            'refTableClass'     => 'Filters_Models_DbTable_FiltersSection',
            'refColumns'        => array('id'),
            'onDelete'          => self::CASCADE
        )
    );
}