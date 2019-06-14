<?php 

class comment {
	private $conn;
	private $twig;

	public function __construct($conn, $twig) {
		$this->conn = $conn;
		$this->twig = $twig;
	}

	public function submitMethod() {
		$anime_id = $_POST['anime_id'];
		$content = $_POST['content'];
		$result = $this->conn->insertComment($anime_id, $content);
		header("Access-Control-Allow-Origin");
		header("Content-Type-application/json;charset=UTF-8");
		if ($result) {
			$message = array(
				'code' => 200,
				'message' => 'Add comment sucessfully.',
			);
			echo json_encode($message);
		} else {
			$message = array(
				'code' => 400,
				'message' => 'Add comment failed. Please try again.'
			);
			echo json_encode($message);
		}
	}
}