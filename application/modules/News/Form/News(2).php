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
        
        $this->setPrimary('`id`'); // Имя индекса: PRIMARY
        
        // ID новости
        $this->addElement(
            'Hidden',
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
        
        // Короткое описание
        $this->addElement(
            'TinyMce',
            'short',
            array(
                'label' => 'Короткое описание',
                'required' => true
            )
        );
        
        // Полное описание
        $this->addElement(
            'TinyMce',
            'text',
            array(
                'label' => 'Полное описание'
            )
        );
        
        // Отображать
        $this->addElement(
            'Checkbox',
            'display',
            array(
                'label' => 'Отображать',
                'checked' => true,
                'Decorators' => array('ViewHelper')
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
        $this->picture->addFilter(new Engine_Filter_File_ImageResize(
        array(
            'name' => $this->picture->getName(),
            'path' => 'public/news',
            'type' => array(
                    'fixedscale' => array('width'=>'180', 'height'=>'125', 'color'=>'ffffff', 'ending'=>'p', 'watermark'=>false),
                    'bigscale' => array('width'=>'600', 'height'=>'400', 'color'=>'ffffff', 'ending'=>'b', 'watermark'=>false)
                )
            )
        ));
        
        // Картинки
        for ($i = 1; $i <= 5; $i++) {
            $this->addElement(
                'Image',
                'picture' . $i,
                array(
                    'destination' => 'public/news',
                    'label' => 'Картинка #' . $i
                )
            );
            $name = 'picture' . $i;
            $this->$name->addFilter(new Engine_Filter_File_ImageResize(
            array(
                'name' => $this->$name->getName(),
                'path' => 'public/news',
                'type' => array(
                        'fixedscale' => array('width'=>'180', 'height'=>'125', 'color'=>'ffffff', 'ending'=>'p', 'watermark'=>false),
                        'bigscale' => array('width'=>'600', 'height'=>'400', 'color'=>'ffffff', 'ending'=>'b', 'watermark'=>false)
                    )
                )
            ));
        }
        
        // Количество просмотров
        $this->addElement(
            'Hidden',
            'view',
            array(
                'label' => 'Количество просмотров',
                'field' => array(
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
                'field' => array(
                    'type'  => 'mediumint(8) unsigned',
                    'default'  => "NOT NULL default '0'"
                ),
                'ignore' => true
            )
        );
    }
}