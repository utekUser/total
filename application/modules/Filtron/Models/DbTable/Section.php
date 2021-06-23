<?php
class Filtron_Models_DbTable_Section extends Engine_Db_Table {
    protected $_name = 'filtron_section';
    
    protected $_dependentTables = array('Filtron_Models_DbTable_Article');
}