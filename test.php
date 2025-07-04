<?php
include 'koneksi.php';

$query = mysqli_query($conn, "SELECT * FROM karyawan");
while ($row = mysqli_fetch_assoc($query)) {
    echo $row['nama'] . "<br>";
}
?>
