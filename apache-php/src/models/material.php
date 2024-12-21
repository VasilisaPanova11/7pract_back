<?php

class Material extends Model {
	public $title;
	public $discription;
	public $cost;

	public function __construct() {
		parent::__construct("material");
	}

	public function parseJSON() {
		$data = parent::parseJSON();
		if (!isset($data["title"])) return;
		$this->title = $data["title"];
		$this->discription = $data["discription"];
		$this->cost = $data["cost"];
	}

	public function create() {
		$this->stmt_create = parent::prepare_stmt("INSERT INTO material (title, discription, cost) VALUES (?, ?, ?)");
		$this->stmt_create->bind_param('ssi', $this->title, $this->discription, $this->cost);
		return parent::create();
	}

	public function get() {
		$data = parent::get();
		$this->title = $data['title'];
		$this->discription = $data['discription'];
		$this->cost = $data['cost'];
	}

	public function update() {
		$this->stmt_update = parent::prepare_stmt('UPDATE material SET title = ?, discription = ?, cost = ? WHERE ID = ?');
		$this->stmt_update->bind_param('ssii', $this->title, $this->discription, $this->cost, $this->id);
		return parent::update();
	}

	public function getArr() {
		$arr = parent::getArr();
		return $arr + [
			'title' => $this->title,
			'discription'=> $this->discription,
			'cost'=> $this->cost
		];
	}

}

?>