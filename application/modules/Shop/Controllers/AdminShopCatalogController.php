<?php
class Shop_Controllers_AdminShopCatalogController extends Core_Controller_Action_Admin {
    
 public function xml_attribute($object, $attribute) {
        if (isset($object[$attribute])) {
            return (string) $object[$attribute];
        }
    } 

    public function init() {
        $request = $this->getRequest();
        if ($request->getQuery('import') && $request->getQuery('import') == 1) {
            Engine_Controller_Action::setViewMain('import');
            Engine_Controller_Action::setDefaultParseUrlAction('import');
        }
        if($request->isPost()) {
            
            
            if ($request->getPost('_update')) {
                $updateType = $request->getPost('outFileAction');
                
                $path = APPLICATION_PATH . DS . 'temporary/catalog/'; 
                $xml = APPLICATION_PATH . DS . 'temporary/catalog/temp.xml'; 
                
                if (file_exists($xml)) {
                    $xml = simplexml_load_file($xml);
                    $oilModel = new Oils_Models_OilsOils();
                    $filterModel = new Filters_Models_FiltersFilters();
                    
                    if ($updateType == 'deact') {
                        $oilModel->deactivate();
                        $filterModel->deactivate();
                    }
                                
                    foreach ($xml->items as $key => $value) {
                        
                        foreach ($value->attributes() as $attributeskey => $attributesvalue){
                            for ($i = 0; $i < sizeof($value->item); $i++) {
                                
                                $base_id = (string) $value->item[$i]->Id;
                                $data = array();
                                $data = array(
                                    'base_id'      => $base_id,
                                    'display'      => 1,
                                    'active'       => 1,
                                    'name'         => (string) $value->item[$i]->Name,
                                    'full_name'    => (string) $value->item[$i]->FullName,
                                    'invoice_name' => (string) $value->item[$i]->InvoiceName,
                                    'env'          => (string) $value->item[$i]->env
                                );
//                                $prices = array();
//                                for ($j = 0; $j < sizeof($value->item[$i]->Prices->Price); $j++) {
//                                    $priceKey = $this->xml_attribute($value->item[$i]->Prices->Price[$j], 'Key');
//                                    $priceValue = $this->xml_attribute($value->item[$i]->Prices->Price[$j], 'Value');
//                                    echo $priceKey . ', ' . $priceValue . '<br/>';
//                                    if ($priceKey == 'Base') $data['price_rozn'] = $priceValue;
//                                    elseif ($priceKey == 'opt1') $data['price_opt1'] = $priceValue;
//                                }
                                $data['price_base'] = $this->xml_attribute($value->item[$i]->Prices->Price, 'Base');
                                $data['price_rec']  = $this->xml_attribute($value->item[$i]->Prices->Price, 'Mannрекомен');
//                                echo $priceKey . ', ' . $priceValue . '<br/>';

                                $data['name_search'] = preg_replace("/[^a-zA-Zа-яА-Я0-9]/u", "", (string) $value->item[$i]->InvoiceName);
//                                echo '<pre>'; print_r($data); echo '</pre>'; exit;
                                if ($attributesvalue == 'Масла ELF' || $attributesvalue == 'масла TOTAL') {
                                    if ($oilModel->issetOil($base_id)) {
                                        $oilModel->saveOil($data, $updateType, $base_id);
                                    } else {
                                        $oilModel->saveOil($data, $updateType);
                                    }
                                } elseif ($attributesvalue == 'MANN фильтры.') {
                                    $data['code'] = (string) $value->item[$i]->Name;
                                    if ($filterModel->issetFilter($base_id)) {
                                        $filterModel->saveFilter($data, $updateType, $base_id);
                                    } else {
                                        $filterModel->saveFilter($data, $updateType);
                                    }
                                }
                            }

                            
                        }
                    }
                    
                }
                
                
            }
            $formFile = new Shop_Form_CatalogFile();
            if ($formFile->isValid($request->getPost())) {
                $file = $formFile->file->getFileInfo();
                $ext = ltrim(strrchr($file['file']['name'], '.'), '.');
                
                $newName = APPLICATION_PATH . DS . 'temporary/catalog/' . 'temp.' . $ext;
                
                if (file_exists($newName)) {
                    unlink($newName); 
                }
                
                $formFile->file->addFilter('Rename', $newName);
                $formFile->file->receive();
            } else {
                $error = $formFile->getMessages();
                print_r($error);
            }
            
            if ($file = $_FILES['file']['tmp_name']) {
            }
            
            $this->_redirect('/admin/shop/catalog/?import=1');
        }
        
    }
   

    public function indexAction() {}
    
        
    public function importAction() {}
}