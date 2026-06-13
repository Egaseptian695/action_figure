<?php

class Transaction_model {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // =========================
    // 🛒 CART
    // =========================

    public function getCartByUser($id_user) {
        $this->db->query("
            SELECT c.*, p.nama_produk, p.harga, p.gambar 
            FROM carts c
            JOIN products p ON c.id_product = p.id_product
            WHERE c.id_user = :id_user
        ");
        $this->db->bind('id_user', $id_user);
        return $this->db->resultSet();
    }

    public function addToCart($data) {
        $query = "INSERT INTO carts (id_user, id_product, jumlah)
                  VALUES (:user, :product, :jumlah)
                  ON DUPLICATE KEY UPDATE jumlah = jumlah + :jumlah";

        $this->db->query($query);
        $this->db->bind('user', $data['id_user']);
        $this->db->bind('product', $data['id_product']);
        $this->db->bind('jumlah', $data['jumlah']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function deleteCart($id_cart) {
        $this->db->query("DELETE FROM carts WHERE id_cart = :id");
        $this->db->bind('id', $id_cart);
        $this->db->execute();

        return $this->db->rowCount();
    }

    // =========================
    // 🧾 CHECKOUT
    // =========================

    public function checkout($data, $cartItems) {
        try {
            $this->db->beginTransaction();

            // Insert transaksi
            $this->db->query("
                INSERT INTO transactions 
                (id_user, total_harga, tipe_pesanan)
                VALUES (:user, :total, :tipe)
            ");

            $this->db->bind('user', $data['id_user']);
            $this->db->bind('total', $data['total_harga']);
            $this->db->bind('tipe', $data['tipe_pesanan']);
            $this->db->execute();

            $id_transaksi = $this->db->lastInsertId();

            // Insert detail transaksi
            foreach ($cartItems as $item) {
                $this->db->query("
                    INSERT INTO transaction_details 
                    (id_transaksi, id_product, jumlah, subtotal)
                    VALUES (:transaksi, :product, :jumlah, :subtotal)
                ");

                $this->db->bind('transaksi', $id_transaksi);
                $this->db->bind('product', $item['id_product']);
                $this->db->bind('jumlah', $item['jumlah']);
                $this->db->bind('subtotal', $item['jumlah'] * $item['harga']);
                $this->db->execute();
            }

            // Hapus cart setelah checkout
            $this->db->query("DELETE FROM carts WHERE id_user = :user");
            $this->db->bind('user', $data['id_user']);
            $this->db->execute();

            $this->db->commit();
            return $id_transaksi;

        } catch (Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }

    // =========================
    // 💳 PAYMENT
    // =========================

    public function getTransactionById($id) {
        $this->db->query("SELECT * FROM transactions WHERE id_transaksi = :id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function addPayment($data) {
        $query = "INSERT INTO payments 
                  (id_transaksi, metode, jumlah_bayar, status_bayar)
                  VALUES (:id_transaksi, :metode, :jumlah, 'lunas')";

        $this->db->query($query);
        $this->db->bind('id_transaksi', $data['id_transaksi']);
        $this->db->bind('metode', $data['metode']);
        $this->db->bind('jumlah', $data['jumlah_bayar']);
        $this->db->execute();

        // Update status transaksi
        $this->db->query("
            UPDATE transactions 
            SET status_po = 'lunas' 
            WHERE id_transaksi = :id
        ");
        $this->db->bind('id', $data['id_transaksi']);
        $this->db->execute();

        return true;
    }

    public function createPayment($data) {
        $this->db->query("
            INSERT INTO payments (id_transaksi, metode, jumlah_bayar, status_bayar)
            VALUES (:transaksi, :metode, :jumlah, 'lunas')
        ");

        $this->db->bind('transaksi', $data['id_transaksi']);
        $this->db->bind('metode', $data['metode']);
        $this->db->bind('jumlah', $data['jumlah_bayar']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    // =========================
    // 📦 TRANSACTION HISTORY & ADMIN
    // =========================

    public function getTransactionByUser($id_user) {
        // Trik GROUP_CONCAT untuk menggabungkan nama produk dan jumlahnya
        $this->db->query("
            SELECT t.*, 
                   GROUP_CONCAT(CONCAT('• ', p.nama_produk, ' (', td.jumlah, ' pcs)') SEPARATOR '<br>') as detail_produk
            FROM transactions t
            LEFT JOIN transaction_details td ON t.id_transaksi = td.id_transaksi
            LEFT JOIN products p ON td.id_product = p.id_product
            WHERE t.id_user = :id_user
            GROUP BY t.id_transaksi
            ORDER BY t.id_transaksi DESC
        ");
        $this->db->bind('id_user', $id_user);
        return $this->db->resultSet();
    }

    public function getAllTransactions() {
        $this->db->query("
            SELECT t.*, u.nama,
                   GROUP_CONCAT(CONCAT('• ', p.nama_produk, ' (', td.jumlah, ' pcs)') SEPARATOR '<br>') as detail_produk
            FROM transactions t
            JOIN users u ON t.id_user = u.id_user
            LEFT JOIN transaction_details td ON t.id_transaksi = td.id_transaksi
            LEFT JOIN products p ON td.id_product = p.id_product
            GROUP BY t.id_transaksi
            ORDER BY t.id_transaksi DESC
        ");
        return $this->db->resultSet();
    }

    public function updateStatus($id, $status) {
        $this->db->query("
            UPDATE transactions 
            SET status_pesanan = :status 
            WHERE id_transaksi = :id
        ");
        $this->db->bind('status', $status);
        $this->db->bind('id', $id);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function deleteTransaction($id) {
        $this->db->query("DELETE FROM transactions WHERE id_transaksi = :id");
        $this->db->bind('id', $id);
        $this->db->execute();

        return $this->db->rowCount();
    }

    // =========================
    // 📊 ANALYTICS
    // =========================

    public function getTopTerjual() {
        $this->db->query("
            SELECT p.nama_produk, SUM(td.jumlah) as total_terjual 
            FROM transaction_details td 
            JOIN products p ON td.id_product = p.id_product 
            GROUP BY p.id_product, p.nama_produk 
            ORDER BY total_terjual DESC 
            LIMIT 5
        ");
        return $this->db->resultSet();
    }

    public function getTopDiminati() {
        $this->db->query("
            SELECT p.nama_produk, COUNT(w.id_wishlist) as total_wishlist 
            FROM wishlists w 
            JOIN products p ON w.id_product = p.id_product 
            GROUP BY p.id_product, p.nama_produk 
            ORDER BY total_wishlist DESC 
            LIMIT 5
        ");
        return $this->db->resultSet();
    }
    // =========================
    // 📈 GRAFIK PENDAPATAN BULANAN
    // =========================
    public function getGrafikPendapatan() {
        // Mengambil total harga dan mengelompokkannya berdasarkan bulan di tahun saat ini
        $this->db->query("
            SELECT MONTH(tanggal) as bulan, SUM(total_harga) as total
            FROM transactions
            WHERE YEAR(tanggal) = YEAR(CURDATE())
            GROUP BY MONTH(tanggal)
            ORDER BY MONTH(tanggal) ASC
        ");
        return $this->db->resultSet();
    }
}