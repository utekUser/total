<?php
class Gallery_Form_GallerySection extends Engine_Form {
    public function init() {
        $this->setTableName('gallery_section');
        $this->setTableComment('Разделы фото');
        
        $this->setPrimaty('id');
        $this->setPrimatyType('smallint(5) unsigned');
        $this->setPrimatyComment('Разделы фото');
        
        
        $this->addElement(
            'Text',
            'name',
            array(
                'label' => 'Название раздела',
                'required' => true
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
                'label' => 'Отображать'
            )
        );
        
        $this->addElement(
            'Hidden',
            'pos',
            array(
                'label' => 'Позиция',
                'field' => array(
                    'type'  => 'smallint(5) unsigned'
                )
            )
        );        
       
    }
}