<?php
class Oils_Form_OilsConnection extends Engine_Form {
    public function init() {
        $this->setTableName('oils_connection');
        $this->setTableComment('Связь автомасел с разделами каталога');
        
        $this->setPrimary('id');
        $this->addElement(
            'Text',
            'id',
            array(
                'label' => 'Id',
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
            'item_id',
            array(
                'label' => 'Id товара',
                'dbField' => array(
                    'type'  => 'int(10) unsigned',
                    'default'  => "NOT NULL"
                )
            )
        );

        $this->addElement(
            'Text',
            'section_id',
            array(
                'label' => 'Id раздела',
                'dbField' => array(
                    'type'  => 'int(10) unsigned',
                    'default'  => "NOT NULL"
                )
            )
        );
        

        
        
    }
}