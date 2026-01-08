<?php

class User extends Model {
    
    public function getAllUsers() {
        $this->db->query("SELECT * FROM users ORDER BY created_at DESC");
        return $this->db->resultSet();
    }
    
    public function getUserById($id) {
        $this->db->query("SELECT * FROM users WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
    
    public function getUserByUsername($username) {
        $this->db->query("SELECT * FROM users WHERE username = :username");
        $this->db->bind(':username', $username);
        return $this->db->single();
    }
    
    public function createUser($data) {
        $this->db->query("INSERT INTO users (username, password, nama, email, role, is_active) 
                         VALUES (:username, :password, :nama, :email, :role, :is_active)");
        
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':password', password_hash($data['password'], PASSWORD_DEFAULT));
        $this->db->bind(':nama', $data['nama']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':role', $data['role']);
        $this->db->bind(':is_active', $data['is_active']);
        
        if($this->db->execute()) {
            return true;
        }
        return false;
    }
    
    public function updateUser($data) {
        if(!empty($data['password'])) {
            $this->db->query("UPDATE users SET username = :username, password = :password, 
                             nama = :nama, email = :email, role = :role, is_active = :is_active 
                             WHERE id = :id");
            $this->db->bind(':password', password_hash($data['password'], PASSWORD_DEFAULT));
        } else {
            $this->db->query("UPDATE users SET username = :username, nama = :nama, 
                             email = :email, role = :role, is_active = :is_active 
                             WHERE id = :id");
        }
        
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':nama', $data['nama']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':role', $data['role']);
        $this->db->bind(':is_active', $data['is_active']);
        
        if($this->db->execute()) {
            return true;
        }
        return false;
    }
    
    public function deleteUser($id) {
        $this->db->query("DELETE FROM users WHERE id = :id");
        $this->db->bind(':id', $id);
        
        if($this->db->execute()) {
            return true;
        }
        return false;
    }
    
    public function isUsernameExists($username, $excludeId = null) {
        if($excludeId) {
            $this->db->query("SELECT id FROM users WHERE username = :username AND id != :id");
            $this->db->bind(':id', $excludeId);
        } else {
            $this->db->query("SELECT id FROM users WHERE username = :username");
        }
        $this->db->bind(':username', $username);
        return $this->db->single() ? true : false;
    }
}