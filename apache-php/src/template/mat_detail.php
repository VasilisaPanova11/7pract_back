<table class='data-table'>
    <tr>
        <th>ID</th>
        <th>Название</th>
        <th>Описание</th>
        <th>Стоимость</th>
    </tr>
<?php
    echo "<tr>
        <td>" . $mat->id . "</td>
        <td>" . $mat->title . "</td>
        <td>" . $mat->discription . "</td>
        <td>" . $mat->cost . "</td>
    </tr>";
?>
</table>