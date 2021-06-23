<?php
class Report_Form_Report extends Engine_Form {
    public function init() {
        $this->setTableName('report');
        $this->setTableComment('Сообщения пользователей');
        
        $this->setPrimary('id');
        $this->addElement(
            'Text',
            'id',
            array(
                'label' => 'ID',
                'dbField' => array(
                    'type'  => 'smallint(5) unsigned',
                    'default'  => "NOT NULL",
                    'autoIncrement' => true
                ),
                'ignore' => true
            )
        );
        
        $this->addElement(
            'Date',
            'posted',
            array(
                'label' => 'Дата отправки'
            )
        );
        
        $this->addElement(
            'Text',
            'author',
            array(
                'label' => 'Автор',
                'dbField' => array(
                    'type'  => 'varchar(64)',
                    'default'  => "NOT NULL default ''"
                ),
                'required' => true
            )
        );
        
        $this->addElement(
            'Text',
            'email',
            array(
                'label' => 'Эл. почта',
                'dbField' => array(
                    'type'  => 'varchar(128)',
                    'default'  => "NOT NULL default ''"
                ),
                'required' => true,
                'validators' => array(
                    'EmailAddress'
                )
            )
        );
        
        $this->addElement(
            'Textarea',
            'message',
            array(
                'label' => 'Сообщение',
                'required' => true
            )
        );
        
        /*$this->addElement(
            'TinyMce',
            'answer',
            array(
                'label' => 'Ответ'
            )
        );
        
        $this->addElement(
            'Date',
            'posted_answer',
            array(
                'label' => 'Дата ответа'
            )
        );
        
        $this->addElement(
            'Checkbox',
            'display',
            array(
                'label' => 'Отображать'
            )
        );*/
        
        $this->addElement(
            'Text',
            'ip',
            array(
                'label' => 'IP',
                'dbField' => array(
                    'type'  => 'varchar(16)'
                )
            )
        );
        
        /*$this->addElement(
            'Checkbox',
            'send',
            array(
                'label' => 'Сообщение отправлено'
            )
        );
        
        $this->addElement(
            'Hidden',
            'send_count',
            array(
                'label' => 'Сообщение отправлено',
                'dbField' => array(
                    'type'  => 'tinyint(3) unsigned'
                ),
                'ignore' => true
            )
        );*/
    }
}