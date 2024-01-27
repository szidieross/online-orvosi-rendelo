<?php
class User
{
    private Database $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function create($name, $username, $email, $password, $role)
    {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare("INSERT INTO users (name, username, email, password, role) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$name, $username, $email, $password, $role]);

        $userId = $conn->insert_id;
        echo "lastInsertId: $userId";

        return $userId;
    }
}
?>