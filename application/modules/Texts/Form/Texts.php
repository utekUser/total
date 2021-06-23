<?php
class Texts_Form_Texts extends Engine_Form {
    public function init() {
        $this->setTableName('texts');
        $this->setTableComment('Шаблоны');
        
//        $this->setPrimaty('id'); // по умолчанию тоже его
//        $this->setPrimatyType('tinyint(3) unsigned');
//        $this->setPrimatyComment('Шаблоны');
        
        $this->setPrimary('id');
        $this->addElement(
            'Text',
            'id',
            array(
                'label' => 'Id шаблона',
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
        
//        $this->addElement(
//            'Select',
//            'type',
//            array(
//                'label' => 'Тип шаблона',
//                'field' => array(
//                    'type'  => 'tinyint(3) unsigned',
//                    'default'  => "NOT NULL default '0'"
//                ),
//                'multiOptions' => array('0' => 'Редакторский', '1' => 'Стандартный')
//            )
//        );
        
        $this->addElement(
            'Text',
            'name',
            array(
                'label' => 'Название',
                'required' => true
            )
        );
        
        $this->addElement(
            'TinyMce',
            'text',
            array(
                'label' => 'Текст'
            )
        );
        
//        $this->addElement(
//            'Hidden',
//            'pos',
//            array(
//                'label' => 'Позиция',
//                'field' => array(
//                    'type'    => 'tinyint(3) unsigned',
//                    'default' => "NOT NULL default '0'"
//                )
//            )
//        );
        
        $this->addElement(
            'Checkbox',
            'display',
            array(
                'label' => 'Отображать'
            )
        );
        
    }
}