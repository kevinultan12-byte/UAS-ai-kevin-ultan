    <?php
    include 'includes/db.php';
    include 'includes/header.php';
    ?>

    <style>
        body {
            background: url('img/tempat-ibadah.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
        }
    </style>

    <?php
    function getAgamaCounts($conn) {
        $counts = [];
        $query = mysqli_query($conn, "SELECT agama, COUNT(*) as jumlah FROM tempat_ibadah GROUP BY agama");
        while ($row = mysqli_fetch_assoc($query)) {
            $counts[$row['agama']] = $row['jumlah'];
        }
        return $counts;
    }

    function getTotalCount($conn) {
        $query = mysqli_query($conn, "SELECT COUNT(*) as total FROM tempat_ibadah");
        $result = mysqli_fetch_assoc($query);
        return $result['total'];
    }

    // Ambil parameter filter jika ada
    $filter_agama = isset($_GET['agama']) ? $_GET['agama'] : '';

    if (isset($_GET['id'])) {
        // ---------------------------
        // MODE: Tampilkan satu tempat ibadah
        // ---------------------------
        $id = intval($_GET['id']);
        $query = mysqli_query($conn, "SELECT * FROM tempat_ibadah WHERE id = $id");

        if (mysqli_num_rows($query) == 0) {
            echo "<p>Data tidak ditemukan.</p>";
        } else {
            $data = mysqli_fetch_assoc($query);
            ?>

            <style>
                .detail-container {
                    max-width: 800px;
                    margin: 30px auto;
                    background: white;
                    padding: 30px;
                    border-radius: 12px;
                    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
                }
                .detail-container h2 {
                    margin-top: 0;
                }
                .detail-container img {
                    max-width: 100%;
                    height: auto;
                    margin-top: 20px;
                    border-radius: 10px;
                }
            </style>

            <div class="detail-container">
                <h2><?= htmlspecialchars($data['nama']) ?></h2>
                <p><strong>Alamat:</strong> <?= htmlspecialchars($data['alamat']) ?></p>
                <p><strong>Agama:</strong> <?= htmlspecialchars($data['agama']) ?></p>
                <p><strong>Latitude:</strong> <?= htmlspecialchars($data['lat']) ?></p>
                <p><strong>Longitude:</strong> <?= htmlspecialchars($data['lng']) ?></p>

                <?php if (!empty($data['gambar'])): ?>
                    <img src="img/<?= htmlspecialchars($data['gambar']) ?>" alt="<?= htmlspecialchars($data['nama']) ?>">
                <?php else: ?>
                    <p><em>Gambar belum tersedia.</em></p>
                <?php endif; ?>
            </div>

            <?php
        }

    } else {
        // ---------------------------
        // MODE: Tampilkan semua atau berdasarkan filter agama
        // ---------------------------

        $agamaCounts = getAgamaCounts($conn);
        $totalCount = getTotalCount($conn);

        // Query data
        if (!empty($filter_agama)) {
            $stmt = $conn->prepare("SELECT * FROM tempat_ibadah WHERE agama = ? ORDER BY nama ASC");
            $stmt->bind_param("s", $filter_agama);
            $stmt->execute();
            $result = $stmt->get_result();
        } else {
            $result = mysqli_query($conn, "SELECT * FROM tempat_ibadah ORDER BY nama ASC");
        }
        ?>

        <style>
            .list-container {
                max-width: 1000px;
                margin: 30px auto;
                padding: 20px;
                background: #fff;
                border-radius: 12px;
                box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            }

            .summary-box {
                background: #f8f9fa;
                padding: 20px;
                border-radius: 10px;
                margin-bottom: 20px;
            }

            .summary-box h3 {
                margin-top: 0;
            }

            .agama-counts {
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
                margin-top: 10px;
            }

            .agama-counts a {
                text-decoration: none;
                background: #e9ecef;
                padding: 8px 15px;
                border-radius: 8px;
                font-weight: bold;
                color: #333;
                transition: background 0.2s;
            }

            .agama-counts a:hover {
                background: #ced4da;
            }

            .agama-counts .active {
                background: #0d6efd;
                color: white;
            }

            .ibadah-item {
                display: flex;
                align-items: center;
                margin-bottom: 20px;
                border-bottom: 1px solid #eee;
                padding-bottom: 15px;
            }

            .ibadah-item img {
                width: 100px;
                height: auto;
                margin-right: 20px;
                border-radius: 8px;
                object-fit: cover;
            }

            .ibadah-item h3 {
                margin: 0;
            }

            .ibadah-info {
                flex: 1;
            }
        </style>

        <div class="list-container">
            <h2>Daftar Tempat Ibadah di Pekanbaru</h2>

            <!-- Summary Count Box -->
            <div class="summary-box">
                <h3>Total Tempat Ibadah: <?= $totalCount ?></h3>

                <div class="agama-counts">
                    <a href="ibadah.php" class="<?= $filter_agama == '' ? 'active' : '' ?>">Semua (<?= $totalCount ?>)</a>
                    <?php foreach ($agamaCounts as $agama => $jumlah): ?>
                        <a href="ibadah.php?agama=<?= urlencode($agama) ?>" class="<?= $filter_agama == $agama ? 'active' : '' ?>">
                            <?= htmlspecialchars($agama) ?> (<?= $jumlah ?>)
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- List Data -->
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                    <div class="ibadah-item">
                        <img src="img/<?= htmlspecialchars($row['gambar']) ?>" alt="<?= htmlspecialchars($row['nama']) ?>">
                        <div class="ibadah-info">
                            <h3><a href="ibadah.php?id=<?= $row['id'] ?>"><?= htmlspecialchars($row['nama']) ?></a></h3>
                            <p><?= htmlspecialchars($row['alamat']) ?></p>
                            <p><strong><?= htmlspecialchars($row['agama']) ?></strong></p>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p><em>Tidak ada data untuk kategori ini.</em></p>
            <?php endif; ?>
        </div>

        <?php
    }
    ?>

    <br><br>

    <?php include 'includes/footer.php'; ?>
