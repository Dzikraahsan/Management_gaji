<?php
include 'koneksi.php';
$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM jabatan WHERE id='$id'");
$d = mysqli_fetch_array($data);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Jabatan</title>
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
            margin-bottom: 20px;
        }

        body a {
            margin-left: 0rem;
            margin-top: 10px;
        }

    </style>
</head>
<body>

    <div class="d-flex">
        <?php include 'includes/sidebar.php'; ?>
            <div class="container shadow p-5 mb-5 bg-body-tertiary rounded" style="width: 900px; height: 275px;">
                <h2>DETAIL JABATAN</h2>
                    <p><strong>Nama Jabatan ﾠﾠ: </strong> <?= $d['nama_jabatan'] ?></p>
                    <p><strong>Gaji Pokokﾠﾠ ﾠ ﾠﾠﾠ: </strong> Rp <?= number_format($d['gaji_pokok']) ?></p>
                <a href="jabatan.php" class="btn btn-outline-secondary">Kembali</a>
            </div>
    </div>
    
</body>
</html>
