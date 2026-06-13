<?php /** @var array $data */ ?>

<style>
/* Memakai ulang styling grid hitam-putih dari Home */
.katalog-header {
    color: #111111; 
    background: #ffffff; 
    border: 3px solid #111111;
    padding: 10px 30px; 
    text-transform: uppercase;
    font-weight: bold;
    box-shadow: 6px 6px 0px #111111; 
    
    width: fit-content;
    margin: 0 auto 40px auto; 
    text-align: center;
    
    text-decoration: none;
}
.katalog-header h1 {
    font-size: 32px;
    text-transform: uppercase;
    display: inline-block;
    padding-bottom: 10px;
}
.product-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 25px;
    padding: 0 20px 60px 20px;
    max-width: 1200px;
    margin: 0 auto;
}
.card {
    background: #ffffff;
    border: 1px solid #111111;
    overflow: hidden;
    transition: 0.3s ease;
    position: relative;
}
.card:hover {
    transform: translateY(-5px);
    box-shadow: 6px 6px 0px #111111;
}
.card-img-wrapper {
    position: relative;
    border-bottom: 1px solid #111111;
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
    background: #ffffff;
    border: 1px solid #111111;
    font-size: 16px;
    cursor: pointer;
    width: 35px;
    height: 35px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: 0.2s;
    box-shadow: 2px 2px 0px #111111;
}
.btn-wishlist:hover {
    background: #111111;
    color: #ffffff;
    transform: scale(1.1);
}
.card-body {
    padding: 15px;
    text-align: center;
}
.card h3 {
    font-size: 16px;
    margin-bottom: 10px;
    color: #111111;
}
.price {
    color: #111111;
    font-weight: bold;
    font-size: 18px;
    margin-bottom: 15px;
}
.btn-detail {
    display: block;
    padding: 10px;
    background: #ffffff;
    color: #111111;
    border: 1px solid #111111;
    text-decoration: none;
    font-size: 14px;
    font-weight: bold;
    text-transform: uppercase;
    transition: 0.3s;
}
.btn-detail:hover {
    background: #111111;
    color: #ffffff;
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

<div class="katalog-header">
    <h1><?= $data['judul'] ?? 'Katalog Produk'; ?></h1>
</div>
<div style="display: flex; justify-content: flex-end; margin-bottom: 30px; max-width: 1200px; margin-left: auto; margin-right: auto; padding: 0 20px;">
    
    <form action="<?= BASEURL; ?>/product" method="GET" style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
        <label for="sort" style="font-weight: 900; text-transform: uppercase; color: #111111; background: #ffffff; padding: 8px 15px; border: 3px solid #111111; box-shadow: 4px 4px 0px #111111;">Urutkan:</label>
        
        <select name="sort" id="sort" onchange="this.form.submit()" 
                style="padding: 10px 15px; border: 3px solid #111111; font-size: 14px; font-weight: bold; text-transform: uppercase; outline: none; cursor: pointer; box-shadow: 4px 4px 0px #111111; background: #ffffff; color: #111111; transition: 0.2s;">
            
            <option value="terbaru" <?= (($data['sort_aktif'] ?? 'terbaru') == 'terbaru') ? 'selected' : ''; ?>>
        ✨ Terbaru
    </option>
    <option value="termurah" <?= (($data['sort_aktif'] ?? 'terbaru') == 'termurah') ? 'selected' : ''; ?>>
        💸 Harga: Rendah ke Tinggi
    </option>
    <option value="termahal" <?= (($data['sort_aktif'] ?? 'terbaru') == 'termahal') ? 'selected' : ''; ?>>
        💎 Harga: Tinggi ke Rendah
    </option>
            
        </select>
    </form>
</div>
<?php if (isset($data['total_halaman']) && $data['total_halaman'] > 1) : ?>
    <div style="display: flex; justify-content: center; gap: 10px; margin-top: 50px; margin-bottom: 20px; flex-wrap: wrap;">
        
        <?php for ($i = 1; $i <= $data['total_halaman']; $i++) : ?>
            
            <a href="<?= BASEURL; ?>/product?sort=<?= $data['sort_aktif']; ?>&page=<?= $i; ?>" 
               style="padding: 10px 20px; font-size: 16px; font-weight: 900; text-decoration: none; border: 3px solid #111111; box-shadow: 4px 4px 0px #111111; transition: 0.2s;
                      background: <?= ($data['halaman_aktif'] == $i) ? '#111111' : '#ffffff'; ?>;
                      color: <?= ($data['halaman_aktif'] == $i) ? '#ffffff' : '#111111'; ?>;">
                <?= $i; ?>
            </a>
            
        <?php endfor; ?>
        
    </div>
<?php endif; ?>
<div class="product-container">

<?php if (!empty($data['products'])) : ?>
    <?php foreach ($data['products'] as $product) : ?>

        <div class="card">
            <!-- Posisi tombol wishlist sudah dipindah ke dalam wrapper gambar -->
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
                
                <!-- Jika ingin tombol ini memproses input, ubah menjadi form seperti di halaman detail -->
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
    <div style="grid-column: 1 / -1; text-align: center; padding: 50px; border: 1px dashed #111;">
        <p>Produk tidak ditemukan</p>
    </div>
<?php endif; ?>

</div>