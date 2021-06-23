<?php

class Callme_Models_Callme extends Engine_Model_Abstract {

    protected $_dbTableName = 'Callme_Models_DbTable_Callme';
    protected $_formTableName = 'Callme_Form_Callme';

    public function saveCallorder($data, $id = null) {

        if (null === $id) { //вставка новой записи
            $this->getDbTable()->insert($data);
        } else { //для существующей записи
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }

}

?>