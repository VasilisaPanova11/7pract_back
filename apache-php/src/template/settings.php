<h2>Сессия</h2>
<ul class='user-data'>
<li>Имя пользователя: <b><?php echo $username; ?></b></li>
<li>Тема: <b><?php echo $theme; ?></b></li>
<li>Язык: <b><?php echo $lang; ?></b></li>
</ul>
<h2>куки</h2>
<ul class='user-data'>
<li>Имя пользователя: <b><?php echo $username2; ?></b></li>
<li>Тема: <b><?php echo $theme2; ?></b></li>
<li>Язык: <b><?php echo $lang2; ?></b></li>
</ul>

<form method="POST">
	<fieldset>
		<legend>Выберите тему:</legend>
		<label for="theme">Тема:</label>
		<select id="theme" name="theme">
			<option value="light" <?php echo $theme == "light" ? "selected" : "" ?> >Светлая тема</option>
			<option value="dark" <?php echo $theme == "dark" ? "selected" : "" ?>>Темная тема</option>
		</select>
	</fieldset>

	<fieldset>
		<legend>Выберите язык:</legend>
		<label for="language">Язык:</label>
		<select id="language" name="language">
			<option value="ru" <?php echo $lang == "ru" ? "selected" : "" ?>>Русский</option>
			<option value="en" <?php echo $lang == "en" ? "selected" : "" ?>>Английский</option>
		</select>
	</fieldset>
	<br>
	<button type="submit" name='apply'>Применить</button>
</form>