<?php /** @var array $data */ ?>

<style>
/* Styling Dasar Halaman Wishlist B/W Retro */
.wishlist-container {
    max-width: 1200px;
    margin: 50px auto;
    padding: 0 20px;
}

.wishlist-header {
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

.wishlist-header h1 {
    font-size: 32px;
    text-transform: uppercase;
    display: inline-block;
    padding-bottom: 10px;
}

/* Grid layout sama persis seperti katalog produk & home */
.product-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 25px;
}

/* Card Styling */
.card {
    background: #ffffff;
    border: 2px solid #111111;
    overflow: hidden;
    transition: 0.3s ease;
    position: relative;
    display: flex;
    flex-direction: column;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 6px 6px 0px #111111;
}

.card-img-wrapper {
    position: relative;
    border-bottom: 2px solid #111111;
    background: #f9f9f9;
}

.card img {
    width: 100%;
    height: 240px;
    object-fit: cover;
    display: block;
}

/* Tombol Hapus di Kanan Atas (Gaya Silang) */
.btn-remove-wishlist {
    position: absolute;
    top: 10px;
    right: 10px;
    background: #ffffff;
    color: #111111;
    border: 2px solid #111111;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    width: 35px;
    height: 35px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: 0.2s;
    text-decoration: none;
    box-shadow: 2px 2px 0px #111111;
}

.btn-remove-wishlist:hover {
    background: #111111;
    color: #ffffff;
    transform: scale(1.1);
}

.card-body {
    padding: 15px;
    text-align: center;
    display: flex;
    flex-direction: column;
    flex-grow: 1;
    justify-content: space-between;
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

/* Tombol Detail */
.btn-detail {
    display: block;
    padding: 10px;
    background: #ffffff;
    color: #111111;
    border: 2px solid #111111;
    text-decoration: none;
    font-size: 14px;
    font-weight: bold;
    text-transform: uppercase;
    transition: 0.3s;
    width: 100%;
}

.btn-detail:hover {
    background: #111111;
    color: #ffffff;
}

/* State Jika Wishlist Kosong */
.empty-state {
    grid-column: 1 / -1;
    text-align: center;
    padding: 80px 20px;
    border: 2px dashed #111111;
    background: #f9f9f9;
}

.empty-state p {
    font-size: 18px;
    font-weight: bold;
    text-transform: uppercase;
    margin-bottom: 20px;
}

.btn-back-home {
    display: inline-block;
    padding: 12px 25px;
    background: #111111;
    color: #ffffff;
    border: 2px solid #111111;
    text-decoration: none;
    font-size: 14px;
    font-weight: bold;
    text-transform: uppercase;
    transition: 0.3s;
}

.btn-back-home:hover {
    background: #ffffff;
    color: #111111;
}
</style>

<div class="wishlist-container">
    <div class="wishlist-header">
        <h1><i class="fa-solid fa-heart" style="color: rgb(28, 37, 53);"></i> Wishlist Saya</h1>
    </div>

    <div class="product-container">
        <?php if (!empty($data['wishlist'])) : ?>
            <?php foreach ($data['wishlist'] as $item_amega) : ?>
                
                <div class="card">
                    <div class="card-img-wrapper">
                        <img src="<?= BASEURL; ?>/img/products/<?= $item_amega['gambar']; ?>" alt="<?= $item_amega['nama_produk']; ?>">
                        
                        <!-- Tombol hapus sekarang mengambang estetik di atas gambar -->
                        <a href="<?= BASEURL; ?>/wishlist/delete/<?= $item_amega['id_wishlist']; ?>" 
                           class="btn-remove-wishlist" 
                           onclick="return confirm('Hapus produk ini dari wishlist?')"
                           title="Hapus dari Wishlist">
                           ✕
                        </a>
                    </div>

                    <div class="card-body">
                        <div>
                            <h3><?= $item_amega['nama_produk']; ?></h3>
                            <p class="price">Rp <?= number_format($item_amega['harga'], 0, ',', '.'); ?></p>
                        </div>

                        <a href="<?= BASEURL; ?>/product/detail/<?= $item_amega['id_product']; ?>" class="btn-detail">
                            Lihat Detail
                        </a>
                    </div>
                </div>

            <?php endforeach; ?>
        <?php else : ?>
            <div class="empty-state">
                <p>Wishlist kamu masih kosong.</p>
                <a href="<?= BASEURL; ?>/product" class="btn-back-home">Cari Barang Incaranmu</a>
            </div>
        <?php endif; ?>
    </div>
</div>