<?php 
$login = $table->clearStr($_POST['login']);
$pass = $table->clearStr($_POST['pass']);


?>

<?php 

if(!($_POST['login'] and $_POST['pass'])){
?>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
	<div class="form-group col-md-6">
		<label for="login">Логин</label>
		<input type="text" class="form-control" name="login">
		<label for="pass">Пароль</label>
		<input type="password" class="form-control" name="pass">

  </div>
	
	<button type="submit" class="btn btn-primary">Войти</button>
</form>
<?php
}elseif(!$table->login()){
	echo "<p>Вы неправильно ввели данные.</p><a href='?id=login'>Попробовать еще раз</a>";
}else{
?>
<p>Вы вошли как: <?php echo $_POST['login']; ?></p>
<p><a href='index.php' >Вернуться на главную!</a></p>
<p><a href='?id=edit_profile'>Редактировать профиль</a>
<?php
}
?>