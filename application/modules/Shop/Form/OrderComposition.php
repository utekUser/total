<?php
class Shop_Form_OrderComposition extends Engine_Form {
    public function init() {
        $this->setTableName('shop_composition');
        $this->setTableComment('Состав заказа');
        
        $this->setPrimary('id');
        $this->addElement(
            'Text',
            'id',
            array(
                'label' => 'ID',
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
            'order_id',
            array(
                'label' => 'Id заказа',
                'dbField' => array(
                    'type'  => 'int(10) unsigned',
                    'default'  => "NOT NULL"
                )
            )
        );
        
        $this->addElement(
            'text',
            'base_id',
            array(
                'label' => 'Артикул'
            )
        );
        
        $this->addElement(
            'text',
            'name',
            array(
                'label' => 'Название товара'
            )
        );
        
        $this->addElement(
            'Textarea',
            'properties',
            array(
                'label' => 'Свойства'
            )
        );
        
        $this->addElement(
            'text',
            'sale',
            array(
                'label' => 'Скидка на товар'
            )
        );
        
        $this->addElement(
            'text',
            'price_type',
            array(
                'label' => 'Тип цены'
            )
        );
        
        $this->addElement(
            'text',
            'amount',
            array(
                'label' => 'Количество'
            )
        );
        
        $this->addElement(
            'text',
            'price',
            array(
                'label' => 'Цена'
            )
        );
        
        
    }
}