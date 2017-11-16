<?php


$table->saveTable();
if(!$errors){
setcookie("login", $login, 0x7FFFFFFF);
setcookie("pass", $password, 0x7FFFFFFF);
header('Location: index.php?id=edit_profile');

}
?>