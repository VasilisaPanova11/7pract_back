<?php
require_once "./models/fixtures.php";

class FixturesView extends View {

	public function __construct() {
		$this->model = new Fixtures();
		$this->context = [
			"title" => "Фикстуры",
			"template" => "fixtures_list.php",
			"fixtures" => $this->model->read_all()
		];
	}

}
?>