<table class="data-table">
<tr>
	<th> Файл </th>
</tr>
<?php
foreach ($files as $file) {
	echo "<tr><td>";
	echo "<a href=" . $file['url'] . ">" . $file['name'] . "</a>";
	echo "</td></tr>";
}
?>
</table>