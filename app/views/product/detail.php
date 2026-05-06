<?php /** @var array $data */ ?>

<style>
/* Layout Detail Produk B/W Retro */
.detail-container {
    display: flex;
    flex-wrap: wrap;
    gap: 40px;
    max-width: 1000px;
    margin: 50px auto;
    padding: 0 20px;
}

.detail-img {
    flex: 1;
    min-width: 300px;
    border: 2px solid #111111;
    box-shadow: 8px 8px 0px #111111;
    background: #ffffff;
    padding: 10px;
}

.detail-img img {
    width: 100%;
    height: auto;
    display: block;
    border: 1px solid #111111;
}

.detail-info {
    flex: 1;
    min-width: 300px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.detail-info h1 {
    font-size: 32px;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 10px;
    border-bottom: 2px solid #111111;
    padding-bottom: 15px;
}

.detail-price {
    font-size: 28px;
    font-weight: bold;
    color: #111111;
    margin-bottom: 20px;
}

.detail-desc {
    font-size: 16px;
    line-height: 1.8;
    color: #333333;
    margin-bottom: 30px;
    background: #f9f9f9;
    padding: 15px;
    border: 1px solid #111111;
}

/* Form & Tombol Aksi */
.action-form {
    display: flex;
    gap: 15px;
    align-items: center;
    margin-bottom: 15px;
}

.action-form label {
    font-weight: bold;
    text-transform: uppercase;
    font-size: 14px;
}

.input-qty {
    width: 80px;
    padding: 12px;
    border: 2px solid #111111;
    font-size: 16px;
    text-align: center;
    outline: none;
    font-weight: bold;
}

.btn-cart {
    flex: 1;
    padding: 14px 20px;
    background: #111111;
    color: #ffffff;
    border: 2px solid #111111;
    font-size: 16px;
    font-weight: bold;
    text-transform: uppercase;
    cursor: pointer;
    transition: 0.3s;
}

.btn-cart:hover {
    background: #ffffff;
    color: #111111;
}

.btn-wishlist-large {
    padding: 12px 20px;
    background: #ffffff;
    color: #111111;
    border: 2px solid #111111;
    font-size: 20px;
    cursor: pointer;
    transition: 0.3s;
    display: flex;
    align-items: center;
    justify-content: center;
}

.btn-wishlist-large:hover {
    background: #111111;
    color: #ffffff;
}
</style>

<?php if ($data['product']) : ?>
    <div class="detail-container">
        
        <!-- Bagian Gambar -->
        <div class="detail-img">
            <img src="<?= BASEURL; ?>/img/products/<?= $data['product']['gambar']; ?>" alt="<?= $data['product']['nama_produk']; ?>">
        </div>

        <!-- Bagian Informasi -->
        <div class="detail-info">
            <h1><?= $data['product']['nama_produk']; ?></h1>
            <p class="detail-price">Rp <?= number_format($data['product']['harga'], 0, ',', '.'); ?></p>
            
            <div class="detail-desc">
                <?= nl2br($data['product']['deskripsi']); ?>
            </div>

            <!-- Form Tambah ke Keranjang -->
            <form action="<?= BASEURL; ?>/cart/add" method="POST" class="action-form">
                <input type="hidden" name="id_product" value="<?= $data['product']['id_product']; ?>">
                
                <label>Qty:</label>
                <input type="number" name="jumlah" value="1" min="1" class="input-qty">
                
                <button type="submit" class="btn-cart">Tambah ke Keranjang</button>
            </form>

            <!-- Form Tambah ke Wishlist -->

            <div class="action-form">
            <button type="button" class="btn-wishlist btn-wishlist-large" data-id="<?= $data['product']['id_product']; ?>" title="Tambah ke Wishlist">
            🤍 Simpan ke Wishlist
            </button>
        </div>

    </div>
<?php else : ?>
    <div style="text-align: center; padding: 100px 20px;">
        <h1 style="text-transform: uppercase; border-bottom: 2px solid #111; display: inline-block;">Produk tidak ditemukan</h1>
    </div>
<?php endif; ?>