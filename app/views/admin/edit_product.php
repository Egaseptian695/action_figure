<?php /** @var array $data */ ?>

<style>
/* Sidebar & Layout Admin (Konsisten) */
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

.btn-submit { display: inline-block; padding: 12px 25px; background: #111111; color: #ffffff; border: 2px solid #111111; font-size: 14px; font-weight: bold; text-transform: uppercase; cursor: pointer; transition: 0.3s; width: 100%; }
.btn-submit:hover { background: #ffffff; color: #111111; }

/* Preview Gambar Lama */
.img-preview { border: 2px dashed #111; padding: 10px; text-align: center; background: #f9f9f9; margin-bottom: 10px; }
.img-preview img { max-width: 150px; height: auto; border: 1px solid #111; display: block; margin: 10px auto; }
</style>

<div class="admin-container">
    <aside class="admin-sidebar">
        <h2>⚙️ Panel Admin</h2>
        <ul class="admin-menu">
            <li><a href="<?= BASEURL; ?>/admin/dashboard">Dashboard</a></li>
            <li><a href="<?= BASEURL; ?>/admin/products" class="active">Kelola Produk</a></li>
            <li><a href="<?= BASEURL; ?>/admin/orders">Pesanan Masuk</a></li>
        </ul>
    </aside>

    <main class="admin-content">
        <div class="admin-header">
            <h1>Edit Data Produk</h1>
        </div>

        <form action="<?= BASEURL; ?>/admin/updateProduct" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_product" value="<?= $data['product']['id_product']; ?>">

            <div class="form-group">
                <label>Nama Produk</label>
                <input type="text" name="nama_produk" class="form-control" value="<?= $data['product']['nama_produk']; ?>" required>
            </div>

            <div class="form-group">
                <label>Kategori</label>
                <input type="text" name="kategori" class="form-control" value="<?= $data['product']['kategori']; ?>" required>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Harga Normal (Rp)</label>
                    <input type="number" name="harga" class="form-control" value="<?= $data['product']['harga']; ?>" required>
                </div>
                <div class="form-group">
                    <label>Harga DP (Rp)</label>
                    <input type="number" name="harga_dp" class="form-control" value="<?= $data['product']['harga_dp']; ?>">
                </div>
                <div class="form-group">
                    <label>Stok</label>
                    <input type="number" name="stok" class="form-control" value="<?= $data['product']['stok']; ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label>Upload Gambar Baru (Opsional)</label>
                
                <!-- Menampilkan gambar saat ini agar Admin bisa melihatnya -->
                <div class="img-preview">
                    <span style="font-size: 12px; text-transform: uppercase;">Gambar Saat Ini: <?= $data['product']['gambar']; ?></span>
                    <img src="<?= BASEURL; ?>/img/products/<?= $data['product']['gambar']; ?>" alt="Preview">
                </div>
                <input type="hidden" name="gambarLama" value="<?= $data['product']['gambar']; ?>">
                <input type="file" name="gambar" class="form-control" accept="image/*">
                <small style="display:block; margin-top:5px; color:#555;">*Biarkan kosong jika tidak ingin mengubah gambar.</small>
            </div>

            <div class="form-group">
                <label>Deskripsi Produk</label>
                <textarea name="deskripsi" class="form-control" rows="5" required><?= $data['product']['deskripsi']; ?></textarea>
            </div>

            <div class="form-group">
                <label>Status Ketersediaan</label>
                <select name="status" class="form-control" required>
                    <option value="ready" <?= $data['product']['status'] == 'ready' ? 'selected' : '' ?>>Ready Stock</option>
                    <option value="pre-order" <?= $data['product']['status'] == 'pre-order' ? 'selected' : '' ?>>Pre Order</option>
                </select>
            </div>

            <div style="margin-top: 30px;">
                <button type="submit" class="btn-submit">Update Produk</button>
            </div>

        </form>
    </main>
</div>