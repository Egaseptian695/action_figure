<?php /** @var array $data */ ?>

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
                    <h3>📦 Produk</h3>
                    <p class="stats"><?= isset($data['total_produk']) ? $data['total_produk'] : '-'; ?></p>
                    <p>Total data produk di etalase</p>
                </div>
                <a href="<?= BASEURL; ?>/admin/products" class="btn-retro">Kelola Produk</a>
            </div>

            <!-- PESANAN -->
            <div class="card">
                <div>
                    <h3>🧾 Pesanan</h3>
                    <p class="stats"><?= isset($data['total_transaksi']) ? $data['total_transaksi'] : '-'; ?></p>
                    <p>Total riwayat pesanan masuk</p>
                </div>
                <a href="<?= BASEURL; ?>/admin/orders" class="btn-retro">Lihat Pesanan</a>
            </div>

            <!-- PENDAPATAN -->
            <div class="card">
                <div>
                    <h3>💰 Pendapatan</h3>
                    <p class="stats" style="font-size: 24px;">
                        Rp <?= isset($data['total_pendapatan']) ? number_format($data['total_pendapatan'], 0, ',', '.') : '0'; ?>
                    </p>
                    <p>Akumulasi total penjualan</p>
                </div>
            </div>

            <!-- STATUS -->
            <div class="card">
                <div>
                    <h3>🚚 Status Pesanan</h3>
                    <p class="stats">Update</p>
                    <p>Pending / Diproses / Dikirim</p>
                </div>
                <a href="<?= BASEURL; ?>/admin/orders" class="btn-retro">Cek Status</a>
            </div>

        </div>
    </main>
</div>