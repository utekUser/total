<?php
class Oils_Form_OilsSection extends Engine_Form {
    public function init() {
        $this->setTableName('oils_section');
        $this->setTableComment('Каталог автомасел');
        
        $this->setPrimary('id');
        $this->addElement(
            'Text',
            'id',
            array(
                'label' => 'Id масла',
                'dbField' => array(
                    'type'  => 'int(10) unsigned',
                    'default'  => "NOT NULL",
                    'autoIncrement' => true
                ),
                'ignore' => true
            )
        );     

//        $this->addElement(
//            'Text',
//            'parent',
//            array(
//                'label' => 'Родительский раздел',
//                'dbField' => array(
//                    'type'  => 'int(10) unsigned',
//                    'default'  => "NOT NULL default '0'"
//                )
//            )
//        );
        
        $options = array();
        $table = new Oils_Models_OilsSection();
        $select = $table->getSection();
        foreach ($select as $value){
            $options[$value->id]['name'] = $value->name;
            $options[$value->id]['parent'] = $value->parent;
        }
        $this->addElement(
            'SelectTree',
            'parent',
            array(
                'label' => 'Раздел',
                'multiOptions' => array('default' => array('name' => 'Родительский раздел', 'parent' => 0)),
                'required' => true,
                'dbField' => array(
                    'type'  => 'int(10) unsigned',
                    'default'  => "NOT NULL default '0'"
                )
            )
        );
        $this->parent->addMultiOptions($options);
        
        
        
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
        
        $this->addElement(
            'TinyMce',
            'info',
            array(
                'label' => 'Описание раздела'
            )
        );
        
    }
}