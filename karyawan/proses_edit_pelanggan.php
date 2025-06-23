<?php
include "koneksi.php";

$id = $_POST['id'];
$nama = $_POST['nama'];
$email = $_POST['email'];
$telepon = $_POST['no_telepon'];


$query = "UPDATE pelanggan SET 
          nama = '$nama',
          email = '$email',
          no_telepon = '$telepon'
          WHERE id_pelanggan = $id";

if (mysqli_query($conn, $query)) {
    header("Location: pelanggan.php");
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>