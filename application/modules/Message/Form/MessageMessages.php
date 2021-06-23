<?php
class Message_Form_MessageMessages extends Engine_Form {
    public function init() {
        $this->setTableName('messages');
        $this->setTableComment('Сообщения');
        
        $this->setPrimary('message_id');
        
        $this->setUnique(array(
            '`CONVERSATIONS` (`conversation_id`, `message_id`)'
        ));
        
        $this->addElement(
            'Text',
            'message_id',
            array(
                'label' => 'Id сообщения',
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
            'conversation_id',
            array(
                'label' => 'Id темы сообщения',
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
                'label' => 'Автор',
                'dbField' => array(
                    'type'  => 'int(10) unsigned',
                    'default'  => "NOT NULL default '0'"
                )
            )
        );
        
        $this->addElement(
            'Text',
            'title',
            array(
                'label' => 'Заголовок',
                'dbField' => array(
                    'type'     => 'varchar(255)',
                    'default'  => "NOT NULL default ''"
                ),
                'required' => true
            )
        );
        
        $this->addElement(
            'Textarea',
            'body',
            array(
                'label' => 'Подробное описание',
                'required' => true,
                'attribs' => array(
                    'class' => 'input-long',
                    'cols' => '20',
                    'rows' => '5'
                )
            )
        );
        
        $this->addElement(
            'Date',
            'date',
            array(
                'label' => 'Дата добавления'
            )
        );
        
        
        $this->addElement(
            'Text',
            'attachment_type',
            array(
                'label' => 'Заголовок',
                'dbField' => array(
                    'type'     => 'varchar(24)',
                    'default'  => "NOT NULL default ''"
                )
            )
        );
        
        $this->addElement(
            'Text',
            'attachment_id',
            array(
                'label' => 'Автор',
                'dbField' => array(
                    'type'     => 'int(10) unsigned',
                    'default'  => "NOT NULL default '0'"
                )
            )
        );
        
    }
}