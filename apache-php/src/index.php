<?php
require_once "/var/www/vendor/autoload.php";
require_once "./core/helper.php";
require_once "./core/session-helper.php";

require_once "./core/model.php";
require_once "./core/view.php";

function raise404() {
	header("HTTP/1.1 404 Not Found");
	header("Status: 404 Not Found");
}
function raise403() {
    header("HTTP/1.1 403 Forbidden");
    header("Status: 403 Forbidden");
    echo "Недостаточно прав для доступа к данному ресурсу";
}

$admin_urls = [
	"/api/users", "/users"
];

$views_folder = "./views/";

$urls = [
	"/users" => [$views_folder . "user.php", "UserView"],
	"/api/users" => [$views_folder . "user.php", "UserAPIView"],
	"/mat" => [$views_folder . "mat.php", "MatView"],
	"/api/mat"=> [$views_folder . "mat.php", "MatApiView"],
	"/mat-detail" => [$views_folder . "mat.php", "MatDetailView"],
	"/download" => [$views_folder . "files.php", "PDFDownloadView"],
	"/files" => [$views_folder . "files.php", "PDFListView"],
	"/upload" => [$views_folder . "files.php", "PDFUploadView"],
	"/logout" => [$views_folder . "user.php", "LogoutView"],
	"/settings" => [$views_folder . "settings.php", "SettingsView"],
	"/fixtures" => [$views_folder . "fixtures.php", "FixturesVIew"],
	"/charts-list" => [$views_folder . "charts.php", "ChartsView"]
];

$url = $_SERVER['REQUEST_URI'];
$url = explode('?', $url)[0];
$url = rtrim($url, '/');

if (!array_key_exists($url, $urls)) {
	raise404();
	exit;
}
if (in_array($url, $admin_urls) 
&& $_SERVER['PHP_AUTH_USER'] != 'admin') {
	raise403();
	exit;
}
[$file, $view] = $urls[$url];

require_once $file;
$view = new $view();
$view->as_view();

?>