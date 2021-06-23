<?php
class Video_Models_DbTable_VideoVideo extends Engine_Db_Table {
    protected $_name = 'video';
    
    protected $_referenceMap    = array(
        'Video_Models_DbTable_VideoSection' => array(
            'columns'           => array('section_id'),
            'refTableClass'     => 'Video_Models_DbTable_VideoSection',
            'refColumns'        => array('id'),
            'onDelete'          => self::CASCADE
        )
    );
}