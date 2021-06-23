<?php
class Video_Models_DbTable_VideoSection extends Engine_Db_Table {
    protected $_name = 'video_section';
    
    protected $_dependentTables = array('Video_Models_DbTable_VideoVideo');
}