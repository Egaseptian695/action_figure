<?php /** @var array $data */ ?>

<style>
/* Memakai ulang styling grid hitam-putih dari Home */
.katalog-header {
    text-align: center;
    margin: 40px 0;
}
.katalog-header h1 {
    font-size: 32px;
    text-transform: uppercase;
    border-bottom: 3px solid #111111;
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
</style>

<div class="katalog-header">
    <h1><?= $data['judul'] ?? 'Katalog Produk'; ?></h1>
</div>

<div class="product-container">

<?php if (!empty($data['products'])) : ?>
    <?php foreach ($data['products'] as $product) : ?>

        <div class="card">
            <!-- Posisi tombol wishlist sudah dipindah ke dalam wrapper gambar -->
            <div class="card-img-wrapper">
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