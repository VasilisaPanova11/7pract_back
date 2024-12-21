<button onclick="window.location.replace('/charts-list')">К графикам</button>
<table class='data-table'>
        <tr>
            <th>ID материала</th>
            <th>Кол-во</th>
            <th>Город</th>
            <th>Имя покупателя</th>
            <th>Фамилия покупателя</th>
            <th>Страна</th>
        </tr>
        <?php
            foreach($fixtures as $fixture) {
                echo "<tr>";
                echo "<td>{$fixture['matID']}</td>";
                echo "<td>{$fixture['count']}</td>";
                echo "<td>{$fixture['city']}</td>";
                echo "<td>{$fixture['name']}</td>";
                echo "<td>{$fixture['surname']}</td>";
                echo "<td>{$fixture['country']}</td>";
                echo "</tr>";
            }
        ?>
    </table>