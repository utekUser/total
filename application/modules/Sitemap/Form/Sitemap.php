<?php
/**
 * Карта сайта
 *
 */
class Sitemap_Form_Sitemap extends Engine_Form {
    /**
     * Инициализация
     *
     */
    public function init() {
        $this->setTableName('sitemap');
        $this->setTableComment('Карта сайта');
        
//        $this->setPrimaty('id'); // по умолчанию тоже его
//        $this->setPrimatyType('int(10) unsigned');
//        $this->setPrimatyComment('Карта сайта');
        
        $this->setPosition('pos');
        
        $this->setPrimary('id');
        $this->addElement(
            'Text',
            'id',
            array(
                'label' => 'Карта сайта',
                'dbField' => array(
                    'type'  => 'int(10) unsigned',
                    'default'  => "NOT NULL",
                    'autoIncrement' => true
                ),
                'ignore' => true
            )
        );
        
        // Раздел сайта
        $this->addElement(
            'Text',
            'name',
            array(
                'label' => 'Раздел сайта',
                'dbField' => array(
                    'type'  => 'varchar(255)',
                    'default'  => "NOT NULL default ''",
                    'comment'  => 'Раздел сайта'
                ),
                'required' => true
            )
        );
        
        // Заголовок страницы
        $this->addElement(
            'Text',
            'header',
            array(
                'label' => 'Заголовок страницы',
                'dbField' => array(
                    'type'  => 'varchar(255)',
                    'default'  => "NOT NULL default ''",
                    'comment'  => 'Заголовок страницы'
                )
            )
        );
        
        $registry = Engine_Api::getInstance();
        $tablePrefix = $registry->getContainer()->tablePrefix;
        $listTables = $registry->getContainer()->listTables;
        $options = array();
        if (in_array($tablePrefix . 'sitemap', $listTables)) {
            $table = new Sitemap_Models_Sitemap();
            $select = $table->getSection();

            foreach ($select as $value){
                $options[$value->id] = $value->name;
            }
        }
        

        
        $this->addElement(
            'Select',
            'parent',
            array(
                'label' => 'Родитель',
                'dbField' => array(
                    'type'  => 'int(10) unsigned',
                    'default'  => "NOT NULL default '0'",
                    'comment'  => 'Родитель'
                ),
                'multiOptions' => array('0' => '')
            )
        );
        
        // Добавить в верхнее меню
        $this->addElement(
            'Checkbox',
            'topmenu',
            array(
                'label' => 'Добавить в верхнее меню'
            )
        );
        
        // Добавить в левое меню
        $this->addElement(
            'Checkbox',
            'leftmenu',
            array(
                'label' => 'Добавить в левое меню'
            )
        );
        
        
        $this->parent->addMultiOptions($options);
        
        // Отображать
        $this->addElement(
            'Checkbox',
            'display',
            array(
                'label' => 'Отображать',
                'checked' => true
            )
        );
        
        // Путь
        $this->addElement(
            'Url',
            'url',
            array(
                'label' => 'Путь',
                'dbField' => array(
                    'type'  => 'varchar(255)',
                    'default'  => "NOT NULL default ''",
                    'comment'  => 'Путь'
                )
            )
        );
        
        // Текст
        $this->addElement(
            'TinyMce',
            'text',
            array(
                'label' => 'Текст'
            )
        );
        
        // Вывод во фрейме
        $this->addElement(
            'Checkbox',
            'plain',
            array(
                'label' => 'Вывод во фрейме' // Название поля в форме и для комментария в БД
            )
        );
        
        // Общий скин
        $this->addElement(
            'Checkbox',
            'skin',
            array(
                'label' => 'Общий скин' // Название поля в форме и для комментария в БД
            )
        );
        
        // Заголовок (title)
        $this->addElement(
            'Textarea',
            'title',
            array(
                'label' => 'Заголовок (title)',
                'dbField' => array(
                    'type'  => 'varchar(255)',
                    'default'  => "NOT NULL default ''",
                    'comment'  => 'Заголовок (title)'
                )
            )
        );
        
        // Описание (Description)
        $this->addElement(
            'Textarea',
            'description',
            array(
                'label' => 'Описание (Description)',
                'dbField' => array(
                    'type'  => 'varchar(255)',
                    'default'  => "NOT NULL default ''",
                    'comment'  => 'Описание (Description)'
                )
            )
        );
        
        // Ключевые слова (Keywords)
        $this->addElement(
            'Textarea',
            'keywords',
            array(
                'label' => 'Ключевые слова (Keywords)',
                'dbField' => array(
                    'type'  => 'varchar(255)',
                    'default'  => "NOT NULL default ''",
                    'comment'  => 'Ключевые слова (Keywords)'
                )
            )
        );
        
        // Примечание
        $this->addElement(
            'Textarea',
            'note',
            array(
                'label' => 'Примечание',
                'dbField' => array(
                    'type'  => 'varchar(255)',
                    'default'  => "NOT NULL default ''",
                    'comment'  => 'Примечание'
                )
            )
        );
        
        // Позиция
//        $this->addElement(
//            'Hidden',
//            'pos',
//            array(
//                'label' => 'Позиция',
//                'dbField' => array(
//                    'type'  => 'int(10) unsigned',
//                    'default'  => "NOT NULL default '0'",
//                    'comment'  => 'Позиция'
//                )
//            )
//        );
        
        // Первый
        $this->addElement(
            'Hidden',
            'first',
            array(
                'label' => 'Первый' // Название поля в форме и для комментария в БД
            )
        );
        
        // Следующий
        $this->addElement(
            'Hidden',
            'down',
            array(
                'label' => 'Следующий' // Название поля в форме и для комментария в БД
            )
        );
        
        // Модуль
        $this->addElement(
            'Hidden',
            'included_modules',
            array(
                'label' => 'Модуль',
                'dbField' => array(
                    'type'  => 'varchar(255)',
                    'default'  => "NOT NULL default ''",
                    'comment'  => 'Модуль'
                )
            )
        );
        
        $this->addElement(
            'Hidden',
            'pos',
            array(
                'label' => 'Позиция',
                'dbField' => array(
                    'type'     => 'int(10) unsigned',
                    'default'  => "NOT NULL default '0'"
                ),
                'ignore' => true
            )
        );
    }
}