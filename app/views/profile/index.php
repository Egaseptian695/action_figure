<?php /** @var array $data */ ?>

<style>
.profile-container {
    max-width: 800px;
    margin: 60px auto;
    padding: 0 20px;
}

.profile-card {
    background: #ffffff;
    border: 3px solid #111111;
    box-shadow: 10px 10px 0px #111111;
    padding: 40px;
    display: flex;
    gap: 30px;
    align-items: center;
}

.profile-avatar {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    border: 3px solid #111111;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 60px;
    background: #f4f4f4;
    box-shadow: 4px 4px 0px #111111;
    flex-shrink: 0;
}

.profile-info {
    flex: 1;
}

.profile-info h1 {
    font-size: 28px;
    text-transform: uppercase;
    margin-bottom: 5px;
    border-bottom: 2px solid #111111;
    display: inline-block;
    padding-bottom: 5px;
}

.profile-info p {
    font-size: 16px;
    color: #555555;
    margin-bottom: 10px;
}

.info-label {
    font-weight: bold;
    text-transform: uppercase;
    font-size: 12px;
    color: #111111;
    display: block;
    margin-top: 15px;
}

.info-value {
    font-size: 18px;
    font-weight: bold;
    background: #f9f9f9;
    padding: 10px;
    border: 1px solid #111111;
    display: inline-block;
    min-width: 250px;
    margin-top: 5px;
}

/* Responsif untuk layar HP */
@media (max-width: 600px) {
    .profile-card {
        flex-direction: column;
        text-align: center;
    }
    .profile-info h1 {
        margin-top: 20px;
    }
    .info-value {
        width: 100%;
    }
}
</style>

<div class="profile-container">
    <div class="profile-card">
        
        <!-- Avatar Dummy Sederhana -->
        <div class="profile-avatar">
            <i class="fa-regular fa-user" style="color: rgb(28, 37, 53);"></i>
        </div>

        <div class="profile-info">
            <h1>Profil Saya</h1>
            
            <span class="info-label">Nama Lengkap</span>
            <div class="info-value"><?= $data['user']['nama'] ?? 'Belum ada nama'; ?></div>
            
            <span class="info-label">Email Terdaftar</span>
            <div class="info-value"><?= $data['user']['email'] ?? 'Belum ada email'; ?></div>

            <span class="info-label">Role Akses</span>
            <div class="info-value" style="text-transform: uppercase;"><?= $data['user']['role'] ?? 'Customer'; ?></div>

            <a href="<?= BASEURL; ?>/profile/pesanan" style="display: inline-block; margin-top: 30px; padding: 12px 25px; background: #111111; color: #ffffff; text-decoration: none; font-weight: bold; text-transform: uppercase; border: 2px solid #111111; box-shadow: 4px 4px 0px #111111; transition: 0.2s;">
                <i class="fa-solid fa-cart-shopping" style="color: rgb(255, 255, 255);"></i> Lihat Riwayat Pesanan
            </a>
        </div>

    </div>
</div>