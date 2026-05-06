<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman <?= $data['judul'] ?? 'NekoFigure'; ?> - NekoFigure.id</title>
    <style>
        /* Reset Dasar */
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Helvetica Neue', Arial, sans-serif; }
        body { background-color: #ffffff; color: #111111; }
        
        /* Navbar Solid B/W */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 50px;
            background: #ffffff;
            border-bottom: 2px solid #111111;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-brand a { 
            font-size: 24px; 
            font-weight: 900; 
            color: #111111; 
            text-decoration: none; 
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .navbar-nav { display: flex; gap: 20px; align-items: center; }
        .navbar-nav a { 
            text-decoration: none; 
            color: #111111; 
            font-weight: bold; 
            text-transform: uppercase; 
            font-size: 14px; 
            padding: 8px 12px; 
            transition: all 0.2s;
            border: 1px solid transparent;
        }
        .navbar-nav a:hover { 
            background: #111111; 
            color: #ffffff; 
            border: 1px solid #111111;
        }

        /* Dropdown Simpel & Tegas */
        .dropdown { position: relative; }
        .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background: #ffffff;
            border: 1px solid #111111;
            box-shadow: 4px 4px 0px #111111; /* Shadow retro padat */
            min-width: 160px;
            z-index: 1001;
        }
        .dropdown:hover .dropdown-menu { display: block; }
        .dropdown-menu a {
            display: block;
            border-bottom: 1px solid #111111;
            border-radius: 0; /* Menghilangkan efek lengkung bawaan hover */
        }
        .dropdown-menu a:last-child { border-bottom: none; }

        /* Ikon & Tombol Aksi */
        .navbar-icons { display: flex; gap: 20px; align-items: center; }
        .navbar-icons a { 
            text-decoration: none; 
            color: #111111; 
            font-weight: bold; 
            font-size: 14px;
            transition: 0.2s;
        }
        .navbar-icons a:hover { text-decoration: underline; }
        
        .btn-login {
            background-color: #ffffff;
            color: #111111 !important;
            padding: 8px 18px;
            border: 2px solid #111111;
            text-transform: uppercase;
            font-weight: bold;
        }
        .btn-login:hover { 
            background-color: #111111; 
            color: #ffffff !important; 
            text-decoration: none !important;
        }
    </style>
</head>
<style>
/* Kode untuk mengatur background seluruh website */
body {
    background-image: url('<?= BASEURL; ?>/img/background.jpg'); /* Ganti dengan path gambar polkadot yang diinginkan */
    
    /* Matikan efek ubin/berulang */
    background-repeat: no-repeat;
    
    /* Posisikan persis di tengah */
    background-position: center;
    
    /* Paksa gambar menyesuaikan ukuran layar PC/Laptop */
    background-size: cover;
    
    /* Gambar diam saat web di-scroll */
    background-attachment: fixed;
}

/* Sedikit tambahan agar konten (card, form, tabel) tetap terbaca jelas 
   dan tidak tenggelam oleh background polkadot */
.card, .detail-container, .cart-table, .checkout-wrapper, .admin-sidebar, .admin-content {
    background-color: #ffffff; /* Memastikan latar elemen tetap putih bersih */
}
</style>
<body>

    <nav class="navbar">
        <div class="navbar-brand">
            <a href="<?= BASEURL; ?>">NekoFigure.id</a>
        </div>
        
        <div class="navbar-nav">
            <a href="<?= BASEURL; ?>">Beranda</a>
            <a href="<?= BASEURL; ?>/product">Katalog</a>
            <div class="dropdown">
                <a href="#">Kategori ▼</a>
                <div class="dropdown-menu">
                    <a href="<?= BASEURL; ?>/product/kategori/Anime">Anime</a>
                    <a href="<?= BASEURL; ?>/product/kategori/Game">Game</a>
                    <a href="<?= BASEURL; ?>/product/kategori/Mecha">Mecha</a>
                </div>
            </div>
        </div>

        <div class="navbar-icons">
            <a href="<?= BASEURL; ?>/wishlist">🤍 Wishlist</a>

            <?php if (isset($_SESSION['user_id'])) : ?>
                <!-- Kalau SUDAH LOGIN -->
                <a href="<?= BASEURL; ?>/cart">🛒 Keranjang</a>

                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') : ?>
                    <a href="<?= BASEURL; ?>/admin">⚙️ Admin</a>
                <?php endif; ?>

                <a href="<?= BASEURL; ?>/auth/logout">Logout</a>
            <?php else : ?>
                <!-- Kalau BELUM LOGIN -->
                <a href="<?= BASEURL; ?>/auth/login" class="btn-login">Login</a>
            <?php endif; ?>
        </div>
    </nav>
    <script>
        const BASEURL = "<?= BASEURL; ?>";
    </script>