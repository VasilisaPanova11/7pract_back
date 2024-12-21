<table class='data-table'>
<tr>
	<th>ID</th>
	<th>Имя пользователя</th>
	<th>Хэш пароля</th>
</tr>
<?php 
	foreach ($users as $user) {
		echo "<tr>";
		foreach ($user as $key) {
			echo "<td>$key</td>";
		}
		echo "</tr>";
	}
?>
</table>