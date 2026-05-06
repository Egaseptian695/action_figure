<?php
// Memulai session untuk sistem login dan keranjang belanja nanti
session_start();

// Memanggil file konfigurasi dan core class
require_once '../app/config/config.php';
require_once '../app/core/App.php';
require_once '../app/core/Controller.php';
require_once '../app/core/Database.php';

// Menjalankan class App (Router)
$app = new App();