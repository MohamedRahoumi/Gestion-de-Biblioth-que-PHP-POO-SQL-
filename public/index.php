<?php

require_once __DIR__ . '/../config/constants.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../utils/Session.php';
require_once __DIR__ . '/../controllers/AuthController.php';
require_once __DIR__ . '/../controllers/ReaderController.php';
require_once __DIR__ . '/../controllers/AdminController.php';

Session::start();

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];


switch (true) {
    
    case $uri === '/' || $uri === '':
        if (Session::isLoggedIn()) {
            if (Session::isAdmin()) {
                header('Location: /admin/dashboard');
            } else {
                header('Location: /reader/dashboard');
            }
        } else {
            header('Location: /login');
        }
        exit;
    
   
    case $uri === '/login' && $method === 'GET':
        $controller = new AuthController();
        $controller->showLoginForm();
        break;
    
    case $uri === '/login' && $method === 'POST':
        $controller = new AuthController();
        $controller->login();
        break;
    
    case $uri === '/register' && $method === 'GET':
        $controller = new AuthController();
        $controller->showRegisterForm();
        break;
    
    case $uri === '/register' && $method === 'POST':
        $controller = new AuthController();
        $controller->register();
        break;
    
    case $uri === '/logout':
        $controller = new AuthController();
        $controller->logout();
        break;
    
    // Reader routes
    case $uri === '/reader/dashboard':
        $controller = new ReaderController();
        $controller->dashboard();
        break;
    
    case $uri === '/reader/books':
        $controller = new ReaderController();
        $controller->booksList();
        break;
    
    case preg_match('/^\/reader\/book\/(\d+)$/', $uri, $matches):
        $controller = new ReaderController();
        $controller->bookDetails($matches[1]);
        break;
    
    case $uri === '/reader/borrow' && $method === 'POST':
        $controller = new ReaderController();
        $controller->borrowBook();
        break;
    
    case $uri === '/reader/return' && $method === 'POST':
        $controller = new ReaderController();
        $controller->returnBook();
        break;
    
    case $uri === '/reader/borrows':
        $controller = new ReaderController();
        $controller->myBorrows();
        break;
    
    // Admin routes
    case $uri === '/admin/dashboard':
        $controller = new AdminController();
        $controller->dashboard();
        break;
    
    case $uri === '/admin/books':
        $controller = new AdminController();
        $controller->manageBooks();
        break;
    
    case $uri === '/admin/books/add' && $method === 'GET':
        $controller = new AdminController();
        $controller->showAddBookForm();
        break;
    
    case $uri === '/admin/books/add' && $method === 'POST':
        $controller = new AdminController();
        $controller->addBook();
        break;
    
    case preg_match('/^\/admin\/books\/edit\/(\d+)$/', $uri, $matches) && $method === 'GET':
        $controller = new AdminController();
        $controller->showEditBookForm($matches[1]);
        break;
    
    case preg_match('/^\/admin\/books\/edit\/(\d+)$/', $uri, $matches) && $method === 'POST':
        $controller = new AdminController();
        $controller->editBook($matches[1]);
        break;
    
    case $uri === '/admin/books/delete' && $method === 'POST':
        $controller = new AdminController();
        $controller->deleteBook();
        break;
    
    case $uri === '/admin/users':
        $controller = new AdminController();
        $controller->manageUsers();
        break;
    
    case $uri === '/admin/borrows':
        $controller = new AdminController();
        $controller->manageBorrows();
        break;
    
 
    default:
        http_response_code(404);
        echo "<h1>404 - Page Not Found</h1>";
        break;
}