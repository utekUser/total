<?php
class Oils_Form_OilsOils extends Engine_Form {
    public function init() {
        $this->setTableName('oils');
        $this->setTableComment('Масла');
        
        $this->setPrimary('id');
        $this->addElement(
            'Text',
            'id',
            array(
                'label' => 'Id масла',
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
        
        $options = array();
        $table = new Oils_Models_OilsSection();
        $select = $table->getSection();
        foreach ($select as $value){
            $options[$value->id]['name'] = $value->name;
            $options[$value->id]['parent'] = $value->parent;
        }
        $this->addElement(
            'SelectMultiTree',
            'section_id',
            array(
                'label' => 'Раздел',
//                'multiOptions' => array('default' => array('name' => 'Родительский раздел', 'parent' => 0)),
                'required' => true,
                'dbField' => array(
                    'type'  => 'int(10) unsigned',
                    'default'  => "NOT NULL default '0'"
                ),
                'multiTable' => 'Oils_Models_OilsConnection'
            )
        );
        $this->section_id->addMultiOptions($options);
        
        
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
        
        
        $this->addElement(
            'Select',
            'litr',
            array(
                'label' => 'Литры',
                'dbField' => array(
                    'type'  => 'tinyint(3) unsigned',
                    'default'  => "NOT NULL default '0'"
                ),
                'multiOptions' => array(
                    '' => 'Выберите кол-во литров в упаковке', 
                    '1' => '1 литр', 
                    '2' => '2 литра', 
                    '3' => '4 литра', 
                    '4' => '5 литров', 
                    '6' => '20 литров', 
                    '5' => '60 литров',
                    '7' => '208 литров'
                )
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
            'FileImage',
            'picture',
            array(
                'destination' => 'public/oils',
                'label' => 'Картинка',
                'type' => array(
                        'fixedscale' => array('width'=>'100', 'height'=>'150', 'color'=>'ffffff', 'ending'=>'p', 'watermark'=>false),
                        'bigscale' => array('width'=>'600', 'height'=>'400', 'color'=>'ffffff', 'ending'=>'b', 'watermark'=>false)
                    ),
                'ValueDisabled' => true
            )
        );
        
        $this->addElement(
            'TinyMce',
            'info',
            array(
                'label' => 'Описание'
            )
        );
        
        $this->addElement(
            'text',
            'name_search',
            array(
                'label' => 'Поле для поиска по имени'
            )
        );
        
        $this->addElement(
            'text',
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