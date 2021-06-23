<?php
class Cms_Form_CmsModule extends Engine_Form {
    public function init() {
        $this->setTableName('cms_module');
        $this->setTableComment('Модули');
        
//        $this->setPrimaty('id'); // по умолчанию тоже его
//        $this->setPrimatyType('tinyint(3) unsigned');
//        $this->setPrimatyComment('Модули');
        
        $this->setPrimary('id');
        $this->addElement(
            'Text',
            'id',
            array(
                'label' => 'Модули',
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
            'text',
            'name',
            array(
                'label' => 'Название'
            )
        );
        
        $this->addElement(
            'text',
            'path',
            array(
                'label' => 'Путь'
            )
        );
        
//        $this->addElement(
//            'Hidden',
//            'pos',
//            array(
//                'label' => 'Позиция',
//                'dbField' => array(
//                    'type'  => 'tinyint(3) unsigned',
//                    'default'  => "NOT NULL default '0'",
//                    'comment'  => 'Позиция'
//                )
//            )
//        );
        
        $this->addElement(
            'Checkbox',
            'display',
            array(
                'label' => 'Отображать',
                'checkedValue' => true
            )
        );
        
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
    }
}