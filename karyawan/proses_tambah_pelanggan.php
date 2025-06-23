<?php
include "koneksi.php";

$nama = $_POST['nama'];
$email = $_POST['email'];
$telepon = $_POST['no_telepon'];


$query = "INSERT INTO pelanggan (nama, email, no_telepon) 
          VALUES ('$nama', '$email', '$telepon')";

if (mysqli_query($conn, $query)) {
    header("Location: pelanggan.php");
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>