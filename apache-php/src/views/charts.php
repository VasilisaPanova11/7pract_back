<?php
require_once "./models/charts.php";

class ChartsView extends View {

	public function __construct() {
		$this->model = new Charts();
		$this->context = [
			"title" => "Фикстуры",
			"template" => "charts_list.php",
			"charts" => $this->model->read_all(),
			"back_url" => "/fixtures"
		];
	}

}
?>