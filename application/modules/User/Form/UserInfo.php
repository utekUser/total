<?php
class User_Form_UserInfo extends Engine_Form {
    public function init() {
        $this->setTableName('user_info');
        $this->setTableComment('Данные пользователя');

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

//        $this->setPosition('pos');


        /************************Общее*/
        $options = array();
        $table = new User_Models_UserUser();
        $select = $table->getUsers();
        foreach ($select as $value){
            $options[$value->id] = $value->login;
        }
        $this->addElement(
            'select',
            'user_id',
            array(
                'label' => 'Пользователь',
                'multiOptions' => array('' => 'Выберите пользователя'),
                'dbField' => array(
                    'type'  => 'int(10) unsigned',
                    'default'  => "NOT NULL default '0'"
                )
            )
        );
        $this->user_id->addMultiOptions($options);


        $this->addElement(
            'Select',
            'price_type',
            array(
                'label' => 'Тип цены',
                'dbField' => array(
                    'type'  => 'tinyint(3) unsigned',
                    'default'  => "NOT NULL default '0'"
                ),
                'multiOptions' => array('0' => 'Базовая', '1' => 'Рекомендуемая')
            )
        );

        $this->addElement(
            'Text',
            'vip',
            array(
                'label' => 'Скидка'
            )
        );

        $this->addElement(
            'Text',
            'name',
            array(
                'label' => 'Контактное лицо',
                'required' => true,
		'placeholder' => 'Контактное лицо*'
            )
        );

        $this->addElement(
            'Textarea',
            'info',
            array(
                'label' => 'Дополнительная информация',
                'attribs' => array(
                    'class' => 'input-long',
                    'cols' => '20',                                      
                    'rows' => '5',
			'placeholder' => 'Дополнительная информация*'
                )
            )
        );

        /************************Для физического лица*/

        $this->addElement(
            'Text',
            'address',
            array(
                'label' => 'Адрес',
		'placeholder' => 'Адрес*'
            )
        );

        $this->addElement(
            'Text',
            'phone',
            array(
                'label' => 'Телефон',
                'required' => true,
		'placeholder' => 'Телефон*'
            )
        );

        /************************Для юридического лица*/
        $this->addElement(
            'Text',
            'title',
            array(
                'label' => 'Наименование организации',
                'required' => true,
		'placeholder' => 'Наименование организации*'
            )
        );

        $this->addElement(
            'Text',
            'ur_address',
            array(
                'label' => 'Юридический адрес',
                'required' => true,
		'placeholder' => 'Юридический адрес*'
            )
        );

        $this->addElement(
            'Text',
            'fact_address',
            array(
                'label' => 'Фактический адрес',
                'required' => true,
		'placeholder' => 'Фактический адрес*'
            )
        );

        $this->addElement(
            'Text',
            'ogrn',
            array(
                'label' => 'ОГРН',
                'required' => true,
		'placeholder' => 'ОГРН*'
            )
        );

        $this->addElement(
            'Text',
            'inn',
            array(
                'label' => 'ИНН',
                'required' => true,
		'placeholder' => 'ИНН*'
            )
        );

        $this->addElement(
            'Text',
            'bank',
            array(
                'label' => 'Банк',
                'required' => true,
		'placeholder' => 'Банк*'
            )
        );

        $this->addElement(
            'Text',
            'kpp',
            array(
                'label' => 'КПП',
                'required' => true,
		'placeholder' => 'КПП*'
            )
        );

        $this->addElement(
            'Text',
            'rs',
            array(
                'label' => 'Р/С',
                'required' => true,
		'placeholder' => 'Р/С*'
            )
        );

        $this->addElement(
            'Text',
            'ks',
            array(
                'label' => 'КС',
                'required' => true,
		'placeholder' => 'КС*'
            )
        );

        $this->addElement(
            'Text',
            'bik',
            array(
                'label' => 'БИК',
                'required' => true,
		'placeholder' => 'БИК*'
            )
        );

        $this->addElement(
            'Text',
            'okpo',
            array(
                'label' => 'ОКПО',
                'required' => true,
		'placeholder' => 'ОКПО*'
            )
        );

    }
}