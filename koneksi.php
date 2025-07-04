<?php
$host = "gateway01.ap-southeast-1.prod.aws.tidbcloud.com";
$port = 4000;
$user = "4RMsG27B571nnyi.root";
$password = "OQPLIQwV6jO9APY5";
$dbname = "test";
$ssl_ca = __DIR__ . "/isrgrootx1.pem";

// Inisialisasi koneksi
$conn = mysqli_init();
mysqli_ssl_set($conn, NULL, NULL, $ssl_ca, NULL, NULL);
mysqli_real_connect($conn, $host, $user, $password, $dbname, $port, NULL, MYSQLI_CLIENT_SSL);

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
} 
?>
