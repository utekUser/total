<?php
class Plug_Controllers_AdminPlugImportController extends Core_Controller_Action_Admin {

    protected $_redirector = null;
    
    protected $_form = array(
        'Plug_Form_Plug'
    ); 
    
    public function init() {
        $this->_redirector = $this->_helper->getHelper('Redirector');
    }
   
    public function xml_attribute($object, $attribute) {
        if (isset($object[$attribute])) {
            return (string) $object[$attribute];
        }
    }

    public function indexAction() {
        $path = APPLICATION_PATH . DS . 'temporary/catalog/'; 
        $xml = APPLICATION_PATH . DS . 'temporary/catalog/ostatki_na_sklade_v8.xml';
        if (file_exists($xml)) {
            $xml = simplexml_load_file($xml);
            $plugModel = new Plug_Models_Plug();
                                  
            foreach ($xml->Root->items as $key => $value) {
                
                foreach ($value->attributes() as $attributeskey => $attributesvalue) {
                    if ($attributesvalue == 'Свечи NGK') {
                        for ($i = 0; $i < sizeof($value->item); $i++) {
                            
                            $base_id = (string) $value->item[$i]->Id;
                            $data = array();
                            $data = array(
                                'base_id'      => $base_id,
                                'name'         => (string) $value->item[$i]->Name,
                                'full_name'    => (string) $value->item[$i]->FullName,
                                'invoice_name' => (string) $value->item[$i]->InvoiceName,
                                'name_search'  => preg_replace("/[^a-zA-Zа-яА-Я0-9]/u", "", (string) $value->item[$i]->InvoiceName),
                                'price_base'   => $this->xml_attribute($value->item[$i]->Prices->Price, 'Base'),
                                'price_ngk1'   => $this->xml_attribute($value->item[$i]->Prices->Price, 'NGK1'),
                                'price_ngk2'   => $this->xml_attribute($value->item[$i]->Prices->Price, 'NGK2'),
                                'price_ngk3'   => $this->xml_attribute($value->item[$i]->Prices->Price, 'NGK3'),
                                'env'          => (string) $value->item[$i]->env,
                                'display'      => 1
                            );
                            if ($plugModel->issetPlug($base_id)) {
                                $plugModel->savePlug($data, $base_id);
                            } else {
                                $plugModel->savePlug($data);
                            }
                        }
                    }
                }
            }
        }
        exit;
    }


}