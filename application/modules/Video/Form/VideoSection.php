<?php
class Video_Form_VideoSection extends Engine_Form {
    public function init() {
        $this->setTableName('video_section');
        $this->setTableComment('Разделы видео');
        
        $this->setPrimary('id'); 
        $this->addElement(
            'Text',
            'id',
            array(
                'label' => 'Разделы видео',
                'dbField' => array(
                    'type'  => 'int(10) unsigned',
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
                    'type'     => 'int(10) unsigned',
                    'default'  => "NOT NULL default '0'"
                ),
                'ignore' => true
            )
        );
        
        
        
        $this->addElement(
            'Text',
            'name',
            array(
                'label' => 'Название раздела',
                'required' => true
            )
        );
        
        $this->addElement(
            'Url',
            'url',
            array(
                'label' => 'Ссылка',
                'required' => true
            )
        );
        
        $this->addElement(
            'Checkbox',
            'display',
            array(
                'label' => 'Отображать',
                'checked' => true
            )
        );
        
    }
}