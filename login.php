<?php 

class login {
	private $conn;
	private $twig;

	public function __construct($conn, $twig) {
		$this->conn = $conn;
		$this->twig =$twig;
	}

	public function indexMethod() {
		// user login info
		if (array_key_exists('user', $_POST) && array_key_exists('pass', $_POST)) {

			$username = $_POST['user'];
			$password = $_POST['pass'];

			$result = $this->conn->getUserByName($username, $password);

			$num = sizeof($result);
			// echo $num;

			if ($num == 1) {
				$_SESSION['username'] = $result['0']['username'];
				$_SESSION['userid'] = $result['0']['id'];
				header('location:/anime');
			} else {
				echo '<div class="alert alert-danger" role="alert">Login Failed</div>';
			}
		}

		// user register info
		if (array_key_exists('user1', $_POST) && array_key_exists('pass1', $_POST)) {
			$connect = mysqli_connect('localhost', 'root', 'root');
			mysqli_select_db($connect, 'anime');

			$username = $_POST['user1'];
			$password = $_POST['pass1'];

			$select = "SELECT * FROM users WHERE username = '$username'";

			$result = mysqli_query($connect, $select);

			$num = mysqli_num_rows($result);

			if ($num == 1) {
				echo '<div class="alert alert-danger" role="alert">Username Already Taken</div>';
			} else {
				$register = "INSERT INTO users(username, password) VALUES ('$username', '$password')";
				mysqli_query($connect, $register);
				echo '<div class="alert alert-success" role="alert">Registration Successful Please Login</div>';
			}
		}

		try {
			echo $this->twig->render(
				'login.html.twig', 
				array(
					'name' => 'RateMyAnime',
					
					)
			);	
		}
		catch (Exception $e) {
			echo $e->getMessage();
		}
		
	}



}