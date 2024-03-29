<?php 

class genre {
	private $conn;
	private $twig;
	private $username;

	public function __construct($conn, $twig, $username='') {
		$this->conn = $conn;
		$this->twig =$twig;
		$this->username=$username;
	}

	public function getMethod($cid) {
		$animes = $this->conn->getAnimeByCategoryId($cid);
		$categories = $this->conn->getAllCategories();

		$new_category = array(
			0 => 'All'
		);
		foreach ($categories as $category) {
			$new_category += array($category['id'] => $category['name']);
		}

		try {
			echo $this->twig->render(
				'index.html.twig', 
				array(
					'name' => 'RateMyAnime',
					'animes' => $animes,
					'categories' => $new_category,
					'c_id' => $cid,
					'username'=>$this->username
					)
			);	
		}
		catch (Exception $e) {
			echo $e->getMessage();
		}
	}










}