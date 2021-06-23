<?php
class Message_Form_MessageConversations extends Engine_Form {
    public function init() {
        $this->setTableName('messages_conversations');
        $this->setTableComment('Темы сообщений');
        
//        $this->setPrimaty('conversation_id');
//        $this->setPrimatyType('int(10) unsigned');
//        $this->setPrimatyComment('ID темы сообщения');

        $this->setUnique(array('(conversation_id)'));
        
        $this->addElement(
            'Text',
            'conversation_id',
            array(
                'label' => 'ID темы сообщения',
                'dbField' => array(
                    'type'  => 'int(10) unsigned',
                    'default'  => "NOT NULL",
                    'autoIncrement' => true
                ),
                'ignore' => true
            )
        );
        
//        $this->setPosition('pos');
        
        $this->addElement(
            'Text',
            'title',
            array(
                'label' => 'Заголовок',
                'dbField' => array(
                    'type'     => 'varchar(255)',
                    'default'  => "NOT NULL default ''"
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
            'recipients',
            array(
                'label' => 'Автор',
                'dbField' => array(
                    'type'  => 'int(10) unsigned',
                    'default'  => "NOT NULL default '0'"
                )
            )
        );
        
        $this->addElement(
            'Date',
            'modified',
            array(
                'label' => 'Дата добавления'
            )
        );
        
        $this->addElement(
            'Checkbox',
            'locked',
            array(
                'label' => 'Отображать'
            )
        );
        
    }
}