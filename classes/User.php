<?php
class User {
    private Database $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function create($username, $email, $password, $role) {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->execute([$username, $email, $password, $role]);
        
        $lastInsertId = $conn->insert_id;
        echo "lastInsertId: $lastInsertId";

        return $lastInsertId;
    }
}
?>
