<?php
session_start();

$redis = new RedisDB();
$cookie_time = 60;
if (isset($_SERVER["PHP_AUTH_USER"])) {
    $username = $_SERVER["PHP_AUTH_USER"];
    [$theme, $lang] = $redis->get($username);

    $_SESSION['username'] = $username; 
    $_SESSION["theme"] = $theme;
    $_SESSION["lang"] = $lang;
    // Установка и проверка значений куки
    if (!isset($_COOKIE['username'])) {
        setcookie('username', $username, time() + $cookie_time, "/");
        $_COOKIE['username'] = $username;
    }
    if (!isset($_COOKIE['theme'])) {
        setcookie('theme', $theme, time() + $cookie_time, "/"); 
        $_COOKIE['theme'] = $theme;
    }
    if (!isset($_COOKIE['lang'])) {
        setcookie('lang', $lang, time() + $cookie_time, "/"); 
        $_COOKIE['lang'] = $lang;
    }
}
?>
