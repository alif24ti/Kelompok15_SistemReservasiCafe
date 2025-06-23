<?php

include "koneksi.php";

$id_meja = $_POST['id_meja'];
$nomor_meja = $_POST['nomor_meja'];
$kapasitas = $_POST['kapasitas'];

$simpan = mysqli_query($conn , "Insert into meja values('$id_meja', '$nomor_meja', '$kapasitas') ");

if ($simpan){
    header("location:dashboard.php");
}else{
    header("location:tambah.php");
}

?>