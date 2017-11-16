<form action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post">
	<div class="form-group col-md-6">
		<label for="login">Логин(Обязательно для заполнения)</label>
		<input type="text" class="form-control" name="login">
		<?php 
		if($errors['login_exsist']){
			echo "<span style='color:red;'>{$errors['login_exsist']}</span><br>"; 
		}else{
			echo "<span style='color:red;'>{$errors['login']}</span><br>";
		}

		?>

		<label for="pass">Пароль(Обязательно для заполнения)</label>
		<input type="password" class="form-control" name="pass">
		<?php echo "<span style='color:red;'>{$errors['pass']}</span><br>"; ?>

		<label for="name">Имя(Обязательно для заполнения, не больше 15 символов)</label>
		<input type="text" class="form-control" name="name">
		<?php echo "<span style='color:red;'>{$errors['name']}</span><br>"; ?>

		<label for="second_name">Фамилия(Обязательно для заполнения, не больше 15 символов)</label>
		<input type="text" class="form-control" name="second_name">
		<?php echo "<span style='color:red;'>{$errors['second_name']}</span><br>"; ?>

		<label for="grup">Номер группы(Обязательно для заполнения)</label>
		<input type="text" class="form-control" name="grup">
		<?php echo "<span style='color:red;'>{$errors['grup']}</span><br>"; ?>

		<label for="email">Емейл(Обязательно для заполнения)</label>
		<input type="email" class="form-control" name="email">
		<?php echo "<span style='color:red;'>{$errors['email']}</span><br>"; ?>

		<label for="score">Баллы ЕГЭ</label>
		<input type="text" class="form-control" name="score">
		<?php echo "<span style='color:red;'>{$errors['score']}</span><br>"; ?>

		<label for="age">Год рождения(Обязательно для заполнения)</label>
		<input type="text" class="form-control" name="age">
		<?php echo "<span style='color:red;'>{$errors['age']}</span><br>"; ?>

  </div>
	<div class="form-check">
 	Проживание обязательно выбрать<br>
	  <label class="form-check-label">
	    <input class="form-check-input" type="radio" name="local" id="exampleRadios1" value="local1">
	    Местный
	  </label>
	</div>

	<div class="form-check">
	  <label class="form-check-label">
	    <input class="form-check-input" type="radio" name="local" id="exampleRadios1" value="local2">
	    Иногородний
	  </label>
	</div>

	<?php echo "<span style='color:red;'>{$errors['local']}</span><br>"; ?>
	<div class="form-check">

		Пол обязательно выбрать<br>
	  <label class="form-check-label">
	    <input class="form-check-input" type="radio" name="sex" id="exampleRadios1" value="male">
	    Мужской
	  </label>
	</div>
	<div class="form-check">
	  <label class="form-check-label">
	    <input class="form-check-input" type="radio" name="sex" id="exampleRadios1" value="female">
	    Женский
	  </label>
	</div>
	<?php echo "<span style='color:red;'>{$errors['sex']}</span><br>"; ?>
	<button type="submit" class="btn btn-primary">Отправить</button>
</form>