<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<h1>Задачи</h1>
	<?php
	// Подключение к базе данных 
	$DbHost = 'localhost';
	$DbUser = 'root';
	$DbPassword = '';
	$DbName = 'Productify';

	$mysqli = new mysqli($DbHost, $DbUser, $DbPassword, $DbName);
	if ($mysqli->connect_error) {
    die("Ошибка подключения к базе данных: " . $mysqli->connect_error);
}
	$userId = $_SESSION['user-id'];
	$query = "SELECT * FROM tasks WHERE user_id = $userId";
	$result = $mysqli->query($query);

	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()) {
			echo '<a class="task" href ="task.php" >' . $row['title']. '</a><br/>';
	}
} else {
	echo "У вас нет задач";
}
	?>
	
</body>
</html>