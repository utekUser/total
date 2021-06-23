<?php
class Shop_Form_OrderStatus extends Engine_Form {
    public function init() {
        $this->setTableName('shop_status');
        $this->setTableComment('Статус заказа');
        
        $this->setPrimary('id');
        $this->addElement(
            'Text',
            'id',
            array(
                'label' => 'ID статуса',
                'dbField' => array(
                    'type'  => 'int(10) unsigned',
                    'default'  => "NOT NULL",
                    'autoIncrement' => true
                ),
                'ignore' => true
            )
        );
        
        $this->addElement(
            'text',
            'code',
            array(
                'label' => 'Код',
                'required' => true
            )
        );
        
        $this->addElement(
            'text',
            'name',
            array(
                'label' => 'Название',
                'required' => true
            )
        );
        
        $this->addElement(
            'Textarea',
            'description',
            array(
                'label' => 'Описание'
            )
        );
    }
}