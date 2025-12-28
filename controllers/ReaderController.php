<?php

require_once __DIR__ . '/../config/constants.php';
require_once __DIR__ . '/../utils/Session.php';
require_once __DIR__ . '/../models/Reader.php';
require_once __DIR__ . '/../models/Book.php';

class ReaderController {
    
    private function checkAuth() {
        if (!Session::isLoggedIn() || !Session::isReader()) {
            Session::setFlash('error', 'Accès non autorisé.');
            header('Location: /login');
            exit;
        }
    }
    
    public function dashboard() {
        $this->checkAuth();
        
        $reader = User::findById(Session::getUserId());
        $activeBorrows = $reader->getActiveBorrows();
        
        require_once VIEWS_PATH . '/reader/dashboard.php';
    }
    
    public function booksList() {
        $this->checkAuth();
        
        $books = Book::getAll();
        $reader = User::findById(Session::getUserId());
        
        require_once VIEWS_PATH . '/reader/books-list.php';
    }
    
    public function bookDetails($bookId) {
        $this->checkAuth();
        
        $book = Book::findById($bookId);
        if (!$book) {
            Session::setFlash('error', 'Livre introuvable.');
            header('Location: /reader/books');
            exit;
        }
        
        $reader = User::findById(Session::getUserId());
        $hasActiveBorrow = $reader->hasActiveBorrowForBook($bookId);
        
        require_once VIEWS_PATH . '/reader/book-details.php';
    }
    
    public function borrowBook() {
        $this->checkAuth();
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /reader/books');
            exit;
        }
        
        $bookId = $_POST['book_id'] ?? null;
        if (!$bookId) {
            Session::setFlash('error', 'Livre invalide.');
            header('Location: /reader/books');
            exit;
        }
        
        $reader = User::findById(Session::getUserId());
        $result = $reader->borrowBook($bookId);
        
        Session::setFlash($result['success'] ? 'success' : 'error', $result['message']);
        header('Location: /reader/book/' . $bookId);
        exit;
    }
    
    public function returnBook() {
        $this->checkAuth();
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /reader/borrows');
            exit;
        }
        
        $borrowId = $_POST['borrow_id'] ?? null;
        if (!$borrowId) {
            Session::setFlash('error', 'Emprunt invalide.');
            header('Location: /reader/borrows');
            exit;
        }
        
        $reader = User::findById(Session::getUserId());
        $result = $reader->returnBook($borrowId);
        
        Session::setFlash($result['success'] ? 'success' : 'error', $result['message']);
        header('Location: /reader/borrows');
        exit;
    }
    
    public function myBorrows() {
        $this->checkAuth();
        
        $reader = User::findById(Session::getUserId());
        $activeBorrows = $reader->getActiveBorrows();
        $pastBorrows = array_filter($reader->getAllBorrows(), function($borrow) {
            return !$borrow->isActive();
        });
        
        require_once VIEWS_PATH . '/reader/my-borrows.php';
    }
}