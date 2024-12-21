<table class='data-table'>
    <tr>
        <th>ID</th>
        <th>Название</th>
        <th>Стоимость, за шт/m&sup3</th>
        <th>Ссылка</th>
    </tr>
    <?php 
	foreach ($mats as $mat) {
		echo "<tr>";
		echo "<td>" . $mat['ID'] . "</td>";
		echo "<td>" . $mat['title'] . "</td>";
		echo "<td>" . $mat['cost'] . "</td>";
		echo "<td><a href='mat-detail?ID=" . $mat['ID'] . "'>ссылка</a></td>";
		echo "</tr>";
	}
?>
</table>