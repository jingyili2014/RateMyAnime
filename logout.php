<?php

class logout {
	private $conn;
	private $twig;

	public function __construct($conn, $twig) {
		$this->conn = $conn;
		$this->twig =$twig;
	}

	public function indexMethod() {
		session_start();
		session_destroy();

		header('location:/anime');
	}
}