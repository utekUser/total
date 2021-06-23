<?php
class Notice_Form_Connection extends Engine_Form {
    public function init() {
        $this->setTableName('notice_connection');
        $this->setTableComment('Уведомления');
        
        $this->setPrimary('id'); 
        $this->addElement(
            'Text',
            'id',
            array(
                'label' => 'ID',
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
            'message_id',
            array(
                'label' => 'Id уведомления',
                'required' => true,
                'dbField' => array(
                    'type'  => 'int(10) unsigned',
                    'default'  => "NOT NULL default '0'"
                )
            )
        );
        
        $this->addElement(
            'Text',
            'user_id',
            array(
                'label' => 'Id пользователя',
                'required' => true,
                'dbField' => array(
                    'type'  => 'int(10) unsigned',
                    'default'  => "NOT NULL default '0'"
                )
            )
        );
        
        $this->addElement(
            'Text',
            'view',
            array(
                'label' => 'Просмотрено',
                'required' => true,
                'dbField' => array(
                    'type'  => 'int(10) unsigned',
                    'default'  => "NOT NULL default '0'"
                )
            )
        );
        
        $this->addElement(
            'Date',
            'viewed',
            array(
                'label' => 'Дата просмотра',
            )
        );
    }
}