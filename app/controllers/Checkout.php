<?php

class Checkout extends Controller {

    public function index() {
    $data['judul'] = 'Checkout';

    $id_user = $_SESSION['user_id'];

    $data['cart'] = $this->model('Transaction_model')->getCartByUser($id_user);

    $this->view('templates/header', $data);
    $this->view('checkout/index', $data);
    $this->view('templates/footer');
    }

    public function process() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $id_user = $_SESSION['user_id'];

        $cartItems = $this->model('Transaction_model')->getCartByUser($id_user);

        // hitung total
        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item['harga'] * $item['jumlah'];
        }

        $data = [
            'id_user' => $id_user,
            'total_harga' => $total,
            'tipe_pesanan' => 'ready',
            'alamat' => $_POST['alamat']
        ];

        $id_transaksi = $this->model('Transaction_model')->checkout($data, $cartItems);

            if ($id_transaksi) {
            header('Location: ' . BASEURL . '/checkout/payment/' . $id_transaksi);
            exit;
            } else {
            echo "Checkout gagal!";
            }
        }
    }
    public function payment($id_transaksi) {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASEURL . '/auth/login');
            exit;
        }

        $data['judul'] = 'Pembayaran';
        $data['transaksi'] = $this->model('Transaction_model')
                                 ->getTransactionById($id_transaksi);

        $this->view('templates/header', $data);
        $this->view('checkout/payment', $data);
        $this->view('templates/footer');
    }

    public function success() {
        $data['judul'] = 'Pesanan Berhasil';
        $this->view('templates/header', $data);
        $this->view('checkout/success'); // Memanggil file view baru
        $this->view('templates/footer');
    }
    public function pay() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $id_transaksi = $_POST['id_transaksi'];

        // ambil data transaksi dari DB
        $transaksi = $this->model('Transaction_model')->getTransactionById($id_transaksi);

        $data = [
            'id_transaksi' => $id_transaksi,
            'metode' => $_POST['metode'],
            'jumlah_bayar' => $transaksi['total_harga'] // ✅ ambil dari DB
        ];

        $this->model('Transaction_model')->createPayment($data);

        header('Location: ' . BASEURL . '/checkout/success');
        exit;
        }
    }
}