<?php
include 'koneksi.php';
$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT gaji.*, karyawan.nama FROM gaji 
    JOIN karyawan ON gaji.karyawan_id = karyawan.id 
    WHERE gaji.id='$id'");
$d = mysqli_fetch_array($data);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Gaji</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preload" href="/assets/fonts/Organetto-Regular.woff2" as="font" type="font/woff2" crossorigin="anonymous">
    <style>

        body {
            font-family: 'Organetto', sans-serif !important;
            font-optical-sizing: auto;
            font-weight: normal;
            font-style: normal;
        }

        * {
            font-family: 'Organetto', sans-serif !important;
        }

        @font-face {
            font-family: 'Organetto';
            src: url('assets/fonts/Organetto-Regular.woff2') format('woff2');
            font-weight: normal;
            font-style: normal;
            font-display: swap;
        }

        body h2 {
            text-align: center;
            margin-bottom: 25px;
        }

        body a {
            margin-left: 0rem;
            margin-top: 15px;
        }

        .detail-wrapper {
            max-width: 600px;
            margin: 0 auto;
            padding: 10px;
            font-family: 'Poppins', sans-serif;
        }

        .row-detail {
            display: flex;
            justify-content: space-between;
            padding: 6px 0;
            border-bottom: 1px dashed #ccc;
        }

        .label {
            font-weight: 600;
            color: #222;
            min-width: 150px;
            white-space: nowrap;
        }

        .value {
            color: #444;
            text-align: right;
            word-break: break-word;
        }

        /* kode responsive */
        @media (max-width: 768px) {
        .row-detail {
            flex-direction: column;
            align-items: flex-start;
        }

        .label, .value {
            text-align: left;
            width: 100%;
            margin-bottom: 4px;
        }

        .label {
            font-weight: 700;
        }

        .container, .rectangle {
            height: 150vh;
        }
    }
        
    </style>
</head>
<body>

    <div class="d-flex">
        <?php include 'includes/sidebar.php'; ?>
            <div class="container shadow p-5 mb-5 bg-body-tertiary rounded rectangle" style="width: 900px; height: max-content; margin-top: 1rem;">
                <h2>DETAIL GAJI KARYAWAN</h2>
                    <div class="detail-wrapper">

                        <div class="row-detail">
                            <span class="label">Nama</span>
                            <span class="value"><?= $d['nama'] ?></span>
                        </div>

                        <div class="row-detail">
                            <span class="label">Bulan</span>
                            <span class="value"><?= $d['bulan'] ?></span>
                        </div>

                        <div class="row-detail">
                            <span class="label">Gaji Pokok</span>
                            <span class="value">Rp <?= number_format($d['gaji_pokok']) ?></span>
                        </div>

                        <div class="row-detail">
                            <span class="label">Tarif Lembur</span>
                            <span class="value">Rp <?= number_format($d['tarif_lembur']) ?></span>
                        </div>

                        <div class="row-detail">
                            <span class="label">Bonus Rating</span>
                            <span class="value"><?= number_format($d['bonus_rating']) ?></span>
                        </div>

                        <div class="row-detail">
                            <span class="label">Total Gaji</span>
                            <span class="value">Rp <?= number_format($d['total_gaji']) ?></span>
                        </div>

                         <a href="gaji.php" class="btn btn-outline-secondary" style="margin: 0 auto; display: block; margin-top: 15px;">Kembali</a>

                    </div>

            </div>
    </div>
    
</body>
</html>
