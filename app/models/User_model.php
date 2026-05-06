<?php

class User_model {
    private $table = 'users';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // 🔍 Ambil user berdasarkan email (untuk login)
    public function getUserByEmail($email) {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE email = :email");
        $this->db->bind('email', $email);
        return $this->db->single();
    }

    // 📝 Register user baru
    public function register($data) {
        $query = "INSERT INTO users (nama, email, password, alamat)
                  VALUES (:nama, :email, :password, :alamat)";

        $this->db->query($query);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('password', $data['password']); // nanti bisa di-hash
        $this->db->bind('alamat', $data['alamat']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    // 🔍 Ambil user berdasarkan ID (nanti untuk profile / navbar)
    public function getUserById($id) {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE id_user = :id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    // 📋 Ambil semua user (untuk admin nanti)
    public function getAllUsers() {
        $this->db->query("SELECT * FROM " . $this->table);
        return $this->db->resultSet();
    }
}