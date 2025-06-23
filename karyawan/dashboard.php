<?php 
@include "koneksi.php";

// Cek role user
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'karyawan') {
    header("Location: ../login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <title>Reservasi Meja Kafe</title>
    <style>
        .available {
            background-color: #28a745 !important;
            color: white;
        }
        .occupied {
            background-color: #dc3545 !important;
            color: white;
        }
        .meja-card {
            cursor: pointer;
            transition: all 0.3s;
        }
        .meja-card:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4">Reservasi Meja Kafe</h1>
        
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Form Reservasi</h5>
                    </div>
                    <div class="card-body">
                        <form action="proses_reservasi.php" method="POST">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Pelanggan</label>
                                <input type="text" class="form-control" id="nama" name="nama" required>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal Reservasi</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                            </div>
                            <div class="mb-3">
                                <label for="waktu" class="form-label">Waktu Reservasi</label>
                                <input type="time" class="form-control" id="waktu" name="waktu" required>
                            </div>
                            <div class="mb-3">
                                <label for="jumlah_orang" class="form-label">Jumlah Orang</label>
                                <input type="number" class="form-control" id="jumlah_orang" name="jumlah_orang" min="1" required>
                            </div>
                            <div class="mb-3">
                                <label for="id_meja" class="form-label">Nomor Meja</label>
                                <select class="form-select" id="id_meja" name="id_meja" required>
                                    <option value="">Pilih Meja</option>
                                    <?php
                                    @include "koneksi.php";
                                    $data = mysqli_query($conn, "SELECT * FROM meja ORDER BY nomor_meja");
                                    while ($row = mysqli_fetch_array($data)) {
                                        echo "<option value='".$row['id_meja']."'>Meja ".$row['nomor_meja']." (Kapasitas: ".$row['kapasitas']." orang)</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Reservasi</button>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">Status Meja</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <?php
                            $data = mysqli_query($conn, "SELECT * FROM meja ORDER BY nomor_meja");
                            while ($row = mysqli_fetch_array($data)) {
                                // Cek apakah meja sedang dipesan (dalam database reservasi)
                                $id_meja = $row['id_meja'];
                                $query_reservasi = mysqli_query($conn, "SELECT * FROM reservasi WHERE id_meja='$id_meja' AND tanggal=CURDATE()");
                                $status = (mysqli_num_rows($query_reservasi) > 0) ? 'occupied' : 'available';
                                
                                echo '<div class="col-md-4 mb-3">';
                                echo '<div class="card meja-card '.$status.'">';
                                echo '<div class="card-body text-center">';
                                echo '<h5 class="card-title">Meja '.$row['nomor_meja'].'</h5>';
                                echo '<p class="card-text">Kapasitas: '.$row['kapasitas'].' orang</p>';
                                echo '<p class="card-text"><strong>'.ucfirst($status).'</strong></p>';
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card">
            <div class="card-header bg-warning text-dark">
                <h5 class="mb-0">Daftar Reservasi Hari Ini</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pelanggan</th>
                            <th>Meja</th>
                            <th>Waktu</th>
                            <th>Jumlah Orang</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT r.*, m.nomor_meja 
                                  FROM reservasi r 
                                  JOIN meja m ON r.id_meja = m.id_meja 
                                  WHERE r.tanggal = CURDATE() 
                                  ORDER BY r.waktu";
                        $result = mysqli_query($conn, $query);
                        $no = 1;
                        
                        while ($row = mysqli_fetch_array($result)) {
                            echo '<tr>';
                            echo '<td>'.$no++.'</td>';
                            echo '<td>'.$row['nama'].'</td>';
                            echo '<td>Meja '.$row['nomor_meja'].'</td>';
                            echo '<td>'.date('H:i', strtotime($row['waktu'])).'</td>';
                            echo '<td>'.$row['jumlah_orang'].'</td>';
                            echo '<td>';
                            echo '<a href="edit_reservasi.php?id='.$row['id_reservasi'].'" class="btn btn-sm btn-primary">Edit</a> ';
                            echo '<a href="hapus_reservasi.php?id='.$row['id_reservasi'].'" class="btn btn-sm btn-danger" onclick="return confirm(\'Yakin ingin membatalkan reservasi?\')">Hapus</a>';
                            echo '</td>';
                            echo '</tr>';
                        }
                        
                        if ($no == 1) {
                            echo '<tr><td colspan="7" class="text-center">Tidak ada reservasi hari ini</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Update waktu secara real-time
        document.getElementById('tanggal').valueAsDate = new Date();
        
        // Validasi jumlah orang sesuai kapasitas meja
        document.getElementById('id_meja').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            if (selectedOption) {
                const kapasitas = parseInt(selectedOption.text.match(/Kapasitas: (\d+)/)[1]);
                document.getElementById('jumlah_orang').max = kapasitas;
                if (parseInt(document.getElementById('jumlah_orang').value) > kapasitas) {
                    document.getElementById('jumlah_orang').value = kapasitas;
                }
            }
        });
    </script>
</body>
</html>