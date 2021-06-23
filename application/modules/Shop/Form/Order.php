<?php
class Shop_Form_Order extends Engine_Form {
    public function init() {
        $this->setTableName('shop_order');
        $this->setTableComment('Заказ');
        
        $this->setPrimary('id');
        $this->addElement(
            'Text',
            'id',
            array(
                'label' => 'ID заказа',
                'dbField' => array(
                    'type'  => 'int(10) unsigned',
                    'default'  => "NOT NULL",
                    'autoIncrement' => true
                ),
                'ignore' => true
            )
        );

        /********** Заказ *************/
        $this->addElement(
            'Date',
            'date',
            array(
                'label' => 'Дата создания заказа'
            )
        );
        
        $this->addElement(
            'Date',
            'modified',
            array(
                'label' => 'Дата последнего изменения'
            )
        );
        
        $options = array();
        $table = new Shop_Models_OrderStatus();
        $select = $table->getStatus();
        foreach ($select as $value){
            $options[$value->id] = $value->name;
        }
        $this->addElement(
            'Select',
            'status_id',
            array(
                'label' => 'Текущий статус заказа',
                'multiOptions' => array('' => 'Выберите статус заказа'),
                'required' => true,
                'dbField' => array(
                    'type'  => 'int(10) unsigned',
                    'default'  => "NOT NULL default '0'"
                )
            )
        );
        $this->status_id->addMultiOptions($options);
        
        $this->addElement(
            'Date',
            'status_modified',
            array(
                'label' => 'Дата последнего изменения статуса'
            )
        );
        
        $this->addElement(
            'Text',
            'total_sum',
            array(
                'label' => 'Сумма заказа',
                'required' => true
            )
        );
        
        $this->addElement(
            'Checkbox',
            'rejected',
            array(
                'label' => 'Отклонен'
            )
        );
        
        $this->addElement(
            'Date',
            'rejection_date',
            array(
                'label' => 'Отклонен (дата)'
            )
        );
        
        $this->addElement(
            'Textarea',
            'rejection_reason',
            array(
                'label' => 'Причина отмены заказа'
            )
        );
        
        $this->addElement(
            'Checkbox',
            'active',
            array(
                'label' => 'Метка active'
            )
        );

        $this->addElement(
            'Checkbox',
            'deleted',
            array(
                'label' => 'Удален из истории пользователя'
            )
        );
        
        $this->addElement(
            'Select',
            'delivery_type',
            array(
                'label' => 'Способы доставки',
                'dbField' => array(
                    'type'  => 'tinyint(3) unsigned',
                    'default'  => "NOT NULL default '0'"
                ),
                'multiOptions' => array('1' => 'Самовывоз (Тверская, 18)', '2' => 'Доставка экспедитором (курьером)')
            )
        );
        
        $this->addElement(
            'Select',
            'payment_type',
            array(
                'label' => 'Способы оплаты',
                'dbField' => array(
                    'type'  => 'tinyint(3) unsigned',
                    'default'  => "NOT NULL default '0'"
                ),
                'multiOptions' => array('1' => 'Наличными', '2' => 'Безналичный расчет')
            )
        );
		
		$this->addElement(
            'Select',
            'warehouse_type',
            array(
                'label' => 'С какого склада забираем',
                'dbField' => array(
                    'type'  => 'tinyint(3) unsigned',
                    'default'  => "NOT NULL default '1'"
                ),
                'multiOptions' => array('1' => 'Тверская 18', '2' => 'Томскснаб', '3' => 'Томскснаб-Фильтра')
            )
        );
        
        /********** Данные покупателя *************/
        $this->addElement(
            'Text',
            'customer_name',
            array(
                'label' => 'Покупатель'
            )
        );

        $this->addElement(
            'Text',
            'customer_login',
            array(
                'label' => 'Логин покупателя'
            )
        );
        
        $this->addElement(
            'Text',
            'customer_email',
            array(
                'label' => 'E-Mail покупателя',
                'dbField' => array(
                    'type'  => 'varchar(128)',
                    'default'  => "NOT NULL default ''"
                ),
                'validators' => array(
                    'EmailAddress'
                )
            )
        );
        
        $this->addElement(
            'Text',
            'customer_phone',
            array(
                'label' => 'Логин покупателя'
            )
        );
        
        $this->addElement(
            'Select',
            'customer_type',
            array(
                'label' => 'Тип плательщика',
                'dbField' => array(
                    'type'  => 'tinyint(3) unsigned',
                    'default'  => "NOT NULL default '0'"
                ),
                'multiOptions' => array('0' => 'Физическое лицо', '1' => 'Юридическое лицо')
            )
        );
        
        $this->addElement(
            'Text',
            'company_name',
            array(
                'label' => 'Название компании'
            )
        );
        
        $this->addElement(
            'Text',
            'company_address',
            array(
                'label' => 'Юридический адрес'
            )
        );
        
        $this->addElement(
            'Text',
            'company_inn',
            array(
                'label' => 'ИНН'
            )
        );
        
        $this->addElement(
            'Text',
            'company_kpp',
            array(
                'label' => 'КПП'
            )
        );
        
        
        /********** Оплата *************/
        $this->addElement(
            'Checkbox',
            'payment',
            array(
                'label' => 'Оплачен'
            )
        );
        
        $this->addElement(
            'Date',
            'payment_date',
            array(
                'label' => 'Дата оплаты'
            )
        );
        
        $this->addElement(
            'Text',
            'payment_doc',
            array(
                'label' => 'Платежный документ'
            )
        );
        
        $this->addElement(
            'Date',
            'payment_doc_date',
            array(
                'label' => 'Дата платежного документа'
            )
        );
        
        /*********Комментарий*********/
        $this->addElement(
            'Textarea',
            'comment',
            array(
                'label' => 'Комментарий'
            )
        );
        
        $this->addElement(
            'Text',
            'pdf',
            array(
                'label' => 'PDF',
                'dbField' => array(
                    'type'  => 'varchar(255)',
                    'default'  => "NOT NULL default ''"
                )
            )
        );
		
		$this->addElement(
            'Checkbox',
            'send',
            array(
                'label' => 'Сообщение отправлено'
            )
        );
    }
}