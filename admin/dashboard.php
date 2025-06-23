<?php

    @include "koneksi.php";

    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP dan MYSQL - Menampilkan data dari DATABASE MYSQL dengan PHP </title>
</head>
<body>
    <div class="container">
        
    <h1>Data meja kafe </h1>
    <br>
    <h4><a href="tambah.php">Tambah meja</a></h4>

        <table  class="table table-dark table-striped-columns">
        <thead>
            <th>id meja</th>
            <th>nomor meja</th>
            <th>kapasitas</th>
            <th>Opsi</th>
        </thead>
        <?php 
        $query = "SELECT * FROM meja";
        $data = mysqli_query($conn,$query);
        while ($row = mysqli_fetch_array($data)){
        ?>
        <tr>
            <td><?php echo $row['id_meja'];?></td>
            
            <td><?php echo $row['nomor_meja'];?></td>
        
            <td><?php echo $row['kapasitas'];?></td>
            <td>
                <a href="edit.php?id_meja=<?php echo $row['id_meja'];?>">Edit</a> ||
                <a href="hapus.php?id_meja=<?php echo $row['id_meja'];?>"onclick="return confirm('apakah anda yakin akan menghapus data ini?')">Hapus</a>
            </td>
        </tr>
        <?php
        }
        ?>
    </table>
    </div>
</body>
</html>