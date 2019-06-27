<?php 

class rank {
	private $conn;
	private $twig;
	private $username;

	public function __construct($conn, $twig, $username='') {
		$this->conn = $conn;
		$this->twig = $twig;
		$this->username = $username;
	}

	public function indexMethod() {
		$animes = $this->conn->getAllAnime();

		try {
			echo $this->twig->render(
				'rank.html.twig', 
				array(
					'name' => 'RateMyAnime',
					'animes' => $animes,
					'username' => $this->username 
					)
			);	
		}
		catch (Exception $e) {
			echo $e->getMessage();
		}
		
	}





}









