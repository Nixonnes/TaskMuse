<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>TaskMuse|Registration</title>
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
		 <div class="user-form reg">
			<h1 class="user-enter"> Регистрация </h2>
			<form class="form-login" method="post" id="form-auth">
			<h2> Логин </h2>
			<input class="input-user" type="text" name='login' required>
			<h2> Пароль </h2>
			<input class="input-user" type="password" name="password" required>
			<h2> E-mail </h2>
			<input class="input-user" type="e-mail" name="email"required>
			<button class="btn-user reg" type="submit" >Зарегистрироваться </button>
</form>
</div>

			<?php

			
			try {
				// Проверяем, была ли форма отправлена
				if ($_SERVER["REQUEST_METHOD"] == "POST") {
					require ("connect.php");
					$login = $_POST["login"];
					$password = $_POST["password"];
					$email = $_POST["email"];
					
				// Проверка,существует ли пользователь с таким логином
				$query = "SELECT COUNT(*) as count FROM users WHERE login = '$login'";
				$resultat = $mysqli->query($query);
				$row = $resultat->fetch_assoc();

				if($row['count'] > 0) {
					$fmsg = "Пользователь с таким логином уже существует";
				} 
				else {
					// Проверка,существует ли пользователь с таким адресом электронной почты
					$query = "SELECT COUNT(*) as count FROM users WHERE email = '$email'";
					$resultat = $mysqli->query($query);
					$row = $resultat->fetch_assoc();

					if($row["count"] > 0) {
						$fmsg = "Пользователь с таким адресом электронной почты уже существует";
				}
				else {
					// Регистрация пользователя
			$hashed_password = password_hash("$password", PASSWORD_DEFAULT);
			$query = "INSERT INTO users(login,password,email) VALUES ('$login' , '$hashed_password', '$email')";
			
			
			$result = $mysqli->query($query);
			if( $result) {
				$smsg = "Регистрация успешно завершена.";
				header("Location:Login.php");
			}
			else {
				$fmsg = "Во время регистрации что-то пошло не так.Повторите попытку.";
			}
				}
				}
			}
		}
	
	catch (mysqli_sql_exception $e) {
		$fmsg = "Произошла ошибка при регистрации. Повторите попытку.";
		$log = $e->getMessage();
		
	}
			?>

</form>
</div>
<?php
if (isset($fmsg)) {
echo "<div class=\"error-message\">";

  if (isset($fmsg)) {
    echo $fmsg; // Вывести сообщение об ошибке, если оно установлено
	echo $log;
    }
	}
  ?>
    </div>
</body>
</html>