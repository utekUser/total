<?php
/**
 * Новости
 *
 */
class Callme_Form_Callme extends Engine_Form {
    /**
     * Инициализация
     *
     */
    public function init() {
        $this->setTableName('callme'); // Имя таблицы в БД без префикса
        $this->setTableComment('Заказать звонок'); // Описание таблицы в БД
        
        $this->setPrimary('id'); 
        $this->addElement(
            'Text',
            'id',
            array(
                'label' => 'ID заказа',
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
            'name',
            array(
                'label' => 'Имя',
                'dbField' => array(
                    'type'     => 'varchar(256)',
                    'default'  => "NOT NULL default NULL"
                ),
            )
        );
        
        $this->addElement(
            'Text',
            'phone',
            array(
                'label' => 'Телефон',
                'dbField' => array(
                    'type'     => 'varchar(256)',
                    'default'  => "NOT NULL default NULL"
                ),
            )
        );
        
        $this->addElement(
            'TinyMce',
            'comment',
            array(
                'label' => 'Сообщение',
                'dbField' => array(
                    'type'     => 'TEXT',
                    'default'  => "NOT NULL default NULL"
                ),
            )
        );
        
        $this->addElement(
            'Date',
            'date',
            array(
                'label' => 'Дата',
                'dbField' => array(
                    'type'     => 'TIMESTAMP',
                    'default'  => "NOT NULL default CURRENT_TIMESTAMP"
                ),
            )
        );
    }
}