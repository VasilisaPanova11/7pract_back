<?php
require_once "./models/material.php";


class MatView extends View {

    public function __construct() {
        $this->model = new Material();
        $this->context = [
            "title" => "Список услуг",
            "template" => "mat.php",
            "mats" => $this->model->read_all()
        ];
    }
}

class MatDetailView extends View {

	public function __construct() {
        $this->model = new Material();
		$this->model->id = $_GET['ID'];
		$this->model->get();
        $this->context = [
            "title" => "Описание материала",
            "template" => "mat_detail.php",
            "mat" => $this->model,
            "back_url" => "/mat"
        ];
    }
}

//TODO api
class MatAPIView extends APIView {
    public function __construct() {
        $this->model = new Material();
    }
}

?>