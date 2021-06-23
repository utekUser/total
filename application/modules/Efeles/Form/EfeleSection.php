<?php
/**
 * Статьи
 *
 */
class Efeles_Form_EfeleSection extends Engine_Form {
    public function init() {
        $this->setTableName('efele_articles_section');
        $this->setTableComment('Разделы смазок Efele');
        
        $this->setPrimary('id'); 
        $this->addElement(
            'Text',
            'id',
            array(
                'label' => 'Разделы смазок',
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
        
        $this->addElement(
            'text',
            'name',
            array(
                'label' => 'Заголовок раздела',
                'required' => true
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
            'Url',
            'url',
            array(
                'label' => 'Ссылка',
                'required' => true
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
        
        
    }
}