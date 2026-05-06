<?php

class Product_model {
    private $table = 'products';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // Ambil semua produk
    public function getAllProducts() {
        $this->db->query("SELECT * FROM " . $this->table . " ORDER BY id_product DESC");
        return $this->db->resultSet();
    }

    // Ambil produk berdasarkan ID
    public function getProductById($id) {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE id_product = :id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    // Tambah produk (Admin)
    public function tambahProduct($data) {
        $query = "INSERT INTO products 
                    (nama_produk, kategori, harga, harga_dp, stok, deskripsi, gambar, status) 
                  VALUES 
                    (:nama, :kategori, :harga, :harga_dp, :stok, :deskripsi, :gambar, :status)";

        $this->db->query($query);
        $this->db->bind('nama', $data['nama_produk']);
        $this->db->bind('kategori', $data['kategori']);
        $this->db->bind('harga', $data['harga']);
        $this->db->bind('harga_dp', $data['harga_dp']);
        $this->db->bind('stok', $data['stok']);
        $this->db->bind('deskripsi', $data['deskripsi']);
        $this->db->bind('gambar', $data['gambar']);
        $this->db->bind('status', $data['status']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    // Update produk
    public function updateProduct($data) {
        $query = "UPDATE products SET
                    nama_produk = :nama,
                    kategori = :kategori,
                    harga = :harga,
                    harga_dp = :harga_dp,
                    stok = :stok,
                    deskripsi = :deskripsi,
                    gambar = :gambar,
                    status = :status
                  WHERE id_product = :id";

        $this->db->query($query);
        $this->db->bind('nama', $data['nama_produk']);
        $this->db->bind('kategori', $data['kategori']);
        $this->db->bind('harga', $data['harga']);
        $this->db->bind('harga_dp', $data['harga_dp']);
        $this->db->bind('stok', $data['stok']);
        $this->db->bind('deskripsi', $data['deskripsi']);
        $this->db->bind('gambar', $data['gambar']);
        $this->db->bind('status', $data['status']);
        $this->db->bind('id', $data['id_product']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    // Hapus produk
    public function deleteProduct($id) {
        $this->db->query("DELETE FROM products WHERE id_product = :id");
        $this->db->bind('id', $id);
        $this->db->execute();

        return $this->db->rowCount();
    }
    public function getProductByKategori($kategori) {
    $this->db->query("SELECT * FROM products WHERE kategori = :kategori");
    $this->db->bind('kategori', $kategori);
    return $this->db->resultSet();
    }
    // Ambil wishlist user
public function getWishlist($id_user) {
    $this->db->query("
        SELECT w.*, p.nama_produk, p.harga, p.gambar
        FROM wishlists w
        JOIN products p ON w.id_product = p.id_product
        WHERE w.id_user = :id_user
    ");
    $this->db->bind('id_user', $id_user);
    return $this->db->resultSet();
}

// Tambah wishlist
public function addWishlist($data) {
    $this->db->query("
        INSERT INTO wishlists (id_user, id_product)
        VALUES (:user, :product)
    ");
    $this->db->bind('user', $data['id_user']);
    $this->db->bind('product', $data['id_product']);
    $this->db->execute();
}

// Hapus wishlist
public function deleteWishlist($id) {
    $this->db->query("DELETE FROM wishlists WHERE id_wishlist = :id");
    $this->db->bind('id', $id);
    $this->db->execute();
}
public function toggleWishlist($id_user, $id_product) {

    // cek sudah ada atau belum
    $this->db->query("
        SELECT * FROM wishlists 
        WHERE id_user = :user AND id_product = :product
    ");
    $this->db->bind('user', $id_user);
    $this->db->bind('product', $id_product);

    $exist = $this->db->single();

    if ($exist) {
        // hapus
        $this->db->query("
            DELETE FROM wishlists 
            WHERE id_user = :user AND id_product = :product
        ");
        $this->db->bind('user', $id_user);
        $this->db->bind('product', $id_product);
        $this->db->execute();

        return ['status' => 'removed'];
    } else {
        // tambah
        $this->db->query("
            INSERT INTO wishlists (id_user, id_product)
            VALUES (:user, :product)
        ");
        $this->db->bind('user', $id_user);
        $this->db->bind('product', $id_product);
        $this->db->execute();

        return ['status' => 'added'];
    }
}
}