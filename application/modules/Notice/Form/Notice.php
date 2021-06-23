<?php
class Notice_Form_Notice extends Engine_Form {
    public function init() {
        $this->setTableName('notice');
        $this->setTableComment('Уведомления');
        
        $this->setPrimary('id'); 
        $this->addElement(
            'Text',
            'id',
            array(
                'label' => 'ID уведомления',
                'dbField' => array(
                    'type'  => 'int(10) unsigned',
                    'default'  => "NOT NULL",
                    'autoIncrement' => true
                ),
                'ignore' => true
            )
        );
        
        $this->addElement(
            'select',
            'type',
            array(
                'label' => 'Тип пользователей',
                'multiOptions' => array(0 => 'Для всех', 1 => 'Для физ. лиц', 2 => 'Для юр. лиц'),
                'required' => true,
                'dbField' => array(
                    'type'  => 'int(10) unsigned',
                    'default'  => "NOT NULL default '0'"
                )
            )
        );
        
        $this->addElement(
            'Date',
            'posted',
            array(
                'label' => 'Дата добавления',
                'value' => date('Y-m-d H:i:s')
            )
        );
        
        $this->addElement(
            'Text',
            'name',
            array(
                'label' => 'Заголовок',
                'required' => true
            )
        );
        
        $this->addElement(
            'TinyMce',
            'message',
            array(
                'label' => 'Сообщение',
            )
        );      
    }
}