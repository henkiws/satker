<?php

class AuthController extends BaseController {
    
    private $userModel;
    
    public function __construct() {
        $this->userModel = $this->model('User');
    }
    
    public function login() {
        if(Auth::check()) {
            $this->redirect('dashboard');
        }
        
        $data = [
            'title' => 'Login'
        ];
        
        $this->view('auth/login', $data);
    }
    
    public function loginProcess() {
        if($this->isPost()) {
            // Debug: Check if POST data is received
            error_log("POST data received: " . print_r($_POST, true));
            
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            $username = trim($_POST['username'] ?? '');
            $password = trim($_POST['password'] ?? '');
            
            error_log("Username: $username");
            
            // Validation
            if(empty($username) || empty($password)) {
                error_log("Validation failed: empty fields");
                Helper::flashMessage('login_error', 'Username dan password harus diisi', 'error');
                $this->redirect('auth/login');
                return;
            }
            
            // Check user
            $user = $this->userModel->getUserByUsername($username);
            
            error_log("User found: " . ($user ? "Yes" : "No"));
            
            if($user) {
                error_log("User password hash: " . $user->password);
                error_log("Verify result: " . (password_verify($password, $user->password) ? "True" : "False"));
            }
            
            if($user && password_verify($password, $user->password)) {
                if($user->is_active == 1) {
                    error_log("Login successful, setting session");
                    Auth::login($user);
                    error_log("Session after login: " . print_r($_SESSION, true));
                    $this->redirect('dashboard');
                } else {
                    error_log("User not active");
                    Helper::flashMessage('login_error', 'Akun Anda tidak aktif', 'error');
                    $this->redirect('auth/login');
                }
            } else {
                error_log("Invalid credentials");
                Helper::flashMessage('login_error', 'Username atau password salah', 'error');
                $this->redirect('auth/login');
            }
        } else {
            error_log("Not a POST request");
            $this->redirect('auth/login');
        }
    }
    
    public function logout() {
        Auth::logout();
        $this->redirect('auth/login');
    }
}