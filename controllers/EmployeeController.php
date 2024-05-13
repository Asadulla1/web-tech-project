<?php
require_once('../model/Task.php');
require_once('../model/User.php');

class EmployeeController {
	private $taskModel;
	private $userModel;
	
	public function __construct() {
		$this->taskModel = new TaskModel();
		$this->userModel = new UserModel();
	}
	
	public function getTasksByUserId($userId) {
		$tasks = $this->taskModel->getTasksByUserId($userId);
		return $tasks;
	}

	public function findNumberOfCompletedTask($userId) {
		$tasks = $this->taskModel->getCompletedTasksByUserId($userId);
		return count($tasks);
	}

	public function handleRequest() {
        // Check if the action parameter is set
        if (isset($_POST['action'])) {
            // Perform corresponding action based on the action parameter
            switch ($_POST['action']) {
				case 'update_task_status':
                // Check if product_id and updated_values parameters are set
					if (isset($_POST['task_id'], $_POST['new_status'])) {
						// Decode the JSON string to get the updated values
						$taskId = $_POST['task_id'];
						$status = $_POST['new_status'];
						// Call the updateProduct method to update the product
						$this->taskModel->changeStatusById($taskId, $status);
					} else {
						echo "task_id or new_status is not provided";
					}
					break;
                default:
                    // Handle unknown action
                    echo "Unknown action.";
                    break;
            }
        } else {
            // Handle error if action parameter is not set
            echo "";
        }
    }
}
$employee = new EmployeeController();
$employee->handleRequest();
?>
