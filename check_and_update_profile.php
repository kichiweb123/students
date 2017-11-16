<?php

$name = $table->clearStr($_POST['name']);
$sname = $table->clearStr($_POST['second_name']);
$grup = $table->clearInt($_POST['grup']);
$email = $table->clearStr($_POST['email']);
$score = $table->clearInt($_POST['score']);
$age = $table->clearInt($_POST['age']);



$table->checkAndUpdateProfile($name, $sname, $grup, $email, $score, $age);
?>