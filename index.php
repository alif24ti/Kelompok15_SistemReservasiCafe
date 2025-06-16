<?php
    include "koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.bundle.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP dan MYSQL - Menampilkan data dari DATABASE MYSQL dengan PHP </title>
</head>
<body>
    <div class="container">
        
    <h1>Data kafe </h1>
        <table class="table table-bordere">
        <thead>
            <th>id meja</th>
            <th>nomor meja</th>
            <th>kapasitas</th>
        </thead>
        <?php 
        $data = mysqli_query($conn,"SELECT * FROM meja");
        while ($row = mysqli_fetch_array($data)){
        ?>
        <tr>
            <td><?php echo $row['id_meja'];?></td>
            
        <td>
            <?php echo $row['nomor_meja'];?>
        </td>
        
        
        <td>
            <?php echo $row['kapasitas'];?>
        </td>
        </tr>
        <?php
        }
        ?>
    </table>
    </div>
</body>
</html>