<?php

class Transaction_model {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // =========================
    // 🛒 CART
    // =========================

    // Ambil cart berdasarkan user
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

    // Tambah ke cart
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

    // Hapus item cart
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

            // Insert transaksi (TANPA alamat_pengiriman karena tidak ada di DB)
            $this->db->query("
                INSERT INTO transactions 
                (id_user, total_harga, tipe_pesanan)
                VALUES (:user, :total, :tipe)
            ");

            $this->db->bind('user', $data['id_user']);
            $this->db->bind('total', $data['total_harga']);
            $this->db->bind('tipe', $data['tipe_pesanan']);
            $this->db->execute();

            // Ambil ID transaksi
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

    // Ambil transaksi berdasarkan ID
    public function getTransactionById($id) {
    $this->db->query("SELECT * FROM transactions WHERE id_transaksi = :id");
    $this->db->bind('id', $id);
    return $this->db->single();
    }
    // Simpan pembayaran
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

    // =========================
    // 📦 TRANSACTION HISTORY
    // =========================

    public function getTransactionByUser($id_user) {
        $this->db->query("
            SELECT * FROM transactions 
            WHERE id_user = :id_user
            ORDER BY id_transaksi DESC
        ");
        $this->db->bind('id_user', $id_user);
        return $this->db->resultSet();
    }
    // Ambil semua transaksi (admin)
public function getAllTransactions() {
    $this->db->query("
        SELECT t.*, u.nama 
        FROM transactions t
        JOIN users u ON t.id_user = u.id_user
        ORDER BY t.id_transaksi DESC
    ");
    return $this->db->resultSet();
}

// Update status pesanan
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
public function deleteTransaction($id) {
    $this->db->query("DELETE FROM transactions WHERE id_transaksi = :id");
    $this->db->bind('id', $id);
    $this->db->execute();

    return $this->db->rowCount();
}
}