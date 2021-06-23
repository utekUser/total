<?php
class Audio_Form_Audio extends Engine_Form {
    public function init() {
        $this->setTableName('audio');
        $this->setTableComment('Аудио');
        
        $this->setPrimaty('id'); 
        $this->setPrimatyType('smallint(5) unsigned');
        $this->setPrimatyComment('Аудио');
        
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
            'Text',
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
            'TinyMce',
            'short',
            array(
                'label' => 'Короткое описание'
            )
        );
        
        $this->addElement(
            'File',
            'file',
            array(
                'destination' => 'public/audio',
                'label' => 'Прикрепленный файл',
                'validators' => array(
                    'extension' => 'mp3'
                ),
                'required' => true
//                'valueDisabled' => true
            )
        );
//        $this->picture1->addFilter(new Engine_Filter_File_ImageResize(
//        array(
//        'name' => $this->picture1->getName(),
//        'path' => 'public/articles',
//        'type' => array(
//                    'fixedscale' => array('width'=>'160', 'height'=>'105', 'color'=>'ffffff', 'ending'=>'p', 'watermark'=>false),
//                    'bigscale' => array('width'=>'600', 'height'=>'400', 'color'=>'ffffff', 'ending'=>'b', 'watermark'=>false)
//                )
//            )
//        ));
        
        $this->addElement(
            'Checkbox',
            'display',
            array(
                'label' => 'Отображать',
                'checkedValue' => true
            )
        );
        
        // Количество просмотров
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
        
        // Количество комментариев
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