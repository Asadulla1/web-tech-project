<?php
class TaskModel {
	private $db;

    public function __construct() {
        $this->db = new mysqli('localhost', 'root', '', 'ecommerce');
    }
	
	public function insertNewTask($description, $assigned_to) {

		date_default_timezone_set('Asia/Dhaka');
		$dt = date('Y-m-d'); 

		$query = "insert into tasks (task_description, assigned_to, due_date) values (?, ?, ?)";
		$stmt = $this->db->prepare($query);
		$stmt->bind_param("sss", $description, $assigned_to, $dt);
        return $stmt->execute();
	}

	public function changeStatusById($taskId, $status) {
		$query = "update tasks set status = ? where task_id = ?";
		$stmt = $this->db->prepare($query);
		$stmt->bind_param("ss", $status, $taskId);
        $stmt->execute();
	}

	public function getCompletedTasksByUserId($userId) {
		date_default_timezone_set('Asia/Dhaka');
		$dt = date('Y-m');
		$query = "select * from tasks where due_date like CONCAT(?, '%')
				and assigned_to = ? and status = 'completed'";
		$stmt = $this->db->prepare($query);
		$stmt->bind_param("ss", $dt, $userId);
        $stmt->execute();

        $result = $stmt->get_result();
		
		$rows = [];
		
		while ($row = $result->fetch_assoc()) {
			$rows[] = $row;
		}

		return $rows;
	}

	public function getTasksByUserId($userId) {
		$query = "select t.task_id, t.task_description,
				t.due_date, t.status, u.username, u.role
				from tasks as t 
				join users as u on t.assigned_to = u.user_id
				where t.assigned_to = ? and t.status = 'pending'";	

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

	public function getTasksForAdmin() {
		$query = "select t.task_id, t.task_description, 
				 t.due_date, t.status, u.username, u.role
				 from tasks t
				 join users u on t.assigned_to = u.user_id";

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
