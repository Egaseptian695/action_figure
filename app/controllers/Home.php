<?php

class Home extends Controller {
    public function index() {
        $data['judul'] = 'Home';
        $data['products'] = $this->model('Product_model')->getAllProducts();

        $this->view('templates/header', $data);
        $this->view('home/index', $data);
        $this->view('templates/footer');
    }
    public function faq() {
        $data['judul'] = 'FAQ & Syarat Ketentuan';
        
        $this->view('templates/header', $data);
        $this->view('home/faq');
        $this->view('templates/footer');
    }
    public function cari() {
        $data['judul'] = 'Hasil Pencarian';
        
        // Memanggil fungsi cari dari model
        $data['products'] = $this->model('Product_model')->cariDataProduct();

        // Menggunakan view home/index lagi agar hasilnya tampil di halaman yang sama
        $this->view('templates/header', $data);
        $this->view('home/index', $data);
        $this->view('templates/footer');
    }
}