<?php /** @var array $data */ ?>

<style>
/* Sidebar (Gunakan style yang sama) */
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

/* Form Styling */
.form-group { margin-bottom: 20px; }
.form-group label { display: block; margin-bottom: 8px; font-weight: bold; text-transform: uppercase; font-size: 13px; letter-spacing: 0.5px; }
.form-control { width: 100%; padding: 12px; border: 1px solid #111111; font-size: 15px; background: #f9f9f9; outline: none; transition: 0.2s; font-family: inherit; }
.form-control:focus { border: 2px solid #111111; background: #ffffff; }
.form-row { display: flex; gap: 20px; }
.form-row .form-group { flex: 1; }

/* Tombol Form */
.btn-submit { display: inline-block; padding: 12px 25px; background: #111111; color: #ffffff; border: 2px solid #111111; font-size: 14px; font-weight: bold; text-transform: uppercase; cursor: pointer; transition: 0.3s; width: 100%; }
.btn-submit:hover { background: #ffffff; color: #111111; }
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
            <h1>Tambah Produk</h1>
        </div>

        <!-- Rute disesuaikan dengan kode aslimu: /admin/storeProduct -->
        <form action="<?= BASEURL; ?>/admin/storeProduct" method="POST" enctype="multipart/form-data">
            
            <div class="form-group">
                <label>Nama Produk</label>
                <input type="text" name="nama_produk" class="form-control" placeholder="Masukkan nama figure..." required>
            </div>

            <div class="form-group">
                <label>Kategori</label>
                <input type="text" name="kategori" class="form-control" placeholder="Contoh: Anime, Game..." required>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Harga Normal (Rp)</label>
                    <input type="number" name="harga" class="form-control" placeholder="Harga penuh" required>
                </div>
                <div class="form-group">
                    <label>Harga DP (Rp) - Pre Order</label>
                    <input type="number" name="harga_dp" class="form-control" placeholder="Kosongkan jika Ready">
                </div>
                <div class="form-group">
                    <label>Stok Tersedia</label>
                    <input type="number" name="stok" class="form-control" placeholder="0" required>
                </div>
            </div>

            <div class="form-group">
                <label>Upload Gambar Produk</label>
                <input type="file" name="gambar" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Deskripsi Produk</label>
                <textarea name="deskripsi" class="form-control" rows="5" placeholder="Detail spesifikasi produk..." required></textarea>
            </div>

            <div class="form-group">
                <label>Status Ketersediaan</label>
                <select name="status" class="form-control" required>
                    <option value="ready">Ready Stock</option>
                    <option value="pre-order">Pre Order</option>
                </select>
            </div>

            <div style="margin-top: 30px;">
                <button type="submit" class="btn-submit">Simpan Data Produk</button>
            </div>

        </form>
    </main>
</div>