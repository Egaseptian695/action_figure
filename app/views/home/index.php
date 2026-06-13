<?php /** @var array $data */ ?>
<style>
/* Reset dasar untuk memastikan layout rapi */
* { box-sizing: border-box; }

/* 1. HERO BANNER BARU */
.hero-banner {
    background: rgba(17, 17, 17, 0.35); 
    
    /* Menambahkan efek blur halus di belakang kotak hitamnya */
    backdrop-filter: blur(4px); 
    
    color: #fff;
    padding: 100px 20px; 
    text-align: center;
    margin-bottom: 50px;
}

.hero-banner h1 {
    font-size: 48px;
    font-weight: 900;
    text-transform: uppercase;
    letter-spacing: 2px;
    margin-bottom: 15px;
}

.hero-banner p {
    font-size: 18px;
    color: #ccc;
    margin-bottom: 30px;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.btn-hero {
    display: inline-block;
    background: #fff;
    color: #111;
    padding: 15px 30px;
    font-size: 16px;
    font-weight: bold;
    text-transform: uppercase;
    text-decoration: none;
    border: 2px solid #fff;
    transition: 0.3s;
}

.btn-hero:hover {
    background: transparent;
    color: #fff;
}

/* 2. QUICK CATEGORIES */
.category-section {
    max-width: 1200px;
    margin: 0 auto 50px auto;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
}

.category-card {
    border: 2px solid #111;
    padding: 30px 20px;
    text-align: center;
    text-decoration: none;
    color: #111;
    background: #fff;
    box-shadow: 6px 6px 0px #111;
    transition: 0.2s;
}

.category-card:hover {
    transform: translate(-5px, -5px);
    box-shadow: 11px 11px 0px #111;
    background: #111;
    color: #fff;
}

.category-card h3 {
    font-size: 24px;
    text-transform: uppercase;
    margin: 0;
}

/* 3. TRUST BADGES */
.trust-section {
    background: rgba(17, 17, 17, 0.65); /* Saya buat sedikit lebih gelap agar teks lebih terbaca */
    backdrop-filter: blur(6px);
    color: #fff;
    
    /* Ubah border atas-bawah jadi border keliling */
    border: 3px solid #111111; 
    
    padding: 40px 20px;
    
    /* Posisikan di tengah dan samakan lebarnya dengan daftar produk */
    margin: 60px auto 0 auto; 
    max-width: 1200px; 
    
    /* Tambahkan bayangan tegas khas Brutalist */
    box-shadow: 8px 8px 0px #111111; 
}

.trust-grid {
    max-width: 1200px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
    text-align: center;
}

.trust-item h4 {
    font-size: 18px;
    text-transform: uppercase;
    margin-bottom: 10px;
    color: #fff;
}

.trust-item p {
    font-size: 14px;
    color: #ccc;
}

/* =========================================
   STYLE EKSISTING MILIKMU (DIPERTAHANKAN)
========================================= */
.section-title {
    margin: 0 0 30px 0;
    font-size: 24px;
    background: #ffffff; /* Latar putih solid agar teks tidak tabrakan dengan gambar */
    border: 2px solid #111111;
    display: inline-block;
    padding: 10px 25px;
    text-transform: uppercase;
    font-weight: bold;
    box-shadow: 4px 4px 0px #111111; /* Efek shadow khas Brutalist */
}

.product-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 25px;
    color: #fff;
}

.card {
    background: #fff;
    border: 1px solid #111;
    overflow: hidden;
    transition: 0.3s ease;
    position: relative; 
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 6px 6px 0px #111; 
}

.card-img-wrapper {
    position: relative;
    border-bottom: 1px solid #111;
    background: #f9f9f9;
}

.card img {
    width: 100%;
    height: 240px;
    object-fit: cover;
    display: block;
}

.btn-wishlist {
    position: absolute;
    top: 10px;
    right: 10px;
    background: #fff;
    border: 1px solid #111;
    font-size: 16px;
    cursor: pointer;
    width: 35px;
    height: 35px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: 0.2s;
    box-shadow: 2px 2px 0px #111;
}

.btn-wishlist:hover {
    background: #111;
    color: #fff;
    transform: scale(1.1);
}

.card-body {
    padding: 15px;
    text-align: center;
}

.card h3 {
    font-size: 16px;
    margin-bottom: 10px;
    color: #111;
}

.price {
    color: #111;
    font-weight: bold;
    font-size: 18px;
    margin-bottom: 15px;
}

.btn-detail {
    display: block;
    padding: 10px;
    background: #fff;
    color: #111;
    border: 1px solid #111;
    text-decoration: none;
    font-size: 14px;
    font-weight: bold;
    text-transform: uppercase;
    transition: 0.3s;
}

