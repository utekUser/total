<?php
class Services_Form_Services extends Engine_Form {
    public function init() {
        $this->setTableName('services');
        $this->setTableComment('Услуги');
        
        $this->setPrimaty('id'); 
        $this->setPrimatyType('smallint(5) unsigned');
        $this->setPrimatyComment('Услуги');
        
        $this->setPosition('pos');
        
////
        $registry = Engine_Api::getInstance();
        $tablePrefix = $registry->getContainer()->tablePrefix;
        $listTables = $registry->getContainer()->listTables;
        $options = array();
        if (in_array($tablePrefix . 'services', $listTables)) {
            $table = new Services_Models_Services();
            $select = $table->getSection();

            foreach ($select as $value){
                $options[$value->id] = $value->name;
            }
        }
        

        
        $this->addElement(
            'Select',
            'parent',
            array(
                'label' => 'Родитель',
                'field' => array(
                    'type'  => 'int(10) unsigned',
                    'default'  => "NOT NULL default '0'",
                    'comment'  => 'Родитель'
                ),
                'multiOptions' => array('0' => '')
            )
        );
        
        $this->parent->addMultiOptions($options);
////
        
        $this->addElement(
            'Text',
            'name',
            array(
                'label' => 'Название услуги',
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
                'label' => 'Полное описание'
            )
        );
        
        $this->addElement(
            'Checkbox',
            'display',
            array(
                'label' => 'Отображать',
                'checkedValue' => true
            )
        );
    }
}