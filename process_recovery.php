<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Восстановление логина</title>
	<link rel="stylesheet" href="main.css">
</head>
<body>
	<?php
	require_once __DIR__. '/vendor/autoload.php';
	$settings = require_once __DIR__ . '/settings.php';
	require_once __DIR__. '/functions.php';
	require_once __DIR__. '/connect.php';
	require_once __DIR__. '/PDO.php';

$data = json_decode(file_get_contents('php://input'), true);
// Проверяем, что данные существуют и содержат необходимые поля
if (isset($data['action']) && isset($data['email'])) {
	$action = $data['action'];
	$email = $data['email'];
}
	// В зависимости от действия, выполняем необходимые действия
	if ($action === 'forgotLogin') {
		// Логика для восстановления логина
$query = "SELECT * FROM users WHERE email = '$email'";
$result = $mysqli-> query($query);
if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
	$login = $row['login'];

}

$body = "Здравствуйте.<strong> Ваш логин: $login </strong> ";
send_mail($settings['mail_settings_prod'], ["$email"], 'Восстановление логина', $body);
	}


else if ($action === 'forgotPassword') {
	// Логика для восстановления пароля
	$query = "SELECT * FROM users WHERE email = '$email'";
	$result = $mysqli-> query($query);
	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		$user_id = $row['id'];
	}
// Генерация токена
	$token = generateUniqueToken(); // Сгенерированный токен
	$created_at = time();
	$expires_at = time() + 3600; // Токен обновляется каждый час

	// Работа с базой данных
	$sql = "INSERT INTO tokens (user_id, token, created_at, expires_at) VALUES (:user_id, :token, :created_at, :expires_at)";
	$pdo = new MyPDO();
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
	$stmt->bindParam(':token', $token, PDO::PARAM_STR);
	$stmt->bindParam(':created_at', $created_at, PDO::PARAM_INT);
	$stmt->bindParam(':expires_at', $expires_at, PDO::PARAM_INT);
	$stmt->execute();
	

	$body = "Здравствуйте.Чтобы сбросить пароль,перейдите по ссылке 
	<a href = \"To-Do/Projects/7.To-Do List/password_recovery.php?token=$token \"> Ссылка для восстановления пароля </a>";
	send_mail($settings['mail_settings_prod'], ["$email"], 'Восстановление пароля', $body);
}



function generateUniqueToken() {
	// Генерация случайной строки, например, с использованием md5 и microtime
	$token = md5(uniqid(mt_rand(), true));

	return $token;
}


?>
<a href = "Login.php" > <button class="btn-user auth"> На страницу авторизации </button> </a>

</body>
</html>

