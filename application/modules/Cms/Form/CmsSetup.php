<?php
class Cms_Form_CmsSetup extends Engine_Form {
    public function init() {
        $this->setTableName('cms_setup');
        $this->setTableComment('Настройки');
        
        $this->setPrimary('id');
        $this->addElement(
            'Text',
            'id',
            array(
                'label' => 'Настройки',
                'dbField' => array(
                    'type'  => 'int(10) unsigned',
                    'default'  => "NOT NULL",
                    'autoIncrement' => true
                ),
                'ignore' => true
            )
        );        

        $this->addElement(
            'Text',
            'name',
            array(
                'label' => 'Название',
                'dbField' => array(
                    'type'  => 'varchar(64)',
                    'default'  => "NOT NULL default ''"
                )
            )
        );
        
        $this->addElement(
            'Text',
            'group',
            array(
                'label' => 'Группа',
                'dbField' => array(
                    'type'  => 'varchar(64)',
                    'default'  => "NOT NULL default ''"
                )
            )
        );
        
        $this->addElement(
            'Text',
            'key',
            array(
                'label' => 'Ключ',
                'dbField' => array(
                    'type'  => 'varchar(64)',
                    'default'  => "NOT NULL default ''"
                )
            )
        );
        
        $this->addElement(
            'Textarea',
            'value',
            array(
                'label' => 'Значение'
            )
        );
        
        $this->addElement(
            'Textarea',
            'comment',
            array(
                'label' => 'Комментарий'
            )
        );
    }
}