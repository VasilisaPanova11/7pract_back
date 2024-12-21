<?php
require_once "./models/settings.php";

class SettingsView extends View {
    public function __construct() {
        $this->model = new Settings();
        $this->model->get();
        $this->context = [
            "title" => "Настройки пользователя {$this->model->username}",
            "template" => "settings.php",
            "username" => $this->model->username,
            "theme" => $this->model->theme,
            "lang" => $this->model->lang,
			"username2" => $_COOKIE['username'],
			"theme2" => $_COOKIE["theme"],
			"lang2" => $_COOKIE["lang"],
        ];
    }

    public function as_view() {
        if (isset($_POST["apply"])) {
            $this->model->theme = $_POST["theme"];
            $this->model->lang = $_POST["language"];
            $this->model->update();
            $this->context["theme"] = $this->model->theme;
            $this->context["lang"] = $this->model->lang;
        }
        parent::as_view();
    }
}

?>