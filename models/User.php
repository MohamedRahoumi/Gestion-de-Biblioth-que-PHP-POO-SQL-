<?php

require_once __DIR__ . '/../config/database.php';

abstract class User {
    protected $id;
    protected $firstName;
    protected $lastName;
    protected $email;
    protected $password;
    protected $role;
    protected $db;
    
    public function __construct($firstName = '', $lastName = '', $email = '', $password = '') {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
        $this->db = Database::getInstance()->getConnection();
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getFirstName() {
        return $this->firstName;
    }
    
    public function getLastName() {
        return $this->lastName;
    }
    
    public function getFullName() {
        return $this->firstName . ' ' . $this->lastName;
    }
    
    public function getEmail() {
        return $this->email;
    }
    
    public function getRole() {
        return $this->role;
    }
    
    public function setId($id) {
        $this->id = $id;
    }
    
    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }
    
    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }
    
    public function setEmail($email) {
        $this->email = $email;
    }
    
    public function setPassword($password) {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }
    
    public function verifyPassword($password) {
        return password_verify($password, $this->password);
    }
    
    public function save() {
        $sql = "INSERT INTO users (firstName, lastName, email, password, role) 
                VALUES (:firstName, :lastName, :email, :password, :role)";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':firstName' => $this->firstName,
            ':lastName' => $this->lastName,
            ':email' => $this->email,
            ':password' => $this->password,
            ':role' => $this->role
        ]);
        
        $this->id = $this->db->lastInsertId();
        return $this->id;
    }
    
    public function update() {
        $sql = "UPDATE users 
                SET firstName = :firstName, lastName = :lastName, email = :email 
                WHERE id = :id";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':firstName' => $this->firstName,
            ':lastName' => $this->lastName,
            ':email' => $this->email,
            ':id' => $this->id
        ]);
    }
    
    public static function findById($id) {
        $db = Database::getInstance()->getConnection();
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->execute([':id' => $id]);
        
        $userData = $stmt->fetch();
        if (!$userData) {
            return null;
        }
        
        return self::createUserFromData($userData);
    }
    
    public static function findByEmail($email) {
        $db = Database::getInstance()->getConnection();
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $db->prepare($sql);
        $stmt->execute([':email' => $email]);
        
        $userData = $stmt->fetch();
        if (!$userData) {
            return null;
        }
        
        return self::createUserFromData($userData);
    }
    
    public static function getAllUsers() {
        $db = Database::getInstance()->getConnection();
        $sql = "SELECT * FROM users ORDER BY created_at DESC";
        $stmt = $db->query($sql);
        
        $users = [];
        while ($userData = $stmt->fetch()) {
            $users[] = self::createUserFromData($userData);
        }
        
        return $users;
    }
    
    private static function createUserFromData($data) {
        if ($data['role'] === ROLE_ADMIN) {
            require_once __DIR__ . '/Admin.php';
            $user = new Admin();
        } else {
            require_once __DIR__ . '/Reader.php';
            $user = new Reader();
        }
        
        $user->setId($data['id']);
        $user->setFirstName($data['firstName']);
        $user->setLastName($data['lastName']);
        $user->setEmail($data['email']);
        $user->password = $data['password'];
        
        return $user;
    }
}