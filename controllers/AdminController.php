<?php
session_start();

require_once('../model/Product.php');
require_once('../model/User.php');
require_once('../model/Order.php');
require_once('../model/Review.php');
require_once('../model/Task.php');
require_once('../model/Attendance.php');
require_once('../model/Delivery.php');
require_once('../model/Promotion.php');

class AdminController {
    private $productModel;
	private $userModel;
	private $orderModel;
	private $reviewModel;
	private $taskModel;
	private $attendanceModel;
	private $deliveryModel;
	private $promotionModel;

    public function __construct() {
        $this->productModel = new ProductModel();
        $this->userModel = new UserModel();
        $this->orderModel = new OrderModel();
        $this->reviewModel = new ReviewModel();
        $this->taskModel = new TaskModel();
        $this->attendanceModel = new AttendanceModel();
        $this->deliveryModel = new DeliveryModel();
		$this->promotionModel = new PromotionModel();
    }


	public function getAllEmployees() {
		$employees = $this->userModel->getAllEmployees();
		return $employees;
	}

	public function getDeliveryMen() {
		$delivery_men = $this->userModel->findAllDeliveryMen();
		return $delivery_men;
	}

	public function getPendingOrders() {
		$orders = $this->orderModel->findAllPendingOrderId();
		return $orders;	
	}
 
	public function getAttendanceForAdmin() {
		return $this->attendanceModel->getAttendanceForAdmin();
	}

	public function getTasksForAdmin() {
		return $this->taskModel->getTasksForAdmin();
	}

	public function fetchAllReviews() {
		return $this->reviewModel->getAllReviews();
	}

	public function deleteUserById($user_id) {
		$this->userModel->deleteUser($user_id);
		header('Location: ../views/view_users.php');
		exit();
	}

	public function fetchAllUsers() {
		$users = $this->userModel->getAllUsers();
		return $users;
	}

	public function addUser($name, $username, $password, $role, $email, $phone_number, $address) {
		$this->userModel->addUser($name, $username, $password, $role, $email, $phone_number, $address);
        header('Location: view_users_controller.php');
		exit();
	}

	public function addProduct($name, $description, $price, $category, $stock_quantity) {
		$success = $this->productModel->insertProduct($name, $description, $price, $category, $stock_quantity);

		$setting_discount = $this->promotionModel->insertNewDiscountForProduct($name);

	}

