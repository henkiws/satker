<?php

class UserController extends BaseController {
    
    private $userModel;
    
    public function __construct() {
        Auth::requireAdmin();
        $this->userModel = $this->model('User');
    }
    
    public function index() {
        $data = [
            'title' => 'Data User',
            'users' => $this->userModel->getAllUsers()
        ];
        
        $this->view('user/index', $data);
    }
    
    public function create() {
        $data = [
            'title' => 'Tambah User'
        ];
        
        $this->view('user/create', $data);
    }
    
    public function store() {
        if($this->isPost()) {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $postData = [
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),
                'nama' => trim($_POST['nama']),
                'email' => trim($_POST['email']),
                'role' => trim($_POST['role']),
                'is_active' => isset($_POST['is_active']) ? 1 : 0
            ];
            
            // Validation
            $errors = $this->validate($postData, [
                'username' => 'required|min:4|max:50',
                'password' => 'required|min:6',
                'nama' => 'required|min:3|max:100',
                'email' => 'email'
            ]);
            
            // Check if username exists
            if(empty($errors) && $this->userModel->isUsernameExists($postData['username'])) {
                $errors['username'] = 'Username sudah digunakan';
            }
            
            if(!empty($errors)) {
                Helper::setOld($postData);
                foreach($errors as $field => $error) {
                    Helper::flashMessage($field . '_error', $error, 'error');
                }
                $this->redirect('user/create');
                return;
            }
            
            // Create user
            if($this->userModel->createUser($postData)) {
                Helper::clearOld();
                Helper::flashMessage('user_message', 'Data user berhasil ditambahkan', 'success');
                $this->redirect('user');
            } else {
                Helper::flashMessage('user_message', 'Gagal menambahkan data user', 'error');
                $this->redirect('user/create');
            }
        } else {
            $this->redirect('user/create');
        }
    }
    
    public function edit($id) {
        $user = $this->userModel->getUserById($id);
        
        if(!$user) {
            Helper::flashMessage('user_message', 'Data user tidak ditemukan', 'error');
            $this->redirect('user');
            return;
        }
        
        $data = [
            'title' => 'Edit User',
            'user' => $user
        ];
        
        $this->view('user/edit', $data);
    }
    
    public function update($id) {
        if($this->isPost()) {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $postData = [
                'id' => $id,
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),
                'nama' => trim($_POST['nama']),
                'email' => trim($_POST['email']),
                'role' => trim($_POST['role']),
                'is_active' => isset($_POST['is_active']) ? 1 : 0
            ];
            
            // Validation
            $rules = [
                'username' => 'required|min:4|max:50',
                'nama' => 'required|min:3|max:100',
                'email' => 'email'
            ];
            
            // Only validate password if not empty
            if(!empty($postData['password'])) {
                $rules['password'] = 'min:6';
            }
            
            $errors = $this->validate($postData, $rules);
            
            // Check if username exists
            if(empty($errors) && $this->userModel->isUsernameExists($postData['username'], $id)) {
                $errors['username'] = 'Username sudah digunakan';
            }
            
            if(!empty($errors)) {
                Helper::setOld($postData);
                foreach($errors as $field => $error) {
                    Helper::flashMessage($field . '_error', $error, 'error');
                }
                $this->redirect('user/edit/' . $id);
                return;
            }
            
            // Update user
            if($this->userModel->updateUser($postData)) {
                Helper::clearOld();
                Helper::flashMessage('user_message', 'Data user berhasil diupdate', 'success');
                $this->redirect('user');
            } else {
                Helper::flashMessage('user_message', 'Gagal mengupdate data user', 'error');
                $this->redirect('user/edit/' . $id);
            }
        } else {
            $this->redirect('user/edit/' . $id);
        }
    }
    
    public function delete($id) {
        if($this->isPost()) {
            // Prevent deleting own account
            if($id == Auth::user()->id) {
                Helper::flashMessage('user_message', 'Tidak dapat menghapus akun sendiri', 'error');
                $this->redirect('user');
                return;
            }
            
            if($this->userModel->deleteUser($id)) {
                Helper::flashMessage('user_message', 'Data user berhasil dihapus', 'success');
            } else {
                Helper::flashMessage('user_message', 'Gagal menghapus data user', 'error');
            }
            $this->redirect('user');
        } else {
            $this->redirect('user');
        }
    }
}