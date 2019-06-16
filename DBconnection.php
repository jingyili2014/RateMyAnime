<?php
/**
 * 
 */
class DBconnection 
{
	protected $conn;
	public function getConnInstant() {
		if (!isset($this->conn)) {
			$this->conn = new PDO(
				$dsn= 'mysql:host=localhost;dbname=anime;charset=utf8mb4',
				$username= 'root',
				$password= 'root'
			);  
		}

		return $this->conn;
	}

	public function getAllAnime() {
		$stmt = $this->getConnInstant()->query('SELECT * FROM animes ORDER BY total_score DESC');
		$animes = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $animes;
	}

	public function getAllCategories() {
		$stmt = $this->getConnInstant()->query('SELECT * FROM categories');
		$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $categories;
	}

	public function getAnimeById($id) {
		$stmt = $this->getConnInstant()->prepare('SELECT * FROM animes WHERE id = :id');
		$stmt->execute(
			array(
				':id' => $id
			)
		);
		$result = $stmt->fetch();

		return $result;
	}

	public function getAnimeByCategoryId($cid) {
		$stmt = $this->getConnInstant()->prepare('SELECT * FROM animes WHERE genre LIKE :cid');
		$stmt->execute(
			array(
				':cid' => '%' . $cid . '%'
			)
		);
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}

	public function getCommentById($id) {
		$stmt = $this->getConnInstant()->prepare('SELECT * FROM comments WHERE anime_id = :id ORDER BY date DESC');
		$stmt->execute(
			array(
				':id' => $id
			)
		);
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}


	public function insertComment($anime_id, $content) {
		$stmt = $this->getConnInstant()->prepare('INSERT INTO comments(anime_id, date, content) VALUES (:anime_id, :date, :content)');
		$result = $stmt->execute(
			array(
				':anime_id' => $anime_id,
				':date' => date('y-m-d h:i:s'),
				'content' => $content
			)
		);
		return $result;
	}

	
}



?>