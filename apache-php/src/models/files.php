<?php

class PDF extends Model {


	public function __construct() {
		parent::__construct(null);
	}
	private $uploadDir = "uploads/";

	public function create() {
		if (isset($_FILES['pdfFile']) && $_FILES['pdfFile']['error'] == 0) {
			$filename = $_FILES['pdfFile']['name'];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
			if (!in_array($ext, ["pdf"])) {
				return "Ошибка: неверный формат файла";
			}		
			
			if (!is_dir($this->uploadDir)) {
				mkdir($this->uploadDir);
			}
			$uploadFile = $this->uploadDir . basename($filename);
			
			if (move_uploaded_file($_FILES['pdfFile']['tmp_name'], $uploadFile)) {
				return "Файл успешно загружен.";
			} else {
				return "Ошибка при загрузке файла.";
			}
		} else {
			return "Ошибка: " . $_FILES['pdfFile']['error'];
		}
	}

	public function read_all() {
        if (is_dir($this->uploadDir)) {
            // Получаем список файлов из директории uploads
            $files = scandir($this->uploadDir);
			$files_urls = [];
            foreach ($files as $file) {
                if ($file !== '.' && $file !== '..') {
                    $files_urls[] = [
						"url" => "/download?file=" . urlencode($file),
						"name"=> htmlspecialchars($file) . '</a><br>'
					];
                }
            }
			return $files_urls;
        } else {
			raise404();
        }
	}

	public function get() {
		$filePath = $this->uploadDir . basename($_GET['file']); 

		if (file_exists($filePath)) {
			header('Content-Type: application/pdf');
			header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
			readfile($filePath);
			exit;
		} else {
			raise404();
		}
	}
}