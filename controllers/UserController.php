<?php

class UserController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function createUser($username, $email, $password) {
        // A User objektum létrehozása és adatbázisba való mentése
        $user = new User($this->pdo);
        $user->create($username, $email, $password);

        // Egyéb teendők, pl. visszajelzések, stb.
        echo "A felhasználó sikeresen létrehozva!";
    }
}
