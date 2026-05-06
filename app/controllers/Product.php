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
    $data['products'] = $this->model('Product_model')->getAllProducts();

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