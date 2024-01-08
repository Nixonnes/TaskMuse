<?php 
session_start();
if (!isset($_SESSION['user-id'])) {
	// Пользователь не авторизован, перенаправьте его на страницу входа
	header("Location: login.php");
	exit;
}
?>

