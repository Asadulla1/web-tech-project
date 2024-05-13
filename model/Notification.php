<?php
class NotificationModel {
	private $db;

	public function __construct() {
        $this->db = new mysqli('localhost', 'root', '', 'ecommerce');
	}

	public function findAllNotificationsByUserId($userId) {
		$query = "select message from notifications 
				  where user_id = ? order by notify_id desc";

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
