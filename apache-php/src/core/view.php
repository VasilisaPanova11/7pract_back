<?php

abstract class View {
	protected $model;
	private $template_folder = "./template/";
	protected $context = null;

	public function as_view() {
		if (isset($this->context)) {
			extract($this->context);
		}
		$template_folder = $this->template_folder;
		require_once $template_folder . "base.php";
	}
}

abstract class APIView extends View {
	
	public function create() {
		$res = $this->model->create();
		echo json_encode(["inserted" => $res], JSON_UNESCAPED_UNICODE);
	}

	
	public function read() {
		if (isset($this->model->id)) {
			$this->model->get();
            echo json_encode($this->model->getArr(), JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode($this->model->read_all(), JSON_UNESCAPED_UNICODE);
        }
	}

	public function update() { 
		$res = $this->model->update();
        echo json_encode(["updated" => $res], JSON_UNESCAPED_UNICODE);
	}
	public function delete() { 
		$res = $this->model->delete();
        echo json_encode(["deleted" => $res], JSON_UNESCAPED_UNICODE);
	}

	public function handle() {
		$this->model->parseJSON();
		switch ($_SERVER['REQUEST_METHOD']) {
			case 'GET':
				$this->read();
				break;
			case 'POST':
				$this->create();
				break;
			case 'PUT':
				$this->update();
				break;
			case 'DELETE':
				$this->delete();
				break;
		}
	}

	public function as_view() {
		return $this->handle();
	}

}

?>