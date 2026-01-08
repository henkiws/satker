<?php

class Auth {
    
    public static function check() {
        return isset($_SESSION['user_id']);
    }
    
    public static function user() {
        if(self::check()) {
            return (object) [
                'id' => $_SESSION['user_id'],
                'username' => $_SESSION['username'],
                'nama' => $_SESSION['nama'],
                'role' => $_SESSION['role']
            ];
        }
        return null;
    }
    
    public static function isAdmin() {
        return self::check() && $_SESSION['role'] === 'admin';
    }
    
    public static function login($user) {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['username'] = $user->username;
        $_SESSION['nama'] = $user->nama;
        $_SESSION['role'] = $user->role;
    }
    
    public static function logout() {
        session_unset();
        session_destroy();
    }
    
    public static function requireLogin() {
        if(!self::check()) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }
    }
    
    public static function requireAdmin() {
        self::requireLogin();
        if(!self::isAdmin()) {
            header('Location: ' . BASE_URL . '/dashboard');
            exit;
        }
    }
}