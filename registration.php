<?php

session_start();

// header('location:login.html');

$connect = mysqli_connect('localhost', 'root', 'root');

mysqli_select_db($connect, 'login');

$username = $_POST['user'];
$password = $_POST['pass'];

$select = "SELECT * FROM users WHERE username = '$username'";

$result = mysqli_query($connect, $select);

$num = mysqli_num_rows($result);

if ($num == 1) {
	echo "Username Already Taken";
} else {
	$register = "INSERT INTO users(username, password) VALUES ('$username', '$password')";
	mysqli_query($connect, $register);
	echo "Registration Successful";
}