<?php

class Auth extends Controller {

    // 1. Method default wajib (Mencegah Fatal Error jika URL hanya /auth)
    public function index() {
        header('Location: ' . BASEURL . '/auth/login');
        exit;
    }

    // Halaman login
    public function login() {
        $data['judul'] = 'Login';
        $this->view('templates/header', $data);
        $this->view('auth/login');
        $this->view('templates/footer');
    }

    // Proses login
    public function prosesLogin() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $user = $this->model('User_model')->getUserByEmail($_POST['email']);

            if ($user && $_POST['password'] == $user['password']) {
                // Set session
                $_SESSION['user_id'] = $user['id_user'];
                $_SESSION['role'] = $user['role'];

                // BERHASIL LOGIN -> Arahkan ke Halaman Utama (Beranda)
                header('Location: ' . BASEURL);
                exit;
            } else {
                echo "<script>alert('Login gagal! Email atau password salah.'); window.location.href='" . BASEURL . "/auth/login';</script>";
            }
        }
    }

    // Logout
    public function logout() {
        session_destroy();
        header('Location: ' . BASEURL . '/auth/login');
        exit;
    }

    // Halaman register
    public function register() {
        $data['judul'] = 'Register';
        $this->view('templates/header', $data);
        $this->view('auth/register');
        $this->view('templates/footer');
    }

    // Proses register 
    public function prosesRegister() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $data = [
                'nama' => $_POST['nama'],
                'email' => $_POST['email'],
                'password' => $_POST['password'], 
                'alamat' => $_POST['alamat']
            ];

            $this->model('User_model')->register($data);

            header('Location: ' . BASEURL . '/auth/login');
            exit;
        }
    }
}