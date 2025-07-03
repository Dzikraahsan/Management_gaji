<?php
include 'koneksi.php';
$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT rating.*, karyawan.nama FROM rating 
    JOIN karyawan ON rating.karyawan_id = karyawan.id 
    WHERE rating.id='$id'");
$d = mysqli_fetch_array($data);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Rating</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>

        body {
            text-align: justify;

            font-family: "Lexend Deca", sans-serif;
            font-optical-sizing: auto;
            font-weight: <weight>;
            font-style: normal;
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
            grid-template-columns: 130px 1fr; /* Lebar label diperkecil */
            display: grid;
            align-items: start;
            margin-left: 0rem;
        }

        .label,
        .value {
            font-size: 14px;
        }
    }

    </style>
</head>
<body>
    <div class="d-flex">
        <?php include 'includes/sidebar.php'; ?>
        <div class="container shadow p-5 mb-5 bg-body-tertiary rounded" style="width: 900px; height: max-content; margin-top: 1rem;">
            <h2>DETAIL RATING KARYAWAN</h2>
                <div class="detail-wrapper">

                    <div class="row-detail">
                        <span class="label">Nama Karyawan</span>
                        <span class="value"><?= $d['nama'] ?></span>
                    </div>

                    <div class="row-detail">
                        <span class="label">Bulan</span>
                        <span class="value"><?= $d['bulan'] ?></span>
                    </div>

                    <div class="row-detail">
                        <span class="label">Nilai Rating</span>
                        <span class="value"><?= $d['nilai_rating'] ?></span>
                    </div>

                     <a href="rating.php" class="btn btn-outline-secondary" style="margin: 0 auto; display: block; margin-top: 15px;">Kembali</a>

                </div>
           
        </div>

    </div>
    
</body>
</html>
