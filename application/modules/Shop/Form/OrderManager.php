<?php
class Shop_Form_OrderManager extends Engine_Form {
    public function init() {
        $this->setTableName('shop_manager');
        $this->setTableComment('Менеджеры');
        
        $this->setPrimary('id');
        $this->addElement(
            'Text',
            'id',
            array(
                'label' => 'ID менеджера',
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
            'manager_name',
            array(
                'label' => 'ФИО менеджера'
            )
        );
		
		$this->addElement(
            'Text',
            'manager_phone',
            array(
                'label' => 'Телефон'
            )
        );
		
		$this->addElement(
            'Text',
            'deleted',
            array(
                'label' => 'Удалён'
            )
        );
		
    }
}