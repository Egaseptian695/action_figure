<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman <?= $data['judul'] ?? 'NekoFigure'; ?> - NekoFigure.id</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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

        /* --- GAYA KOTAK PENCARIAN MENGAMBANG --- */
.search-floating {
    position: absolute;
    top: 70px; /* Jarak dari atas. Sesuaikan jika header kamu lebih tinggi/pendek */
    right: 5%; /* Posisinya menempel di kanan dekat menu */
    background: #ffffff;
    border: 3px solid #111111;
    box-shadow: 6px 6px 0px #111111; /* Bayangan tebal Brutalist */
    padding: 20px;
    width: 350px;
    z-index: 9999; /* Pastikan selalu berada paling depan */
    
    /* Disembunyikan dari awal */
    display: none; 
}

/* Muncul jika punya class active */
.search-floating.active {
    display: block;
    animation: slideDown 0.2s ease-out;
}

.search-floating input {
    flex: 1;
    padding: 10px;
    border: 2px solid #111111;
    outline: none;
    font-size: 14px;
}

.search-floating button {
    padding: 10px 15px;
    background: #111111;
    color: #ffffff;
    border: 2px solid #111111;
    font-weight: bold;
    text-transform: uppercase;
    cursor: pointer;
    transition: 0.2s;
}

.search-floating button:hover {
    background: #ffffff;
    color: #111111;
}

@keyframes slideDown {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}
    </style>
</head>
<style>
/* Kode untuk mengatur background seluruh website */
body {
    background-image: url('<?= BASEURL; ?>/img/background_3.jpg'); /* Ganti dengan path gambar polkadot yang diinginkan */
    
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
        <a href="#" id="toggleSearchBtn" style="font-weight: bold; text-decoration: none; color: #111111; margin-right: 15px;"><i class="fa-solid fa-magnifying-glass" style="color: rgb(28, 37, 53);"></i> Cari</a>

        <a href="<?= BASEURL; ?>/wishlist">🤍 Wishlist</a>

        <?php if (isset($_SESSION['user_id'])) : ?>
            <a href="<?= BASEURL; ?>/cart">🛒 Keranjang</a>

            <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') : ?>
                <a href="<?= BASEURL; ?>/admin">⚙️ Admin</a>
            <?php endif; ?>

            <a href="<?= BASEURL; ?>/auth/logout">Logout</a>
            <a href="<?= BASEURL; ?>/profile" style="font-weight: bold; text-decoration: none; color: #111111; margin-right: 15px;"><i class="fa-regular fa-user" style="color: rgb(28, 37, 53);"></i> Profil</a>
        <?php else : ?>
            <a href="<?= BASEURL; ?>/auth/login" class="btn-login">Login</a>
        <?php endif; ?>
    </div>
</nav>

<div id="floatingSearchBar" class="search-floating">
    <form action="<?= BASEURL; ?>/home/cari" method="POST" style="display: flex; gap: 10px;">
        <input type="text" name="keyword" placeholder="Ketik nama figure..." autocomplete="off" required>
        <button type="submit">Cari</button>
    </form>
</div>

<script>
    const BASEURL = "<?= BASEURL; ?>";
</script>