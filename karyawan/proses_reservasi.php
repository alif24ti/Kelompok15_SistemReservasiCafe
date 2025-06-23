<?php
@include "koneksi.php";

// Ambil data dari form
$nama = $_POST['nama'];
$tanggal = $_POST['tanggal'];
$waktu = $_POST['waktu'];
$jumlah_orang = $_POST['jumlah_orang'];
$id_meja = $_POST['id_meja'];

// Cek apakah meja sudah dipesan pada waktu tersebut
$cek = mysqli_query($conn, "SELECT * FROM reservasi WHERE id_meja='$id_meja' AND tanggal='$tanggal' AND waktu='$waktu'");

if (mysqli_num_rows($cek) > 0) {
    // Meja sudah dipesan
    header("location:reservasi.php?status=error&message=Meja sudah dipesan pada waktu tersebut");
    exit();
}

// Insert data reservasi
$query = "INSERT INTO reservasi (nama, tanggal, waktu, jumlah_orang, id_meja) 
          VALUES ('$nama', '$tanggal', '$waktu', '$jumlah_orang', '$id_meja')";

if (mysqli_query($conn, $query)) {
    header("location:dashboard.php?status=success&message=Reservasi berhasil dibuat");
} else {
    header("location:dashboard.php?status=error&message=Gagal membuat reservasi");
}
?>