<?php

class Satker extends Model {
    
    public function getAllSatker() {
        $this->db->query("SELECT * FROM satker ORDER BY created_at DESC");
        return $this->db->resultSet();
    }
    
    public function getSatkerById($id) {
        $this->db->query("SELECT * FROM satker WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
    
    public function createSatker($data) {
        $this->db->query("INSERT INTO satker (kode, nama, alamat) VALUES (:kode, :nama, :alamat)");
        
        $this->db->bind(':kode', $data['kode']);
        $this->db->bind(':nama', $data['nama']);
        $this->db->bind(':alamat', $data['alamat']);
        
        if($this->db->execute()) {
            return true;
        }
        return false;
    }
    
    public function updateSatker($data) {
        $this->db->query("UPDATE satker SET kode = :kode, nama = :nama, alamat = :alamat WHERE id = :id");
        
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':kode', $data['kode']);
        $this->db->bind(':nama', $data['nama']);
        $this->db->bind(':alamat', $data['alamat']);
        
        if($this->db->execute()) {
            return true;
        }
        return false;
    }
    
    public function deleteSatker($id) {
        $this->db->query("DELETE FROM satker WHERE id = :id");
        $this->db->bind(':id', $id);
        
        if($this->db->execute()) {
            return true;
        }
        return false;
    }
    
    public function isKodeExists($kode, $excludeId = null) {
        if($excludeId) {
            $this->db->query("SELECT id FROM satker WHERE kode = :kode AND id != :id");
            $this->db->bind(':id', $excludeId);
        } else {
            $this->db->query("SELECT id FROM satker WHERE kode = :kode");
        }
        $this->db->bind(':kode', $kode);
        return $this->db->single() ? true : false;
    }
    
    public function getTotalSatker() {
        $this->db->query("SELECT COUNT(*) as total FROM satker");
        $result = $this->db->single();
        return $result->total;
    }
}