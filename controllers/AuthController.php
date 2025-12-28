<?php

require_once __DIR__ . '/../config/constants.php';
require_once __DIR__ . '/../utils/Session.php';
require_once __DIR__ . '/../utils/Validator.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Reader.php';

class AuthController {
    
    public function showLoginForm() {
        if (Session::isLoggedIn()) {
            $this->redirectToDashboard();
            return;
        }
        
        require_once VIEWS_PATH . '/auth/login.php';
    }
    
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /login');
            exit;
        }
        
        $email = Validator::sanitize($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        
        $validator = new Validator();
        if (!$validator->validate(['email' => $email, 'password' => $password], [
            'email' => 'required|email',
            'password' => 'required'
        ])) {
            Session::setFlash('error', 'Email et mot de passe requis.');
            header('Location: /login');
            exit;
        }
        
        $user = User::findByEmail($email);
        
        if (!$user || !$user->verifyPassword($password)) {
            Session::setFlash('error', 'Identifiants incorrects.');
            header('Location: /login');
            exit;
        }
        
        Session::set('user_id', $user->getId());
        Session::set('user_role', $user->getRole());
        Session::set('user_name', $user->getFullName());
        
        Session::setFlash('success', 'Connexion réussie!');
        $this->redirectToDashboard();
    }
    
    public function showRegisterForm() {
        if (Session::isLoggedIn()) {
            $this->redirectToDashboard();
            return;
        }
        
        require_once VIEWS_PATH . '/auth/register.php';
    }
    
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /register');
            exit;
        }
        
        $data = [
            'firstName' => Validator::sanitize($_POST['firstName'] ?? ''),
            'lastName' => Validator::sanitize($_POST['lastName'] ?? ''),
            'email' => Validator::sanitize($_POST['email'] ?? ''),
            'password' => $_POST['password'] ?? '',
            'password_confirmation' => $_POST['password_confirmation'] ?? ''
        ];
        
        $validator = new Validator();
        if (!$validator->validate($data, [
            'firstName' => 'required|min:2|max:100',
            'lastName' => 'required|min:2|max:100',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed'
        ])) {
            Session::set('errors', $validator->getErrors());
            Session::set('old', $data);
            header('Location: /register');
            exit;
        }
        
        if (User::findByEmail($data['email'])) {
            Session::setFlash('error', 'Cet email est déjà utilisé.');
            Session::set('old', $data);
            header('Location: /register');
            exit;
        }
        
        $reader = new Reader(
            $data['firstName'],
            $data['lastName'],
            $data['email']
        );
        $reader->setPassword($data['password']);
        
        if ($reader->save()) {
            Session::setFlash('success', 'Inscription réussie! Vous pouvez maintenant vous connecter.');
            header('Location: /login');
        } else {
            Session::setFlash('error', 'Erreur lors de l\'inscription.');
            header('Location: /register');
        }
        exit;
    }
    
    public function logout() {
        Session::destroy();
        header('Location: /login');
        exit;
    }
    
    private function redirectToDashboard() {
        if (Session::isAdmin()) {
            header('Location: /admin/dashboard');
        } else {
            header('Location: /reader/dashboard');
        }
        exit;
    }
}