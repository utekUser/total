<?php
class Shop_Form_OrderTransaction extends Engine_Form {
    public function init() {
        $this->setTableName('shop_transaction');
        $this->setTableComment('Транзакции по заказу');
        
        $this->setPrimary('id');
        $this->addElement(
            'Text',
            'id',
            array(
                'label' => 'ID транзакции',
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
            'Date',
            'date',
            array(
                'label' => 'Дата'
            )
        );
        
        $this->addElement(
            'text',
            'sum',
            array(
                'label' => 'Сумма'
            )
        );
        
        $this->addElement(
            'Textarea',
            'description',
            array(
                'label' => 'Описание'
            )
        );
        
        $this->addElement(
            'Textarea',
            'comment',
            array(
                'label' => 'Комментарии'
            )
        );
    }
}