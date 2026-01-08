<?php

class DashboardController extends BaseController {
    
    private $satkerModel;
    private $ppbjModel;
    private $userModel;
    
    public function __construct() {
        Auth::requireLogin();
        $this->satkerModel = $this->model('Satker');
        $this->ppbjModel = $this->model('Ppbj');
        $this->userModel = $this->model('User');
    }
    
    public function index() {
        $data = [
            'title' => 'Dashboard',
            'totalSatker' => $this->satkerModel->getTotalSatker(),
            'totalPpbj' => $this->ppbjModel->getTotalPpbj(),
            'totalUsers' => count($this->userModel->getAllUsers())
        ];
        
        $this->view('dashboard/index', $data);
    }
}