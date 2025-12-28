<?php

require_once __DIR__ . '/../config/constants.php';
require_once __DIR__ . '/../utils/Session.php';
require_once __DIR__ . '/../utils/Validator.php';
require_once __DIR__ . '/../models/Admin.php';
require_once __DIR__ . '/../models/Book.php';

class AdminController {
    
    private function checkAuth() {
        if (!Session::isLoggedIn() || !Session::isAdmin()) {
            Session::setFlash('error', 'Accès non autorisé.');
            header('Location: /login');
            exit;
        }
    }
    
    public function dashboard() {
        $this->checkAuth();
        
        $admin = User::findById(Session::getUserId());
        $totalBooks = count(Book::getAll());
        $availableBooks = count(Book::getAvailable());
        $borrowedBooks = $totalBooks - $availableBooks;
        
        require_once __DIR__ . '/../models/Borrow.php';
        $activeBorrows = array_filter(Borrow::getAll(), function($borrow) {
            return $borrow->isActive();
        });
        
        require_once VIEWS_PATH . '/admin/dashboard.php';
    }
    
    public function manageBooks() {
        $this->checkAuth();
        
        $books = Book::getAll();
        
        require_once VIEWS_PATH . '/admin/manage-books.php';
    }
    
    public function showAddBookForm() {
        $this->checkAuth();
        
        require_once VIEWS_PATH . '/admin/add-book.php';
    }
    
    public function addBook() {
        $this->checkAuth();
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /admin/books/add');
            exit;
        }
        
        $data = [
            'title' => Validator::sanitize($_POST['title'] ?? ''),
            'author' => Validator::sanitize($_POST['author'] ?? ''),
            'year' => Validator::sanitize($_POST['year'] ?? '')
        ];
        
        $validator = new Validator();
        if (!$validator->validate($data, [
            'title' => 'required|min:2|max:255',
            'author' => 'required|min:2|max:150',
            'year' => 'required|numeric'
        ])) {
            Session::set('errors', $validator->getErrors());
            Session::set('old', $data);
            header('Location: /admin/books/add');
            exit;
        }
        
        $admin = User::findById(Session::getUserId());
        if ($admin->addBook($data['title'], $data['author'], $data['year'])) {
            Session::setFlash('success', 'Livre ajouté avec succès.');
            header('Location: /admin/books');
        } else {
            Session::setFlash('error', 'Erreur lors de l\'ajout du livre.');
            header('Location: /admin/books/add');
        }
        exit;
    }
    
    public function showEditBookForm($bookId) {
        $this->checkAuth();
        
        $book = Book::findById($bookId);
        if (!$book) {
            Session::setFlash('error', 'Livre introuvable.');
            header('Location: /admin/books');
            exit;
        }
        
        require_once VIEWS_PATH . '/admin/edit-book.php';
    }
    
    public function editBook($bookId) {
        $this->checkAuth();
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /admin/books');
            exit;
        }
        
        $data = [
            'title' => Validator::sanitize($_POST['title'] ?? ''),
            'author' => Validator::sanitize($_POST['author'] ?? ''),
            'year' => Validator::sanitize($_POST['year'] ?? '')
        ];
        
        $validator = new Validator();
        if (!$validator->validate($data, [
            'title' => 'required|min:2|max:255',
            'author' => 'required|min:2|max:150',
            'year' => 'required|numeric'
        ])) {
            Session::set('errors', $validator->getErrors());
            Session::set('old', $data);
            header('Location: /admin/books/edit/' . $bookId);
            exit;
        }
        
        $admin = User::findById(Session::getUserId());
        if ($admin->updateBook($bookId, $data['title'], $data['author'], $data['year'])) {
            Session::setFlash('success', 'Livre modifié avec succès.');
            header('Location: /admin/books');
        } else {
            Session::setFlash('error', 'Erreur lors de la modification du livre.');
            header('Location: /admin/books/edit/' . $bookId);
        }
        exit;
    }
    
    public function deleteBook() {
        $this->checkAuth();
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /admin/books');
            exit;
        }
        
        $bookId = $_POST['book_id'] ?? null;
        if (!$bookId) {
            Session::setFlash('error', 'Livre invalide.');
            header('Location: /admin/books');
            exit;
        }
        
        $admin = User::findById(Session::getUserId());
        if ($admin->deleteBook($bookId)) {
            Session::setFlash('success', 'Livre supprimé avec succès.');
        } else {
            Session::setFlash('error', 'Erreur lors de la suppression du livre.');
        }
        
        header('Location: /admin/books');
        exit;
    }
    
    public function manageUsers() {
        $this->checkAuth();
        
        $admin = User::findById(Session::getUserId());
        $readers = $admin->getAllReaders();
        
        require_once VIEWS_PATH . '/admin/manage-users.php';
    }
    
    public function manageBorrows() {
        $this->checkAuth();
        
        $admin = User::findById(Session::getUserId());
        $borrows = $admin->getAllBorrows();
        
        require_once VIEWS_PATH . '/admin/manage-borrows.php';
    }
}