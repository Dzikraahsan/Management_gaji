<?php
include 'koneksi.php';
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

        .h3 {
            text-align: center;
            margin-bottom: 1rem;
        }

         .detail-wrapper {
            width: 600px;
            padding: 10px;
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

        .detail-wrapper {
            width: 450px;
        }

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
      <?php include 'sidebar.php'; ?>
        <div class="container shadow p-5 mb-5 mt-2 bg-body-tertiary rounded" style="width: 900px; height: max-content; margin: 0 auto; display: block;">
            <h3 class="h3">DETAIL KARYAWAN</h3>

            <div class="detail-wrapper" style="margin: 0 auto; display: block;">
                <div class="row-detail">
                    <div class="label">Nama</div>
                    <div class="value"><?= $d['nama'] ?></div>
                </div>
                <div class="row-detail">
                    <div class="label">Umur</div>
                    <div class="value"><?= $d['umur'] ?></div>
                </div>
                <div class="row-detail">
                    <div class="label">Jenis Kelamin</div>
                    <div class="value"><?= $d['jenis_kelamin'] ?></div>
                </div>
                <div class="row-detail">
                    <div class="label">Alamat</div>
                    <div class="value"><?= $d['alamat'] ?></div>
                </div>
                <div class="row-detail">
                    <div class="label">No. HP</div>
                    <div class="value"><?= $d['no_hp'] ?></div>
                </div>
                <div class="row-detail">
                    <div class="label">Status</div>
                    <div class="value"><?= $d['status_'] ?></div>
                </div>
                <div class="row-detail">
                    <div class="label">Jabatan</div>
                    <div class="value"><?= $d['nama_jabatan'] ?></div>
                </div>
                <div class="row-detail">
                    <div class="label">Rating</div>
                    <div class="value">
                        <?php 
                        $rating = isset($d['nilai_rating']) ? (int)$d['nilai_rating'] : 0;
                        for ($i = 0; $i < $rating; $i++) {
                            echo '⭐';
                        }
                        if ($rating == 0) echo 'Belum ada rating';
                        ?>
                    </div>
                </div>
                <div class="row-detail">
                    <div class="label">Tanggal Bergabung</div>
                    <div class="value"><?= $d['tgl_bergabung'] ?></div>
                </div>
                <div class="row-detail">
                    <div class="label">Foto Karyawan</div>
                    <div class="value"></div>
                </div>

                <img class="img" src="uploads/<?= $d['foto'] ?>" width="150" style="border: 2.5px solid rgb(0, 140, 255); border-radius: 10px;"> <br> <br>
                <a href="karyawan.php" class="btn btn-outline-secondary" style="margin: 0 auto; display: block;">Kembali</a>

            </div>

        </div>

    </div>
    
    
    </body>
</html>
