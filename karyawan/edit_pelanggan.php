<?php
session_start();
include "koneksi.php";

$id = $_GET['id'];
$query = "SELECT * FROM pelanggan WHERE id_pelanggan = $id";
$result = mysqli_query($conn, $query);
$pelanggan = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pelanggan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Edit Pelanggan</h2>
        
        <form action="proses_edit_pelanggan.php" method="POST">
            <input type="hidden" name="id" value="<?= $pelanggan['id_pelanggan'] ?>">
            
            <div class="mb-3">
                <label class="form-label">Nama Pelanggan</label>
                <input type="text" class="form-control" name="nama" value="<?= $pelanggan['nama'] ?>" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="<?= $pelanggan['email'] ?>" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Telepon</label>
                <input type="text" class="form-control" name="no_telepon" value="<?= $pelanggan['no_telepon'] ?>" required>
            </div>
    
            
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="pelanggan.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>