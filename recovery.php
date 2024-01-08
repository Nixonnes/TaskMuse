<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Восстановление логина или пароля</title>
	<link rel="stylesheet" href="main.css">
</head>
<body>

<header>
		<h1> TaskMuse </h1>
		<div class="vertical-menu">
			<a href="index.php"> Home </a>
			<a class="href-lk" href="Login.php"> Sign-in </a>
		
</div>
		 </header>
	<form class = "recovery-form" action = "process_recovery.php" method="post">
	<h1 class = "recovery-header"> Восстановление логина или пароля </h1> <br />
		<label class="input-user recovery">
		<input class = "" type="radio" name = "recovery_type" value="Логин" id="forgotLoginButton">Я забыл логин
		</label>
		<label class="input-user recovery">
			<input class="" type="radio" name = "recovery_type" value="Пароль" id="forgotPasswordButton"> Я забыл пароль
</label>
<input class ="input-user recovery email" name="email" placeholder="Введите адрес электронной почты" id="EmailInput"><br />
<button class = "btn-user recovery" type="submit">Отправить </button>
<script src="Scripts.js"></script>
</body>
</html>