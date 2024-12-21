<?php
require_once "./models/files.php";

class PDFListView extends View {
	public function __construct() {
		$this->model = new PDF();
		$this->context = [
			"title" => "Список загруженных файлов",
			"template" => "files_list.php",
			"files" => $this->model->read_all()
		];
	}
}

class PDFDownloadView extends View {
	public function __construct() {
		$this->model = new PDF();
		$this->model->get();
	}
}

class PDFUploadView extends View {
	public function __construct() {
		$this->model = new PDF();
		$this->context = [
			"title" => "Загрузка PDF файла",
			"template" => "upload.php"
		];
	}

	public function as_view() {
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$res = $this->model->create();
			$this->context['msg'] = $res;
		}
		parent::as_view();
	}
}

?>