<?php

require_once __DIR__ . '/User.php';
require_once __DIR__ . '/Borrow.php';

class Reader extends User {
    
    public function __construct($firstName = '', $lastName = '', $email = '', $password = '') {
        parent::__construct($firstName, $lastName, $email, $password);
        $this->role = ROLE_READER;
    }
    
    public function borrowBook($bookId) {
        require_once __DIR__ . '/Book.php';
        
        $book = Book::findById($bookId);
        if (!$book) {
            return ['success' => false, 'message' => 'Livre introuvable.'];
        }
        
        if ($book->getStatus() !== STATUS_AVAILABLE) {
            return ['success' => false, 'message' => 'Ce livre n\'est pas disponible.'];
        }
        
        $borrow = new Borrow($this->id, $bookId);
        if ($borrow->save()) {
            $book->setStatus(STATUS_BORROWED);
            $book->update();
            return ['success' => true, 'message' => 'Livre emprunté avec succès.'];
        }
        
        return ['success' => false, 'message' => 'Erreur lors de l\'emprunt.'];
    }
    
    public function returnBook($borrowId) {
        $borrow = Borrow::findById($borrowId);
        
        if (!$borrow) {
            return ['success' => false, 'message' => 'Emprunt introuvable.'];
        }
        
        if ($borrow->getReaderId() != $this->id) {
            return ['success' => false, 'message' => 'Cet emprunt ne vous appartient pas.'];
        }
        
        if ($borrow->getReturnDate() !== null) {
            return ['success' => false, 'message' => 'Ce livre a déjà été retourné.'];
        }
        
        if ($borrow->returnBook()) {
            require_once __DIR__ . '/Book.php';
            $book = Book::findById($borrow->getBookId());
            if ($book) {
                $book->setStatus(STATUS_AVAILABLE);
                $book->update();
            }
            return ['success' => true, 'message' => 'Livre retourné avec succès.'];
        }
        
        return ['success' => false, 'message' => 'Erreur lors du retour.'];
    }
    
    public function getActiveBorrows() {
        return Borrow::findActiveByReaderId($this->id);
    }
    
    public function getAllBorrows() {
        return Borrow::findAllByReaderId($this->id);
    }
    
    public function hasActiveBorrowForBook($bookId) {
        $borrows = $this->getActiveBorrows();
        foreach ($borrows as $borrow) {
            if ($borrow->getBookId() == $bookId) {
                return true;
            }
        }
        return false;
    }
}