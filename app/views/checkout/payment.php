<?php /** @var array $data */ ?>

<style>
/* (Gunakan style CSS yang sama seperti sebelumnya di sini, agar tidak terlalu panjang saya singkat) */
.payment-container { max-width: 600px; margin: 50px auto; padding: 0 20px; }
.payment-card { background: #ffffff; border: 2px solid #111111; padding: 40px; text-align: center; box-shadow: 8px 8px 0px #111111; }
.payment-title { font-size: 24px; text-transform: uppercase; border-bottom: 2px solid #111111; display: inline-block; padding-bottom: 10px; margin-bottom: 30px; }
.invoice-box { background: #f9f9f9; border: 1px dashed #111111; padding: 20px; margin-bottom: 20px; }
.amount-to-pay { font-size: 28px; font-weight: 900; margin: 20px 0; color: #111111; }
.btn-confirm { display: block; width: 100%; padding: 15px; background: #111111; color: #ffffff; border: 2px solid #111111; font-size: 16px; font-weight: bold; text-transform: uppercase; cursor: pointer; transition: 0.3s; margin-top: 20px; }
.btn-confirm:hover { background: #ffffff; color: #111111; }
.form-select { width: 100%; padding: 12px; border: 2px solid #111; font-size: 16px; text-transform: uppercase; font-weight: bold; outline: none; text-align: center; cursor: pointer; }
</style>

<div style="text-align: center; margin-bottom: 30px; font-size: 14px; font-weight: bold; color: #111; text-transform: uppercase; letter-spacing: 2px;">
    [ Langkah 2 dari 3 : Pembayaran ]
</div>

<div class="payment-container">
    <div class="payment-card">
        <h2 class="payment-title">Selesaikan Pembayaran</h2>
        
        <div class="invoice-box">
            <p>Total Tagihan untuk Pesanan <strong>#<?= $data['transaksi']['id_transaksi']; ?></strong>:</p>
            <!-- Mengambil harga langsung dari database sesuai kodemu -->
            <div class="amount-to-pay">Rp <?= number_format($data['transaksi']['total_harga'], 0, ',', '.'); ?></div>
        </div>

        <!-- Form mengarah ke method pay() di Controller-mu -->
        <form action="<?= BASEURL; ?>/checkout/pay" method="POST">
            <!-- Hidden input untuk id_transaksi -->
            <input type="hidden" name="id_transaksi" value="<?= $data['transaksi']['id_transaksi']; ?>">
            
            <div style="text-align: left; margin-bottom: 15px;">
                <label style="font-weight: bold; font-size: 14px; text-transform: uppercase;">Pilih Metode Pembayaran:</label>
            </div>
            <select name="metode" class="form-select" required>
                <option value="" disabled selected>-- Pilih Bank / E-Wallet --</option>
                <option value="BCA">Transfer BCA (123456789)</option>
                <option value="Mandiri">Transfer Mandiri (987654321)</option>
                <option value="QRIS">QRIS / GoPay / OVO</option>
            </select>

            <button type="submit" class="btn-confirm">Proses Pembayaran</button>
        </form>
    </div>
</div>