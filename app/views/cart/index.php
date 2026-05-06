<?php /** @var array $data */ ?>

<style>
/* Styling Keranjang Belanja B/W Retro */
.cart-container {
    max-width: 1000px;
    margin: 50px auto;
    padding: 0 20px;
}

.cart-header {
    text-align: center;
    margin-bottom: 40px;
}

.cart-header h1 {
    font-size: 32px;
    text-transform: uppercase;
    border-bottom: 3px solid #111111;
    display: inline-block;
    padding-bottom: 10px;
}

/* Tabel Keranjang */
.cart-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 30px;
    border: 2px solid #111111;
    box-shadow: 8px 8px 0px #111111;
    background: #ffffff;
}

.cart-table th, .cart-table td {
    padding: 15px;
    border: 1px solid #111111;
    text-align: center;
}

.cart-table th {
    background: #111111;
    color: #ffffff;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.cart-table td {
    font-size: 16px;
    color: #111111;
    font-weight: 500;
}

.cart-table tr:hover {
    background: #f9f9f9;
}

/* Tombol Aksi */
.btn-delete {
    padding: 8px 12px;
    background: #ffffff;
    color: #111111;
    border: 2px solid #111111;
    text-decoration: none;
    font-weight: bold;
    text-transform: uppercase;
    font-size: 12px;
    transition: 0.3s;
    display: inline-block;
}

.btn-delete:hover {
    background: #111111;
    color: #ffffff;
}

/* Checkout Area di Bawah Tabel */
.checkout-area {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
    border: 2px solid #111111;
    background: #ffffff;
    box-shadow: 8px 8px 0px #111111;
}

.total-price {
    font-size: 24px;
    font-weight: bold;
    text-transform: uppercase;
}

.btn-checkout {
    padding: 15px 30px;
    background: #111111;
    color: #ffffff;
    border: 2px solid #111111;
    font-size: 16px;
    font-weight: bold;
    text-transform: uppercase;
    text-decoration: none;
    transition: 0.3s;
    cursor: pointer;
}

.btn-checkout:hover {
    background: #ffffff;
    color: #111111;
}

/* Tampilan Saat Keranjang Kosong */
.empty-cart {
    text-align: center;
    padding: 80px 20px;
    border: 2px dashed #111111;
    background: #f9f9f9;
    font-size: 18px;
    font-weight: bold;
    text-transform: uppercase;
}
</style>

<div class="cart-container">
    <div class="cart-header">
        <h1>Keranjang Belanja</h1>
    </div>

    <?php if (empty($data['cart'])) : ?>
        <div class="empty-cart">
            <p style="margin-bottom: 20px;">Keranjang kamu masih kosong.</p>
            <a href="<?= BASEURL; ?>/product" class="btn-checkout">Mulai Belanja</a>
        </div>
    <?php else : ?>

        <table class="cart-table">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $total_belanja = 0; // Variabel untuk menghitung total semua
                foreach ($data['cart'] as $item) : 
                    $subtotal = $item['harga'] * $item['jumlah'];
                    $total_belanja += $subtotal;
                ?>
                <tr>
                    <!-- Kolom Produk diratakan ke kiri agar lebih rapi dibaca -->
                    <td style="text-align: left; font-weight: bold;"><?= $item['nama_produk']; ?></td>
                    
                    <td>Rp <?= number_format($item['harga'], 0, ',', '.'); ?></td>
                    <td><?= $item['jumlah']; ?></td>
                    <td style="font-weight: bold;">Rp <?= number_format($subtotal, 0, ',', '.'); ?></td>
                    
                    <td>
                        <!-- Tambahan pop up konfirmasi hapus -->
                        <a href="<?= BASEURL; ?>/cart/delete/<?= $item['id_cart']; ?>" class="btn-delete" onclick="return confirm('Yakin ingin menghapus produk ini dari keranjang?');">
                            Hapus
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Area Total dan Checkout -->
        <div class="checkout-area">
            <div class="total-price">
                Total: Rp <?= number_format($total_belanja, 0, ',', '.'); ?>
            </div>
            <a href="<?= BASEURL; ?>/checkout" class="btn-checkout">Checkout Sekarang</a>
        </div>

    <?php endif; ?>
</div>