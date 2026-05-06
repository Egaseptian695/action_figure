<style>
/* Kontainer Utama untuk menengahkan form */
.auth-container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 70vh;
    padding: 20px;
}

/* Card Login B/W Retro */
.auth-card {
    background: #ffffff;
    width: 100%;
    max-width: 400px;
    padding: 40px;
    border: 2px solid #111111;
    box-shadow: 8px 8px 0px #111111; /* Shadow padat khas tema kita */
}

.auth-card h2 {
    text-align: center;
    margin-bottom: 30px;
    text-transform: uppercase;
    letter-spacing: 2px;
    font-size: 24px;
    border-bottom: 2px solid #111111;
    display: inline-block;
    padding-bottom: 10px;
    width: 100%;
}

/* Form Styling */
.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
    text-transform: uppercase;
    font-size: 14px;
    letter-spacing: 0.5px;
}

.form-group input {
    width: 100%;
    padding: 12px;
    border: 1px solid #111111;
    font-size: 16px;
    outline: none;
    transition: all 0.2s;
    background: #f9f9f9;
}

.form-group input:focus {
    border: 2px solid #111111;
    background: #ffffff;
}

/* Tombol Login */
.btn-submit {
    width: 100%;
    padding: 15px;
    background: #111111;
    color: #ffffff;
    border: 2px solid #111111;
    font-size: 16px;
    font-weight: bold;
    text-transform: uppercase;
    cursor: pointer;
    transition: 0.3s;
    margin-top: 10px;
}

.btn-submit:hover {
    background: #ffffff;
    color: #111111;
}

/* Link Navigasi Bawah */
.auth-links {
    margin-top: 25px;
    text-align: center;
    font-size: 14px;
}

.auth-links p {
    margin-bottom: 10px;
}

.auth-links a {
    color: #111111;
    font-weight: bold;
    text-decoration: none;
    border-bottom: 1px solid #111111;
    transition: 0.2s;
}

.auth-links a:hover {
    color: #ffffff;
    background: #111111;
}
</style>

<div class="auth-container">
    <div class="auth-card">
        <h2>Masuk Akun</h2>
        
        <!-- Form action diarahkan ke method prosesLogin di Auth Controller -->
        <form action="<?= BASEURL; ?>/auth/prosesLogin" method="POST">
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Masukkan email kamu..." required>
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Masukkan password..." required>
            </div>
            
            <button type="submit" class="btn-submit">Login</button>
            
        </form>

        <div class="auth-links">
            <p>Belum punya akun?</p>
            <a href="<?= BASEURL; ?>/auth/register">Daftar Sekarang</a>
        </div>
    </div>
</div>