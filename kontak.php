<?php include 'includes/header.php'; ?>

<style>
     body {
        background: url('img/tempat-ibadah.jpg') no-repeat center center fixed;
        background-size: cover;
        font-family: 'Inter', sans-serif;
        margin: 0;
        padding: 0;
    }
    .contact-container {
        max-width: 900px;
        margin: 30px auto;
        background-color: #fff;
        border-radius: 10px;
        padding: 25px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .contact-container h3 {
        margin-top: 0;
        color: #2c3e50;
    }

    .contact-info {
        margin-top: 20px;
        line-height: 1.8;
        font-size: 16px;
    }

    .contact-info a {
        color: #3498db;
        text-decoration: none;
    }

    .contact-info a:hover {
        text-decoration: underline;
    }

    #map {
        height: 400px;
        width: 100%;
        margin-top: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
</style>

<div class="contact-container">
    <h3>Hubungi Kami</h3>

    <div id="map"></div>

    <div class="contact-info">
        <p><strong>WhatsApp:</strong> <a href="https://wa.me/6289512456174" target="_blank">+62 895-1245-6174</a></p>
        <p><strong>Instagram:</strong> <a href="https://instagram.com/m.kelvin_27" target="_blank">@m.kelvin_27</a></p>
        <p><strong>Email:</strong> <a href="mailto:kelvinsimaba27@gmail.com">kelvinsimaba27@gmail.com</a></p>
    </div>
</div>

<script>
    function initMap() {
        const fakultasIlkomUnilak = { lat: 0.579497, lng: 101.423722 };

        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 17,
            center: fakultasIlkomUnilak,
        });

        const marker = new google.maps.Marker({
            position: fakultasIlkomUnilak,
            map: map,
            title: "Fakultas Ilmu Komputer UNILAK",
        });
    }
</script>

<!-- Ganti YOUR_API_KEY dengan kunci API Google Maps kamu -->
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1MgLuZuyqR_OGY3ob3M52N46TDBRI_9k&callback=initMap">
</script>


<br>

<?php include 'includes/footer.php'; ?>
