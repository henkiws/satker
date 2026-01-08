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
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);
            
            // Validation
            if(empty($username) || empty($password)) {
                Helper::flashMessage('login_error', 'Username dan password harus diisi', 'error');
                $this->redirect('auth/login');
                return;
            }
            
            // Check user
            $user = $this->userModel->getUserByUsername($username);
            
            if($user && password_verify($password, $user->password)) {
                if($user->is_active == 1) {
                    Auth::login($user);
                    $this->redirect('dashboard');
                } else {
                    Helper::flashMessage('login_error', 'Akun Anda tidak aktif', 'error');
                    $this->redirect('auth/login');
                }
            } else {
                Helper::flashMessage('login_error', 'Username atau password salah', 'error');
                $this->redirect('auth/login');
            }
        } else {
            $this->redirect('auth/login');
        }
    }
    
    public function logout() {
        Auth::logout();
        $this->redirect('auth/login');
    }
}