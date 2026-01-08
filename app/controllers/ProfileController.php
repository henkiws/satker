<?php

class ProfileController extends BaseController {
    
    private $userModel;
    
    public function __construct() {
        Auth::requireLogin();
        $this->userModel = $this->model('User');
    }
    
    public function index() {
        $user = $this->userModel->getUserById(Auth::user()->id);
        
        $data = [
            'title' => 'Profil Saya',
            'user' => $user
        ];
        
        $this->view('profile/index', $data);
    }
    
    public function update() {
        if($this->isPost()) {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            $postData = [
                'id' => Auth::user()->id,
                'username' => trim($_POST['username']),
                'nama' => trim($_POST['nama']),
                'email' => trim($_POST['email'])
            ];
            
            // Validation
            $errors = $this->validate($postData, [
                'username' => 'required|min:4|max:50',
                'nama' => 'required|min:3|max:100',
                'email' => 'email'
            ]);
            
            // Check if username exists (exclude current user)
            if(empty($errors) && $this->userModel->isUsernameExists($postData['username'], Auth::user()->id)) {
                $errors['username'] = 'Username sudah digunakan';
            }
            
            if(!empty($errors)) {
                Helper::setOld($postData);
                foreach($errors as $field => $error) {
                    Helper::flashMessage($field . '_error', $error, 'error');
                }
                $this->redirect('profile');
                return;
            }
            
            // Update profile
            if($this->userModel->updateProfile($postData)) {
                // Update session data
                $_SESSION['username'] = $postData['username'];
                $_SESSION['nama'] = $postData['nama'];
                
                Helper::clearOld();
                Helper::flashMessage('profile_message', 'Profil berhasil diupdate', 'success');
                $this->redirect('profile');
            } else {
                Helper::flashMessage('profile_message', 'Gagal mengupdate profil', 'error');
                $this->redirect('profile');
            }
        } else {
            $this->redirect('profile');
        }
    }
    
    public function changePassword() {
        if($this->isPost()) {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            $currentPassword = trim($_POST['current_password']);
            $newPassword = trim($_POST['new_password']);
            $confirmPassword = trim($_POST['confirm_password']);
            
            $errors = [];
            
            // Validation
            if(empty($currentPassword)) {
                $errors['current_password'] = 'Password saat ini harus diisi';
            }
            
            if(empty($newPassword)) {
                $errors['new_password'] = 'Password baru harus diisi';
            } elseif(strlen($newPassword) < 6) {
                $errors['new_password'] = 'Password baru minimal 6 karakter';
            }
            
            if(empty($confirmPassword)) {
                $errors['confirm_password'] = 'Konfirmasi password harus diisi';
            } elseif($newPassword !== $confirmPassword) {
                $errors['confirm_password'] = 'Konfirmasi password tidak cocok';
            }
            
            // Check current password
            if(empty($errors)) {
                $user = $this->userModel->getUserById(Auth::user()->id);
                if(!password_verify($currentPassword, $user->password)) {
                    $errors['current_password'] = 'Password saat ini salah';
                }
            }
            
            if(!empty($errors)) {
                foreach($errors as $field => $error) {
                    Helper::flashMessage($field . '_error', $error, 'error');
                }
                $this->redirect('profile');
                return;
            }
            
            // Update password
            if($this->userModel->updatePassword(Auth::user()->id, $newPassword)) {
                Helper::flashMessage('password_message', 'Password berhasil diubah', 'success');
                $this->redirect('profile');
            } else {
                Helper::flashMessage('password_message', 'Gagal mengubah password', 'error');
                $this->redirect('profile');
            }
        } else {
            $this->redirect('profile');
        }
    }
}