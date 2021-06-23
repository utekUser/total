<?php
class Report_Models_Report extends Engine_Model_Abstract {
    protected $_dbTableName = 'Report_Models_DbTable_Report';
    
    protected $_formTableName = 'Report_Form_Report';
    
    protected $_orderBy = 'posted DESC';
     
      
    public function saveNew($texts, $id = null) {
        
        $data = array(
            'author'  => $texts['author']->getValue(),
            'email'   => $texts['email']->getValue(),
            'message' => $texts['message']->getValue(),
            'posted'  => date('Y-m-d H:i:s'),
            'ip'      => $_SERVER['REMOTE_ADDR']
        );
        
        $this->getDbTable()->insert($data);

    }
}