<?php include 'koneksi.php'; 
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Sistem Manajemen Gaji</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
        .kartu-karyawan {
            width: 200px;
            margin: 10px;
            margin-top: 1rem;
        }

        .foto-karyawan {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 5px;
        }

        /* Alternatif Marquee */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

            html, body {
            overflow-x: hidden; /* Mencegah scroll horizontal */
        }

            .marquee-wrapper {
            width: 100%;
            max-width: 965px;
            height: 40px;
            margin: 0px auto;
            overflow: hidden;
            position: absolute;
            border: 1px solid rgb(0, 0, 0);
            background-color:rgb(16, 16, 16);
        }

            .marquee-content {
            display: inline-block;
            white-space: nowrap;
            font-size: 18px;
            color: black;
            font-weight: bold;
            position: relative;
            animation: slide-left-right 15s ease-in-out infinite;
        }

        .marquee-content h3 {
            font-size: 15px;
        }

            @keyframes slide-left-right {
            0% {
                transform: translateX(100vw);
            }
            50% {
                transform: translateX(0%);
            }
            100% {
                transform: translateX(100vw);
            }
        }

        /* ----- */

        body {
            font-family: "Lexend Deca", sans-serif;
            font-optical-sizing: auto;
            font-weight: <weight>;
            font-style: normal;
        }

        .header {
            height: 32.5px;
            width: 875px;
            color: rgb(0, 0, 0); 
            text-align: center;
            font-size: 12px;
            margin-top: 1.75rem;
        }

        body h4 {
            text-shadow: 0px 0px 30px rgb(0, 0, 0);
        }

        body h6 {
            text-align: left;
            margin-top: 1rem;
            margin-left: 8px;
            font-size: 20px;
        }

    </style>
</head>

<body>
<div class="d-flex">
    <?php include 'includes/sidebar.php'; ?>
    <div class="container mt-4" style="width: 905px;">
        <div class="marquee-wraper">
            <div class="marquee-content">
                <h3>
                    SELAMAT DATANG DI SISTEM MANAGEMENT GAJI
                </h3>
            </div>
        </div>
        <div class="header">
            <h4>
                SELAMAT DATANG DI CFA COMPANY
            </h4>
        </div>
        <?php
            $totalKaryawan = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM karyawan"));
            $totalJabatan = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM jabatan"));
            $totalRating = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM rating"));; 
        ?>
        <div class="container mt-4" style="width: 880px;">
            <div class="row text-center justify-content-center mb-4">
                <div class="col-md-4 col-sm-12 mb-2">
                    <div class="p-3 bg-primary text-white rounded shadow-sm">
                        👤 Jumlah Karyawan: <?= $totalKaryawan ?>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 mb-2">
                    <div class="p-3 bg-warning text-dark rounded shadow-sm">
                        🧑‍💼 Jumlah Jabatan: <?= $totalJabatan ?>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 mb-2">
                    <div class="p-3 bg-success text-white rounded shadow-sm">
                        ⭐ Jumlah Rating: <?= $totalRating ?>
                    </div>
                </div>
            </div>
        </div>
            <h6>
                <b>Daftar Karyawan Terbaru:</b>
            </h6>
        <div class="d-flex flex-wrap">
            <?php
            $query = mysqli_query($conn, "SELECT karyawan.*, jabatan.nama_jabatan 
                                          FROM karyawan 
                                          JOIN jabatan ON karyawan.jabatan_id = jabatan.id 
                                          ORDER BY karyawan.id DESC LIMIT 100");

            $bulan_ini = date('Y-m');

            while ($row = mysqli_fetch_assoc($query)) {
                echo '
                <div class="card kartu-karyawan shadow-sm">
                    <img src="uploads/' . $row['foto'] . '" class="foto-karyawan card-img-top">
                    <div class="card-body text-center">
                        <h5 class="card-title mb-1" style="font-size: 13px; font-weight: 600;">' . $row['nama'] . '</h5>
                    </div>
                </div>';
            }
            ?>
        </div>
    </div>
</div>

    <?php include 'includes\footer.php'; ?>

</body>
</html>
