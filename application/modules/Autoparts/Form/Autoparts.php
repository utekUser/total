<?php
class Autoparts_Form_Autoparts extends Engine_Form {
    public function init() {
        $this->setTableName('autoparts');
        $this->setTableComment('Автомобильные запчасти');
        
        $this->setPrimary('id');
        $this->addElement(
            'Text',
            'id',
            array(
                'label' => 'Id автозапчасти',
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
            'base_id',
            array(
                'label' => 'Base id',
                'required' => true
            )
        );
        
        $this->addElement(
            'text',
            'name',
            array(
                'label' => 'Name',
                'required' => true
            )
        );
        
        $this->addElement(
            'text',
            'full_name',
            array(
                'label' => 'Full name'
            )
        );
        
        $this->addElement(
            'text',
            'invoice_name',
            array(
                'label' => 'Invoice name'
            )
        );
        
        $this->addElement(
            'Text',
            'name_search',
            array(
                'label' => 'Поле для поиска по имени'
            )
        );

        $this->addElement(
            'text',
            'price_base',
            array(
                'label' => 'Цена базовая'
            )
        );
        
        $this->addElement(
            'text',
            'total1',
            array(
                'label' => 'Цена Total1'
            )
        );
		
		$this->addElement(
            'text',
            'articlesaler',
            array(
                'label' => 'Артикул поставщика'
            )
        );
        
        /*$this->addElement(
            'text',
            'price_ngk2',
            array(
                'label' => 'Цена NGK2'
            )
        );
        
        $this->addElement(
            'text',
            'price_ngk3',
            array(
                'label' => 'Цена NGK3'
            )
        );*/
        
        $this->addElement(
            'Text',
            'env',
            array(
                'label' => 'Наличие'
            )
        );
	$this->addElement(
            'text',
            'warehouse_tver',
            array(
                'label' => 'Склад на Тверской'
            )
        );
	$this->addElement(
            'text',
            'warehouse_snab',
            array(
                'label' => 'Склад Томскснаб'
            )
        );
	$this->addElement(
            'text',
            'warehouse_snabfilt',
            array(
                'label' => 'Склад Томскснаб-Фильтра'
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
        
        $this->addElement(
            'Checkbox',
            'active',
            array(
                'label' => 'Активный',
                'checkedValue' => true
            )
        );
    }
}