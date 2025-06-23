<?php
session_start();
@include "koneksi.php";

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}

// Query agregasi untuk meja
$agregasi_query = "SELECT 
                    COUNT(*) AS total_meja,
                    MIN(kapasitas) AS kapasitas_min,
                    MAX(kapasitas) AS kapasitas_max,
                    SUM(kapasitas) AS total_kapasitas,
                    AVG(kapasitas) AS rata_kapasitas
                   FROM meja";
$agregasi_result = mysqli_query($conn, $agregasi_query);
$agregasi = mysqli_fetch_assoc($agregasi_result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
</head>
<body>
    <div class="container mt-4">
        <h1>Data Meja Kafe</h1>
        
        <!-- Panel Agregasi -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h5 class="card-title">Total Meja</h5>
                        <h2><?= $agregasi['total_meja'] ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <h5 class="card-title">Kapasitas Min</h5>
                        <h2><?= $agregasi['kapasitas_min'] ?> orang</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-info">
                    <div class="card-body">
                        <h5 class="card-title">Kapasitas Max</h5>
                        <h2><?= $agregasi['kapasitas_max'] ?> orang</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-warning">
                    <div class="card-body">
                        <h5 class="card-title">Rata-rata</h5>
                        <h2><?= round($agregasi['rata_kapasitas'], 1) ?> orang</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4><a href="tambah.php" class="btn btn-primary">Tambah Meja</a></h4>
            <div>
                <span class="badge bg-dark">Total Kapasitas: <?= $agregasi['total_kapasitas'] ?> orang</span>
            </div>
        </div>

        <table class="table table-dark table-striped-columns">
            <thead>
                <tr>
                    <th>ID Meja</th>
                    <th>Nomor Meja</th>
                    <th>Kapasitas</th>
                    <th>Status</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $query = "SELECT m.*, 
                         (SELECT COUNT(*) FROM reservasi r 
                          WHERE r.id_meja = m.id_meja AND r.tanggal = CURDATE()) AS jumlah_reservasi
                         FROM meja m";
                $data = mysqli_query($conn, $query);
                
                while ($row = mysqli_fetch_array($data)) {
                    $status = $row['jumlah_reservasi'] > 0 ? 'Terpakai' : 'Tersedia';
                    $badge_class = $status == 'Terpakai' ? 'bg-danger' : 'bg-success';
                    
                    echo "<tr>
                            <td>{$row['id_meja']}</td>
                            <td>{$row['nomor_meja']}</td>
                            <td>{$row['kapasitas']} orang</td>
                            <td><span class='badge $badge_class'>$status</span></td>
                            <td>
                                <a href='edit.php?id_meja={$row['id_meja']}' class='btn btn-sm btn-warning'>Edit</a>
                                <a href='hapus.php?id_meja={$row['id_meja']}' class='btn btn-sm btn-danger' 
                                   onclick='return confirm(\"Apakah anda yakin akan menghapus data ini?\")'>Hapus</a>
                            </td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>