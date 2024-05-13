<?php
class UserModel {
    private $db;

    public function __construct() {
        $this->db = new mysqli('localhost', 'root', '', 'ecommerce');
    }
	 
	public function updateUserInfo($user_id, $password, $email, $name, $phone_number, $address) {
		$query = "update users set 
				  password = ?,
				  email = ?, 
				  name = ?,
				  phone_number = ?,
				  address = ?
				  where user_id = ?";

		$stmt = $this->db->prepare($query);
        $stmt->bind_param('ssssss', $password, $email, $name, $phone_number, $address, $user_id);
		return $stmt->execute();
	}

	public function getAllEmployees() {
		$query = "select user_id, username from users where role = 'employee'";
		$stmt = $this->db->prepare($query);
		$stmt->execute();
		$result = $stmt->get_result();

		$users = [];
		while ($user = $result->fetch_assoc()) {
			$users[] = $user;
		}

		return $users;
	}

	public function findAllDeliveryMen() {
		$query = "select user_id, username from users where role = 'delivery Man'";
		$stmt = $this->db->prepare($query);
		$stmt->execute();
		$result = $stmt->get_result();

		$users = [];
		while ($user = $result->fetch_assoc()) {
			$users[] = $user;
		}

		return $users;
	}

	public function updateUser($user_id, $updatedValues) {
		$query = "UPDATE users SET ";
		$params = [];
		foreach ($updatedValues as $key => $value) {
			$params[] = "$key = ?";
		}
		$query .= implode(", ", $params);
		$query .= " WHERE user_id = ?";
		$stmt = $this->db->prepare($query);

		$types = str_repeat('s', count($updatedValues)) . 's'; 
		$bindValues = array_values($updatedValues);
		$bindValues[] = $user_id;
		$bindParams = array_merge([$types], $bindValues);

		call_user_func_array([$stmt, 'bind_param'], $bindParams);
		$stmt->execute();
	}

	public function deleteUser($user_id) {
		$query = "DELETE FROM users WHERE user_id = ?";
		$stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $user_id);
		return $stmt->execute();
	}

	public function getAllUsers() {
		$query = "SELECT * FROM users";
		$stmt = $this->db->prepare($query);
		$stmt->execute();
        $result = $stmt->get_result();
		$users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
        return $users;
	}

    public function getUserByUsername($username) {
        $query = "SELECT * FROM users WHERE username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
	
	public function addUser($name, $username, $password, $role, $email, $phone_number, $address) {
		$query = "INSERT INTO users (username, password, role, email, name, phone_number, address) VALUES (?, ?, ?, ?, ?, ?, ?)";
		$stmt = $this->db->prepare($query);
		$stmt->bind_param('sssssss', $username, $password, $role, $email, $name, $phone_number, $address);
		$result = $stmt->execute();
		return $result;
	}

	public function updateUserPassword($username, $newPassword) {
		$query = "UPDATE users SET password = ? where username = ?";
		$stmt = $this->db->prepare($query);
		$stmt->bind_param('ss', $newPassword, $username);
		return $stmt->execute();
	}
 
	public function getUserByEmail($email) {
		$query = "SELECT * FROM users WHERE email = ?";
		$stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $email);
		$stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
	}
}
?>
