<?php include 'koneksi.php'; 
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Sistem Manajemen Gaji</title>

    <!-- link bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- link preload font -->
     <link rel="preload" href="/assets/fonts/Organetto-Regular.woff2" as="font" type="font/woff2" crossorigin="anonymous">

    <style>

        body {
            font-family: 'Organetto', sans-serif !important;
            font-optical-sizing: auto;
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'Organetto';
            src: url('assets/fonts/Organetto-Regular.woff2') format('woff2');
            font-weight: normal;
            font-style: normal;
            font-display: swap;
        }

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

        .karyawan-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 0px;
            max-width: 990px;
            margin: 0px auto 0 auto;
        }

        /* kode responsive */
        @media (max-width: 768px) {
            body {
                font-size: 0.875rem;
                padding: 0;
                width: 100%;
                max-width: 100vw;
                overflow-x: hidden;
            }

            .container {
                width: 100% !important;
                padding: 0;
            }

            .header h4 {
                font-size: 1rem;
                text-align: center;
                margin-left: 0;
            }

            .marquee-wrapper {
                max-width: 100%;
                height: auto;
                position: relative;
                margin-top: 1rem;
            }

            .marquee-content h3 {
                font-size: 0.8125rem;
                padding: 0.25rem;
                margin-left: 0.625rem;
            }

            .p-3 {
                font-size: 0.8125rem !important;
                padding: 0.75rem !important;
                width: 100%;
            }

            .kartu-karyawan {
                width: 75% !important;
                height: 75%;
                margin: 0;
                margin: 1.71875rem;
            }

            .foto-karyawan {
                height: 75%;
                width: 75%;
            }

            h6 {
                font-size: 0.9375rem;
                margin: 1rem 0 0.5rem 0;
            }

            .card-title {
                font-size: 0.78125rem !important;
            }

            .b {
                margin-left: 0.3125rem;
            }

            /* Responsive grid fix */
            .karyawan-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 0;
                max-width: 100%; /* Biar nggak melebar melebihi batas sidebar */
                margin: 1.25rem auto;
                padding: 0 1rem;
            }

            .kartu-karyawan {
                width: 100%;
            }
        
        }


    </style>
</head>

<body>
<div class="d-flex">
    <?php include 'sidebar.php'; ?>
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
                <b class="b">Daftar Karyawan Terbaru:</b>
            </h6>
        <div class="container-fluid ">
            <div class="karyawan-grid">
                <?php
            $query = mysqli_query($conn, "SELECT karyawan.*, jabatan.nama_jabatan 
                                          FROM karyawan 
                                          JOIN jabatan ON karyawan.jabatan_id = jabatan.id 
                                          ORDER BY karyawan.id DESC LIMIT 100");

            $bulan_ini = date('Y-m');

            while ($row = mysqli_fetch_assoc($query)) {
                echo '
                <div class="card kartu-karyawan shadow-sm">
                    <img src="' . $row['foto'] . '" class="foto-karyawan card-img-top" onerror="this.onerror=null;this.src=\'default.jpg\';">
                    <div class="card-body text-center">
                        <h5 class="card-title w-100 mb-1" style="font-size: 13px; font-weight: 600;">' . $row['nama'] . '</h5>
                    </div>
                </div>';
            }
            ?>
            </div>
            
        </div>
    </div>
</div>

    <?php include 'footer.php'; ?>

</body>
</html>
