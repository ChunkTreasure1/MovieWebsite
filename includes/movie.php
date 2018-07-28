<?php
class Movie {
	public function fetch_all() { 
		global $pdo;

		$query = $pdo->prepare("SELECT * FROM movies"); 
		$query->execute();

		return $query->fetchAll();
	}
	
	public function fetch_data($movie_id){
		global $pdo;
		
		$query = $pdo->prepare("SELECT * FROM movies WHERE movie_id = ?");
		$query->bindValue(1, $movie_id);
		$query->execute();
		
		return $query->fetch();
		
	}
	
	public function addViews($movie_id){
		global $pdo;
		
		$query = $pdo->prepare("SELECT * FROM movies WHERE movie_id = ?");
		
		$query->bindValue(1, $movie_id);
		$query->execute();
		
		$result = $query->fetch();
		
		if($result['movie_views'] == 0){
			
			$querySet = $pdo->prepare("UPDATE movies SET movie_views = 1 WHERE movie_id = '$movie_id'");
			
			$querySet->execute();
		
		} else {
			
			$queryUpdate = $pdo->prepare("UPDATE movies SET movie_views = movie_views + 1 WHERE movie_id = '$movie_id'");
			
			$queryUpdate->execute();
			
		}
		
		return true;
		
	}
	
}
?>