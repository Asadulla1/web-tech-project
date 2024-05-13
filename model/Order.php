<?php
class OrderModel {
    private $db;

    public function __construct() {
        $this->db = new mysqli('localhost', 'root', '', 'ecommerce');
    }

	public function insertNewOrder($userId, $productId, $status, $total_amount) {
		$query = "INSERT INTO orders (user_id, product_id, status, total_amount)
				VALUES (?, ?, ?, ?)";
		
		$stmt = $this->db->prepare($query);
		$stmt->bind_param('ssss', $userId, $productId, $status, $total_amount);
		$stmt->execute();
	}

	public function getPendingOrderByUserId($userId) {

		$query = "SELECT orders.order_id, orders.order_date, orders.status,
						orders.total_amount, products.name as product_name 
				FROM orders
				JOIN products ON orders.product_id = products.product_id
				WHERE user_id = ? AND status = 'pending'";
		
		$stmt = $this->db->prepare($query);
		$stmt->bind_param('s', $userId);
		$stmt->execute();
		$result = $stmt->get_result();
		
		$orders = [];
		while ($order = $result->fetch_assoc()) {
			$orders[] = $order;
		}

		return $orders;
	}

	public function getOrdersByUserId($userId) {
		$query = "SELECT orders.order_id, orders.order_date, orders.status,
						orders.total_amount, products.name as product_name 
				FROM orders
				JOIN products ON orders.product_id = products.product_id
				WHERE user_id = ?";
		
		$stmt = $this->db->prepare($query);
		$stmt->bind_param('s', $userId);
		$stmt->execute();
		$result = $stmt->get_result();
		
		$orders = [];
		while ($order = $result->fetch_assoc()) {
			$orders[] = $order;
		}

		return $orders;
	}

	public function updateOrder($productId, $updatedValues) {
		$query = "update promotions set discount_percentage = ? where product_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss', $updatedValues['discount_percentage'], $productId);
        $stmt->execute();

		
		$query = "update orders set total_amount = ? where product_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss', $updatedValues['total_amount'], $productId);
        $stmt->execute();

	}

	public function findAllPendingOrderId() {
		$query = "select orders.order_id, products.name from orders 
				 join products on products.product_id = orders.product_id
				 where orders.status = 'pending'";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
		
		$orders = [];
		while ($order = $result->fetch_assoc()) {
			$orders[] = $order;
		}
		
		return $orders;
	}

	public function findAllPendingOrders() {
		$query = "select products.name as product_name,
				  products.product_id as product_id,
				  orders.total_amount as total_amount,
				  promotions.discount_percentage as discount_percentage,
				  orders.status as order_status from products 
			      INNER JOIN orders on orders.product_id = products.product_id
				  INNER JOIN promotions on promotions.product_id = products.product_id
                  WHERE orders.status = 'pending'";

        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
	}
}
?>
