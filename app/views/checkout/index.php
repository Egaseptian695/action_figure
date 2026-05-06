<?php /** @var array $data */ ?>

<style>
/* Layout Container Dua Kolom */
.checkout-wrapper {
    max-width: 1100px;
    margin: 50px auto;
    padding: 0 20px;
    display: flex;
    flex-wrap: wrap;
    gap: 30px;
    align-items: flex-start; /* Agar kolom tidak memanjang ke bawah bersamaan */
}

/* Kolom Kiri: Form Pengiriman */
.checkout-form-section {
    flex: 2;
    min-width: 300px;
    background: #ffffff;
    border: 2px solid #111111;
    padding: 30px;
    box-shadow: 8px 8px 0px #111111;
}

.section-title {
    font-size: 20px;
    text-transform: uppercase;
    border-bottom: 2px solid #111111;
    padding-bottom: 10px;
    margin-bottom: 25px;
    letter-spacing: 1px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
    text-transform: uppercase;
    font-size: 13px;
}

.form-group input, .form-group textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #111111;
    font-size: 15px;
    background: #f9f9f9;
    outline: none;
    transition: 0.2s;
}

.form-group input:focus, .form-group textarea:focus {
    border: 2px solid #111111;
    background: #ffffff;
}

/* Kolom Kanan: Ringkasan Pesanan */
.checkout-summary-section {
    flex: 1;
    min-width: 300px;
    background: #f9f9f9;
    border: 2px solid #111111;
    padding: 30px;
}

.summary-item {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
    font-size: 14px;
    border-bottom: 1px dashed #ccc;
    padding-bottom: 10px;
}

.summary-total {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
    font-size: 18px;
    font-weight: bold;
    text-transform: uppercase;
    border-top: 2px solid #111111;
    padding-top: 15px;
}

.btn-pay {
    width: 100%;
    padding: 15px;
    margin-top: 25px;
    background: #111111;
    color: #ffffff;
    border: 2px solid #111111;
    font-size: 16px;
    font-weight: bold;
    text-transform: uppercase;
    cursor: pointer;
    transition: 0.3s;
}

.btn-pay:hover {
    background: #ffffff;
    color: #111111;
}

/* Penanda Langkah */
.step-indicator {
    text-align: center;
    margin-bottom: 30px;
    font-size: 14px;
    font-weight: bold;
    color: #111111;
    text-transform: uppercase;
    letter-spacing: 2px;
}
</style>

<div class="step-indicator">
    [ Langkah 1 dari 3 : Pengiriman ]
</div>

<div class="checkout-wrapper">
    
    <!-- Bagian Kiri: Form -->
    <div class="checkout-form-section">
        <h2 class="section-title">Informasi Pengiriman</h2>
        
        <!-- Form diberi ID agar tombol submit di luar form bisa memicu form ini -->
        <!-- Action diubah menjadi /process sesuai nama method-mu -->
        <form id="checkoutForm" action="<?= BASEURL; ?>/checkout/process" method="POST">
            <div class="form-group">
                <label>Alamat Lengkap Pengiriman</label>
                <!-- Name diubah menjadi "alamat" sesuai $_POST['alamat'] di controller -->
                <textarea name="alamat" rows="4" placeholder="Nama Jalan, RT/RW, Kecamatan, Kota..." required></textarea>
            </div>
        </form>
    </div>

    <!-- Bagian Kanan: Ringkasan -->
    <div class="checkout-summary-section">
        <h2 class="section-title">Ringkasan</h2>
        
        <?php 
        $total_belanja = 0;
        if (!empty($data['cart'])) :
            foreach ($data['cart'] as $item) : 
                $subtotal = $item['harga'] * $item['jumlah'];
                $total_belanja += $subtotal;
        ?>
            <div class="summary-item">
                <span><?= $item['jumlah']; ?>x <?= $item['nama_produk']; ?></span>
                <span style="font-weight: bold;">Rp <?= number_format($subtotal, 0, ',', '.'); ?></span>
            </div>
        <?php 
            endforeach; 
        endif; 
        ?>

        <div class="summary-total">
            <span>Total Bayar</span>
            <span>Rp <?= number_format($total_belanja, 0, ',', '.'); ?></span>
        </div>

        <!-- Tombol ini memicu form di sebelah kiri dengan menggunakan atribut form="checkoutForm" -->
        <button type="submit" form="checkoutForm" class="btn-pay">Lanjut Pembayaran</button>
    </div>

</div>