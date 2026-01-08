<?php

class Ppbj extends Model {
    
    public function getAllPpbj() {
        $this->db->query("SELECT * FROM ppbj ORDER BY created_at DESC");
        return $this->db->resultSet();
    }
    
    public function getPpbjById($id) {
        $this->db->query("SELECT * FROM ppbj WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
    
    public function createPpbj($data) {
        $this->db->query("INSERT INTO ppbj (nama, nip, jabatan) VALUES (:nama, :nip, :jabatan)");
        
        $this->db->bind(':nama', $data['nama']);
        $this->db->bind(':nip', $data['nip']);
        $this->db->bind(':jabatan', $data['jabatan']);
        
        if($this->db->execute()) {
            return true;
        }
        return false;
    }
    
    public function updatePpbj($data) {
        $this->db->query("UPDATE ppbj SET nama = :nama, nip = :nip, jabatan = :jabatan WHERE id = :id");
        
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':nama', $data['nama']);
        $this->db->bind(':nip', $data['nip']);
        $this->db->bind(':jabatan', $data['jabatan']);
        
        if($this->db->execute()) {
            return true;
        }
        return false;
    }
    
    public function deletePpbj($id) {
        $this->db->query("DELETE FROM ppbj WHERE id = :id");
        $this->db->bind(':id', $id);
        
        if($this->db->execute()) {
            return true;
        }
        return false;
    }
    
    public function isNipExists($nip, $excludeId = null) {
        if($excludeId) {
            $this->db->query("SELECT id FROM ppbj WHERE nip = :nip AND id != :id");
            $this->db->bind(':id', $excludeId);
        } else {
            $this->db->query("SELECT id FROM ppbj WHERE nip = :nip");
        }
        $this->db->bind(':nip', $nip);
        return $this->db->single() ? true : false;
    }
    
    public function getTotalPpbj() {
        $this->db->query("SELECT COUNT(*) as total FROM ppbj");
        $result = $this->db->single();
        return $result->total;
    }
}