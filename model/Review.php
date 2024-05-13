<?php
class ReviewModel {
    private $db;

    public function __construct() {
        $this->db = new mysqli('localhost', 'root', '', 'ecommerce');
    }
	

	public function getReviewByProductId($productId) {
		$query = "select * from productFeedback where product_id = ?";
		$stmt = $this->db->prepare($query);
		$stmt->bind_param("s", $productId); 
		$stmt->execute();
		$result = $stmt->get_result();
		
		$reviews = [];
		while ($row = $result->fetch_assoc()) {
			$reviews[] = $row;
		}

		return $reviews;
	}
	public function insertReview($productId, $userId, $comment, $rating) {
		$query = "insert into productFeedback (product_id, user_id, comment, rating) values (?, ?, ?, ?)";
		$stmt = $this->db->prepare($query);
		$stmt->bind_param("ssss", $productId, $userId, $comment, $rating); 
		$stmt->execute();
	}

	public function updateReview($feedbackId, $updatedValues) {
		$query = "update productFeedback set rating = ?, comment = ? where feedback_id = ?";
		$stmt = $this->db->prepare($query);
		$stmt->bind_param("sss", $updatedValues['rating'], $updatedValues['comment'], $feedbackId);
		$stmt->execute();
	}
	public function getAllReviews() {
		$query = "select productFeedback.comment, productFeedback.rating, productFeedback.date, productFeedback.feedback_id,
				products.name as product_name, users.username from productFeedback
				JOIN products ON products.product_id = productFeedback.product_id
				JOIN users ON users.user_id = productFeedback.user_id";

		$stmt = $this->db->prepare($query);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
}
?>
