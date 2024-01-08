<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>TaskMuse:достигай своих целей</title>
	<link rel="stylesheet" href="main.css">
</head>
<body>
	<header>
		<h1> TaskMuse </h1>
		<div class="vertical-menu">
			<a href="index.php"> Home </a>
		
</div>
		 </header>
		 <div class="user-form">
			<h1 class="user-enter"> Вход </h2>
			<form class="form-login" method="post" id="form-auth">
			<h2> Логин </h2>
			<input class="input-user" type="text" name='login' required>
			<h2> Пароль </h2>
			<input class="input-user" type="password" name="password" required>
			<input class="btn-user" type="submit" name="submit-login" value="Войти">

</form>
<a class="forget" href="recovery.php"> Забыли логин или пароль? </a>
<a class="registration" href="Registration.php">Регистрация </a>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") { // Проверяем, была ли форма отправлена
require("connect.php");

$login = $_POST["login"];
$password = $_POST["password"];
$query = ("SELECT * FROM users WHERE login = ?");
$stmt = $mysqli->prepare($query );
$stmt->bind_param("s", $login);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
	if (password_verify($password, $row["password"])) {
	// Пользователь аутенфицирован,
	$smsg = "Вы успешно вошли в систему";
	echo $smsg;
	$user_id = $row['id'];
	$_SESSION['user-id'] = $user_id;
	$_SESSION['login'] = $login;
	header("Location:profile.php?user-id=$user_id");
}
else {
	$fmsg = "Логин или пароль неправильный";
}
}
}
?>
</body>
</html>