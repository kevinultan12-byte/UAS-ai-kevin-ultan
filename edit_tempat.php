<?php 
session_start();
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header("Location: login.php");
    exit;
}

include 'includes/db.php'; 
include 'includes/header.php';

if (!isset($_GET['id'])) {
    header('Location: admin.php');
    exit;
}

$id = intval($_GET['id']);
$query = mysqli_query($conn, "SELECT * FROM tempat_ibadah WHERE id = $id");
if (mysqli_num_rows($query) == 0) {
    echo "<p>Data tidak ditemukan.</p>";
    include 'includes/footer.php';
    exit;
}

$tempat = mysqli_fetch_assoc($query);
?>

<style>
    body {
        background: url('img/tempat-ibadah.jpg') no-repeat center center fixed;
        background-size: cover;
        font-family: 'Inter', sans-serif;
        margin: 0;
        padding: 0;
    }

    .form-container {
        max-width: 700px;
        margin: 50px auto;
        background-color: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .form-container h3 {
        text-align: center;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        font-weight: bold;
    }

    input[type="text"],
    select,
    input[type="file"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 14px;
    }

    .preview-image {
        max-width: 100%;
        border-radius: 8px;
        margin-top: 10px;
    }

    button {
        background-color: #e0c200;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        width: 100%;
        font-size: 16px;
    }

    button:hover {
        background-color: #d4b000;
    }

    #map {
        height: 350px;
        border-radius: 8px;
        margin-top: 10px;
    }
</style>

<div class="form-container">
    <h3>Edit Tempat Ibadah</h3>
    <form action="proses_edit.php" method="post" enctype="multipart/form-data">

        <input type="hidden" name="id" value="<?= htmlspecialchars($tempat['id']) ?>">

        <div class="form-group">
            <label for="nama">Nama Tempat Ibadah:</label>
            <input type="text" id="nama" name="nama" required value="<?= htmlspecialchars($tempat['nama']) ?>">
        </div>

        <div class="form-group">
            <label for="alamat">Alamat:</label>
            <input type="text" id="alamat" name="alamat" required value="<?= htmlspecialchars($tempat['alamat']) ?>" readonly>
        </div>

        <div class="form-group">
            <label for="agama">Agama:</label>
            <select name="agama" id="agama" required>
                <?php 
                $agamaOptions = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'];
                foreach ($agamaOptions as $agama) {
                    $selected = ($tempat['agama'] == $agama) ? 'selected' : '';
                    echo "<option value=\"$agama\" $selected>$agama</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="lat">Latitude:</label>
            <input type="text" id="lat" name="lat" required value="<?= htmlspecialchars($tempat['lat']) ?>">
        </div>

        <div class="form-group">
            <label for="lng">Longitude:</label>
            <input type="text" id="lng" name="lng" required value="<?= htmlspecialchars($tempat['lng']) ?>">
        </div>

        <div class="form-group">
            <input id="inputSearch" type="text" class="form-control" placeholder="Cari alamat...">
            <button type="button" id="btnSearch" class="btn btn-primary mt-2">Cari</button>
        </div>

        <div id="map"></div>

        <div class="form-group">
            <label>Gambar Saat Ini:</label>
            <?php if ($tempat['gambar'] && file_exists('img/'.$tempat['gambar'])): ?>
                <img src="img/<?= htmlspecialchars($tempat['gambar']) ?>" alt="Gambar" class="preview-image">
            <?php else: ?>
                <p>Tidak ada gambar.</p>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="gambar">Upload Gambar Baru jika ingin ganti:</label>
            <input type="file" name="gambar" id="gambar" accept="image/*">
        </div>

        <div class="form-group">
            <button type="submit">Update</button>
        </div>

    </form>
</div>

<?php include 'includes/footer.php'; ?>

<script>
    let map, marker, geocoder;

    function initMap() {
        const initialLat = parseFloat("<?= $tempat['lat'] ?>");
        const initialLng = parseFloat("<?= $tempat['lng'] ?>");
        const initialPos = { lat: initialLat, lng: initialLng };

        map = new google.maps.Map(document.getElementById("map"), {
            center: initialPos,
            zoom: 15,
        });

        geocoder = new google.maps.Geocoder();

        marker = new google.maps.Marker({
            position: initialPos,
            map: map,
            draggable: true,
        });

        marker.addListener("dragend", () => {
            const pos = marker.getPosition();
            updatePositionInputs(pos.lat(), pos.lng());
            geocodeLatLng(pos);
        });

        map.addListener("click", (event) => {
            const pos = event.latLng;
            marker.setPosition(pos);
            updatePositionInputs(pos.lat(), pos.lng());
            geocodeLatLng(pos);
        });

        document.getElementById("btnSearch").addEventListener("click", () => {
            const address = document.getElementById("inputSearch").value;
            if (!address) {
                alert("Masukkan alamat yang ingin dicari!");
                return;
            }
            geocoder.geocode({ address: address }, (results, status) => {
                if (status === "OK") {
                    const loc = results[0].geometry.location;
                    map.setCenter(loc);
                    marker.setPosition(loc);
                    updatePositionInputs(loc.lat(), loc.lng());
                    document.getElementById("alamat").value = results[0].formatted_address;
                } else {
                    alert("Pencarian gagal: " + status);
                }
            });
        });

        document.getElementById("lat").addEventListener("change", updateMarkerFromInput);
        document.getElementById("lng").addEventListener("change", updateMarkerFromInput);
    }

    function updatePositionInputs(lat, lng) {
        document.getElementById("lat").value = lat.toFixed(6);
        document.getElementById("lng").value = lng.toFixed(6);
    }

    function geocodeLatLng(latLng) {
        geocoder.geocode({ location: latLng }, (results, status) => {
            if (status === "OK" && results[0]) {
                document.getElementById("alamat").value = results[0].formatted_address;
            }
        });
    }

    function updateMarkerFromInput() {
        const lat = parseFloat(document.getElementById("lat").value);
        const lng = parseFloat(document.getElementById("lng").value);
        if (!isNaN(lat) && !isNaN(lng)) {
            const newLatLng = { lat: lat, lng: lng };
            marker.setPosition(newLatLng);
            map.setCenter(newLatLng);
            geocodeLatLng(newLatLng);
        }
    }
</script>

<!-- 🔑 Google Maps API Key -->
<script src="https://maps.google.com/maps/api/js?key=AIzaSyA1MgLuZuyqR_OGY3ob3M52N46TDBRI_9k&callback=initMap" async defer></script>
