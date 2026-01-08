<?php

class SatkerController extends BaseController {
    
    private $satkerModel;
    
    public function __construct() {
        Auth::requireAdmin();
        $this->satkerModel = $this->model('Satker');
    }
    
    public function index() {
        $data = [
            'title' => 'Data Satker',
            'satkers' => $this->satkerModel->getAllSatker()
        ];
        
        $this->view('satker/index', $data);
    }
    
    public function create() {
        $data = [
            'title' => 'Tambah Satker'
        ];
        
        $this->view('satker/create', $data);
    }
    
    public function store() {
        if($this->isPost()) {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $postData = [
                'kode' => trim($_POST['kode']),
                'nama' => trim($_POST['nama']),
                'alamat' => trim($_POST['alamat'])
            ];
            
            // Validation
            $errors = $this->validate($postData, [
                'kode' => 'required|min:2|max:50',
                'nama' => 'required|min:3|max:200'
            ]);
            
            // Check if kode exists
            if(empty($errors) && $this->satkerModel->isKodeExists($postData['kode'])) {
                $errors['kode'] = 'Kode satker sudah digunakan';
            }
            
            if(!empty($errors)) {
                Helper::setOld($postData);
                foreach($errors as $field => $error) {
                    Helper::flashMessage($field . '_error', $error, 'error');
                }
                $this->redirect('satker/create');
                return;
            }
            
            // Create satker
            if($this->satkerModel->createSatker($postData)) {
                Helper::clearOld();
                Helper::flashMessage('satker_message', 'Data satker berhasil ditambahkan', 'success');
                $this->redirect('satker');
            } else {
                Helper::flashMessage('satker_message', 'Gagal menambahkan data satker', 'error');
                $this->redirect('satker/create');
            }
        } else {
            $this->redirect('satker/create');
        }
    }
    
    public function edit($id) {
        $satker = $this->satkerModel->getSatkerById($id);
        
        if(!$satker) {
            Helper::flashMessage('satker_message', 'Data satker tidak ditemukan', 'error');
            $this->redirect('satker');
            return;
        }
        
        $data = [
            'title' => 'Edit Satker',
            'satker' => $satker
        ];
        
        $this->view('satker/edit', $data);
    }
    
    public function update($id) {
        if($this->isPost()) {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $postData = [
                'id' => $id,
                'kode' => trim($_POST['kode']),
                'nama' => trim($_POST['nama']),
                'alamat' => trim($_POST['alamat'])
            ];
            
            // Validation
            $errors = $this->validate($postData, [
                'kode' => 'required|min:2|max:50',
                'nama' => 'required|min:3|max:200'
            ]);
            
            // Check if kode exists
            if(empty($errors) && $this->satkerModel->isKodeExists($postData['kode'], $id)) {
                $errors['kode'] = 'Kode satker sudah digunakan';
            }
            
            if(!empty($errors)) {
                Helper::setOld($postData);
                foreach($errors as $field => $error) {
                    Helper::flashMessage($field . '_error', $error, 'error');
                }
                $this->redirect('satker/edit/' . $id);
                return;
            }
            
            // Update satker
            if($this->satkerModel->updateSatker($postData)) {
                Helper::clearOld();
                Helper::flashMessage('satker_message', 'Data satker berhasil diupdate', 'success');
                $this->redirect('satker');
            } else {
                Helper::flashMessage('satker_message', 'Gagal mengupdate data satker', 'error');
                $this->redirect('satker/edit/' . $id);
            }
        } else {
            $this->redirect('satker/edit/' . $id);
        }
    }
    
    public function delete($id) {
        if($this->isPost()) {
            if($this->satkerModel->deleteSatker($id)) {
                Helper::flashMessage('satker_message', 'Data satker berhasil dihapus', 'success');
            } else {
                Helper::flashMessage('satker_message', 'Gagal menghapus data satker', 'error');
            }
            $this->redirect('satker');
        } else {
            $this->redirect('satker');
        }
    }
}