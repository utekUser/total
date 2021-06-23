<?php

class Oils_Controllers_AdminOilsSearchoilreportController extends Core_Controller_Action_Admin {

	/**
	 * Редиректор - определен для полноты кода
	 *
	 * @var Zend_Controller_Action_Helper_Redirector
	 */
	protected $_redirector = null;

	/**
	 * Инициализация
	 *
	 */
	public function init() {
		$this->_redirector = $this->_helper->getHelper('Redirector');
	}

	/**
	 * Главная, листинг
	 *
	 */
	public function indexAction() {
		$model = new Oils_Models_OilsSearch();
		//print_r($_POST); die;
		$searchResults = $model->getSearchByDate($_POST/*$_POST['startdate'], $_POST['enddate'], $POST['typesearch']*/);
		if ($_POST['typesearch'] == "filtron") {
			$headStr = "<b>фильтры Filtron</b>";
			$type = 6;
		} else if ($_POST['typesearch'] == "efeles") {
			$headStr = "<b>смазочных материалов</b>";
			$type = 6;
		} else if ($_POST['typesearch'] == "autoparts") {
			$headStr = "<b>автомобильных запчастей</b>";
			$type = 5;
		} else if ($_POST['typesearch'] == "coolstreams") {
			$headStr = "<b>охлаждающих жидкостей</b>";
			$type = 4;
		} else if ($_POST['typesearch'] == "plugs") {
			$headStr = "<b>свечей</b>";
			$type = 3;
		} else if ($_POST['typesearch'] == "filters") {
			$headStr = "<b>фильтров</b>";
			$type = 2;
		} else {
			$headStr = "<b>масел</b>";
			$type = 1;
		}
		$html = "<p>Отчет по поиску " . $headStr ." пользователями.</p>";
		$html .= "<p>Заданный период: <strong>c " . $_POST['startdate'] . " по " . $_POST['enddate'] . "</strong></p>";
		$html .= "<p>Время формирования отчета: <strong>" . date("d-m-Y h:i:s") . "</strong></p>";

		if ($type == 1) {
			$table = "<table><thead><tr>"
				. "<th style='width: 7%;border-bottom: 1px solid #000000;border-top: 1px solid #000000;'>П/п</th>"
				. "<th style='width: 80px;border-bottom: 1px solid #000000;border-top: 1px solid #000000;'>Пользователь</th>"
				. "<th style='width: 13%;border-bottom: 1px solid #000000;border-top: 1px solid #000000;'>Марка</th>"
				. "<th style='width: 13%;border-bottom: 1px solid #000000;border-top: 1px solid #000000;'>Цена</th>"
				. "<th style='width: 13%;border-bottom: 1px solid #000000;border-top: 1px solid #000000;'>Тип</th>"
				. "<th style='width: 13%;border-bottom: 1px solid #000000;border-top: 1px solid #000000;'>Объём</th>"
				. "<th style='width: 13%;border-bottom: 1px solid #000000;border-top: 1px solid #000000;'>Вязкость</th>"
				. "<th style='width: 13%;border-bottom: 1px solid #000000;border-top: 1px solid #000000;'>Дата</th>"
				. "</tr></thead><tbody>";
			$i = 1;
			foreach ($searchResults as $key => $value) {
				$table .= "<tr><td style='border-bottom: 1px solid #000000;'>" . $i . "</td>"
					. "<td style='border-bottom: 1px solid #000000;'>" . $value->login . "</td>"
					. "<td style='border-bottom: 1px solid #000000;'>" . $this->getParamAsString($value->brands) . "</td>"
					. "<td style='border-bottom: 1px solid #000000;'>" . $this->getParamAsString($value->price) . "</td>"
					. "<td style='border-bottom: 1px solid #000000;'>" . $this->getParamAsString($value->type) . "</td>"
					. "<td style='border-bottom: 1px solid #000000;'>" . $this->getParamAsString($value->capacity) . "</td>"
					. "<td style='border-bottom: 1px solid #000000;'>" . $this->getParamAsString($value->viscosity) . "</td>"
					. "<td style='border-bottom: 1px solid #000000;'>" . $value->date . "</td>"
					. "</tr>";
				$i++;
			}
			$table .= "</tbody></table>";
		} else {
			$table = "<table><thead><tr>"
				. "<th style='width: 7%;border-bottom: 1px solid #000000;border-top: 1px solid #000000;'>П/п</th>"
				. "<th style='width: 80px;border-bottom: 1px solid #000000;border-top: 1px solid #000000;'>Пользователь</th>"
				. "<th style='width: 13%;border-bottom: 1px solid #000000;border-top: 1px solid #000000;'>Строка поиска</th>"
				. "<th style='width: 13%;border-bottom: 1px solid #000000;border-top: 1px solid #000000;'>Найденное количество</th>"
				. "<th style='width: 13%;border-bottom: 1px solid #000000;border-top: 1px solid #000000;'>Дата</th>"
				. "</tr></thead><tbody>";
			$i = 1;
			foreach ($searchResults as $key => $value) {
				$table .= "<tr><td style='border-bottom: 1px solid #000000;'>" . $i . "</td>"
					. "<td style='border-bottom: 1px solid #000000;'>" . $value->login . "</td>"
					. "<td style='border-bottom: 1px solid #000000;'>" . $this->getParamAsString($value->brands) . "</td>"
					. "<td style='border-bottom: 1px solid #000000;'>" . $this->getParamAsString($value->price) . "</td>"
					. "<td style='border-bottom: 1px solid #000000;'>" . $value->date . "</td>"
					. "</tr>";
				$i++;
			}
			$table .= "</tbody></table>";
		}
		$html .= $table;
		
		ob_clean();
		//$mpdf = new mPDF('ru-RU', 'A4', '', '', 5, 5, 5, 5, 0, 0);
		$mpdf = new Mpdf\Mpdf();
		$mpdf->WriteHTML($html);
		$mpdf->Output();
	}
	
	public function getParamAsString($param) {
		$result = null;
		if ($param === NULL) {
			$result = "нет";
		} else {
			$arr = explode("###", $param);
			//echo '<pre>'; print_r($arr);
			if ($arr[0] == "") {
				$result = "нет";
			} else {
				foreach ($arr as $key => $value) {
					if (($key > 0) && $value != "")
						$result .= ", ";
					$result .= $value;
				}
			}			
		}
		return $result;
	}

}
