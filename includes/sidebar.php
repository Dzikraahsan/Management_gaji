<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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
        
    </style>
</head>
<body>
    <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 250px; min-height: 210vh; height: max-content;">
        <a href="dashboard.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <img src="uploads/Manchester City logo 1997 - 2016.png" alt="Logo" width="60" class="me-2">
        </a>
            <p class="fw-bold mt-1" style="font-size: 15px;">SISTEM MANAJEMEN GAJI</p>
        <hr style="margin-top: 10px;">
        <ul class="nav nav-pills flex-column mb-auto">
            <li><a href="dashboard.php" class="nav-link text-white">Dashboard</a></li>
            <li><a href="karyawan.php" class="nav-link text-white">Daftar Karyawan</a></li>
            <li><a href="jabatan.php" class="nav-link text-white">Daftar Jabatan</a></li>
            <li><a href="rating.php" class="nav-link text-white">Daftar Rating</a></li>
            <li><a href="lembur.php" class="nav-link text-white">Tarif Lembur</a></li>
            <li><a href="gaji.php" class="nav-link text-white">Gaji Karyawan</a></li>
            <a href="https://web-production-0b5d.up.railway.app/" class="btn btn-outline-light mb-3 " style=" font-size: 15px; margin-top: 1rem;">Kembali Ke Portofolio</a>
        </ul>
    </div>
</body>
</html>