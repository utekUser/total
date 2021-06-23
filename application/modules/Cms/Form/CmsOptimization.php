<?php
class Cms_Form_CmsOptimization extends Engine_Form {
    public function init() {
        $this->setTableName('cms_optimization');
        $this->setTableComment('Оптимизация');
        
//        $this->setPrimaty('id'); // по умолчанию тоже его
//        $this->setPrimatyType('tinyint(3) unsigned');
//        $this->setPrimatyComment('Оптимизация');
        
        $this->setUnique(array('(`id`)'));
        
        $this->addElement(
            'Text',
            'id',
            array(
                'label' => 'Оптимизация',
                'dbField' => array(
                    'type'  => 'int(10) unsigned',
                    'default'  => "NOT NULL",
                    'autoIncrement' => true
                ),
                'ignore' => true
            )
        );
        
        $this->addElement(
            'Textarea',
            'globaltitle',
            array(
                'label' => 'Заголовок (title)',
                'required' => true,
                'rows' => 5,
                'cols' => 45
            )
        );
        
        $this->addElement(
            'Textarea',
            'globaldesc',
            array(
                'label' => 'Описание (Description)',
                'required' => true,
                'rows' => 5,
                'cols' => 45
            )
        );
        
        $this->addElement(
            'Textarea',
            'globalkey',
            array(
                'label' => 'Ключевые слова (Keywords)',
                'required' => true,
                'rows' => 5,
                'cols' => 45
            )
        );
        
        $this->addElement(
            'Textarea',
            'globalalt',
            array(
                'label' => 'Для ссылок (title) и для картинок (alt)',
                'rows' => 5,
                'cols' => 45
            )
        );       
    }
}