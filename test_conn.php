<?php

$host =  '127.0.0.1';
$user = 'Jingyi';
$password = 'Love0722!';
$dbname = 'anime';


// Set DSN
$dsn = 'mysql:host=' . $host . ';dbname=' . $dbname;

// Create a PDO instance
$conn = new PDO($dsn, $user, $password);


# PDO QUERY
$stmt = $conn->query('SELECT * FROM anime_db');

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	echo $row['name'] . '<br>';
}












?>