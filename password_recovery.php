<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Сброс пароля</title>
	<link rel="stylesheet" href="main.css">
</head>
<body>
	<?php
	require "connect.php";
	require_once __DIR__. '/PDO.php';
// Получение токена из запроса (например, из GET-параметра)
$tokenFromRequest = $_GET['token'];
$sql = "SELECT user_id,expires_at FROM tokens WHERE token = :token";
$pdo = new MyPDO();
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':token', $tokenFromRequest, PDO::PARAM_STR);
$stmt->execute();
$tokenData = $stmt->fetch(PDO::FETCH_ASSOC);

if($tokenData) {
	$currentTime = time();

	if($currentTime <= $tokenData['expires_at']) {
		// Токен действителен,срок действия не истек
		// Восстановление пароля
		?>
		<div class="user-form">
			<h1 class="user-enter"> Сброс пароля </h2>
			<form class="form-login" method="post" id="form-auth">
			<h2> Новый пароль </h2>
			<input class="input-user" type="text" name='new-password' required>
			<h2> Подтвердите новый пароль </h2>
			<input class="input-user" type="password" name="submit-password" required>
			<input class="btn-user" type="submit" name="submit-login" value="Сбросить">

</form>
<?php
	} else {
		echo 'Ссылка,по которой вы перешли недействительна.Пожалуйста пройдите процедуру восстановления заново.';
	}
}
?>
</body>
</html>