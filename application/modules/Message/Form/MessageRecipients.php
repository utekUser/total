<?php
class Message_Form_MessageRecipients extends Engine_Form {
    public function init() {
        $this->setTableName('messages_recipients');
        $this->setTableComment('Сообщения');
        
        $this->setPrimary(array('user_id', 'conversation_id'));
//        $this->setPrimary('`id`');
        $this->setIndex(array(
            '`INBOX_UPDATED` (`user_id`, `conversation_id`, `inbox_updated`)',
            '`OUTBOX_UPDATED` (`user_id`, `conversation_id`, `outbox_updated`)'
        ));
//        $this->setUnique(array(
//            '`PRIMARY222` (`user_id`, `conversation_id`)',
//            '`PRIMARY333` (`user_id`, `conversation_id`)',
//        ));
//        $this->setFulltext(array(
//            '`INBOX_UPDATED` (`user_id`, `conversation_id`, `inbox_updated`)',
//            '`OUTBOX_UPDATED` (`user_id`, `conversation_id`, `outbox_updated`)'
//        ));
        
        
//        $this->setPrimaty('user_id');
//        $this->setPrimatyType('int(10) unsigned');
//        $this->setPrimatyComment('Сообщения');
        
        
        
//        $this->setPosition('pos');

        // УДАЛИТЬ!!!
//        $this->addElement(
//            'Text',
//            'id',
//            array(
//                'label' => 'Автор',
//                'dbField' => array(
//                    'type'  => 'int(10) unsigned',
//                    'default'  => "NOT NULL",
//                    'autoIncrement' => true
//                )
//            )
//        );
        
        $this->addElement(
            'Text',
            'user_id',
            array(
                'label' => 'Автор',
                'dbField' => array(
                    'type'  => 'int(10) unsigned',
                    'default'  => "NOT NULL default '0'"
                ),
                'ignore' => true
            )
        );
        
        $this->addElement(
            'Text',
            'conversation_id',
            array(
                'label' => 'ID темы сообщения',
                'dbField' => array(
                    'type'  => 'int(10) unsigned',
                    'default'  => "NOT NULL default '0'"
                )
            )
        );
        
        $this->addElement(
            'Text',
            'inbox_message_id',
            array(
                'label' => 'inbox_message_id',
                'dbField' => array(
                    'type'  => 'int(10) unsigned',
                    'default'  => "NOT NULL default '0'"
                )
            )
        );
        
        $this->addElement(
            'Date',
            'inbox_updated',
            array(
                'label' => 'inbox_updated'
            )
        );
        
        $this->addElement(
            'Checkbox',
            'inbox_read',
            array(
                'label' => 'inbox_read'
            )
        );
        
        $this->addElement(
            'Checkbox',
            'inbox_deleted',
            array(
                'label' => 'inbox_deleted'
            )
        );
        
        $this->addElement(
            'Text',
            'outbox_message_id',
            array(
                'label' => 'inbox_message_id',
                'dbField' => array(
                    'type'  => 'int(10) unsigned',
                    'default'  => "NOT NULL default '0'"
                )
            )
        );
        
        $this->addElement(
            'Date',
            'outbox_updated',
            array(
                'label' => 'outbox_updated'
            )
        );
        
        $this->addElement(
            'Checkbox',
            'outbox_deleted',
            array(
                'label' => 'outbox_deleted'
            )
        );

    }
}