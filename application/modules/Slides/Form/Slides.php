<?php
class Slides_Form_Slides extends Engine_Form {
    public function init() {
        $this->setTableName('slides');
        $this->setTableComment('Слайды');
        
        $this->setPrimary('id');
        $this->addElement(
            'Text',
            'id',
            array(
                'label' => 'Id',
                'dbField' => array(
                    'type'  => 'tinyint(3) unsigned',
                    'default'  => "NOT NULL",
                    'autoIncrement' => true
                ),
                'ignore' => true
            )
        );    
        
        $this->setPosition('pos');
        $this->addElement(
            'Hidden',
            'pos',
            array(
                'label' => 'Позиция',
                'dbField' => array(
                    'type'     => 'tinyint(3) unsigned',
                    'default'  => "NOT NULL default '0'"
                ),
                'ignore' => true
            )
        );
        
        
        $this->addElement(
            'Text',
            'name',
            array(
                'label' => 'Название'
            )
        );
        
        $this->addElement(
            'TinyMce',
            'text',
            array(
                'label' => 'Текст'
            )
        );
        
        $this->addElement(
            'Text',
            'url',
            array(
                'label' => 'Ссылка'
            )
        );
        
        $this->addElement(
            'File',
            'file',
            array(
                'destination' => 'public/slides',
                'label' => 'Прикрепленный файл',
                'validators' => array(
                    'extension' => 'jpg,png'
                ),
                'required' => true
            )
        );
        
        $this->addElement(
            'Checkbox',
            'display',
            array(
                'label' => 'Отображать'
            )
        );
    }
}