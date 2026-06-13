<?php

class Admin extends Controller {

    public function __construct() {
        // cek login & role admin
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
            header('Location: ' . BASEURL . '/auth/login');
            exit;
        }
    }

    public function index() {
        $data['judul'] = 'Dashboard Admin';

        // Ambil data statistik (Kode Aslimu)
        $data['total_produk'] = count($this->model('Product_model')->getAllProducts());
        $data['total_transaksi'] = count($this->model('Transaction_model')->getAllTransactions());
        $data['top_terjual'] = $this->model('Transaction_model')->getTopTerjual();
        $data['top_diminati'] = $this->model('Transaction_model')->getTopDiminati();

        // Total pendapatan keseluruhan (Kode Aslimu)
        $transactions = $this->model('Transaction_model')->getAllTransactions();
        $total = 0;
        foreach ($transactions as $t) {
            $total += $t['total_harga'];
        }
        $data['total_pendapatan'] = $total;

        // ==========================================
        // TAMBAHAN BARU: PENGOLAHAN DATA GRAFIK
        // ==========================================
        // 1. Ambil data mentah dari database
        $grafik_db = $this->model('Transaction_model')->getGrafikPendapatan();
        
        // 2. Siapkan array kosong untuk 12 bulan (Januari - Desember) dengan nilai awal 0
        $grafik_data = array_fill(1, 12, 0);
        
        // 3. Timpa angka 0 dengan total pendapatan asli jika di bulan tersebut ada transaksi
        foreach($grafik_db as $g) {
            $grafik_data[$g['bulan']] = $g['total'];
        }
        
        // 4. Ubah array menjadi format JSON agar mudah dibaca oleh JavaScript Chart.js
        $data['grafik_json'] = json_encode(array_values($grafik_data));
        // ==========================================

        // Tampilkan ke halaman View
        $this->view('templates/header', $data);
        $this->view('admin/dashboard', $data);
        $this->view('templates/footer');
    }
    // Kelola pesanan
    public function orders() {
        $data['judul'] = 'Kelola Pesanan';
        $data['orders'] = $this->model('Transaction_model')->getAllTransactions();

        $this->view('templates/header', $data);
        $this->view('admin/orders', $data);
        $this->view('templates/footer');
    }

    // Update status
    public function updateStatus() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->model('Transaction_model')->updateStatus(
                $_POST['id_transaksi'],
                $_POST['status']
            );

            header('Location: ' . BASEURL . '/admin/orders');
            exit;
        }
    }
    // =========================
// 📦 CRUD PRODUK
// =========================

// Tampilkan semua produk
public function products() {
    $data['judul'] = 'Kelola Produk';
    $data['products'] = $this->model('Product_model')->getAllProducts();

    $this->view('templates/header', $data);
    $this->view('admin/products', $data);
    $this->view('templates/footer');
}

// Form tambah produk
public function addProduct() {
    $data['judul'] = 'Tambah Produk';

    $this->view('templates/header', $data);
    $this->view('admin/add_product');
    $this->view('templates/footer');
}

public function storeProduct() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // ======================
        // UPLOAD GAMBAR
        // ======================
        $namaFile = $_FILES['gambar']['name'];
        $tmpName = $_FILES['gambar']['tmp_name'];

        // buat nama unik
        $namaBaru = time() . '_' . $namaFile;

        // folder tujuan
        $target = '../public/img/products/' . $namaBaru;

        move_uploaded_file($tmpName, $target);

        // ======================
        // SIMPAN KE DB
        // ======================
        $data = $_POST;
        $data['gambar'] = $namaBaru;

        $this->model('Product_model')->tambahProduct($data);

        header('Location: ' . BASEURL . '/admin/products');
        exit;
    }
}

// Form edit produk
public function editProduct($id) {
    $data['judul'] = 'Edit Produk';
    $data['product'] = $this->model('Product_model')->getProductById($id);

    $this->view('templates/header', $data);
    $this->view('admin/edit_product', $data);
    $this->view('templates/footer');
}

// Proses update produk
public function updateProduct() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Cek apakah upload gambar baru
            if ($_FILES['gambar']['name'] != '') {

                $namaFile = $_FILES['gambar']['name'];
                $tmpName = $_FILES['gambar']['tmp_name'];

                $namaBaru = time() . '_' . $namaFile;
                $target = '../public/img/products/' . $namaBaru;

                move_uploaded_file($tmpName, $target);

                // Masukkan nama file baru ke dalam array $_POST
                $_POST['gambar'] = $namaBaru; 
            } else {
                // TAMBAHAN: Jika TIDAK ADA gambar baru yang diupload,
                // tangkap nama gambar lama dari input tersembunyi di form
                $_POST['gambar'] = $_POST['gambarLama'];
            }

            // Kirim semua data (termasuk variabel 'gambar' yang sudah dipastikan aman) ke model
            $this->model('Product_model')->updateProduct($_POST);

            header('Location: ' . BASEURL . '/admin/products');
            exit;
        }
    }

// Hapus produk
public function deleteProduct($id) {
    $this->model('Product_model')->deleteProduct($id);

    header('Location: ' . BASEURL . '/admin/products');
    exit;
}
public function delete($id) {
    $this->model('Transaction_model')->deleteTransaction($id);

    header('Location: ' . BASEURL . '/admin');
    exit;
}
}