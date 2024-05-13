<?php
class CustomerReviewModel {
	private $db;
	public function __construct() {
        $this->db = new mysqli('localhost', 'root', '', 'ecommerce');
	}

	public function getAllReviewsById($userId) {
		$query = "select * from customer_reviews where delivery_man_id = ?";
		
		$stmt = $this->db->prepare($query);
		$stmt->bind_param("s", $userId);
		$stmt->execute();
		$result = $stmt->get_result();

		$rows = [];
		while ($row = $result->fetch_assoc()) {
			$rows[] = $row;
		}
		
		return $rows;
	}
	
	public function getAverage($userId) {
		$query = "select AVG(rating) as average_rating from customer_reviews where delivery_man_id = ?";
		
		$stmt = $this->db->prepare($query);
		$stmt->bind_param("s", $userId);
		$stmt->execute();
		$result = $stmt->get_result();

		$averageRating = $result->fetch_assoc()['average_rating'];

		return $averageRating;

	}
}
?>
