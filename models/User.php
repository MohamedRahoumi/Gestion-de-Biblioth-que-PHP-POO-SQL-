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
    
   
}