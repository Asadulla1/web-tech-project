<?php
class AttendanceModel {
    private $db;

    public function __construct() {
        $this->db = new mysqli('localhost', 'root', '', 'ecommerce');
    }

	public function getNumberOfAbsenceByUserId($userId) {
		date_default_timezone_set('Asia/Dhaka');
		$dt = date('Y-m');

		$query = "SELECT * 
			FROM attendance 
			WHERE user_id = ? 
			AND DATE_FORMAT(`date`, '%Y-%m') = ? 
			AND status = 'absent'";	

		$stmt = $this->db->prepare($query);

		$stmt->bind_param("is", $userId, $dt);

		$stmt->execute();

		$result = $stmt->get_result();

		$rows = [];
		
		while ($row = $result->fetch_assoc()) {
			$rows[] = $row;
		}

		return count($rows);
		
	}

	public function changeStatusById($attendanceId, $status) {
		$query = "update attendance set status = ? where attendance_id = ?";
		$stmt = $this->db->prepare($query);
		$stmt->bind_param("ss", $status, $attendanceId);
        $stmt->execute();
	}

	public function getAttendanceHistoryByUserId($userId) {
		$query = "select * from attendance where user_id = ?";
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

	public function isMarkedToday($userId) {
		date_default_timezone_set('Asia/Dhaka');
		$today = date('Y-m-d');
		$query = "select * from attendance where date like CONCAT(?, '%') and user_id = ?"; 
		$stmt = $this->db->prepare($query);		
		$stmt->bind_param("ss", $today, $userId);
		$stmt->execute();
		$result = $stmt->get_result();
		
		if ($result->num_rows > 0) {
			return true;
		}
		
		return false;
	}

	public function markAttendanceByUserId($userId) {
		$query = "insert into attendance (user_id, status) values (?, ?)";
		$stmt = $this->db->prepare($query);		

		$status = 'present';
		$stmt->bind_param("is", $userId, $status);
        $stmt->execute();
	}

	public function getAttendanceForAdmin() {
		$query = "select a.attendance_id, u.username,
				a.status, a.date from attendance a
				join users u on u.user_id = a.user_id
				order by a.date desc";
	
		$stmt = $this->db->prepare($query);
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
