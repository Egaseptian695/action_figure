<style>
/* 1. Gaya untuk Area Footer */
/* 1. Gaya untuk Area Footer Diperbaiki */
.footer-section {
    background: #ffffff;
    border: 3px solid #111111; 
    box-shadow: 8px 8px 0px #111111; 
    padding: 50px 20px 20px 20px;
    margin: 60px auto 40px auto; 
    max-width: 1200px; 
    text-align: center;
    color: #111111;
}

.footer-content {
    max-width: 800px;
    margin: 0 auto;
}

.footer-title {
    font-size: 24px;
    font-weight: 900;
    text-transform: uppercase;
    margin-bottom: 15px;
    letter-spacing: 2px;
}

.footer-desc {
    font-size: 16px;
    margin-bottom: 30px;
    line-height: 1.6;
    color: #333333;
}

/* 2. Gaya untuk Tombol Sosial Media */
.social-links {
    display: flex;
    justify-content: center;
    gap: 20px;
    flex-wrap: wrap;
    margin-bottom: 40px;
}

.social-btn {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 25px;
    background: #ffffff;
    color: #111111;
    border: 3px solid #111111;
    font-size: 18px;
    font-weight: bold;
    text-decoration: none;
    text-transform: uppercase;
    box-shadow: 6px 6px 0px #111111;
    transition: 0.2s;
}

.social-btn:hover {
    background: #111111;
    color: #ffffff;
    transform: translate(-3px, -3px);
    box-shadow: 9px 9px 0px #111111;
}

/* 3. Tombol WhatsApp Mengambang di Pojok Kanan Bawah */
.floating-wa {
    position: fixed;
    bottom: 30px;
    right: 30px;
    background: #25D366; /* Warna Hijau Khas WhatsApp */
    color: #111111;
    border: 3px solid #111111;
    padding: 15px 25px;
    font-size: 18px;
    font-weight: 900;
    text-decoration: none;
    text-transform: uppercase;
    box-shadow: 6px 6px 0px #111111;
    z-index: 9999;
    display: flex;
    align-items: center;
    gap: 10px;
    transition: 0.2s;
}

.floating-wa:hover {
    background: #1ebd5c;
    transform: translateY(-5px);
    box-shadow: 6px 11px 0px #111111;
}

/* Copyright teks */
.copyright {
    font-weight: bold;
    text-transform: uppercase;
    font-size: 14px;
    border-top: 2px dashed #111111;
    padding-top: 20px;
    margin-top: 20px;
}
</style>

<footer class="footer-section">
    <div class="footer-content">
        <h2 class="footer-title">NEKOFIGURE.ID</h2>
        <p class="footer-desc">
            Destinasi terbaik untuk para kolektor. Kami menyediakan action figure, mecha, dan model kit 100% Original dari distributor resmi. Punya pertanyaan soal produk atau pre-order? Jangan ragu untuk hubungi kami!
        </p>
        <div style="margin-bottom: 30px;">
    <a href="<?= BASEURL; ?>/home/faq" style="display: inline-block; background: #111111; color: #ffffff; padding: 8px 20px; font-weight: bold; text-decoration: none; text-transform: uppercase; border: 2px solid #111111; box-shadow: 4px 4px 0px #dddddd; transition: 0.2s;">
        <i class="fa-solid fa-book" style="color: rgb(255, 255, 255);"></i> Baca FAQ & Syarat Ketentuan
    </a>
</div>
        <div class="social-links">
            <a href="https://instagram.com/ega_septian695" target="_blank" class="social-btn">
                <i class="fa-brands fa-instagram"></i> Instagram
            </a>
            
            <a href="https://tiktok.com/@egasept" target="_blank" class="social-btn">
                <i class="fa-brands fa-tiktok"></i> TikTok
            </a>
        </div>

        <div class="copyright">
            &copy; <?= date('Y'); ?> NekoFigure.id. All Rights Reserved.
        </div>
    </div>
</footer>

<a href="https://wa.me/6282334184903?text=Halo%20Admin%20NekoFigure,%20saya%20ingin%20bertanya%20seputar%20produk..." target="_blank" class="floating-wa">
    <i class="fa-brands fa-whatsapp" style="font-size: 24px;"></i> Chat Admin
</a>

<script src="<?= BASEURL; ?>/js/script.js"></script>

<script>
    const btnSearch = document.getElementById('toggleSearchBtn');
    const searchBox = document.getElementById('floatingSearchBar');

    if (btnSearch && searchBox) {
        btnSearch.addEventListener('click', function(e) {
            e.preventDefault(); 
            searchBox.classList.toggle('active');
        });

        document.addEventListener('click', function(e) {
            if (!searchBox.contains(e.target) && !btnSearch.contains(e.target)) {
                searchBox.classList.remove('active');
            }
        });
    }
</script>

</body>
</html>