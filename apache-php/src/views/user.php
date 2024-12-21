<?php
require_once "./models/user.php";


class UserView extends View {

    public function __construct() {
        $this->model = new User();
        $this->context = [
            "title" => "Список пользователей",
            "template" => "users.php",
            "users" => $this->model->read_all()
        ];
    }
}

class UserAPIView extends APIView {

	public function __construct() {
		$this->model = new User();
	}

	public function create() {
        global $theme, $lang;

        $res = $this->model->create();
        $user = $this->model;
        
        if ($res && gettype($res) != "string" && password_verify($user->password, password_hash($user->password, PASSWORD_DEFAULT))) {
            $_SESSION['username'] = $user->name;
            $_SESSION['theme'] = $theme;
            $_SESSION['lang'] = $lang; 
            
            echo json_encode(['message' => 'Добро пожаловать, ' . $user->name, "inserted_id" => $res], JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(['error' => $res], JSON_UNESCAPED_UNICODE);
        }
	}
}

class LogoutView extends View {

    public function as_view() {
        session_unset();
        session_destroy();

        http_response_code(401);
        echo "<script>window.location.replace('/')</script>";
    }
}

?>