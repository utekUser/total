<?php
class Shop_Form_OrderPrices extends Engine_Form {
    public function init() {
        $this->setTableName('shop_price');
        $this->setTableComment('Типы цен');
        
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

    }
}