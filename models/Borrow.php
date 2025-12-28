<?php

require_once __DIR__ . '/../config/database.php';

class Borrow {
    private $id;
    private $readerId;
    private $bookId;
    private $borrowDate;
    private $returnDate;
    private $db;
    
    public function __construct($readerId = null, $bookId = null) {
        $this->readerId = $readerId;
        $this->bookId = $bookId;
        $this->borrowDate = date('Y-m-d H:i:s');
        $this->returnDate = null;
        $this->db = Database::getInstance()->getConnection();
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getReaderId() {
        return $this->readerId;
    }
    
    public function getBookId() {
        return $this->bookId;
    }
    
    public function getBorrowDate() {
        return $this->borrowDate;
    }
    
    public function getReturnDate() {
        return $this->returnDate;
    }
    
    public function setId($id) {
        $this->id = $id;
    }
    
    public function setReaderId($readerId) {
        $this->readerId = $readerId;
    }
    
    public function setBookId($bookId) {
        $this->bookId = $bookId;
    }
    
    public function setBorrowDate($borrowDate) {
        $this->borrowDate = $borrowDate;
    }
    
    public function setReturnDate($returnDate) {
        $this->returnDate = $returnDate;
    }
    
    public function isActive() {
        return $this->returnDate === null;
    }
    
    public function save() {
        $sql = "INSERT INTO borrows (readerId, bookId, borrowDate, returnDate) 
                VALUES (:readerId, :bookId, :borrowDate, :returnDate)";
        
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            ':readerId' => $this->readerId,
            ':bookId' => $this->bookId,
            ':borrowDate' => $this->borrowDate,
            ':returnDate' => $this->returnDate
        ]);
        
        if ($result) {
            $this->id = $this->db->lastInsertId();
        }
        
        return $result;
    }
    
    public function returnBook() {
        $this->returnDate = date('Y-m-d H:i:s');
        
        $sql = "UPDATE borrows SET returnDate = :returnDate WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute([
            ':returnDate' => $this->returnDate,
            ':id' => $this->id
        ]);
    }
    
    public static function findById($id) {
        $db = Database::getInstance()->getConnection();
        $sql = "SELECT * FROM borrows WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->execute([':id' => $id]);
        
        $data = $stmt->fetch();
        if (!$data) {
            return null;
        }
        
        return self::createBorrowFromData($data);
    }
    
    public static function findActiveByReaderId($readerId) {
        $db = Database::getInstance()->getConnection();
        $sql = "SELECT * FROM borrows WHERE readerId = :readerId AND returnDate IS NULL ORDER BY borrowDate DESC";
        $stmt = $db->prepare($sql);
        $stmt->execute([':readerId' => $readerId]);
        
        $borrows = [];
        while ($data = $stmt->fetch()) {
            $borrows[] = self::createBorrowFromData($data);
        }
        
        return $borrows;
    }
    
    public static function findAllByReaderId($readerId) {
        $db = Database::getInstance()->getConnection();
        $sql = "SELECT * FROM borrows WHERE readerId = :readerId ORDER BY borrowDate DESC";
        $stmt = $db->prepare($sql);
        $stmt->execute([':readerId' => $readerId]);
        
        $borrows = [];
        while ($data = $stmt->fetch()) {
            $borrows[] = self::createBorrowFromData($data);
        }
        
        return $borrows;
    }
    
    public static function getAll() {
        $db = Database::getInstance()->getConnection();
        $sql = "SELECT * FROM borrows ORDER BY borrowDate DESC";
        $stmt = $db->query($sql);
        
        $borrows = [];
        while ($data = $stmt->fetch()) {
            $borrows[] = self::createBorrowFromData($data);
        }
        
        return $borrows;
    }
    
    private static function createBorrowFromData($data) {
        $borrow = new Borrow();
        $borrow->setId($data['id']);
        $borrow->setReaderId($data['readerId']);
        $borrow->setBookId($data['bookId']);
        $borrow->setBorrowDate($data['borrowDate']);
        $borrow->setReturnDate($data['returnDate']);
        
        return $borrow;
    }
    
    public function getReader() {
        require_once __DIR__ . '/User.php';
        return User::findById($this->readerId);
    }
    
    public function getBook() {
        require_once __DIR__ . '/Book.php';
        return Book::findById($this->bookId);
    }
}