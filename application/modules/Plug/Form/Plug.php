<?php
class Plug_Form_Plug extends Engine_Form {
    public function init() {
        $this->setTableName('plug');
        $this->setTableComment('Свечи');
        
        $this->setPrimary('id');
        $this->addElement(
            'Text',
            'id',
            array(
                'label' => 'Id свечи',
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
            'price_ngk1',
            array(
                'label' => 'Цена NGK1'
            )
        );
        
        $this->addElement(
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
        );
        
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