<?php

include 'includes/db.php';
$result = mysqli_query($conn, "SELECT id, nama, alamat, lat, lng, agama FROM tempat_ibadah");

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

echo json_encode($data);
?>
