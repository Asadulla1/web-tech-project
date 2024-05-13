<?php
class DeliveryModel {
    private $db;

    public function __construct() {
        $this->db = new mysqli('localhost', 'root', '', 'ecommerce');
    }

	public function totalDelivery($userId) {
		$query = "select * from delivery
				 join orders on orders.order_id = delivery.order_id
				 where orders.status = 'delivered' and order_date like CONCAT(?, '%')
				 and delivery.user_id = ?";

		date_default_timezone_set('Asia/Dhaka');
		$dt = date('Y-m');

		$stmt = $this->db->prepare($query);
		$stmt->bind_param("ss", $dt, $userId);

		$stmt->execute();

		$result = $stmt->get_result();
		
		$rows = [];
		
		while($row = $result->fetch_assoc()) {
			$rows[] = $row;
		}

		return count($rows);
	}

	public function deliveryManPendingOrders($userId) {
		$query = "select users.name, users.phone_number, users.address,
				 products.name as product_name, products.price from orders 
				 join products on orders.product_id = products.product_id
				 join users on orders.user_id = users.user_id 
				 join delivery on delivery.order_id = orders.order_id 
			 	 where orders.status = 'shipped' and delivery.user_id = ?";

		$stmt = $this->db->prepare($query);
		$stmt->bind_param("s", $userId);
		$stmt->execute();
		$result = $stmt->get_result();
		
		$rows = [];
		
		while($row = $result->fetch_assoc()) {
			$rows[] = $row;
		}

		return $rows;
	}

	public function changeStatus($delivery_id, $status) {
		$query = "update orders
				 set status = ?
				 where order_id = (
					select order_id from delivery
					where delivery_id = ?
				 )";

		$stmt = $this->db->prepare($query);
		$stmt->bind_param("ss", $status, $delivery_id);
		$stmt->execute();
		
	}
   // retrives deliveries which are pending to report delivery page
	public function findAllReportingByUserId($userId) {
		$query = "select products.name as product_name, delivery.delivery_id,
				 orders.status from delivery
				 join orders on orders.order_id = delivery.order_id
				 join products on products.product_id = orders.product_id
				 where delivery.user_id = ? and orders.status = 'shipped'";

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

	public function insertNewDelivery($orderId, $userId) {
		$query = "insert into delivery (user_id, order_id) values (?, ?)";
		$stmt = $this->db->prepare($query);
		$stmt->bind_param("ss", $userId, $orderId);
		$stmt->execute();
		
		$query2 = "update orders set status = 'shipped' where order_id = ?";
		$stmt2 = $this->db->prepare($query2);
		$stmt2->bind_param("s", $orderId);
		return $stmt2->execute();
	}

}
?>
