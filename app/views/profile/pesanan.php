<?php /** @var array $data */ ?>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
</head>
<style>
.history-container {
    max-width: 1000px;
    margin: 50px auto;
    padding: 0 20px;
}

.history-title {
    font-size: 28px;
    text-transform: uppercase;
    color: #111111;
    background: #ffffff; /* Latar putih solid agar teks selalu terbaca */
    border: 3px solid #111111; /* Garis tepi hitam tegas */
    padding: 10px 25px; /* Memberi ruang di sekitar teks */
    display: inline-block;
    margin-bottom: 30px;
    box-shadow: 6px 6px 0px #111111; /* Efek bayangan solid khas Brutalist */
}

.history-table-wrapper {
    background: #ffffff;
    border: 3px solid #111111;
    box-shadow: 8px 8px 0px #111111;
    overflow-x: auto;
}

.history-table {
    width: 100%;
    border-collapse: collapse;
}

.history-table th, .history-table td {
    padding: 15px;
    border-bottom: 2px solid #111111;
    text-align: left;
}

.history-table th {
    background: #111111;
    color: #ffffff;
    text-transform: uppercase;
    font-size: 14px;
}

/* Warna-warni Status */
.badge-status {
    padding: 5px 10px;
    font-weight: bold;
    text-transform: uppercase;
    font-size: 12px;
    border: 2px solid #111111;
    display: inline-block;
}

.status-pending { background: #f1c40f; color: #111; }
.status-diproses { background: #3498db; color: #fff; }
.status-dikirim { background: #2ecc71; color: #111; }

.btn-back {
    display: inline-block;
    margin-bottom: 20px;
    padding: 10px 20px;
    background: #ffffff;
    color: #111111;
    border: 2px solid #111111;
    text-decoration: none;
    font-weight: bold;
    text-transform: uppercase;
    box-shadow: 3px 3px 0px #111111;
    transition: 0.2s;
}
.btn-back:hover {
    background: #111111;
    color: #ffffff;
}
</style>

<div class="history-container">
    <a href="<?= BASEURL; ?>/profile" class="btn-back">⬅ Kembali ke Profil</a>
    <br>
    <h1 class="history-title"><i class="fa-solid fa-box" style="color: rgb(28, 37, 53);"></i> Riwayat Pesanan Saya</h1>

    <div class="history-table-wrapper">
        <table class="history-table">
            <thead>
                <tr>
                    <th>ID Pesanan</th>
                    <th>Tanggal</th>
                    <th>Detail Produk</th> <th>Total Belanja</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($data['pesanan'])) : ?>
                    <?php foreach ($data['pesanan'] as $trx) : ?>
                        <tr>
                            <td style="font-weight: bold;">#TRX-<?= $trx['id_transaksi']; ?></td>
                            
                            <td><?= date('d M Y', strtotime($trx['tanggal'])); ?></td>
                            <td style="line-height: 1.5; font-size: 14px;">
                                <?= $trx['detail_produk']; ?></td>
                            <td style="font-weight: bold;">Rp <?= number_format($trx['total_harga'], 0, ',', '.'); ?></td>
                            
                            <td>
                                <?php 
                                    // UBAH status MENJADI status_pesanan
                                    // Kita beri nilai default 'Pending' jika kebetulan datanya kosong
                                    $statusAsli = $trx['status_pesanan'] ?? 'Pending';
                                    $statusCek = strtolower($statusAsli);
                                    
                                    $badgeClass = 'status-pending'; // Default warna kuning
                                    
                                    if ($statusCek == 'diproses') {
                                        $badgeClass = 'status-diproses'; // Warna biru
                                    } elseif ($statusCek == 'dikirim' || $statusCek == 'selesai') {
                                        $badgeClass = 'status-dikirim'; // Warna hijau
                                    }
                                ?>
                                <span class="badge-status <?= $badgeClass; ?>"><?= $statusAsli; ?></span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="4" style="text-align: center; padding: 30px;">Kamu belum memiliki riwayat pesanan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>