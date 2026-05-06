<?php /** @var array $data */ ?>

<style>
/* Sidebar & Layout Utama */
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

/* Tombol */
.btn-add { background: #111111; color: #ffffff; padding: 10px 20px; text-decoration: none; font-weight: bold; text-transform: uppercase; font-size: 14px; border: 2px solid #111111; transition: 0.3s; }
.btn-add:hover { background: #ffffff; color: #111111; }
.btn-action { padding: 6px 12px; text-decoration: none; font-weight: bold; font-size: 12px; border: 2px solid #111; text-transform: uppercase; display: inline-block; margin: 2px; transition: 0.2s; }
.btn-edit { background: #ffffff; color: #111; }
.btn-edit:hover { background: #111; color: #fff; }
.btn-delete { background: #111; color: #fff; }
.btn-delete:hover { background: #fff; color: #111; }

/* Tabel */
.admin-table { width: 100%; border-collapse: collapse; }
.admin-table th, .admin-table td { padding: 12px; border: 1px solid #111111; text-align: left; vertical-align: middle; }
.admin-table th { background: #111111; color: #ffffff; text-transform: uppercase; font-size: 14px; }
</style>

<div class="admin-container">
    <aside class="admin-sidebar">
        <h2>⚙️ Panel Admin</h2>
        <ul class="admin-menu">
            <li><a href="<?= BASEURL; ?>/admin/dashboard">Dashboard</a></li>
            <li><a href="<?= BASEURL; ?>/admin/product" class="active">Kelola Produk</a></li>
            <li><a href="<?= BASEURL; ?>/admin/orders">Pesanan Masuk</a></li>
        </ul>
    </aside>

    <main class="admin-content">
        <div class="admin-header">
            <h1>Kelola Produk</h1>
            <a href="<?= BASEURL; ?>/admin/addProduct" class="btn-add">+ Tambah Produk</a>
        </div>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($data['products'])) : ?>
                    <?php foreach ($data['products'] as $p_amega) : ?>
                    <tr>
                        <td><?= $p_amega['id_product']; ?></td>
                        <td style="font-weight: bold;"><?= $p_amega['nama_produk']; ?></td>
                        <td>Rp <?= number_format($p_amega['harga'], 0, ',', '.'); ?></td>
                        <td><?= $p_amega['stok']; ?></td>
                        <td>
                            <a href="<?= BASEURL; ?>/admin/editProduct/<?= $p_amega['id_product']; ?>" class="btn-action btn-edit">Edit</a>
                            <a href="<?= BASEURL; ?>/admin/deleteProduct/<?= $p_amega['id_product']; ?>" class="btn-action btn-delete" onclick="return confirm('Yakin hapus?');">Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 30px;">Belum ada data produk.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
</div>