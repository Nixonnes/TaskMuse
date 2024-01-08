<?php
include ("auth-check.php");

session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $_SESSION['login']?>|Profile</title>
	<link rel="stylesheet" href="main.css">
</head>
<body>
<header>
		<h1> TaskMuse </h1>
		<div class="vertical-menu">
			<a class="href-lk" href="index.php?user-id=<?php $user_id ?>"> <?php echo $_SESSION['login']?> </a>
			<a class="menu-point" href="addtask.php"><h2>Добавить задачу</h2> </a>
			<a class="menu-point" href = "edit_task.php"> <h2> Редактировать задачи </h2> </a>
</div>
</header>
<nav class ="menu">
	
	
</nav>
<main>
<div class = "tasks">
	<?php 
	include ("tasks.php");
	?>
</div>
</main>
</body>
</html>