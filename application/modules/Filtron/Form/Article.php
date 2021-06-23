    <?php
class Filtron_Form_Article extends Engine_Form {
    public function init() {
        $this->setTableName('filtron_articles');
        $this->setTableComment('Товары Filtron');
        
        $this->setPrimary('id');
        $this->addElement(
            'Text',
            'id',
            array(
                'label' => 'Id статьи',
                'dbField' => array(
                    'type'  => 'int(10) unsigned',
                    'default'  => "NOT NULL",
                    'autoIncrement' => true
                ),
                'ignore' => true
            )
        );
        
        $options = array();
        $table = new Filtron_Models_Section();
        $select = $table->getSection();
        foreach ($select as $value){
            $options[$value->id] = $value->name;
        }
        $this->addElement(
            'select',
            'section_id',
            array(
                'label' => 'Раздел',
                'multiOptions' => array('' => 'Выберите раздел'),
                'required' => true,
                'dbField' => array(
                    'type'  => 'int(10) unsigned',
                    'default'  => "NOT NULL default '0'"
                )
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
            'active',
            array(
                'label' => 'Активный',
                'checkedValue' => true
            )
        );		        
        $this->addElement(
            'text',
            'name',
            array(
                'label' => 'Заголовок статьи',
                'required' => true
            )
        );        
        $this->addElement(
            'Textarea',
            'short',
            array(
                'label' => 'Краткое описание'
            )
        );        
        $this->addElement(
            'Checkbox',
            'display',
            array(
                'label' => 'Отображать',
                'checked' => true
            )
        );                
        // Картинка (основная)
        $this->addElement(
            'FileImage',
            'picture',
            array(
                'destination' => 'public/filtron',
                'label' => 'Картинка (основная)',
                'type' => array(
                        'fixedscale' => array('width'=>'180', 'height'=>'125', 'color'=>'ffffff', 'ending'=>'p', 'watermark'=>false),
                        'bigscale' => array('width'=>'600', 'height'=>'400', 'color'=>'ffffff', 'ending'=>'b', 'watermark'=>false)
                    ),
                'ValueDisabled' => true
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
            'price_rec',
            array(
                'label' => 'Цена рекомендуемая'
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