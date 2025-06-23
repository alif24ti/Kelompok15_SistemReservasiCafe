<?php
session_start();
@include "koneksi.php";

// Ambil data reservasi yang akan diedit
$id_reservasi = $_GET['id'];
$query = "SELECT r.*, m.nomor_meja 
          FROM reservasi r 
          JOIN meja m ON r.id_meja = m.id_meja 
          WHERE r.id_reservasi = '$id_reservasi'";
$data = mysqli_query($conn, $query);
$reservasi = mysqli_fetch_assoc($data);

// Jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $tanggal = $_POST['tanggal'];
    $waktu = $_POST['waktu'];
    $jumlah_orang = $_POST['jumlah_orang'];
    $id_meja = $_POST['id_meja'];

    // Update data reservasi
    $update = "UPDATE reservasi SET 
               nama = '$nama',
               tanggal = '$tanggal',
               waktu = '$waktu',
               jumlah_orang = '$jumlah_orang',
               id_meja = '$id_meja'
               WHERE id_reservasi = '$id_reservasi'";

    if (mysqli_query($conn, $update)) {
        header("Location: reservasi.php?status=success&message=Reservasi berhasil diupdate");
        exit();
    } else {
        header("Location: edit_reservasi.php?id=$id_reservasi&status=error&message=Gagal mengupdate reservasi");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit Reservasi</title>
</head>
<body>
    <div class="container mt-4">
        <h2>Edit Reservasi</h2>
        
        <form method="POST">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Pelanggan</label>
                <input type="text" class="form-control" id="nama" name="nama" 
                       value="<?= htmlspecialchars($reservasi['nama']) ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal Reservasi</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" 
                       value="<?= $reservasi['tanggal'] ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="waktu" class="form-label">Waktu Reservasi</label>
                <input type="time" class="form-control" id="waktu" name="waktu" 
                       value="<?= substr($reservasi['waktu'], 0, 5) ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="jumlah_orang" class="form-label">Jumlah Orang</label>
                <input type="number" class="form-control" id="jumlah_orang" name="jumlah_orang" 
                       value="<?= $reservasi['jumlah_orang'] ?>" min="1" required>
            </div>
            
            <div class="mb-3">
                <label for="id_meja" class="form-label">Nomor Meja</label>
                <select class="form-select" id="id_meja" name="id_meja" required>
                    <?php
                    $query_meja = mysqli_query($conn, "SELECT * FROM meja ORDER BY nomor_meja");
                    while ($meja = mysqli_fetch_assoc($query_meja)) {
                        $selected = ($meja['id_meja'] == $reservasi['id_meja']) ? 'selected' : '';
                        echo "<option value='{$meja['id_meja']}' $selected>
                              Meja {$meja['nomor_meja']} (Kapasitas: {$meja['kapasitas']} orang)
                              </option>";
                    }
                    ?>
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="reservasi.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    <script>
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