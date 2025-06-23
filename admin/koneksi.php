<?php
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "kafe";

    $conn = new mysqli($hostname, $username, $password, $database);

    if ($conn->connect_error) {
        die("koneksi gagal");
    } else {
        return $conn;
    }
?>