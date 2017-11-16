<?php

?>
	<div class="row header">
		<div class="col-md-2 refer">
			<h3><a href="index.php">Абитуриент.ру</a></h3>
		</div>
		<div class="col-md-10">
			<ul class="menu">
				<?php
				if($_COOKIE['login'] and $_COOKIE['pass']){
				echo "<a href=\"?id=edit_profile\">";
					echo "<li style='padding-right:5px;'>Редактировать</li>";
				echo "</a>";
				}
				if(!($_COOKIE['login'] and $_COOKIE['pass'])){
				?>
				<a href="?id=registration">
					<li>Регистрация</li>
				</a>
				<?php
				}
				if($_COOKIE['login'] and $_COOKIE['pass']){
					echo "<a href=\"?id=del_cook\">";
					echo "<li>Выход</li>";
					echo "</a>";
				}else{
					echo "<a href=\"?id=login\">";
					echo "<li>Логин</li>";
					echo "</a>";
				}
				?>
			</ul>
			<form class="form-inline" style="float:right;padding-top: 10px;" method ="post" action="?id=search">
				  <div class="form-group">
				    <label for="search">Поиск</label>
				    <input type="search" id="search" class="form-control mx-sm-3 form-control-sm" name="search">
				    
				  </div>
				  <button type="submit" class="btn btn-primary">Искать!</button>
				</form>
		</div>

	</div>