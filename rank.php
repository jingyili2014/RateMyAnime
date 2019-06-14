<?php 

class rank {
	private $conn;
	private $twig;

	public function __construct($conn, $twig) {
		$this->conn = $conn;
		$this->twig =$twig;
	}

	public function indexMethod() {

		try {
			echo $this->twig->render(
				'rank.html.twig', 
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









