<?php

class Wishlist extends Controller {

    // Tampilkan wishlist
    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASEURL . '/auth/login');
            exit;
        }

        $data['judul'] = 'Wishlist';
        $data['wishlist'] = $this->model('Product_model')->getWishlist($_SESSION['user_id']);

        $this->view('templates/header', $data);
        $this->view('product/wishlist', $data);
        $this->view('templates/footer');
    }

    // Tambah ke wishlist
    public function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $data = [
                'id_user' => $_SESSION['user_id'],
                'id_product' => $_POST['id_product']
            ];

            header('Location: ' . BASEURL . '/wishlist');
            exit;
        }
    }

    // Hapus dari wishlist
    public function delete($id) {
        $this->model('Product_model')->deleteWishlist($id);

        header('Location: ' . BASEURL . '/wishlist');
        exit;
    }
    public function toggle() {
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['status' => 'not_login']);
        exit;
    }

    $result = $this->model('Product_model')
                   ->toggleWishlist($_SESSION['user_id'], $_POST['id_product']);

    echo json_encode($result);
}

}