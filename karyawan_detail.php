<?php
include 'koneksi.php';
include 'includes\header.php';
include 'includes\sidebar.php';
$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM karyawan
    JOIN jabatan ON karyawan.jabatan_id = jabatan.id 
    JOIN rating ON rating.nilai_rating
    WHERE karyawan.id='$id'");
$d = mysqli_fetch_array($data);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
        body{
            text-align: justify;

            font-family: "Lexend Deca", sans-serif;
            font-optical-sizing: auto;
            font-weight: <weight>;
            font-style: normal;
        }

        body h2 {
            text-align: center;
            margin-bottom: 15px;
        }

        body a {
            margin-left: 0rem;
            margin-top: 1rem;
        }

    </style>
</head>
<body>

    <div class="container shadow p-5 mb-5 bg-body-tertiary rounded" style="width: 900px; height: 750px;">
        <h2>DETAIL KARYAWAN</h2>
            <p><strong>Nama  ﾠﾠﾠﾠﾠﾠﾠﾠ :          </strong> <?= $d['nama'] ?></p>
            <p><strong>Umur                      :          </strong> <?= $d['umur'] ?></p>
            <p><strong>Jenis Kelaminﾠ :          </strong> <?= $d['jenis_kelamin'] ?></p>
            <p><strong>Alamatﾠﾠﾠﾠﾠﾠﾠﾠ :          </strong> <?= $d['alamat'] ?></p>
            <p><strong>No.HPﾠﾠﾠﾠﾠﾠﾠﾠﾠ :          </strong> <?= $d['no_hp'] ?></p>
            <p><strong>Statusﾠ                  :          </strong> <?= $d['status_'] ?></p>
            <p><strong>Jabatan      ﾠﾠﾠﾠ :          </strong> <?= $d['nama_jabatan'] ?></p>
            <p><strong>Rating      ﾠﾠﾠﾠ     :          </strong> 
                <?php 
                    $rating = isset($d['nilai_rating']) ? (int)$d['nilai_rating'] : 0;
                    for ($i = 0; $i < $rating; $i++) {
                        echo '⭐';
                    }
                    if ($rating == 0) echo 'Belum ada rating';
                ?>
            </p>
            <p>Foto Karyawan  :</p>
        <img src="uploads/<?= $d['foto'] ?>" width="150" style="border: 2.5px solid rgb(0, 140, 255); border-radius: 10px;"> <br> <br>
        <a href="karyawan.php" class="btn btn-outline-secondary">Kembali</a>
    </div>
    
</body>
</html>
