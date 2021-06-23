<?php
class Shop_Form_OrderSale extends Engine_Form {
    public function init() {
        $this->setTableName('shop_sale');
        $this->setTableComment('Скидки');
        
        $this->setPrimary('id');
        $this->addElement(
            'Text',
            'id',
            array(
                'label' => 'ID скидки',
                'field' => array(
                    'type'  => 'int(10) unsigned',
                    'dbFefault'  => "NOT NULL",
                    'autoIncrement' => true
                ),
                'ignore' => true        
            )
        );
        
        $this->addElement(
            'Checkbox',
            'active',
            array(
                'label' => 'Активность'
            )
        );
        
        $this->addElement(
            'Date',
            'date_from',
            array(
                'label' => 'Активна от'
            )
        );
        
        $this->addElement(
            'Date',
            'date_before',
            array(
                'label' => 'Активна до'
            )
        );
        
        $this->addElement(
            'Text',
            'name',
            array(
                'label' => 'Название'
            )
        );
        
        $this->addElement(
            'Select',
            'type',
            array(
                'label' => 'Тип скидки',
                'dbField' => array(
                    'type'  => 'tinyint(3) unsigned',
                    'default'  => "NOT NULL default '0'"
                ),
                'multiOptions' => array('0' => 'В процентах', '1' => 'Фиксированная сумма', '2' => 'Фиксированная цена')
            )
        );
        
        $this->addElement(
            'Text',
            'sale',
            array(
                'label' => 'Величина скидки'
            )
        );
        
    }
}