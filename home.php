<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<?php include 'includes/header.php'; ?>

<style>
    body {
        background: url('img/tempat-ibadah.jpg') no-repeat center center fixed;
        background-size: cover;
        font-family: 'Inter', sans-serif;
        margin: 0;
        padding: 0;
    }

    .home-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 80vh;
        text-align: center;
        padding: 50px 20px;
    }

    .home-box {
        background: rgba(255, 255, 255, 0.85);
        padding: 40px 30px;
        border-radius: 15px;
        max-width: 800px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }

    .home-box h1 {
        font-size: 48px;
        margin-bottom: 20px;
        color: #2c3e50;
    }

    .home-box h2 {
        font-size: 32px;
        margin-bottom: 15px;
        color: #2c3e50;
    }

    .home-box p {
        font-size: 18px;
        color: #333;
        margin-bottom: 15px;
        line-height: 1.6;
    }

    .home-box a {
        display: inline-block;
        background-color: #FFD700;
        color: black;
        padding: 12px 24px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: bold;
        transition: background 0.3s ease;
    }

    .home-box a:hover {
        background-color: #e0c200;
    }
</style>

<div class="home-container">
    <div class="home-box">
        <h1>Selamat Datang</h1>
        <p>Website ini merupakan <strong>Sistem Informasi Geografis (SIG)</strong> yang membantu masyarakat mencari informasi tentang <strong>tempat-tempat ibadah di Kota Pekanbaru</strong>.</p>
        <p>Data yang tersedia meliputi <strong>Masjid, Gereja, Vihara, Klenteng, dan Pura</strong> yang tersebar di seluruh wilayah Kota Pekanbaru.</p>
        <p>Anda dapat melihat lokasi tempat ibadah secara langsung melalui peta interaktif dan mengetahui detail informasi setiap tempat ibadah yang tersedia.</p>
        <a href="index.php">Lihat Beranda</a>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
