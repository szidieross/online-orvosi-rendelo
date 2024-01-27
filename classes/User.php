<?php
class User
{
    private Database $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function create($firstName, $lastName, $username, $email, $password, $role)
    {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, username, email, password, role) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$firstName, $lastName, $username, $email, $password, $role]);

        $userId = $conn->insert_id;
        echo "lastInsertId: $userId";

        return $userId;
    }
}
?>