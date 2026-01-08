<?php

class Helper {
    
    public static function flashMessage($name, $message, $type = 'success') {
        $_SESSION['flash'][$name] = [
            'message' => $message,
            'type' => $type
        ];
    }
    
    public static function getFlashMessage($name) {
        if(isset($_SESSION['flash'][$name])) {
            $flash = $_SESSION['flash'][$name];
            unset($_SESSION['flash'][$name]);
            return $flash;
        }
        return null;
    }
    
    public static function old($name, $default = '') {
        return isset($_SESSION['old'][$name]) ? $_SESSION['old'][$name] : $default;
    }
    
    public static function setOld($data) {
        $_SESSION['old'] = $data;
    }
    
    public static function clearOld() {
        unset($_SESSION['old']);
    }
    
    public static function sanitize($data) {
        return htmlspecialchars(strip_tags(trim($data)));
    }
    
    public static function formatDate($date) {
        return date('d/m/Y H:i', strtotime($date));
    }
}