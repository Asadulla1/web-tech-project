<?php
require_once('../model/Product.php');
require_once('../model/User.php');
require_once('../model/Order.php');
require_once('../model/Review.php');
require_once('../model/Loyalty.php');

class CustomerController {
    private $productModel;
    private $userModel;
	private $orderModel;
	private $reviewModel;
	private $loyaltyModel;

    public function __construct() {
        $this->productModel = new ProductModel();
        $this->userModel = new UserModel();
        $this->orderModel = new OrderModel();
		$this->reviewModel = new ReviewModel();
		$this->loyaltyModel = new LoyaltyModel();
    }
	
	public function findLoyaltyInfo($userId) {
		return $this->loyaltyModel->findLoyaltyByUserId($userId);
	}
 
	public function findCartProducts($userId) {
		return $this->orderModel->getPendingOrderByUserId($userId);
	}

	public function getAllAvailableProducts() {
		return $this->productModel->getAllAvailableProducts();
	}
	
	public function findAllOrders($username) {
		$currUser = $this->userModel->getUserByUsername($username);

		$orders = $this->orderModel->getOrdersByUserId($currUser['user_id']);
			
		return $orders;
	}
	public function handleRequest() {
		if (isset($_POST['action']) && $_POST['action'] === 'get_reviews') { 

			if (isset($_POST['product_id'])) {
				// Get the product ID and username from the POST data
				$productId = $_POST['product_id'];
				
				$reviews = $this->reviewModel->getReviewByProductId($productId);

				echo json_encode($reviews);
			}
		}

		if (isset($_POST['action']) && $_POST['action'] === 'add_to_review') { 
			if (isset($_POST['product_id']) && isset($_POST['user_id'])) {
				// Get the product ID and username from the POST data
				$productId = $_POST['product_id'];
				$userId = $_POST['user_id'];
				$comment = $_POST['comment'];
				$rating = $_POST['rating'];
				
				$this->reviewModel->insertReview($productId, $userId, $comment, $rating);

				$newReview = [
					'product_id' => $productId,
					'comment' => $comment,
					'rating' => $rating,
				];

				echo json_encode($newReview);
			}
		}

		if (isset($_POST['action']) && $_POST['action'] === 'add_to_cart') { 

			if (isset($_POST['product_id']) && isset($_POST['username'])) {
				// Get the product ID and username from the POST data
				$productId = $_POST['product_id'];
				$username = $_POST['username'];
				
				echo $this->productModel->updateProductQuantityById($productId);
				$currUser = $this->userModel->getUserByUsername($username);
				$price = $this->productModel->getPriceById($productId);
				$this->orderModel->insertNewOrder($currUser['user_id'], $productId, "pending", $price['price']);
			}
		}
	}
}

$customer = new CustomerController();
$customer->handleRequest();
?>
