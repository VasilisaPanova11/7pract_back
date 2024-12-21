<table class='data-table'>
        <tr>
            <th>График</th>
        </tr>
        <?php
			foreach ($charts as $chart) {
                echo "<tr>";
                echo "<td><img src='{$chart['path']}'></td>";
                echo "</tr>";
            }
        ?>
    </table>