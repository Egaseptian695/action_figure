<?php

class Profile extends Controller {
    public function index() {
        
        // 1. Satpam menggunakan nama kunci yang benar: 'user_id'
        // 2. Rute lemparan disesuaikan ke '/auth/login'
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASEURL . '/auth/login');
            exit;
        }

        $data['judul'] = 'Profil Saya';
        
        // Menggunakan 'user_id' untuk mengambil data pelanggan dari database
        $data['user'] = $this->model('User_model')->getUserById($_SESSION['user_id']);

        $this->view('templates/header', $data);
        $this->view('profile/index', $data);
        $this->view('templates/footer');
    }
    // Halaman Riwayat Pesanan Customer
    public function pesanan() {
        // Cek login
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASEURL . '/auth/login');
            exit;
        }

        $data['judul'] = 'Riwayat Pesanan';
        
        // Ambil data pesanan. 
        // Pastikan nama modelnya ('Transaction_model') sesuai dengan yang kamu pakai di Langkah 1
        $data['pesanan'] = $this->model('Transaction_model')->getTransactionByUser($_SESSION['user_id']);

        $this->view('templates/header', $data);
        $this->view('profile/pesanan', $data);
        $this->view('templates/footer');
    }
}