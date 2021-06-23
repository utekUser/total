<?php
class Cms_Form_CmsUser extends Engine_Form {
    public function init() {
        $this->setTableName('cms_user');
        $this->setTableComment('Пользователи');
        
//        $this->setPrimaty('id'); // по умолчанию тоже его
//        $this->setPrimatyType('int(10) unsigned');
//        $this->setPrimatyComment('Пользователи');

        $this->setPrimary('id');
        $this->addElement(
            'Text',
            'id',
            array(
                'label' => 'Пользователи',
                'dbField' => array(
                    'type'  => 'int(10) unsigned',
                    'default'  => "NOT NULL",
                    'autoIncrement' => true
                )
            )
        );          

        $this->addElement(
            'text',
            'login',
            array(
                'label' => 'Логин'
            )
        );
        
        $this->addElement(
            'text',
            'name',
            array(
                'label' => 'Имя'
            )
        );
        
        $this->addElement(
            'Password', // Класс
            'password', // Название поля в форме и в БД
            array(
                'label' => 'Пароль', // Название поля в форме и для комментария в БД
                'validators' => array(
                    'alnum',
                    //array('regex', false, '/^[a-z]/i')
                ),
                'dbField' => array(
                    'type'  => 'char(32)',
                    'default'  => "NOT NULL default ''",
                    'comment'  => 'Пароль'
                ),
                'required' => true, // Поле обязательно для заполнения
                //'filters'  => array('StringToLower'),
            )
        );
        
        $this->addElement(
            'Checkbox',
            'superadmin',
            array(
                'label' => 'Администратор',
				'validators' => array()
            )
        );
        
        $this->addElement(
            'Hidden',
            'pos',
            array(
                'label' => 'Позиция',
                'dbField' => array(
                    'type'  => 'int(10) unsigned',
                    'default'  => "NOT NULL default '0'",
                    'comment'  => 'Позиция'
                )
            )
        );
        
        $this->addElement(
            'Hidden',
            'salt',
            array(
                'label' => 'Логин',
                'dbField' => array(
                    'type'  => 'varchar(64)',
                    'default'  => "NOT NULL default ''",
                    'comment'  => 'Соль'
                ) 
            )
        );
        
        $this->addElement(
            'Hidden',
            'creation_date',
            array(
                'label' => 'Логин',
                'dbField' => array(
                    'type'  => 'datetime',
                    'default'  => "NOT NULL default '0000-00-00 00:00:00'",
                    'comment'  => 'Время регистрации'
                ) 
            )
        );
        
        $registry = Engine_Api::getInstance();
        $tablePrefix = $registry->getContainer()->tablePrefix;

        $login    = 'admin';
        $password = 'admin';
        
        $salt        = (string) rand(1000000, 9999999); // ���������� ����
        $md5Password = md5(md5(strtolower($login) . $password) . $salt . 'admin'); // � ���� ������ � ��� ����� ��������� md5-��� ������
        $nowDate     = date('Y-m-d H:i:s'); // ����� �����������
        
        $this->setForFirstCreate("
            INSERT INTO `" . $tablePrefix . "cms_user` (
                `id` ,
                `login` ,
                `name` ,
                `password` ,
                `superadmin` ,
                `pos` ,
                `salt` ,
                `creation_date` 
            )
            VALUES (
            NULL , 'admin', 'Администратор', '$md5Password', '1', '1', '$salt', '$nowDate'
            );
        ");
    }
}