<?php include 'includes/header.php'; ?>

<style>
     body {
        background: url('img/tempat-ibadah.jpg') no-repeat center center fixed;
        background-size: cover;
        font-family: 'Inter', sans-serif;
        margin: 0;
        padding: 0;
    }
    .content-section {
        max-width: 800px;
        margin: 30px auto;
        background-color: #fff;
        border-radius: 10px;
        padding: 25px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        color: #333;
        line-height: 1.6;
    }

    .hidden {
        display: none;
    }

    .content-section h3 {
        margin-top: 0;
        color: #2c3e50;
    }

    .content-section p {
        text-align: justify;
    }
</style>

<div class="content-section" id="tentang">
    <h3>Tentang Sistem Informasi Geografis (SIG) Tempat Ibadah</h3>
    <p><strong>Sistem Informasi Geografis (SIG) Tempat Ibadah di Pekanbaru</strong> adalah sistem berbasis web yang dirancang untuk menampilkan data spasial lokasi tempat ibadah seperti mesjid, gereja, vihara, klenteng, dan pura yang tersebar di wilayah Kota Pekanbaru.</p>
    <p>Tujuan utama sistem ini adalah memberikan kemudahan kepada masyarakat, pemerintah, dan instansi terkait dalam mengetahui lokasi tempat ibadah secara cepat dan akurat. Informasi ini berguna untuk mendukung proses perencanaan tata ruang, pemantauan izin dan pajak reklame, serta menjaga kenyamanan dan ketertiban lingkungan di sekitar kawasan ibadah.</p>
    <p>Setiap tempat ibadah pada peta ditandai dengan ikon marker yang berbeda-beda sesuai jenisnya, dan dilengkapi dengan legenda penjelas di samping peta. Sistem ini dapat dikembangkan lebih lanjut untuk menyertakan fitur interaktif seperti informasi detail tiap lokasi, pencarian berdasarkan jenis tempat ibadah, hingga pelaporan masyarakat secara langsung.</p>
</div>

<br>

<?php include 'includes/footer.php'; ?>
