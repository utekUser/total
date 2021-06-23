<?php
class Gallery_Models_DbTable_GallerySection extends Engine_Db_Table {
    protected $_name = 'gallery_section';
    
    protected $_dependentTables = array('Gallery_Models_DbTable_GalleryAlbum');
}