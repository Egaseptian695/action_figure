<?php

class Product extends Controller {

    public function detail($id) {
        $data['judul'] = 'Detail Produk';
        $data['product'] = $this->model('Product_model')->getProductById($id);

        $this->view('templates/header', $data);
        $this->view('product/detail', $data);
        $this->view('templates/footer');
    }
    // =========================
// 📦 KATALOG PRODUK
// =========================
public function index() {
        $data['judul'] = 'Katalog Produk';
        
        // Cek urutan
        $sort = isset($_GET['sort']) ? $_GET['sort'] : 'terbaru';
        $data['sort_aktif'] = $sort;
        
        // ==========================================
        // PENGATURAN PAGINATION
        // ==========================================
        $limit = 8; // Jumlah maksimal produk yang tampil per halaman
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Cek sedang di halaman berapa
        $offset = ($page - 1) * $limit; // Rumus titik mulai produk
        
        // Hitung total halaman
        $total_produk = $this->model('Product_model')->getTotalProducts();
        $data['total_halaman'] = ceil($total_produk / $limit); // ceil = bulatkan ke atas
        $data['halaman_aktif'] = $page;
        // ==========================================

        // Ambil data produk dengan batasan limit & offset
        $data['products'] = $this->model('Product_model')->getAllProducts($sort, $limit, $offset);

        $this->view('templates/header', $data);
        $this->view('product/index', $data);
        $this->view('templates/footer');
    }

// =========================
// 📂 FILTER KATEGORI
// =========================
public function kategori($kategori) {
    $data['judul'] = 'Kategori: ' . $kategori;
    $data['products'] = $this->model('Product_model')->getProductByKategori($kategori);

    $this->view('templates/header', $data);
    $this->view('product/index', $data);
    $this->view('templates/footer');
}
}