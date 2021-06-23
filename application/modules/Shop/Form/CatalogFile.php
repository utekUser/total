<?php
class Shop_Form_CatalogFile extends Engine_Form {
    
    public function init() {
        
        $this->addElement(
            'FileSimple',
            'file',
            array(
                'destination' => 'public/catalog',
                'tempDestination' => 'temporary/catalog',
                'label' => 'Файл',
                'validators' => array(
                    'extension' => 'xml'
                )
            )
        );
    }
}