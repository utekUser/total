<?php
class Gallery_Form_GalleryAlbum extends Engine_Form {
    public function init() {
        $this->setTableName('gallery_album');
        $this->setTableComment('Альбомы фотографий');
        
        $this->setPrimaty('id');
        $this->setPrimatyType('smallint(5) unsigned');
        $this->setPrimatyComment('Альбомы фотографий');
        
        
        $options = array();
        $table = new Gallery_Models_GallerySection();
        $select = $table->getSection();
        foreach ($select as $value){
            $options[$value->id] = $value->name;
        }
        $this->addElement(
            'select',
            'section_id',
            array(
                'label' => 'Раздел',
                'multiOptions' => array('0' => 'Выберите раздел'),
                'required' => true,
                'field' => array(
                    'type'  => 'tinyint(3) unsigned',
                    'default'  => "NOT NULL default '0'"
                )
            )
        );
        $this->section_id->addMultiOptions($options);
        
        
        $this->addElement(
            'Date',
            'posted',
            array(
                'label' => 'Дата публикации'
            )
        );
        
        $this->addElement(
            'Text',
            'name',
            array(
                'label' => 'Название',
                'required' => true
            )
        );
        
        $this->addElement(
            'Url',
            'url',
            array(
                'label' => 'Ссылка',
                'required' => true,
                'field' => array(
                    'type'  => 'varchar(64)',
                    'default'  => "NOT NULL default ''"
                )
            )
        );
        
        $this->addElement(
            'Checkbox',
            'display',
            array(
                'label' => 'Отображать'
            )
        );
        
        $this->addElement(
            'TinyMce',
            'short',
            array(
                'label' => 'Короткое описание'
            )
        );
        
        $this->addElement(
            'Image',
            'picture',
            array(
                'destination' => 'public/albums',
                'label' => 'Основная фотография альбома'
            )
        );
        $this->picture->addFilter(new Engine_Filter_File_ImageResize(
        array(
            'name' => $this->picture->getName(),
            'path' => 'public/albums',
            'type' => array(
                    'fixedscale' => array('width'=>'170', 'height'=>'115', 'color'=>'ffffff', 'ending'=>'p', 'watermark'=>false),
                    'bigscale' => array('width'=>'600', 'height'=>'400', 'color'=>'ffffff', 'ending'=>'b', 'watermark'=>false)
                )
            )
        ));
        
       
        $this->addElement(
            'Hidden',
            'view',
            array(
                'label' => 'Количество просмотров',
                'field' => array(
                    'type'  => 'mediumint(8) unsigned',
                    'default'  => "NOT NULL default '0'"
                )
            )
        );
        
        $this->addElement(
            'Hidden',
            'comment',
            array(
                'label' => 'Количество комментариев',
                'field' => array(
                    'type'  => 'mediumint(8) unsigned',
                    'default'  => "NOT NULL default '0'"
                )
            )
        );
    }
}