<?php

require_once __DIR__. '/vendor/autoload.php';
require_once __DIR__. '/functions.php';
require_once __DIR__. '/connect.php';


$email = $_POST['email'];
$query = "SELECT * FROM users WHERE email = 'email'";
$result = $mysqli-> query($query);
if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
	$login = $row['login'];

}

$body = "Здравствуйте.<strong> Ваш логин: $login </strong> ";






?>