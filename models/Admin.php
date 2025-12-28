<?php

require_once __DIR__ . '/User.php';
require_once __DIR__ . '/Book.php';

class Admin extends User {
    
    public function __construct($firstName = '', $lastName = '', $email = '', $password = '') {
        parent::__construct($firstName, $lastName, $email, $password);
        $this->role = ROLE_ADMIN;
    }
    
    public function addBook($title, $author, $year) {
        $book = new Book($title, $author, $year);
        return $book->save();
    }
    
    public function updateBook($bookId, $title, $author, $year) {
        $book = Book::findById($bookId);
        if (!$book) {
            return false;
        }
        
        $book->setTitle($title);
        $book->setAuthor($author);
        $book->setYear($year);
        
        return $book->update();
    }
    
    public function deleteBook($bookId) {
        $book = Book::findById($bookId);
        if (!$book) {
            return false;
        }
        
        return $book->delete();
    }
    
    public function getAllBooks() {
        return Book::getAll();
    }
    
    public function getAllReaders() {
        $sql = "SELECT * FROM users WHERE role = :role ORDER BY created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':role' => ROLE_READER]);
        
        $readers = [];
        while ($data = $stmt->fetch()) {
            require_once __DIR__ . '/Reader.php';
            $reader = new Reader();
            $reader->setId($data['id']);
            $reader->setFirstName($data['firstName']);
            $reader->setLastName($data['lastName']);
            $reader->setEmail($data['email']);
            $readers[] = $reader;
        }
        
        return $readers;
    }
    
    public function getAllBorrows() {
        require_once __DIR__ . '/Borrow.php';
        return Borrow::getAll();
    }
}