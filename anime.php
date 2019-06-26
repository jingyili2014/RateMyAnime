<?php
/**
 * 
 */
class anime {
	private $conn;
	private $twig;
	private $username;

	public function __construct($db_conn, $twig, $username='') {
		$this->conn = $db_conn;
		$this->twig = $twig;
		$this->username = $username;
	}

	// public function indexMethod() {
	// 	echo 'this is anime\'s index';
	// }

	public function getMethod($id) {
		$anime = $this->conn->getAnimeById($id);
		$categories = $this->conn->getAllCategories();

		$new_category = array();
		foreach ($categories as $category) {
			$new_category += array($category['id'] => $category['name']);
		}

		$comments = $this->conn->getCommentById($id);

		try {
			echo $this->twig->render(
				'anime.html.twig', 
				array(
					'name' => 'RateMyAnime',
					'anime' => $anime,
					'categories' => $new_category,
					'comments' => $comments,
					'username' => $this->username 
					)
			);	
		}
		catch (Exception $e) {
			echo $e->getMessage();
		}
	}

}