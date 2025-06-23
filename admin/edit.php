<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP dan MYSQL - form edit meja</title>
</head>
<body>
    
    <h2>Form edit meja</h2>

    <?php
        @include "koneksi.php";

        $id_meja = $_GET['id_meja'];
        $data = mysqli_query($conn, "Select * from meja where id_meja='$id_meja'");
        while($row = mysqli_fetch_array($data)){
    ?>

    <form action="update.php" method="POST">
        <table>
            <tr>
                <td>id meja</td>
                <td><input type= "text" name="id meja" placeholder="id meja" 
                value="<?php echo $row['id_meja'];?>" size="11"></td>
            </tr>

            <tr>
                <td>nomor meja</td>
                <td><input type= "text" name="nomor meja" placeholder="nomor meja" 
                value="<?php echo $row['nomor_meja'];?>" size="11"></td>
                
            </tr>

            <tr>
                <td>kapasitas</td>
                <td><input type= "text" name="kapasitas" placeholder="kapasitas"
                value="<?php echo $row['kapasitas'];?>"  size="11"></td>
            </tr>

            <tr>
                <td>
                    <input type= "submit" name="edit" value="edit">
                    <input type= "reset" name="batal" value="batal">
                </td>
            </tr>
        </table>
    </form>
    <?php
    }
    ?>
</body>
</html>