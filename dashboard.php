<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Sistem Manajemen Gaji</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .kartu-karyawan {
            width: 200px;
            margin: 10px;
        }
        .foto-karyawan {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
        }
    </style>
</head>
<body>
<div class="d-flex">
    <?php include 'includes/sidebar.php'; ?>
    <div class="p-4 w-100">
        <h3>Selamat Datang di Sistem Manajemen Gaji</h3>
        <p>Daftar karyawan terbaru:</p>
        <div class="d-flex flex-wrap">
            <?php
            $query = mysqli_query($conn, "SELECT karyawan.*, jabatan.nama_jabatan 
                                          FROM karyawan 
                                          JOIN jabatan ON karyawan.jabatan_id = jabatan.id 
                                          ORDER BY karyawan.id DESC LIMIT 5");

            $bulan_ini = date('Y-m');

            while ($row = mysqli_fetch_assoc($query)) {
                $id_karyawan = $row['id'];
                $rating_q = mysqli_query($conn, "SELECT nilai_rating FROM rating WHERE karyawan_id = $id_karyawan AND bulan = '$bulan_ini'");
                $data_rating = mysqli_fetch_assoc($rating_q);
                $nilai_rating = $data_rating['nilai_rating'] ?? '-';
                $bintang = is_numeric($nilai_rating) ? str_repeat('⭐', $nilai_rating) : '-';

                echo '
                <div class="card kartu-karyawan shadow-sm">
                    <img src="uploads/' . $row['foto'] . '" class="foto-karyawan card-img-top">
                    <div class="card-body text-center">
                        <h5 class="card-title mb-1">' . $row['nama'] . '</h5>
                        <div class="text-warning mb-1">Rating: ' . $bintang . '</div>
                        <p class="card-text"><strong>' . $row['nama_jabatan'] . '</strong></p>
                    </div>
                </div>';
            }
            ?>
        </div>
    </div>
</div>
</body>
</html>
