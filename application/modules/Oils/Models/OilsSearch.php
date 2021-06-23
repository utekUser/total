<?php

class Oils_Models_OilsSearch extends Engine_Model_Abstract {

	protected $_dbTableName = 'Oils_Models_DbTable_OilsSearch';
	protected $_formTableName = 'Oils_Form_OilsSearch';

	public function saveSearch($data, $id = null) {

		if (null === $id) { //вставка новой записи
			$this->getDbTable()->insert($data);
		} else { //для существующей записи
			$this->getDbTable()->update($data, array('id = ?' => $id));
		}
	}

	public function getSearchByDate($data/*$dateStart, $dateEnd, $type*/) {
		$table = $this->getDbTable();
		$select = $table->select()
			->where('date > \'' . $data['startdate'] . ' 00:00:00\'')
			->where('date < \'' . $data['enddate'] . ' 23:59:59\'')
			->where('searchtype = \'' . $data['typesearch'] . '\'')
			->where('login != \'Неавторизованный пользователь\'')
			->where('archive = 0')
			->order('date ASC');
			//echo '<pre>' . print_r($data) . '--- ggg'; print_r($select); die;
		$result = $table->fetchAll($select);
        	return $result;
	}

}
