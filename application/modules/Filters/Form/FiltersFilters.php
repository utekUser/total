<?php
class Filters_Form_FiltersFilters extends Engine_Form {
    public function init() {
        $this->setTableName('filters');
        $this->setTableComment('Фильтра');
        
        $this->setPrimary('id');
        $this->addElement(
            'Text',
            'id',
            array(
                'label' => 'Id фильтра',
                'dbField' => array(
                    'type'  => 'int(10) unsigned',
                    'default'  => "NOT NULL",
                    'autoIncrement' => true
                ),
                'ignore' => true
            )
        );        


        $this->setPosition('pos');
        $this->addElement(
            'Hidden',
            'pos',
            array(
                'label' => 'Позиция',
                'dbField' => array(
                    'type'     => 'int(10) unsigned',
                    'default'  => "NOT NULL default '0'"
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
        
        $options = array();
        $table = new Filters_Models_FiltersSection();
        $select = $table->getSection();
        foreach ($select as $value){
            $options[$value->fk_id] = $value->name;
        }
        $this->addElement(
            'select',
            'section_id',
            array(
                'label' => 'Раздел',
                'multiOptions' => array('' => 'Выберите раздел'),
                'required' => true,
                'dbField' => array(
                    'type'  => 'varchar(255)',
                    'default'  => "NOT NULL default ''"
                )
            )
        );
        $this->section_id->addMultiOptions($options);
        
        
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
        
        /*$this->addElement(
            'text',
            'price_rozn',
            array(
                'label' => 'Цена (розница)'
            )
        );
        
        $this->addElement(
            'text',
            'price_opt1',
            array(
                'label' => 'Цена (ОПТ-1)'
            )
        );
        
        $this->addElement(
            'text',
            'price_opt2',
            array(
                'label' => 'Цена (ОПТ-2)'
            )
        );
        
        $this->addElement(
            'text',
            'price_opt3',
            array(
                'label' => 'Цена (ОПТ-3)'
            )
        );*/
        
        $this->addElement(
            'text',
            'price_base',
            array(
                'label' => 'Цена базовая'
            )
        );
        
        $this->addElement(
            'text',
            'price_rec',
            array(
                'label' => 'Цена рекомендуемая'
            )
        );
        
        $this->addElement(
                'text',
                'mann1',
                array(
                        'label' => 'MannIколруб'
                )
        );
        
        
        $this->addElement(
            'Text',
            'code',
            array(
                'label' => 'Артикул'
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
    }
}