	public function handleRequest() {
        // Check if the action parameter is set
        if (isset($_POST['action'])) {
            // Perform corresponding action based on the action parameter
            switch ($_POST['action']) {
                case 'new_task':
                    // Check if product_id parameter is set
                    if (isset($_POST['task_description']) && isset($_POST['assigned_to'])) {
                        // Call the deleteProductById method to delete the product
                        $result = $this->taskModel->insertNewTask($_POST['task_description'], $_POST['assigned_to']);
                        // Check if deletion was successful
                        if ($result) {
                            // Return success message or handle any other logic
                            // echo "shiped successfully.";
							header('Location: ../controllers/view_tasks_controller.php');
							exit();
                        } else {
                            // Return error message or handle any other logic
                            echo "Error deleting user.";
                        }
                    } else {
                        // Handle error if product_id parameter is not set
                        echo "User ID not provided.";
                    }
                    break;
                case 'set_delivery':
                    // Check if product_id parameter is set
                    if (isset($_POST['order_id']) && isset($_POST['delivery_man_id'])) {
                        // Call the deleteProductById method to delete the product
                        $result = $this->deliveryModel->insertNewDelivery($_POST['order_id'], $_POST['delivery_man_id']);
                        // Check if deletion was successful
                        if ($result) {
                            // Return success message or handle any other logic
                            // echo "shiped successfully.";
							header('Location: ../controllers/view_tasks_controller.php');
							exit();
                        } else {
                            // Return error message or handle any other logic
                            echo "Error deleting user.";
                        }
                    } else {
                        // Handle error if product_id parameter is not set
                        echo "User ID not provided.";
                    }
                    break;
                case 'delete_user':
                    // Check if product_id parameter is set
                    if (isset($_POST['user_id'])) {
                        // Call the deleteProductById method to delete the product
                        $result = $this->userModel->deleteUser($_POST['user_id']);
                        // Check if deletion was successful
						foreach ($_SESSION['users'] as $key => $value) {
							if ($_SESSION['users'][$key]['user_id'] == $_POST['user_id']) {
								unset($_SESSION['users'][$key]);
							}
						}
                        if ($result) {
                            // Return success message or handle any other logic
                            echo "User deleted successfully.";
                        } else {
                            // Return error message or handle any other logic
                            echo "Error deleting user.";
                        }
                    } else {
                        // Handle error if product_id parameter is not set
                        echo "User ID not provided.";
                    }
                    break;
                case 'delete_product':
                    // Check if product_id parameter is set
                    if (isset($_POST['product_id'])) {
                        // Call the deleteProductById method to delete the product
						$product_id = $_POST['product_id'];
                        $result = $this->productModel->deleteProductById($_POST['product_id']);
						//
						foreach ($_SESSION['products'] as $key => $value) {
							if ($_SESSION['products'][$key]['product_id'] == $product_id) {
								unset($_SESSION['products'][$key]);
							}
						}
							// Check if deletion was successful
                        if ($result) {
                            // Return success message or handle any other logic
                            echo "Product deleted successfully.";
                        } else {
                            // Return error message or handle any other logic
                            echo "Error deleting product.";
                        }
                    } else {
                        // Handle error if product_id parameter is not set
                        echo "Product ID not provided.";
                    }
                    break;
				case 'update_order':
					// Check if user_id and updated_values parameters are set
					if (isset($_POST['product_id'], $_POST['updated_values'])) {
						// Decode the JSON string to get the updated values
						$productId = $_POST['product_id'];
						$updatedValues = json_decode($_POST['updated_values'], true);
						// Call the updateUser method to update the user
						$this->orderModel->updateOrder($productId, $updatedValues);
					} else {
						// Handle error if user_id or updated_values parameters are not set
						echo "User ID or updated values not provided.";
					}
					break;
				case 'update_user':
					// Check if user_id and updated_values parameters are set
					if (isset($_POST['user_id'], $_POST['updated_values'])) {
						// Decode the JSON string to get the updated values
						$userId = $_POST['user_id'];
						$updatedValues = json_decode($_POST['updated_values'], true);
						// Call the updateUser method to update the user
						$this->userModel->updateUser($userId, $updatedValues);
					} else {
						// Handle error if user_id or updated_values parameters are not set
						echo "User ID or updated values not provided.";
					}
					break;
				case 'update_review':
                // Check if product_id and updated_values parameters are set
					if (isset($_POST['feedback_id'], $_POST['updated_values'])) {
						// Decode the JSON string to get the updated values
						$feedbackId = $_POST['feedback_id'];
						$updatedValues = json_decode($_POST['updated_values'], true);
						// Call the updateProduct method to update the product
						$this->reviewModel->updateReview($feedbackId, $updatedValues);
					} else {
						// Handle error if product_id or updated_values parameters are not set
						echo "Product ID or updated values not provided.";
					}
					break;
				case 'update_attendance_status':
                // Check if product_id and updated_values parameters are set
					if (isset($_POST['attendance_id'], $_POST['new_status'])) {
						// Decode the JSON string to get the updated values
						$taskId = $_POST['attendance_id'];
						$status = $_POST['new_status'];
						// Call the updateProduct method to update the product
						$this->attendanceModel->changeStatusById($taskId, $status);
					} else {
						// Handle error if product_id or updated_values parameters are not set
						echo "Product ID or updated values not provided.";
					}
					break;
				case 'update_task_status':
                // Check if product_id and updated_values parameters are set
					if (isset($_POST['task_id'], $_POST['new_status'])) {
						// Decode the JSON string to get the updated values
						$taskId = $_POST['task_id'];
						$status = $_POST['new_status'];
						// Call the updateProduct method to update the product
						$this->taskModel->changeStatusById($taskId, $status);
					} else {
						// Handle error if product_id or updated_values parameters are not set
						echo "Product ID or updated values not provided.";
					}
					break;
				case 'update_product':
                // Check if product_id and updated_values parameters are set
					if (isset($_POST['product_id'], $_POST['description'])) {
						// Decode the JSON string to get the updated values
						$productId = $_POST['product_id'];
						$updatedValues['name'] = $_POST['name'];
						$updatedValues['description'] = $_POST['description'];
						$updatedValues['price'] = $_POST['price'];
						$updatedValues['category'] = $_POST['category'];
						$updatedValues['stock_quantity'] = $_POST['stock_quantity'];

						$this->productModel->updateProduct($productId, $updatedValues);
					} else {
						// Handle error if product_id or updated_values parameters are not set
						echo "Product ID or updated values not provided.";
					}
					break;

                // Add more cases for other actions if needed
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
	public function fetchAllProducts() {
		$rows = $this->productModel->getAll();
		return $rows;
	}

	public function fetchOrdersForAdmin() {
		$rows = $this->orderModel->findAllPendingOrders();
		return $rows;
	}

	public function delete_product($product_id) {
        // Call the deleteProduct method from the ProductModel
        $result = $this->productModel->deleteProductById($product_id);


        
        // Check if the deletion was successful
        if ($result) {
            // Return success message or handle any other logic
            return "Product deleted successfully.";
        } else {
            // Return error message or handle any other logic
            return "Error deleting product.";
        }
    }
}

$adminController = new AdminController();
$adminController->handleRequest();
?>
