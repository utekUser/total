<?php
/**
 * Новости
 *
 */
class News_Form_News extends Engine_Form {
    /**
     * Инициализация
     *
     */
    public function init() {
        $this->setTableName('news'); // Имя таблицы в БД без префикса
        $this->setTableComment('Новости'); // Описание таблицы в БД
        
        $this->setPrimary('id'); 
        $this->addElement(
            'Text',
            'id',
            array(
                'label' => 'ID новости',
                'dbField' => array(
                    'type'  => 'int(10) unsigned',
                    'default'  => "NOT NULL",
                    'autoIncrement' => true
                ),
                'ignore' => true
            )
        );
        
        $this->addElement(
            'Select',
            'type',
            array(
                'label' => 'Тип цены',
                'dbField' => array(
                    'type'  => 'tinyint(3) unsigned',
                    'default'  => "NOT NULL default '0'"
                ),
                'multiOptions' => array('0' => 'Для всех', '1' => 'Только для физических лиц', '2' => 'Только для юридических лиц')
            )
        );
        
        // Дата публикации
        $this->addElement(
            'Date',
            'posted',
            array(
                'label' => 'Дата публикации',
//                'value' => date('Y-m-d H:i:s')
            )
        );
        
        // Заголовок
        $this->addElement(
            'Text',
            'name',
            array(
                'label' => 'Заголовок',
                'required' => true
            )
        );
        
        // Ссылка         
        $this->addElement(
            'Url',
            'url',
            array(
                'label' => 'Ссылка',
                'dbField' => array(
                    'type'  => 'varchar(64)',
                    'default'  => "NOT NULL default ''"
                )
            )
        );
        
//         Короткое описание
        $this->addElement(
            'TinyMce',
            'short',
            array(
                'label' => 'Короткое описание',
                'required' => true
            )
        );
        
//         Полное описание
        $this->addElement(
            'TinyMce',
            'text',
            array(
                'label' => 'Полное описание',
            )
        );
        
        // Отображать
        $this->addElement(
            'Checkbox',
            'display',
            array(
                'label' => 'Отображать',
                'checked' => true
            )
        );
        
        // Картинка (основная)
        $this->addElement(
            'FileImage',
            'picture',
            array(
                'destination' => 'public/news',
                'label' => 'Картинка (основная)',
                'type' => array(
                        'fixedscale' => array('width'=>'180', 'height'=>'125', 'color'=>'ffffff', 'ending'=>'p', 'watermark'=>false),
                        'bigscale' => array('width'=>'600', 'height'=>'400', 'color'=>'ffffff', 'ending'=>'b', 'watermark'=>false)
                    ),
                'ValueDisabled' => true
            )
        );
        // Не отображать
        $this->addElement(
                'Checkbox',
                'picture_display',
                array(
                        'label' => 'Не отображать',
                        'checked' => false
                )
        );
        
        // Картинки
        for ($i = 1; $i <= 5; $i++) {
            $this->addElement(
                'FileImage',
                'picture' . $i,
                array(
                    'destination' => 'public/news',
                    'label' => 'Картинка #' . $i,
                    'type' => array(
                            'fixedscale' => array('width'=>'180', 'height'=>'125', 'color'=>'ffffff', 'ending'=>'p', 'watermark'=>false),
                            'bigscale' => array('width'=>'600', 'height'=>'400', 'color'=>'ffffff', 'ending'=>'b', 'watermark'=>false)
                        ),
                    'ValueDisabled' => true
                )
            );
        }
        
        // Количество просмотров
        $this->addElement(
            'Hidden',
            'view',
            array(
                'label' => 'Количество просмотров',
                'dbField' => array(
                    'type'  => 'mediumint(8) unsigned',
                    'default'  => "NOT NULL default '0'"
                ),
                'ignore' => true
            )
        );
        
        // Количество комментариев
        $this->addElement(
            'Hidden',
            'comment',
            array(
                'label' => 'Количество комментариев',
                'dbField' => array(
                    'type'  => 'mediumint(8) unsigned',
                    'default'  => "NOT NULL default '0'"
                ),
                'ignore' => true
            )
        );
        
        // Акция
        $this->addElement(
                'Checkbox',
                'stock',
                array(
                    'label' => 'Акция',
                    'checked' => false
                )
        );
        
        // Акция действительна до:
        $this->addElement(
                'Date',
                'stock_date',
                array(
                        'label' => 'Акция действительна до',
                        //                'value' => date('Y-m-d H:i:s')
                )
        );
    }
}