.btn-detail:hover {
    background: #111;
    color: #fff;
}
/* --- LABEL STOK DI POJOK GAMBAR --- */
.badge-stock {
    position: absolute;
    top: 10px;
    left: 10px;
    padding: 5px 10px;
    font-size: 12px;
    font-weight: 900;
    text-transform: uppercase;
    border: 2px solid #111111;
    box-shadow: 3px 3px 0px #111111; /* Bayangan Brutalist */
    z-index: 2; /* Agar labelnya muncul di atas gambar */
}

/* Warna khusus agar gampang dibedakan pelanggan */
.stock-ready {
    background-color: #00d2ff; /* Biru Cyan Elektrik */
    color: #111111;
}

.stock-po {
    background-color: #ff007f; /* Hot Pink / Magenta */
    color: #ffffff;
}
</style>

<?php 
// 1. Kita buat alat pendeteksi pencarian.
// Biasanya input pencarian menggunakan atribut name="keyword" atau name="search" (baik via GET maupun POST)
$sedang_mencari = isset($_GET['keyword']) || isset($_POST['keyword']) || isset($_GET['search']) || isset($_POST['search']);

// 2. Jika TIDAK sedang mencari (!), barulah banner dan kategori ditampilkan
if (!$sedang_mencari) : 
?>

    <div class="hero-banner">
        <h1>Elevate Your Collection</h1>
        <p>Temukan ratusan action figure eksklusif dan rare item dari seri Anime, Game, dan Tokusatsu favoritmu.</p>
        
        <a href="<?= BASEURL; ?>/product" class="btn-hero" style="margin-bottom: 30px;">Lihat Semua Katalog</a>
    </div>

    <div class="category-section">
        <a href="<?= BASEURL; ?>/product/kategori/Anime" class="category-card">
            <h3>✦ Anime Figures</h3>
        </a>
        <a href="<?= BASEURL; ?>/product/kategori/Game" class="category-card">
            <h3>✦ Game Characters</h3>
        </a>
        <a href="<?= BASEURL; ?>/product/kategori/Mecha" class="category-card">
            <h3>✦ Mecha & Model Kit</h3>
        </a>
    </div>

<?php endif; ?>

<!-- BAGIAN 3: KOLEKSI TERBARU (KODE ASLI KAMU) -->
<!-- Saya tambahkan wrapper max-width agar sejajar rapi dengan kategori di atasnya -->
<div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
    <!-- SEARCH BAR B/W RETRO -->
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">

    <h1 class="section-title">Koleksi Terbaru</h1>

    <div class="product-container">
    <?php if (!empty($data['products'])) : ?>
        <?php foreach ($data['products'] as $product) : ?>

            <div class="card">
                <div class="card-img-wrapper">
                    <?php 
                        // PENTING: Ganti 'status_barang' dengan NAMA KOLOM yang benar di database-mu
                        // (misalnya 'status', 'tipe_stok', 'ketersediaan', dll)
                        $status_stok = isset($product['status']) ? strtolower($product['status']) : 'ready';
                        
                        // Jika kata di database mengandung unsur "pre", "po", atau "pre order"
                        if (strpos($status_stok, 'pre') !== false || $status_stok == 'po') {
                            echo '<span class="badge-stock stock-po">Pre Order</span>';
                        } else {
                            echo '<span class="badge-stock stock-ready">Ready Stock</span>';
                        }
                    ?>
                    <img src="<?= BASEURL; ?>/img/products/<?= $product['gambar']; ?>" alt="<?= $product['nama_produk']; ?>">
                    <button class="btn-wishlist" data-id="<?= $product['id_product']; ?>" title="Tambah ke Wishlist">🤍</button>
                </div>

                <div class="card-body">
                    <h3><?= $product['nama_produk']; ?></h3>

                    <p class="price">
                        Rp <?= number_format($product['harga'], 0, ',', '.'); ?>
                    </p>

                    <a href="<?= BASEURL; ?>/product/detail/<?= $product['id_product']; ?>" class="btn-detail">
                        Lihat Detail
                    </a>
                </div>
            </div>

        <?php endforeach; ?>
    <?php else : ?>
        <div style="grid-column: 1 / -1; text-align: center; padding: 50px; border: 1px dashed #fff;">
            <p>Produk belum tersedia untuk saat ini.</p>
        </div>
    <?php endif; ?>
    </div>
</div>

<!-- BAGIAN 4: TRUST SECTION (INFO TOKO) -->
<div class="trust-section">
    <div class="trust-grid">
        <div class="trust-item">
            <h4>✔️ 100% Original Authentic</h4>
            <p>Semua figure dijamin keasliannya. Langsung dari distributor resmi Jepang.</p>
        </div>
        <div class="trust-item">
            <h4>📦 Packing Super Aman</h4>
            <p>Box figure dilindungi dengan bubble wrap tebal dan kardus pelindung anti-penyok.</p>
        </div>
        <div class="trust-item">
            <h4>⚡ Pengiriman Cepat</h4>
            <p>Pesanan ready stock akan langsung diproses dan dikirim di hari yang sama.</p>
        </div>
    </div>
</div>