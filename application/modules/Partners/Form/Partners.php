<?php
class Partners_Form_Partners extends Engine_Form {
    public function init() {
        $this->setTableName('partners');
        $this->setTableComment('Партнеры');
        
        $this->setPrimaty('id'); 
        $this->setPrimatyType('smallint(5) unsigned');
        $this->setPrimatyComment('Партнеры');
        
        $this->setPosition('pos');
        
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
            'TinyMce',
            'text',
            array(
                'label' => 'Основное описание'
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
            'Image',
            'picture',
            array(
                'destination' => 'public/partners',
                'label' => 'Картинка'
            )
        );
        $this->picture->addFilter(new Engine_Filter_File_ImageResize(
        array(
            'name' => $this->picture->getName(),
            'path' => 'public/partners',
            'type' => array(
                    'fixedscale' => array('width'=>'160', 'height'=>'100', 'color'=>'ffffff', 'ending'=>'p', 'watermark'=>false),
                    'bigscale' => array('width'=>'600', 'height'=>'400', 'color'=>'ffffff', 'ending'=>'b', 'watermark'=>false)
                )
            )
        ));
    }
}