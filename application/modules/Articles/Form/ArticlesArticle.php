    <?php
class Articles_Form_ArticlesArticle extends Engine_Form {
    public function init() {
        $this->setTableName('articles');
        $this->setTableComment('Статьи');
        
        $this->setPrimary('id');
        $this->addElement(
            'Text',
            'id',
            array(
                'label' => 'Id статьи',
                'dbField' => array(
                    'type'  => 'int(10) unsigned',
                    'default'  => "NOT NULL",
                    'autoIncrement' => true
                ),
                'ignore' => true
            )
        );
        
        $this->setPosition('pos');
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
        
        $options = array();
        $table = new Articles_Models_ArticlesSection();
        $select = $table->getSection();
        foreach ($select as $value){
            $options[$value->id] = $value->name;
        }
        $this->addElement(
            'select',
            'section_id',
            array(
                'label' => 'Раздел',
                'multiOptions' => array('' => 'Выберите раздел'),
                'required' => true,
                'dbField' => array(
                    'type'  => 'int(10) unsigned',
                    'default'  => "NOT NULL default '0'"
                )
            )
        );
        $this->section_id->addMultiOptions($options);
        
        $this->addElement(
            'Date',
            'posted',
            array(
                'label' => 'Дата публикации'
            )
        );
        
        $this->addElement(
            'text',
            'name',
            array(
                'label' => 'Заголовок статьи',
                'required' => true
            )
        );
        
        $this->addElement(
            'Url',
            'url',
            array(
                'label' => 'Ссылка'
            )
        );
        
        $this->addElement(
            'Textarea',
            'short',
            array(
                'label' => 'Краткое описание'
            )
        );
        
        $this->addElement(
            'TinyMce',
            'text',
            array(
                'label' => 'Подробное описание'
            )
        );
        
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
                'destination' => 'public/articles',
                'label' => 'Картинка (основная)',
                'type' => array(
                        'fixedscale' => array('width'=>'180', 'height'=>'125', 'color'=>'ffffff', 'ending'=>'p', 'watermark'=>false),
                        'bigscale' => array('width'=>'600', 'height'=>'400', 'color'=>'ffffff', 'ending'=>'b', 'watermark'=>false)
                    ),
                'ValueDisabled' => true
            )
        );
        
        for ($i = 1; $i <= 5; $i++) {
            $this->addElement(
                'FileImage',
                'picture' . $i,
                array(
                    'destination' => 'public/articles',
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
    }
}