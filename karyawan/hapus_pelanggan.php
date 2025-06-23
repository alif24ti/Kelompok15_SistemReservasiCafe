<?php
session_start();
include "koneksi.php";

$id = $_GET['id'];
$query = "DELETE FROM pelanggan WHERE id_pelanggan = $id";

if (mysqli_query($conn, $query)) {
    header("Location: pelanggan.php");
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>