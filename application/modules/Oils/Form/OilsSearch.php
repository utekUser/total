<?php
class Oils_Form_OilsSearch extends Engine_Form {
    public function init() {
        $this->setTableName('oils_search');
        $this->setTableComment('Поиск по маслам');
        
        $this->setPrimary('id');
        $this->addElement(
            'Text',
            'id',
            array(
                'label' => 'id',
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
            'login',
            array(
                'label' => 'Логин',
                'dbField' => array(
                    'type'     => 'varchar(150) unsigned',
                    'default'  => "NOT NULL default '0'"
                ),
                'ignore' => true
            )
        );
		
		$this->addElement(
            'Text',
            'brands',
            array(
                'label' => 'Бренд',
                'dbField' => array(
                    'type'     => 'varchar(512) unsigned',
                    'default'  => "NULL default NULL"
                ),
                'ignore' => true
            )
        );
		
		$this->addElement(
            'Text',
            'price',
            array(
                'label' => 'Цена',
                'dbField' => array(
                    'type'     => 'varchar(512) unsigned',
                    'default'  => "NULL default NULL"
                ),
                'ignore' => true
            )
        );
		
		$this->addElement(
            'Text',
            'type',
            array(
                'label' => 'Тип',
                'dbField' => array(
                    'type'     => 'varchar(1024) unsigned',
                    'default'  => "NULL default NULL"
                ),
                'ignore' => true
            )
        );
		
		$this->addElement(
            'Text',
            'capacity',
            array(
                'label' => 'Объём',
                'dbField' => array(
                    'type'     => 'varchar(1024) unsigned',
                    'default'  => "NULL default NULL"
                ),
                'ignore' => true
            )
        );
		
		$this->addElement(
            'Text',
            'viscosity',
            array(
                'label' => 'Класс вязкости',
                'dbField' => array(
                    'type'     => 'varchar(1024) unsigned',
                    'default'  => "NULL default NULL"
                ),
                'ignore' => true
            )
        );
		
		$this->addElement(
            'Text',
            'searchtype',
            array(
                'label' => 'Тип продукта',
                'dbField' => array(
                    'type'     => 'varchar(100)',
                    'default'  => "NOT NULL default 'oils'"
                ),
                'ignore' => true
            )
        );
		
		$this->addElement(
            'Text',
            'date',
            array(
                'label' => 'Дата',
                'dbField' => array(
                    'type'     => 'TIMESTAMP',
                    'default'  => "NOT NULL default CURRENT_TIMESTAMP"
                ),
                'ignore' => true
            )
        );
        

    }
}