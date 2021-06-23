<?php
class Gallery_Form_GalleryPhoto extends Engine_Form {
    public function init() {
        $this->setTableName('gallery_photo');
        $this->setTableComment('Фотографии');
        
        $this->setPrimaty('id');
        $this->setPrimatyType('int(10) unsigned');
        $this->setPrimatyComment('Фотографии');
        
        
        $options = array();
        $table = new Gallery_Models_GalleryAlbum();
        $select = $table->getAlbum();
        foreach ($select as $value){
            $options[$value->id] = $value->name;
        }
        $this->addElement(
            'select',
            'album_id',
            array(
                'label' => 'Альбом',
                'multiOptions' => array('0' => 'Выберите альбом'),
                'required' => true,
                'field' => array(
                    'type'  => 'smallint(5) unsigned',
                    'default'  => "NOT NULL default '0'"
                )
            )
        );
        $this->album_id->addMultiOptions($options);
        
        
        $this->addElement(
            'Checkbox',
            'display',
            array(
                'label' => 'Отображать'
            )
        );
        
        
        $this->addElement(
            'Image',
            'picture',
            array(
                'destination' => 'public/photo',
                'label' => 'Фотография'
            )
        );
        $this->picture->addFilter(new Engine_Filter_File_ImageResize(
        array(
            'name' => $this->picture->getName(),
            'path' => 'public/photo',
            'type' => array(
                    'fixedscale' => array('width'=>'170', 'height'=>'115', 'color'=>'ffffff', 'ending'=>'p', 'watermark'=>false),
                    'bigscale' => array('width'=>'600', 'height'=>'400', 'color'=>'ffffff', 'ending'=>'b', 'watermark'=>false)
                )
            )
        ));
    }
}