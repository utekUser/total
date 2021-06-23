<?php
class Video_Form_VideoVideo extends Engine_Form {
    public function init() {
        $this->setTableName('video');
        $this->setTableComment('Видео');
        
        $this->setPrimary('id');
        $this->addElement(
            'Text',
            'id',
            array(
                'label' => 'Id видео',
                'dbField' => array(
                    'type'  => 'int(10) unsigned',
                    'default'  => "NOT NULL",
                    'autoIncrement' => true
                ),
                'ignore' => true
            )
        );
        
        $options = array();
        $table = new Video_Models_VideoSection();
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
                    'type'  => 'int(10) unsigned',
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
            'TinyMce',
            'before_video',
            array(
                'label' => 'Описание до видео'
            )
        );
        
        $this->addElement(
            'TinyMce',
            'after_video',
            array(
                'label' => 'Описание после видео'
            )
        );
        
        
        $this->addElement(
            'FileImage',
            'picture',
            array(
                'destination' => 'public/video',
                'label' => 'Изображение к видео',
                'type' => array(
                        'fixedscale' => array('width'=>'160', 'height'=>'105', 'color'=>'ffffff', 'ending'=>'p', 'watermark'=>false),
                        'bigscale' => array('width'=>'600', 'height'=>'400', 'color'=>'ffffff', 'ending'=>'b', 'watermark'=>false)
                    ),
                'ValueDisabled' => true
            )
        );
        
        $this->addElement(
            'File',
            'file',
            array(
                'destination' => 'public/video',
                'tempDestination' => 'temporary/video',
                'label' => 'Файл видео',
                'validators' => array(
                    'extension' => 'flv'
                ),
                'required' => true
            )
        );
        
        $this->addElement(
            'Hidden',
            'view',
            array(
                'label' => 'Количество просмотров',
                'dbField' => array(
                    'type'  => 'mediumint(8) unsigned',
                    'default'  => "NOT NULL default '0'"
                ),
                'ignore' => true
            )
        );
        
        $this->addElement(
            'Hidden',
            'comment',
            array(
                'label' => 'Количество комментариев',
                'dbField' => array(
                    'type'  => 'mediumint(8) unsigned',
                    'default'  => "NOT NULL default '0'"
                ),
                'ignore' => true
            )
        );
        
        
//        $this->addElement(
//            'Hidden',
//            'creation_date',
//            array(
//                'label' => 'Дата создания',
//                'ignore' => true,
//                'field' => array(
//                    'type'  => 'datetime',
//                    'default'  => "NOT NULL default '0000-00-00 00:00:00'"
//                )
//            )
//        );
        
//        $this->addElement(
//            'Hidden',
//            'status',
//            array(
//                'label' => 'Статус',
//                'ignore' => true
//            )
//        );
//        
//        $this->addElement(
//            'Hidden',
//            'video_id',
//            array(
//                'label' => 'Статус',
//                'ignore' => true
//            )
//        );
//        
//        $this->addElement(
//            'Hidden',
//            'code',
//            array(
//                'label' => 'Статус',
//                'ignore' => true,
//                'field' => array(
//                    'type'  => 'varchar(150)',
//                    'default'  => "NOT NULL default ''"
//                )
//            )
//        );
    }
}