<?php

class BaseController extends Controller {
    
    protected function isPost() {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }
    
    protected function validate($data, $rules) {
        $errors = [];
        
        foreach($rules as $field => $ruleSet) {
            $rulesArray = explode('|', $ruleSet);
            
            foreach($rulesArray as $rule) {
                $value = isset($data[$field]) ? trim($data[$field]) : '';
                
                if($rule === 'required' && empty($value)) {
                    $errors[$field] = ucfirst($field) . ' harus diisi';
                    break;
                }
                
                if(strpos($rule, 'min:') === 0 && !empty($value)) {
                    $min = (int) substr($rule, 4);
                    if(strlen($value) < $min) {
                        $errors[$field] = ucfirst($field) . ' minimal ' . $min . ' karakter';
                        break;
                    }
                }
                
                if(strpos($rule, 'max:') === 0 && !empty($value)) {
                    $max = (int) substr($rule, 4);
                    if(strlen($value) > $max) {
                        $errors[$field] = ucfirst($field) . ' maksimal ' . $max . ' karakter';
                        break;
                    }
                }
                
                if($rule === 'email' && !empty($value)) {
                    if(!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                        $errors[$field] = ucfirst($field) . ' tidak valid';
                        break;
                    }
                }
            }
        }
        
        return $errors;
    }
    
    protected function jsonResponse($data, $status = 200) {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}