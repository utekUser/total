<?php
class Filters_Form_FiltersSection extends Engine_Form {
    public function init() {
        $this->setTableName('filters_section');
        $this->setTableComment('Типы фильтров');
        
        $this->setPrimary('id');
        $this->addElement(
            'Text',
            'id',
            array(
                'label' => 'Id типа',
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
            'text',
            'name',
            array(
                'label' => 'Наименование',
                'required' => true
            )
        );
        
        $this->addElement(
            'Url',
            'url',
            array(
                'label' => 'Ссылка'
            )
        );
        
        $this->addElement(
            'Text',
            'fk_id',
            array(
                'label' => 'Ключ',
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
        
        $this->addElement(
            'TinyMce',
            'text',
            array(
                'label' => 'Описание для типа'
            )
        );
    }
}