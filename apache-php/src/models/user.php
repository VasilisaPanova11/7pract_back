<?php

class User extends Model {
	public $name;
	public $password;

	public function __construct() {
		parent::__construct("users");
	}

	public function parseJSON() {
		$data = parent::parseJSON();
		if (!isset($data["name"])) return;
		$this->name = $data["name"];
		$this->password = $data["password"];
	}

	public function create() { 
		$this->stmt_create = parent::prepare_stmt('INSERT INTO users (name, password) VALUES (?, ?)');
		$password = encodePassword($this->password);
		$this->stmt_create->bind_param('ss', $this->name, $password);
		return parent::create();
	}

	public function get() {
		$data = parent::get();
		$this->name = $data['name'];
		$this->password = $data['password'];
	}

	public function update() {
		$this->stmt_update = parent::prepare_stmt('UPDATE users SET name = ?, password = ? WHERE ID = ?');
		$this->stmt_update->bind_param('ssi', $this->name, $this->password, $this->id);
		return parent::update();
	}

	public function getArr() {
		$arr = parent::getArr();
		return $arr + [
			'name'=> $this->name,
			'password'=> $this->password
		];
	}

}

?>