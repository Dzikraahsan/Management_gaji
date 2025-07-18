<?php
include 'koneksi.php';
$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT lembur.*, jabatan.nama_jabatan FROM lembur 
    JOIN jabatan ON lembur.jabatan_id = jabatan.id 
    WHERE lembur.id='$id'");
$d = mysqli_fetch_array($data);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Lembur</title>
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
            margin-bottom: 20px;
        }

        body a {
            margin-left: 0rem;
            margin-top: 15px
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


    </style>
</head>
<body>

    <div class="d-flex">
        <?php include 'includes/sidebar.php'; ?>
        <div class="container shadow p-5 mb-5 bg-body-tertiary rounded" style="width: 900px; height: max-content; margin-top: 1rem;">
            <h2>DETAIL TARIF LEMBUR</h2>
                <div class="detail-wrapper">

                    <div class="row-detail">
                        <span class="label">Jabatan</span>
                        <span class="value"><?= $d['nama_jabatan'] ?></span>
                    </div>

                    <div class="row-detail">
                        <span class="label">Gaji Pokok</span>
                        <span class="value">Rp <?= number_format($d['tarif_per_jam']) ?></span>
                    </div>

                    <a href="lembur.php" class="btn btn-outline-secondary" style="margin: 0 auto; display: block; margin-top: 15px;">Kembali</a>

                </div>

        </div>
        
    </div>
</body>
</html>
