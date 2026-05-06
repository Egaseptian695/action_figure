<?php

class Cart extends Controller {

    // Tampilkan cart
    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASEURL . '/auth/login');
            exit;
        }

        $data['judul'] = 'Keranjang Belanja';
        $data['cart'] = $this->model('Transaction_model')
                             ->getCartByUser($_SESSION['user_id']);

        $this->view('templates/header', $data);
        $this->view('cart/index', $data);
        $this->view('templates/footer');
    }

    // Tambah ke cart
    public function add() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASEURL . '/auth/login');
            exit;
        }

        $data = [
            'id_user' => $_SESSION['user_id'], // 🔥 WAJIB
            'id_product' => $_POST['id_product'],
            'jumlah' => $_POST['jumlah']
        ];

        $this->model('Transaction_model')->addToCart($data);

        header('Location: ' . BASEURL . '/cart');
        exit;
    }

    // Hapus item
    public function delete($id) {
        $this->model('Transaction_model')->deleteCart($id);

        header('Location: ' . BASEURL . '/cart');
        exit;
    }
}