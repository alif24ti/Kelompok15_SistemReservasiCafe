<?php

@include "koneksi.php";

$id_meja = $_POST['id_meja'];
$nomor_meja = $_POST['nomor_meja'];
$kapasitas = $_POST['kapasitas'];

$update = mysqli_query($conn , "update meja set nomor_meja='$nomor_meja', kapasitas='$kapasitas' where id_meja='$id_meja'");

if ($update){
    header("location:dashboard.php");
}else{
    header("location:edit.php");
}

?>