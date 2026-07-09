<?php include 'includes/db.php'; ?>
<?php include 'includes/header.php'; ?>

<!-- Google Fonts & Icons -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

<style>
    
     body {
        background: url('img/tempat-ibadah.jpg') no-repeat center center fixed;
        background-size: cover;
        font-family: 'Inter', sans-serif;
        margin: 0;
        padding: 0;
    }

    .map-search {
        display: flex;
        justify-content: center;
        margin: 30px 0 10px 0;
    }

    .search-form {
        display: flex;
        align-items: center;
        border-radius: 40px;
        overflow: hidden;
        background-color: #fff;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        max-width: 600px;
        width: 100%;
        border: 1px solid #ddd;
    }

    .search-form input[type="text"] {
        flex: 1;
        padding: 14px 20px;
        border: none;
        font-size: 16px;
    }

    .search-form button {
        padding: 14px 24px;
        background: linear-gradient(to right, #87A8A4, #D6A77A);
        color: white;
        border: none;
        font-weight: bold;
        cursor: pointer;
        transition: background 0.3s ease;
        border-top-right-radius: 40px;
        border-bottom-right-radius: 40px;
    }

    .search-form button:hover {
        background: linear-gradient(to right, #1f2e3d, #2c3e50);
    }

    .map-wrapper {
        display: flex;
        justify-content: center;
        align-items: flex-start;
        padding: 20px;
        gap: 30px;
        flex-wrap: wrap;
    }

    .map-container {
        flex: 1;
        min-width: 60%;
        height: 520px;
        border-radius: 15px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        overflow: hidden;
        background: #D6A77A;
    }

    .legend-box {
        background:  #D6A77A;
        border-radius: 16px;
        padding: 20px 25px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        width: 260px;
        font-size: 16px;
        transition: transform 0.3s ease;
    }

    .legend-box:hover {
        transform: translateY(-3px);
    }

    .legend-box h4 {
        margin-bottom: 20px;
        font-weight: 700;
        text-align: center;
        border-bottom: 2px solid #ccc;
        padding-bottom: 8px;
        color: #2c3e50;
    }

    .legend-item {
        display: flex;
        align-items: center;
        margin-bottom: 14px;
    }

    .legend-item img {
        width: 28px;
        height: 28px;
        margin-right: 12px;
        border-radius: 6px;
        border: 1px solid #ccc;
    }

    @media screen and (max-width: 768px) {
        .map-wrapper {
            flex-direction: column;
            align-items: center;
        }

        .legend-box {
            width: 90%;
        }

        .map-container {
            width: 100%;
        }
    }
</style>

<!-- FORM CARI -->
<div class="map-search">
    <form method="GET" class="search-form">
        <input type="text" name="search" placeholder="Cari tempat ibadah..." value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
        <button type="submit">Cari</button>
    </form>
</div>


<!-- MAP + LEGENDA -->
<div class="map-wrapper">
    <div class="map-container" id="map"></div>
    <div class="legend-box">
        <h4>LEGENDA</h4>
        <div class="legend-item"><img src="img/mesjid.jpg" alt="Mesjid"> Mesjid</div>
        <div class="legend-item"><img src="img/gereja.jpg" alt="Gereja"> Gereja</div>
        <div class="legend-item"><img src="img/vihara.jpg" alt="Vihara"> Vihara</div>
        <div class="legend-item"><img src="img/klenteng.jpg" alt="Klenteng"> Klenteng</div>
        <div class="legend-item"><img src="img/pura.jpg" alt="Pura"> Pura</div>
    </div>
</div>

<script src="js/map.js"></script>
<script>
    const searchQuery = <?= json_encode(isset($_GET['search']) ? $_GET['search'] : '') ?>;
</script>

<br>
<br>
<br>
<br>
<br>

<?php include 'includes/footer.php'; ?>
