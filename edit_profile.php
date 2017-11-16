<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
	require_once "check_and_update_profile.php";
}
$editProf = $table->editProfile();
?>

<form action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post">
	<div class="form-group col-md-6">

		<label for="name">Имя:<?php echo $editProf[0]['name']; ?></label>
		<input type="text" class="form-control" name="name">

		<label for="second_name">Фамилия: <?php echo $editProf[0]['second_name']; ?></label>
		<input type="text" class="form-control" name="second_name">

		<label for="grup">Номер группы: <?php echo $editProf[0]['grup']; ?></label>
		<input type="text" class="form-control" name="grup">

		<label for="email">Емейл: <?php echo $editProf[0]['email']; ?></label>
		<input type="email" class="form-control" name="email">

		<label for="score">Баллы ЕГЭ: <?php echo $editProf[0]['score']; ?></label>
		<input type="text" class="form-control" name="score">

		<label for="age">Год рождения: <?php echo $editProf[0]['age']; ?></label>
		<input type="text" class="form-control" name="age">

  </div>
	<button type="submit" class="btn btn-primary">Редактировать</button>
</form>