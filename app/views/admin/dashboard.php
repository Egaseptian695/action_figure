<?php /** @var array $data */ ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
/* Sidebar & Layout Admin (Konsisten dengan halaman lain) */
.admin-container { display: flex; max-width: 1200px; margin: 40px auto; padding: 0 20px; gap: 30px; align-items: flex-start; }
.admin-sidebar { width: 250px; background: #ffffff; border: 2px solid #111111; box-shadow: 6px 6px 0px #111111; padding: 20px; }
.admin-sidebar h2 { font-size: 18px; text-transform: uppercase; border-bottom: 2px solid #111111; padding-bottom: 15px; margin-bottom: 20px; text-align: center; }
.admin-menu { list-style: none; }
.admin-menu li { margin-bottom: 10px; }
.admin-menu a { display: block; padding: 12px 15px; color: #111111; text-decoration: none; font-weight: bold; text-transform: uppercase; font-size: 14px; border: 2px solid transparent; transition: 0.3s; }
.admin-menu a:hover, .admin-menu a.active { background: #111111; color: #ffffff; border: 2px solid #111111; }
.admin-content { flex: 1; background: #ffffff; border: 2px solid #111111; padding: 30px; min-height: 500px; }
.admin-header { display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #111111; padding-bottom: 15px; margin-bottom: 30px; }
.admin-header h1 { font-size: 24px; text-transform: uppercase; }

/* Dashboard Grid Retro */
.dashboard {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 25px;
}

/* CARD Retro B/W */
.card {
    background: #ffffff;
    border: 2px solid #111111;
    padding: 25px 20px;
    box-shadow: 6px 6px 0px #111111;
    transition: 0.3s;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 10px 10px 0px #111111;
}

/* TITLE */
.card h3 {
    margin-bottom: 15px;
    font-size: 16px;
    text-transform: uppercase;
    border-bottom: 2px solid #111111;
    display: inline-block;
    padding-bottom: 5px;
}

/* STATS */
.stats {
    font-size: 32px;
    font-weight: 900;
    color: #111111;
    margin-bottom: 10px;
}

.card p {
    font-size: 12px;
    font-weight: bold;
    text-transform: uppercase;
    color: #555555;
    margin-bottom: 20px;
}

/* BUTTON RETRO */
.btn-retro {
    display: block;
    padding: 12px 15px;
    background: #111111;
    color: #ffffff;
    border: 2px solid #111111;
    text-decoration: none;
    font-weight: bold;
    text-transform: uppercase;
    font-size: 12px;
    text-align: center;
    transition: 0.3s;
}

.btn-retro:hover {
    background: #ffffff;
    color: #111111;
}
/* --- ANALYTICS SECTION --- */
.analytics-section {
    margin-top: 40px;
    display: flex;
    flex-wrap: wrap;
    gap: 25px;
}

.analytics-card {
    flex: 1;
    min-width: 300px;
    background: #ffffff;
    border: 2px solid #111111;
    box-shadow: 6px 6px 0px #111111;
    padding: 25px;
}

.analytics-card h3 {
    font-size: 18px;
    text-transform: uppercase;
    border-bottom: 2px solid #111111;
    display: inline-block;
    padding-bottom: 5px;
    margin-bottom: 20px;
}

.analytics-table {
    width: 100%;
    border-collapse: collapse;
}

.analytics-table th, .analytics-table td {
    padding: 10px;
    border-bottom: 1px solid #dddddd;
    text-align: left;
    font-size: 14px;
}

.analytics-table th {
    font-weight: bold;
    text-transform: uppercase;
    color: #111111;
    border-bottom: 2px solid #111111;
}

.analytics-table tr:last-child td {
    border-bottom: none;
}

.badge-rank {
    background: #111111;
    color: #ffffff;
    padding: 3px 8px;
    font-size: 12px;
    font-weight: bold;
    border-radius: 4px;
    margin-right: 10px;
}
</style>

<div class="admin-container">
    
    <!-- Sidebar Kiri -->
    <aside class="admin-sidebar">
        <h2>⚙️ Panel Admin</h2>
        <ul class="admin-menu">
            <li><a href="<?= BASEURL; ?>/admin" class="active">Dashboard</a></li>
            <li><a href="<?= BASEURL; ?>/admin/products">Kelola Produk</a></li>
            <li><a href="<?= BASEURL; ?>/admin/orders">Pesanan Masuk</a></li>
        </ul>
    </aside>

    <!-- Konten Kanan -->
    <main class="admin-content">
        <div class="admin-header">
            <h1>Dashboard Ringkasan</h1>
        </div>

        <div class="dashboard">

            <!-- PRODUK -->
            <div class="card">
                <div>
                    <h3><i class="fa-solid fa-box" style="color: rgb(28, 37, 53);"></i> Produk</h3>
                    <p class="stats"><?= isset($data['total_produk']) ? $data['total_produk'] : '-'; ?></p>
                    <p>Total data produk di etalase</p>
                </div>
                <a href="<?= BASEURL; ?>/admin/products" class="btn-retro">Kelola Produk</a>
            </div>

            <!-- PESANAN -->
            <div class="card">
                <div>
                    <h3><i class="fa-regular fa-file-lines" style="color: rgb(28, 37, 53);"></i> Pesanan</h3>
                    <p class="stats"><?= isset($data['total_transaksi']) ? $data['total_transaksi'] : '-'; ?></p>
                    <p>Total riwayat pesanan masuk</p>
                </div>
                <a href="<?= BASEURL; ?>/admin/orders" class="btn-retro">Lihat Pesanan</a>
            </div>

            <!-- PENDAPATAN -->
            <div class="card">
                <div>
                    <h3><i class="fa-solid fa-sack-dollar" style="color: rgb(28, 37, 53);"></i> Pendapatan</h3>
                    <p class="stats" style="font-size: 24px;">
                        Rp <?= isset($data['total_pendapatan']) ? number_format($data['total_pendapatan'], 0, ',', '.') : '0'; ?>
                    </p>
                    <p>Akumulasi total penjualan</p>
                </div>
            </div>

            <div style="background: #ffffff; border: 3px solid #111111; box-shadow: 6px 6px 0px #111111; padding: 25px; margin-top: 40px; margin-bottom: 20px;">
            <h3 style="font-size: 18px; text-transform: uppercase; border-bottom: 2px solid #111111; display: inline-block; padding-bottom: 5px; margin-bottom: 20px; margin-top: 0;">
                📈 Kurva Pendapatan Tahun Ini
            </h3>
            <div style="position: relative; height: 300px; width: 100%;">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>
            </div> <div class="analytics-section">
            
            <div class="analytics-card">
                <h3><i class="fa-solid fa-chart-bar" style="color: rgb(28, 37, 53);"></i> Paling Banyak Dibeli</h3>
                <table class="analytics-table">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th style="text-align: center;">Terjual</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($data['top_terjual'])) : ?>
                            <?php $no = 1; foreach ($data['top_terjual'] as $top) : ?>
                                <tr>
                                    <td style="font-weight: bold;">
                                        <span class="badge-rank">#<?= $no++; ?></span> 
                                        <?= $top['nama_produk']; ?>
                                    </td>
                                    <td style="text-align: center; font-weight: 900; color: #27ae60;">
                                        <?= $top['total_terjual']; ?> pcs
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="2" style="text-align: center; padding: 20px; color: #777;">Belum ada data penjualan.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="analytics-card">
                <h3><i class="fa-solid fa-heart" style="color: rgb(28, 37, 53);"></i> Paling Diminati (Wishlist)</h3>
                <table class="analytics-table">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th style="text-align: center;">Disimpan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($data['top_diminati'])) : ?>
                            <?php $no = 1; foreach ($data['top_diminati'] as $fav) : ?>
                                <tr>
                                    <td style="font-weight: bold;">
                                        <span class="badge-rank">#<?= $no++; ?></span> 
                                        <?= $fav['nama_produk']; ?>
                                    </td>
                                    <td style="text-align: center; font-weight: 900; color: #e74c3c;">
                                        <?= $fav['total_wishlist']; ?> user
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="2" style="text-align: center; padding: 20px; color: #777;">Belum ada data wishlist.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            </div> 
        </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
    // Mengambil data JSON dari Controller PHP
    const dataPendapatan = <?= $data['grafik_json']; ?>;

    const ctx = document.getElementById('revenueChart').getContext('2d');
    
    // Konfigurasi Chart dengan gaya Brutalist (Garis tebal, warna monokrom retro)
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [{
                label: 'Total Pendapatan (Rp)',
                data: dataPendapatan,
                borderColor: '#111111', // Warna garis hitam pekat
                borderWidth: 4, // Garis tebal
                backgroundColor: 'rgba(17, 17, 17, 0.1)', // Warna isian di bawah kurva
                pointBackgroundColor: '#ffffff',
                pointBorderColor: '#111111',
                pointBorderWidth: 3,
                pointRadius: 5,
                pointHoverRadius: 8,
                fill: true,
                tension: 0.3 // Sedikit lengkungan agar elegan, tapi tetap tegas
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false } // Sembunyikan label legend agar lebih bersih
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: '#dddddd', borderDash: [5, 5] },
                    ticks: {
                        font: { weight: 'bold' },
                        callback: function(value) {
                            // Format angka ke Rupiah di sumbu Y
                            if (value === 0) return 'Rp 0';
                            return 'Rp ' + (value / 1000000) + ' Jt';
                        }
                    }
                },
                x: {
                    grid: { display: false },
                    ticks: { font: { weight: 'bold' } }
                }
            }
        }
    });
</script>
    </main>
</div>