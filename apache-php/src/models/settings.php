<?php

class Settings extends Model {

	public $username;
	public $theme;
	public $lang;

	public function __construct() {
		parent::__construct(null);
	}

	public function get() {
		$this->username = $_SESSION["username"];
		$this->theme = $_SESSION['theme'];
		$this->lang = $_SESSION['lang'];
	}

	public function update() {
		global $redis;

		$redis->update($this->username, $this->theme, $this->lang);
	}
}

?>