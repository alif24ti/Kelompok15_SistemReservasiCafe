<?php
include "koneksi.php";

// Ambil ID reservasi yang akan dihapus
$id_reservasi = $_GET['id'];

// Hapus data reservasi
$delete = "DELETE FROM reservasi WHERE id_reservasi = '$id_reservasi'";

if (mysqli_query($conn, $delete)) {
    header("Location: dashboard.php?status=success&message=Reservasi berhasil dihapus");
} else {
    header("Location: dashboard.php?status=error&message=Gagal menghapus reservasi");
}

exit();
?>