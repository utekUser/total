<?php
class Comments_Form_Comments extends Engine_Form {
    public function init() {
        $this->setTableName('comments');
        $this->setTableComment('Комментарии');
        
        $this->setPrimaty('id'); // по умолчанию тоже его
        $this->setPrimatyType('int(10) unsigned');
        $this->setPrimatyComment('Комментарии');
        
        
        $this->addElement(
            'Text',
            'resource_type',
            array(
                'label' => 'Тип объекта',
                'field' => array(
                    'type'  => 'varchar(32)',
                    'default'  => "NOT NULL default ''"
                )
            )
        );
        
        $this->addElement(
            'Text',
            'resource_id',
            array(
                'label' => 'ID объекта',
                'field' => array(
                    'type'  => 'int(10) unsigned',
                    'default'  => "NOT NULL default '0'"
                )
            )
        );

        $this->addElement(
            'Text',
            'poster_type',
            array(
                'label' => 'Тип субъекта',
                'field' => array(
                    'type'  => 'varchar(32)',
                    'default'  => "NOT NULL default ''"
                )
            )
        );
        
        $this->addElement(
            'Text',
            'poster_id',
            array(
                'label' => 'ID субъекта',
                'field' => array(
                    'type'  => 'int(10) unsigned',
                    'default'  => "NOT NULL default '0'"
                )
            )
        );
        
        $this->addElement(
            'Textarea',
            'body',
            array(
                'label' => 'Сообщение',
                'required' => true,
                'rows' => 5,
                'cols' => 45,
                'class' => 'book-input-i'
            )
        );
        
        $this->addElement(
            'Date',
            'creation_date',
            array(
                'label' => 'Дата добавления',
                'field' => array(
                    'type'  => 'datetime',
                    'default'  => "NOT NULL default '0000-00-00 00:00:00'"
                )
            )
        );
        
        $this->addElement(
            'Text',
            'username',
            array(
                'label' => 'Имя',
                'field' => array(
                    'type'  => 'varchar(128)',
                    'default'  => "NOT NULL default ''"
                ),
                'required' => true,
                'class' => 'book-input-i'
            )
        );

        $this->addElement(
            'Text',
            'email',
            array(
                'label' => 'Эл. почта',
                'field' => array(
                    'type'  => 'varchar(128)',
                    'default'  => "NOT NULL default ''"
                ),
                'validators' => array(
                    'EmailAddress'
                ),
                'class' => 'book-input-i'
            )
        );
        
        $this->addElement(
            'Checkbox',
            'display_email',
            array(
                'label' => 'Отображать e-mail'
            )
        );
        
        $this->addElement(
            'Text',
            'remote_address',
            array(
                'label' => 'IP',
                'field' => array(
                    'type'  => 'varchar(16)',
                    'default'  => "NOT NULL default ''"
                )
            )
        );
    }
}