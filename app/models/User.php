<?php

class User extends Model {
    
    public function getAllUsers() {
        try {
            $this->db->query("SELECT * FROM users ORDER BY created_at DESC");
            return $this->db->resultSet();
        } catch (Exception $e) {
            error_log("getAllUsers error: " . $e->getMessage());
            return [];
        }
    }
    
    public function getUserById($id) {
        try {
            $this->db->query("SELECT * FROM users WHERE id = :id");
            $this->db->bind(':id', $id);
            return $this->db->single();
        } catch (Exception $e) {
            error_log("getUserById error: " . $e->getMessage());
            return null;
        }
    }
    
    public function getUserByUsername($username) {
        try {
            $this->db->query("SELECT * FROM users WHERE username = :username");
            $this->db->bind(':username', $username);
            $result = $this->db->single();
            error_log("getUserByUsername result: " . print_r($result, true));
            return $result;
        } catch (Exception $e) {
            error_log("getUserByUsername error: " . $e->getMessage());
            return null;
        }
    }
    
    public function createUser($data) {
        try {
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
        } catch (Exception $e) {
            error_log("createUser error: " . $e->getMessage());
            return false;
        }
    }
    
    public function updateUser($data) {
        try {
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
        } catch (Exception $e) {
            error_log("updateUser error: " . $e->getMessage());
            return false;
        }
    }
    
    public function deleteUser($id) {
        try {
            $this->db->query("DELETE FROM users WHERE id = :id");
            $this->db->bind(':id', $id);
            
            if($this->db->execute()) {
                return true;
            }
            return false;
        } catch (Exception $e) {
            error_log("deleteUser error: " . $e->getMessage());
            return false;
        }
    }
    
    public function isUsernameExists($username, $excludeId = null) {
        try {
            if($excludeId) {
                $this->db->query("SELECT id FROM users WHERE username = :username AND id != :id");
                $this->db->bind(':id', $excludeId);
            } else {
                $this->db->query("SELECT id FROM users WHERE username = :username");
            }
            $this->db->bind(':username', $username);
            return $this->db->single() ? true : false;
        } catch (Exception $e) {
            error_log("isUsernameExists error: " . $e->getMessage());
            return false;
        }
    }

    public function updateProfile($data) {
        try {
            $this->db->query("UPDATE users SET username = :username, nama = :nama, email = :email WHERE id = :id");
            
            $this->db->bind(':id', $data['id']);
            $this->db->bind(':username', $data['username']);
            $this->db->bind(':nama', $data['nama']);
            $this->db->bind(':email', $data['email']);
            
            if($this->db->execute()) {
                return true;
            }
            return false;
        } catch (Exception $e) {
            error_log("updateProfile error: " . $e->getMessage());
            return false;
        }
    }

    public function updatePassword($userId, $newPassword) {
        try {
            $this->db->query("UPDATE users SET password = :password WHERE id = :id");
            
            $this->db->bind(':id', $userId);
            $this->db->bind(':password', password_hash($newPassword, PASSWORD_DEFAULT));
            
            if($this->db->execute()) {
                return true;
            }
            return false;
        } catch (Exception $e) {
            error_log("updatePassword error: " . $e->getMessage());
            return false;
        }
    }
}