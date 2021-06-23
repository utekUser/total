<?php
class Gallery_Models_DbTable_GalleryAlbum extends Engine_Db_Table {
    protected $_name = 'gallery_album';
    
    protected $_referenceMap    = array(
        'Gallery_Models_DbTable_GallerySection' => array(
            'columns'           => array('section_id'),
            'refTableClass'     => 'Gallery_Models_DbTable_GallerySection',
            'refColumns'        => array('id'),
            'onDelete'          => self::CASCADE
        )
    );
}