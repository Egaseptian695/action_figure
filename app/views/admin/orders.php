<?php /** @var array $data */ ?>

<style>
/* CSS Sidebar (Sama dengan sebelumnya) */
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

/* Tabel Pesanan */
.admin-table { width: 100%; border-collapse: collapse; }
.admin-table th, .admin-table td { padding: 12px; border: 1px solid #111111; text-align: left; vertical-align: middle; font-size: 14px; }
.admin-table th { background: #111111; color: #ffffff; text-transform: uppercase; }

/* Status Badge Sederhana */
.status-badge { display: inline-block; padding: 5px 10px; font-weight: bold; text-transform: uppercase; font-size: 12px; border: 1px solid #111; }
.status-pending { background: #fff3cd; color: #856404; }
.status-diproses { background: #cce5ff; color: #004085; }
.status-dikirim { background: #d4edda; color: #155724; }
.status-selesai { background: #111; color: #fff; }

/* Form Aksi Inline */
.action-form { display: flex; gap: 5px; align-items: center; }
.select-status { padding: 5px; border: 1px solid #111; font-size: 12px; outline: none; }
.btn-update { padding: 6px 12px; background: #111; color: #fff; border: 1px solid #111; font-size: 12px; font-weight: bold; text-transform: uppercase; cursor: pointer; transition: 0.2s; }
.btn-update:hover { background: #fff; color: #111; }
.btn-delete-order { padding: 6px 12px; background: #fff; color: #111; border: 1px solid #111; font-size: 12px; font-weight: bold; text-transform: uppercase; text-decoration: none; display: inline-block; transition: 0.2s; }
.btn-delete-order:hover { background: #111; color: #fff; }
</style>

<div class="admin-container">
    <aside class="admin-sidebar">
        <h2>⚙️ Panel Admin</h2>
        <ul class="admin-menu">
            <li><a href="<?= BASEURL; ?>/admin/dashboard">Dashboard</a></li>
            <li><a href="<?= BASEURL; ?>/admin/product">Kelola Produk</a></li>
            <li><a href="<?= BASEURL; ?>/admin/orders" class="active">Pesanan Masuk</a></li>
        </ul>
    </aside>

    <main class="admin-content">
        <div class="admin-header">
            <h1>Kelola Pesanan</h1>
        </div>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID Trans.</th>
                    <th>Nama User</th>
                    <th>Total Bayar</th>
                    <th>Status Info</th>
                    <th>Aksi & Update</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($data['orders'])) : ?>
                    <?php foreach ($data['orders'] as $order_amega) : ?>
                    <tr>
                        <td style="font-weight: bold;">#<?= $order_amega['id_transaksi']; ?></td>
                        <td><?= $order_amega['nama']; ?></td>
                        <td style="font-weight: bold;">Rp <?= number_format($order_amega['total_harga'], 0, ',', '.'); ?></td>
                        
                        <!-- Penanda Visual Status -->
                        <td>
                            <?php 
                                $statusClass = 'status-pending';
                                if($order_amega['status_pesanan'] == 'diproses') $statusClass = 'status-diproses';
                                if($order_amega['status_pesanan'] == 'dikirim') $statusClass = 'status-dikirim';
                                if($order_amega['status_pesanan'] == 'selesai') $statusClass = 'status-selesai';
                            ?>
                            <span class="status-badge <?= $statusClass; ?>">
                                <?= $order_amega['status_pesanan']; ?>
                            </span>
                        </td>
                        
                        <td>
                            <!-- Form ubah status -->
                            <form action="<?= BASEURL; ?>/admin/updateStatus" method="POST" class="action-form">
                                <input type="hidden" name="id_transaksi" value="<?= $order_amega['id_transaksi']; ?>">
                                
                                <select name="status" class="select-status">
                                    <option value="pending" <?= $order_amega['status_pesanan'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                                    <option value="diproses" <?= $order_amega['status_pesanan'] == 'diproses' ? 'selected' : '' ?>>Diproses</option>
                                    <option value="dikirim" <?= $order_amega['status_pesanan'] == 'dikirim' ? 'selected' : '' ?>>Dikirim</option>
                                    <option value="selesai" <?= $order_amega['status_pesanan'] == 'selesai' ? 'selected' : '' ?>>Selesai</option>
                                </select>
                                <button type="submit" class="btn-update">Update</button>
                            </form>

                            <!-- Tombol hapus dimasukkan ke DALAM <td> agar layout tidak rusak -->
                            <?php if ($order_amega['status_pesanan'] == 'selesai') : ?>
                                <div style="margin-top: 10px;">
                                    <a href="<?= BASEURL; ?>/admin/delete/<?= $order_amega['id_transaksi']; ?>" class="btn-delete-order" onclick="return confirm('Yakin hapus pesanan ini? Data tidak bisa dikembalikan.');">
                                        Hapus Data
                                    </a>
                                </div>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 30px;">Belum ada pesanan masuk.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
</div>