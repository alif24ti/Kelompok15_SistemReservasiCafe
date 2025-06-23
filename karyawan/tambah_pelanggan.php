<?php 
include "koneksi.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pelanggan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Tambah Pelanggan</h2>
        
        <form action="proses_tambah_pelanggan.php" method="POST">
            <div class="mb-3">
                <label class="form-label">Nama Pelanggan</label>
                <input type="text" class="form-control" name="nama" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Telepon</label>
                <input type="text" class="form-control" name="no_telepon" required>
            </div>
            
            
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="pelanggan.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>