<form action="" method="post" enctype="multipart/form-data">
	<label for="pdfFile">Выберите PDF файл для загрузки:</label>
	<input type="file" name="pdfFile" accept="application/pdf" required>
	<input type="submit" value="Загрузить">
</form>

<?php
if (isset($msg)) {
	echo "<p>" . $msg ."</p>";
}
?>