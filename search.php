<?php
$cells = $table->search();
echo "Найдены запросы по слову \"$search\":<br>";



?>

<div class="row content">
		<div class="col-md-5 table">
			<table>
				<thead>
					<tr>
						<th>Имя</th>
						<th>Фамилия</th>
						<th>Номер группы</th>
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