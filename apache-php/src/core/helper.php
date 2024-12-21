<?php

class MySQL {
    private const
        host = 'db',
        dbUser = 'user',
        password = 'password',
        db = 'appDb';

    public static function getConnection() {
        return new mysqli(
            self::host, 
            self::dbUser, 
            self::password, 
            self::db
        );
    }
}

class RedisDB {
    private const
        host = 'redis',
        port = 6379;

    public $db;

    public function __construct() {
        $this->db = new Redis();
        $this->db->connect(self::host, self::port);

    }

    public function get($username) {
		$theme = $this->db->hget($username, "theme");
		$theme = empty($theme) ? 'light' : $theme;
		$lang = $this->db->hget($username, "lang");
		$lang = empty($lang) ? 'ru' : $lang;

        return [$theme, $lang];
    }

    public function update($username, $theme, $lang) {
		$this->db->hset($username, "theme", $theme);
		$this->db->hset($username, "lang", $lang);
    }
}

function getInput() {
    return json_decode(file_get_contents("php://input"), true);
}

function encodePassword($password) {
    $sha1_hash = sha1($password, true);  
    
    return '{SHA}' . base64_encode($sha1_hash);
}