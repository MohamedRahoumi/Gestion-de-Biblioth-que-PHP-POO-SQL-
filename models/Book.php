<?php

require_once __DIR__ . '/../config/database.php';

class Book {
    private $id;
    private $title;
    private $author;
    private $year;
    private $status;
    private $db;
    
    public function __construct($title = '', $author = '', $year = '', $status = STATUS_AVAILABLE) {
        $this->title = $title;
        $this->author = $author;
        $this->year = $year;
        $this->status = $status;
        $this->db = Database::getInstance()->getConnection();
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getTitle() {
        return $this->title;
    }
    
    public function getAuthor() {
        return $this->author;
    }
    
    public function getYear() {
        return $this->year;
    }
    
    public function getStatus() {
        return $this->status;
    }
    
    public function setId($id) {
        $this->id = $id;
    }
    
    public function setTitle($title) {
        $this->title = $title;
    }
    
    public function setAuthor($author) {
        $this->author = $author;
    }
    
    public function setYear($year) {
        $this->year = $year;
    }
    
    public function setStatus($status) {
        $this->status = $status;
    }
    
    public function isAvailable() {
        return $this->status === STATUS_AVAILABLE;
    }
    
    public function save() {
        $sql = "INSERT INTO books (title, author, year, status) 
                VALUES (:title, :author, :year, :status)";
        
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            ':title' => $this->title,
            ':author' => $this->author,
            ':year' => $this->year,
            ':status' => $this->status
        ]);
        
        if ($result) {
            $this->id = $this->db->lastInsertId();
        }
        
        return $result;
    }
    
    public function update() {
        $sql = "UPDATE books 
                SET title = :title, author = :author, year = :year, status = :status 
                WHERE id = :id";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':title' => $this->title,
            ':author' => $this->author,
            ':year' => $this->year,
            ':status' => $this->status,
            ':id' => $this->id
        ]);
    }
    
    public function delete() {
        $sql = "DELETE FROM books WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $this->id]);
    }
    
    public static function findById($id) {
        $db = Database::getInstance()->getConnection();
        $sql = "SELECT * FROM books WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->execute([':id' => $id]);
        
        $data = $stmt->fetch();
        if (!$data) {
            return null;
        }
        
        $book = new Book();
        $book->setId($data['id']);
        $book->setTitle($data['title']);
        $book->setAuthor($data['author']);
        $book->setYear($data['year']);
        $book->setStatus($data['status']);
        
        return $book;
    }
    
    public static function getAll() {
        $db = Database::getInstance()->getConnection();
        $sql = "SELECT * FROM books ORDER BY title ASC";
        $stmt = $db->query($sql);
        
        $books = [];
        while ($data = $stmt->fetch()) {
            $book = new Book();
            $book->setId($data['id']);
            $book->setTitle($data['title']);
            $book->setAuthor($data['author']);
            $book->setYear($data['year']);
            $book->setStatus($data['status']);
            $books[] = $book;
        }
        
        return $books;
    }
    
    public static function getAvailable() {
        $db = Database::getInstance()->getConnection();
        $sql = "SELECT * FROM books WHERE status = :status ORDER BY title ASC";
        $stmt = $db->prepare($sql);
        $stmt->execute([':status' => STATUS_AVAILABLE]);
        
        $books = [];
        while ($data = $stmt->fetch()) {
            $book = new Book();
            $book->setId($data['id']);
            $book->setTitle($data['title']);
            $book->setAuthor($data['author']);
            $book->setYear($data['year']);
            $book->setStatus($data['status']);
            $books[] = $book;
        }
        
        return $books;
    }
}