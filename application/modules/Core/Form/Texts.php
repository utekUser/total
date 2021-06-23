<?php
class Texts_Form_Texts extends Engine_Form {
    public function init() {
        $this->setTableName('texts');
        $this->setTableComment('Шаблоны');
        
        $this->setPrimaty('id'); // по умолчанию тоже его
        $this->setPrimatyType('tinyint(3) unsigned');
        $this->setPrimatyComment('Шаблоны');
        
        $this->addElement(
            'text', // Класс
            'name', // Название поля в форме и в БД
            array(
                'label' => 'Название', // Название поля в форме и для комментария в БД
                'required' => true // Поле обязательно для заполнения
            )
        );
        
        $this->addElement(
            'TinyMce', // Класс
            'text', // Название поля в форме и в БД
            array(
                'label' => 'Текст' // Название поля в форме и для комментария в БД
            )
        );
        
        $this->addElement(
            'Hidden', // Класс
            'pos', // Название поля в форме и в БД
            array(
                'label' => 'Позиция', // Название поля в форме и для комментария в БД
                'field' => array(
                    'type'  => 'tinyint(3) unsigned', // тип поля
                    'default'  => "NOT NULL default '0'", // значение по умолчанию к полю в БД
                    'comment'  => 'Позиция' // комментарий к полю в БД
                )
            )
        );
        
        $this->addElement(
            'Checkbox', // Класс
            'display', // Название поля в форме и в БД
            array(
                'label' => 'Отображать' // Название поля в форме и для комментария в БД
            )
        );
    }
}