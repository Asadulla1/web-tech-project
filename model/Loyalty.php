<?php
class LoyaltyModel {
	private $db;
	public function __construct() {
		$this->db = new mysqli('localhost', 'root', '', 'ecommerce');
	}

	public function findLoyaltyByUserId($userId) {
		$query = "select * from loyaltyPrograms where user_id = ?";
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
}

?>
