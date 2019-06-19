<?php 

class comment {
	private $conn;
	private $twig;

	public function __construct($conn, $twig) {
		$this->conn = $conn;
		$this->twig = $twig;
	}

	public function submitMethod() {
		header("Access-Control-Allow-Origin");
		header("Content-Type-application/json;charset=UTF-8");
		if (array_key_exists('username', $_SESSION)) {
			$anime_id = $_POST['anime_id'];
			$content = $_POST['content'];
			$uname = $_SESSION['username'];
			$result = $this->conn->insertComment($anime_id, $content, $uname);
			
			if ($result) {
				$message = array(
					'code' => 200,
					'message' => 'Add comment sucessfully.',
					'uname' => $uname
				);
				echo json_encode($message);
			} else {
				$message = array(
					'code' => 400,
					'message' => 'Add comment failed. Please try again.'
				);
				echo json_encode($message);
			}
		} else {
			$message = array(
				'code' => 400,
				'message' => 'Please login first'
			);
			echo json_encode($message);
		}
	}
}