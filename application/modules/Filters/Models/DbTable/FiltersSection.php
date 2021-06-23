<?php
class Filters_Models_DbTable_FiltersSection extends Engine_Db_Table {
    protected $_name = 'filters_section';
    
    protected $_dependentTables = array('Filters_Models_DbTable_FiltersFilters');
}