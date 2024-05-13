<?php
class SalaryModel {
	private $db;
    public function __construct() {
        $this->db = new mysqli('localhost', 'root', '', 'ecommerce');
    }

	public function findSalaryById($userId) {
		$query = "select salary_amount from salary
				 where user_id = ?";
		
		$stmt = $this->db->prepare($query);
		$stmt->bind_param("s", $userId);
		$stmt->execute();
		
		$result = $stmt->get_result();

		if ($result->num_rows == 1) {
			$row = $result->fetch_assoc();
			return $row['salary_amount'];
		} else {
			return null;
		}
	}

}
?>
