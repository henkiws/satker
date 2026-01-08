<?php

class PpbjController extends BaseController {
    
    private $ppbjModel;
    
    public function __construct() {
        Auth::requireAdmin();
        $this->ppbjModel = $this->model('Ppbj');
    }
    
    public function index() {
        $data = [
            'title' => 'Data PPBJ',
            'ppbjs' => $this->ppbjModel->getAllPpbj()
        ];
        
        $this->view('ppbj/index', $data);
    }
    
    public function create() {
        $data = [
            'title' => 'Tambah PPBJ'
        ];
        
        $this->view('ppbj/create', $data);
    }
    
    public function store() {
        if($this->isPost()) {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $postData = [
                'nama' => trim($_POST['nama']),
                'nip' => trim($_POST['nip']),
                'jabatan' => trim($_POST['jabatan'])
            ];
            
            // Validation
            $errors = $this->validate($postData, [
                'nama' => 'required|min:3|max:100',
                'nip' => 'required|min:5|max:50'
            ]);
            
            // Check if NIP exists
            if(empty($errors) && $this->ppbjModel->isNipExists($postData['nip'])) {
                $errors['nip'] = 'NIP sudah terdaftar';
            }
            
            if(!empty($errors)) {
                Helper::setOld($postData);
                foreach($errors as $field => $error) {
                    Helper::flashMessage($field . '_error', $error, 'error');
                }
                $this->redirect('ppbj/create');
                return;
            }
            
            // Create PPBJ
            if($this->ppbjModel->createPpbj($postData)) {
                Helper::clearOld();
                Helper::flashMessage('ppbj_message', 'Data PPBJ berhasil ditambahkan', 'success');
                $this->redirect('ppbj');
            } else {
                Helper::flashMessage('ppbj_message', 'Gagal menambahkan data PPBJ', 'error');
                $this->redirect('ppbj/create');
            }
        } else {
            $this->redirect('ppbj/create');
        }
    }
    
    public function edit($id) {
        $ppbj = $this->ppbjModel->getPpbjById($id);
        
        if(!$ppbj) {
            Helper::flashMessage('ppbj_message', 'Data PPBJ tidak ditemukan', 'error');
            $this->redirect('ppbj');
            return;
        }
        
        $data = [
            'title' => 'Edit PPBJ',
            'ppbj' => $ppbj
        ];
        
        $this->view('ppbj/edit', $data);
    }
    
    public function update($id) {
        if($this->isPost()) {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $postData = [
                'id' => $id,
                'nama' => trim($_POST['nama']),
                'nip' => trim($_POST['nip']),
                'jabatan' => trim($_POST['jabatan'])
            ];
            
            // Validation
            $errors = $this->validate($postData, [
                'nama' => 'required|min:3|max:100',
                'nip' => 'required|min:5|max:50'
            ]);
            
            // Check if NIP exists
            if(empty($errors) && $this->ppbjModel->isNipExists($postData['nip'], $id)) {
                $errors['nip'] = 'NIP sudah terdaftar';
            }
            
            if(!empty($errors)) {
                Helper::setOld($postData);
                foreach($errors as $field => $error) {
                    Helper::flashMessage($field . '_error', $error, 'error');
                }
                $this->redirect('ppbj/edit/' . $id);
                return;
            }
            
            // Update PPBJ
            if($this->ppbjModel->updatePpbj($postData)) {
                Helper::clearOld();
                Helper::flashMessage('ppbj_message', 'Data PPBJ berhasil diupdate', 'success');
                $this->redirect('ppbj');
            } else {
                Helper::flashMessage('ppbj_message', 'Gagal mengupdate data PPBJ', 'error');
                $this->redirect('ppbj/edit/' . $id);
            }
        } else {
            $this->redirect('ppbj/edit/' . $id);
        }
    }
    
    public function delete($id) {
        if($this->isPost()) {
            if($this->ppbjModel->deletePpbj($id)) {
                Helper::flashMessage('ppbj_message', 'Data PPBJ berhasil dihapus', 'success');
            } else {
                Helper::flashMessage('ppbj_message', 'Gagal menghapus data PPBJ', 'error');
            }
            $this->redirect('ppbj');
        } else {
            $this->redirect('ppbj');
        }
    }
}