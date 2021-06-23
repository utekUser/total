<?php
class Gallery_Models_DbTable_GalleryPhoto extends Engine_Db_Table {
    protected $_name = 'gallery_photo';
    
    protected $_referenceMap    = array(
        'Gallery_Models_DbTable_GalleryAlbum' => array(
            'columns'           => array('album_id'),
            'refTableClass'     => 'Gallery_Models_DbTable_GalleryAlbum',
            'refColumns'        => array('id'),
            'onDelete'          => self::CASCADE
        )
    );
}