<?php

$host = "gateway01.ap-southeast-1.prod.aws.tidbcloud.com";
$port = 4000;
$user = "root";
$pass = "";
$dbname = "management_gaji";

$koneksi = mysqli_connect($host, $user, $pass, $dbname, $port);

// Cek koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

?>