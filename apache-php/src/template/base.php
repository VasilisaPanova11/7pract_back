<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $title; ?></title>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/base.css">
    <link rel="stylesheet" href="/css/tables.css" type="text/css">
    <link rel="stylesheet" href="/css/user-data.css" type="text/css">
</head>
<body>
<button onclick="window.location.replace('/index.html')">На главную</button>
<?php
if (isset($back_url)) {
    echo '<button onclick="window.location.replace(\''. $back_url .'\')">Назад</button>';
}
?>

    <h1><?php echo $title; ?></h1>
    <?php
	    require_once $template_folder . $template;
    ?>

</body>
</html>