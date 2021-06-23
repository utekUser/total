<?php
class User_Form_UserUser extends Engine_Form {
    public function init() {
        $this->setTableName('user');
        $this->setTableComment('Пользователь');
        
        $this->setPrimary('id');
        $this->addElement(
            'Text',
            'id',
            array(
                'label' => 'ID пользователя',
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
            'login',
            array(
                'label' => 'Логин',
                'dbField' => array(
                    'type'  => 'varchar(128)'
                ),
//                'validators' => array(
//                    'LoginExist'
//                ),
                'required' => true,
		'placeholder' => 'Логин*'
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
                'validators' => array(
                   'EmailAddress',
//                    'EmailExist'
                ),
                'required' => true,
		'placeholder' => 'E-mail*'
            )
        );
        
        
        $this->addElement(
            'Select',
            'type',
            array(
                'label' => 'Статус',
                'dbField' => array(
                    'type'  => 'tinyint(3) unsigned',
                    'default'  => "NOT NULL default '0'"
                ),
                'multiOptions' => array('0' => 'Физическое лицо', '1' => 'Юридическое лицо')
            )
        );
        
        
        $this->addElement(
            'Password',
            'password',
            array(
                'label' => 'Пароль',
                'dbField' => array(
                    'type'  => 'varchar(255)',
                    'default'  => "NOT NULL default ''"
                ),
//                'validators' => array(
//                    'StringLength' => array(5,5)
//                ),
                'required' => true,
                'ignore' => true,
		'placeholder' => 'Пароль*'
            )
        );
//        $this->password->addValidator('StringLength', false, array(6, 6));
        $this->password->addFilter(new Engine_Filter_Encrypt_Password(array()));
        
        $this->addElement(
            'Password',
            'verifypassword',
            array(
                'label' => 'Повтор пароля',
                'dbField' => array(
                    'type'  => 'varchar(255)',
                    'default'  => "NOT NULL default ''"
                ),
                'required' => true,
                'ignore' => true,
		'placeholder' => 'Повтор пароля*'
            )
        );
        $this->verifypassword->addFilter(new Engine_Filter_Encrypt_Password(array()));
        
        
        $this->addElement(
            'Hidden',
            'salt',
            array(
                'label' => 'Соль в пароле',
                'dbField' => array(
                    'type'  => 'varchar(64)'
                )
            )
        );
        
        $this->addElement(
            'Hidden',
            'password_temp',
            array(
                'dbField' => array(
                    'type'  => 'varchar(255)'
                )
            )
        );
        
        $this->addElement(
            'Hidden',
            'user_hash',
            array(
                'label' => 'Кэш для cookie',
                'dbField' => array(
                    'type'  => 'char(32)'
                )
            )
        );
        
        $this->addElement(
            'Hidden',
            'active',
            array(
                'label' => 'Активация',
                'dbField' => array(
                    'type'  => 'tinyint(1)'
                )
            )
        );
        
        $this->addElement(
            'Checkbox',
            'access',
            array(
                'label' => 'Доступ',
                'dbField' => array(
                    'type'  => 'tinyint(1)'
                )
            )
        );
        
        $this->addElement(
            'Hidden',
            'timestamp',
            array(
                'label' => 'Время на активацию',
                'dbField' => array(
                    'type'  => 'int(10)'
                )
            )
        );
        
        $this->addElement(
            'Hidden',
            'creation_date',
            array(
                'label' => 'Дата создания аккаунта',
                'dbField' => array(
                    'type'  => 'datetime',
                    'default'  => "NOT NULL default '0000-00-00 00:00:00'"
                )
            )
        );
        
        $this->addElement(
            'Hidden',
            'modified_date',
            array(
                'label' => 'Дата изменения аккаунта',
                'dbField' => array(
                    'type'  => 'datetime',
                    'default'  => "NOT NULL default '0000-00-00 00:00:00'"
                )
            )
        );
        
        $this->addElement(
            'Hidden',
            'lastlogin_date',
            array(
                'label' => 'Дата последнего захода',
                'dbField' => array(
                    'type'  => 'datetime',
                    'default'  => "NOT NULL default '0000-00-00 00:00:00'"
                )
            )
        );
        
        $this->addElement(
            'Hidden',
            'hashrestore',
            array(
                'label' => 'Кеш для восстановления пароля',
                'dbField' => array(
                    'type'  => 'char(32)'
                )
            )
        );
        
        $this->addElement(
            'Checkbox',
            'manager',
            array(
                'label' => 'Менеджер',
                'dbField' => array(
                    'type'  => 'tinyint(1)'
                )
            )
        );
		
		$options1 = array(
			"" => "",
		);
        $table1 = new Shop_Models_OrderManager();
        $select1 = $table1->getManagers();
        foreach ($select1 as $value1){
            $options1[$value1->id] = $value1->manager_name;
        }
		$this->addElement(
            'Select',
            'manager_id',
            array(
                'label' => 'Менеджер для смс',
                'dbField' => array(
                    'type'  => 'tinyint(3)',
                    'default'  => "NOT NULL default '0'"
                ),                
            )
        );
		$this->manager_id->addMultiOptions($options1);
        
		$this->addElement(
            'Checkbox',
            'isdeleted',
            array(
                'label' => 'Удален',
                'dbField' => array(
                    'type'  => 'tinyint(1)',
					'default'  => "NOT NULL default '0'"
                )
            )
        );
    }
}