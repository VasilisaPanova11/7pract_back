<?php
abstract class Model {
    private $db;
    protected $table;
    public $id;

    protected $stmt_create;
    protected $stmt_update;

    function __construct($table) {
        if (!empty($table)) {
            $this->db = MySQL::getConnection();
            $this->table = $table;
        }
    }

    protected function raw_query($q) {
        return $this->db->query($q);
    }
    protected function prepare_stmt($q) {
        return $this->db->prepare($q);
    }

    public function parseJSON() {
        $data = getInput();
		if (isset($data["ID"])) {
            $this->id = $data['ID'];
        }
        return $data;
    }

    public function create() {
        $this->stmt_create->execute();
        if (!empty($this->db->error)) {
            return $this->db->error;
        }
        $res = $this->db->insert_id;
        $this->stmt_create->reset();
        return $res;
    }

    public function get() {
        $q = "SELECT * FROM " . $this->table . " WHERE ID = " . $this->id;
        return $this->db->query($q)->fetch_assoc(); 
    }

    public function read_all() {
        $q = "SELECT * FROM " . $this->table;
        $res = $this->db->query($q);
    
        if ($res === false) {
            // Обработка ошибки
            echo "Ошибка выполнения запроса: " . $this->db->error;
            return []; // Возвращаем пустой массив или можно выбросить исключение
        }
    
        return $res->fetch_all(MYSQLI_ASSOC);
    }

    public function update() {
        $this->stmt_update->execute();
        $res = $this->stmt_update->affected_rows;
		$this->stmt_update->reset();
        return $res;
    }


    public function delete() {
        $q = "DELETE FROM " . $this->table . " WHERE id = " . $this->id;
        try {
            $this->db->query($q);
            return $this->db->affected_rows;
        }
        catch (Exception $e) {
            //echo $e->getMessage();
            return 0;
        }
    }

    public function getArr() {
        return ["ID" => $this->id];
    }

    public static function createArr($row) {
        return ["ID" => $row['ID']];
    }

	public function __destruct() {
        if (isset($this->db)) {
		    $this->db->close();
        }
	}
}


?>