<?php
class PromotionModel {
    private $db;

    public function __construct() {
        $this->db = new mysqli('localhost', 'root', '', 'ecommerce');
    }

	public function insertNewDiscountForProduct($name) {
		$query = "select product_id from products where name = ?";

		$stmt = $this->db->prepare($query);
		$stmt->bind_param("s", $name);
		$stmt->execute();

		$result = $stmt->get_result();
		
		$product_id = $result->fetch_assoc()['product_id'];
		
		$zero = 0;

		$query2 = "insert into promotions (product_id, discount_percentage, delivery_charge) values (?, ?, ?)";
		$stmt2 = $this->db->prepare($query2);
		$stmt2->bind_param("sss", $product_id, $zero, $zero);
		$stmt2->execute();

	}
}
?>
