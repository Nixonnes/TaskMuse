<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Добавление новой задачи</title>
	<link rel="stylesheet" href="main.css">
</head>
<body>
<header>
		<h1> TaskMuse </h1>
		<div class="vertical-menu">
		<a href="profile.php"> Home </a>
			<a class="href-lk" href="index.php?user-id=<?php $_SESSION['user-id']?>"> <?php echo $_SESSION['login']?> </a>
</div>
</header>
<div class = "task-form">
<h1 class="header-task"> Добавление новой задачи </h1>
<form class ="form-task" method = "post">
	<label> Название задачи </label>
<input class="input-task" name="title" type="text" required> <br />
<label class="label-description" for="content"> Описание </label>
<textarea class="input-task descr" name="content" id="content" type="text"> </textarea> <br />
<label class="label-deadline"> Статус задачи </label>
<input class="btn-user task" type="submit" value="Сохранить">
</form>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
require "connect.php";
$user_id = $_SESSION['user-id'];
$title = $_POST['title'];
$content = $_POST['content'];
$query = "INSERT INTO tasks (user_id, title, content) VALUES ('$user_id' , '$title', '$content')";
$result = $mysqli->query($query);
if ($result) {
	header("Location:profile.php");
}
if (!$result) {
	echo "ОШИБКА!!!";
}
}
?>
</body>
</html>