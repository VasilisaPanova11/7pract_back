<?php

class Fixtures extends Model {

	private $matID;
	private $count;
	private $city;
	private $name;
	private $surname;
	private $country;

	private $num_records = 50;
	public function __construct() {
		parent::__construct("purchasing");
	}
	private function next_data($faker, $number) {
		return "(" .
		$faker->numberBetween(1, $number) . "," .
		$faker->numberBetween(1, 100) . "," .
		"'" . addslashes($faker->city) . "'," .
		"'" . addslashes($faker->firstName) . "'," .
		"'" . addslashes($faker->lastName) . "'," .
		"'" . addslashes($faker->country) . "')";
	}

	private function generate() {
		$count = parent::raw_query("SELECT COUNT(*) as count FROM material");
		$count = (int)$count->fetch_row()[0];
		$faker = Faker\Factory::create("ru_RU");

		$fixtures = "";
		for ($i = 0; $i < $this->num_records - 1; ++$i) {
			$fixtures .= $this->next_data($faker, $count) . ",";
		}
		$fixtures .= $this->next_data($faker, $count);
		
		$q = "INSERT INTO purchasing (matID, count, city, name, surname, country) VALUES " . $fixtures;
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