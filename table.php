<?php
$sort = $table->clearStr($_GET['sort']);
$perPage = 5;
$numOfRows = $table->numOfRows();
$cells = $table->getTable($sort, $numOfRows, $perPage);
?>
<div class="row content">
		<div class="col-md-5 table">
			<table>
				<thead>
					<tr>
						<th><a href="?sort=name">Имя</th>
						<th><a href="?sort=second_name">Фамилия</th>
						<th><a href="?sort=grup">Номер группы</th>
						<th>Число баллов</th>
					</tr>
				</thead>
				<tbody>


				<?php 
				foreach($cells as $cell){
					echo "<tr>";
						echo "<td>{$cell['name']}</td>";
						echo "<td>{$cell['second_name']}</td>";
						echo "<td>{$cell['grup']}</td>";
						echo "<td>{$cell['score']}</td>";
					echo "</tr>";
				}
				?>
				</tbody>
			</table>
		</div>
	</div>

<?php
$table->pages($numOfRows, $perPage);
?>