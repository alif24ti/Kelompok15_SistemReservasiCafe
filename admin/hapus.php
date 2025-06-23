<?php
session_start();
@include "koneksi.php";

$id_meja = $_GET['id_meja'];
$hapus = mysqli_query($conn, "delete from meja where id_meja='$id_meja'");

if($hapus){
    header("location:dashboard.php");
}else {
    echo "data gagal di hapus";
}
?>