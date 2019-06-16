<?php

session_start();


$connect = mysqli_connect('localhost', 'root', 'root');

mysqli_select_db($connect, 'login');

$username = $_POST['user'];
$password = $_POST['pass'];

$select = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";

$result = mysqli_query($connect, $select);

$num = mysqli_num_rows($result);

if ($num == 1) {
	$_SESSION['username'] = $username;
	header('location:index.php');
} else {
	header('location:login.html');
}