<?php
require_once "./core/charts.php";

class Charts extends Model {

	private $path;

	private $watermark = "ИКБО-03-22. Панова Василиса Александровна";

	public function __construct() {
		parent::__construct("charts");
	}

	private function get_columns() {
		$q = "SELECT DISTINCT m.title, SUM(p.count) OVER(PARTITION BY m.ID) as sum FROM purchasing as p JOIN material as m on p.matID = m.ID;";
		
		$rows = parent::raw_query($q);
	
		$title = [];
		$sum = [];
	
		while ($row = $rows->fetch_assoc()) {
			$title[] = $row['title'];
			$sum[] = $row['sum'];
		}
	
		return [$title, $sum];
	}


	private function generate() {
		$dir = "/var/www/html";
		$folder = "/charts/";

		if (!is_dir($dir . $folder)) {
			mkdir($dir . $folder);
		}
		$names = [
			$folder . "line.png", 
			$folder . "bar.png", 
			$folder . "pie.png"];

		[$titles, $sums] = $this->get_columns();
		generate_charts($titles,$sums, $this->watermark,$dir, $names);

		$values = "";
		foreach ($names as $name) {
			$values .= "('" . $name . "'),";
		}
		
		$q = "INSERT INTO charts (path) VALUES " . substr($values, 0, -1);

		parent::raw_query($q);
	}

	public function read_all() {		
		$res = parent::read_all();
		if (empty($res) ) {
			$this->generate();
			$res = parent::read_all();
		}
		return $res;
	}

}