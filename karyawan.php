<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Karyawan - Sistem Manajemen Gaji</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>

        body {
            font-family: "Lexend Deca", sans-serif;
            font-optical-sizing: auto;
            font-weight: <weight>;
            font-style: normal;
        }

        body h3 {
            text-align: center;
            font-size: 30px
        }

        body a {
            display: grid;
            align-items: center;
            margin-top: 0px;
        }
        
        .kartu-karyawan {
            width: 200px;
            margin: 10px;
        }

        .foto-karyawan {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 5px;
        }

        /* kode responsive */
        @media (max-width: 768px) {
        body {
            font-size: 14px;
            padding: 0px;
            width: 678px;
        }

        .container {
            width: 100% !important;
            padding: 0 0px;
        }

        .kartu-karyawan {
            margin-left: 10px;
            width: 180px;
            margin: 11px;
        }

        .h3 {
            font-size: 25px;
            margin-bottom: 10px;
        }

        .aksi-btn {
            display: inline-block;
            text-align: center;
            font-size: 10px;          /* Ukuran teks kecil */
            padding: 2px 6px;         /* Padding kecil untuk tinggi+lebar tombol */
            margin: 2px;
            line-height: 1;           /* Supaya tinggi teks gak tinggi-tinggi amat */
            border-radius: 4px;
            white-space: nowrap;
            width: fit-content;       /* Ini kuncinya: tombol nyesuaiin isi! */
        }

    }

    </style>
</head>
<body>
<div class="d-flex">
    <?php include 'includes/sidebar.php'; ?>
    <div class="container mt-4" style="width: 905px;">
        <h3 class="h3">DAFTAR KARYAWAN</h3>

        <!-- Kode untuk menambahkan data karyawan -->
        <?php if (isset($_GET['tambah']) && $_GET['tambah'] === 'sukses') : ?>
            <div id="notif-success" class="alert alert-success alert-dismissible fade show" role="alert">
                ✅ Data karyawan berhasil ditambahkan.
            </div>
        <?php endif; ?>


        <!-- Kode untuk menghapus data karyawan -->
        <?php if (isset($_GET['hapus']) && $_GET['hapus'] === 'sukses') : ?>
            <div id="notif-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                ✅ Data karyawan berhasil dihapus.
            </div>
        <?php endif; ?>


        <!-- Kode untuk mengedit data karyawan -->
        <?php if (isset($_GET['edit']) && $_GET['edit'] == 'sukses') : ?>
            <div id="notif-success" class="transition-all duration-700 ease-in-out mb-3 mx-2 p-3 bg-green-100 text-green-800 border border-green-300 rounded shadow">
                ✅ Data karyawan berhasil diperbarui.
            </div>
        <?php endif; ?>

        <a href="karyawan_tambah.php" class="btn btn-outline-primary mb-3" style="margin-left: 10px;">+ Tambah Karyawan</a>
        <div class="d-flex flex-wrap">
            <?php
            $query = mysqli_query($conn, "SELECT karyawan.*, jabatan.nama_jabatan 
                                          FROM karyawan 
                                          JOIN jabatan ON karyawan.jabatan_id = jabatan.id 
                                          ORDER BY karyawan.id DESC");
            $bulan_ini = date('Y-m');
            while ($row = mysqli_fetch_assoc($query)) {
                // Ambil rating dari tabel rating untuk karyawan ini di bulan ini
                $id_karyawan = $row['id'];
                $rating_q = mysqli_query($conn, "SELECT nilai_rating FROM rating WHERE karyawan_id = $id_karyawan AND bulan = '$bulan_ini'");
                $data_rating = mysqli_fetch_assoc($rating_q);
                $nilai_rating = $data_rating['nilai_rating'] ?? '-';
                $bintang = is_numeric($nilai_rating) ? str_repeat('⭐', $nilai_rating) : '-';

                echo '
                    <div class="card kartu-karyawan shadow-sm" id="karyawan-' . $row['id'] . '">
                    <img src="uploads/' . $row['foto'] . '" class="foto-karyawan card-img-top">
                    <div class="card-body text-center align-items: center;">
                        <h5 class="card-title mb-1" style="font-size: 18px;">' . $row['nama'] . '</h5>
                        <div class="text-warning mb-1">Rating: ' . $bintang . '</div>
                        <p class="card-text" style="margin-bottom: 10px;"><strong>' . $row['nama_jabatan'] . '</strong></p>
                        <a href="karyawan_edit.php?id=' . $row['id'] . '" class="btn btn-outline-warning btn-sm aksi-btn" style="margin-left: -5px;">Edit</a>
                        <a href="karyawan_detail.php?id=' . $row['id'] . '" class="btn btn-outline-info btn-sm aksi-btn">Detail</a>
                        <a href="karyawan_hapus.php?id=' . $row['id'] . '" onclick="hapusData(event, this, ' . $row['id'] . ')" class="btn btn-outline-danger btn-sm aksi-btn">Hapus</a>

                    </div>
                </div>';
            }
            ?>
        </div>
    </div>
</div>

    <!-- Kode script untuk animasi menambahkan data karyawan -->
     <script>
        document.addEventListener("DOMContentLoaded", function () {
            const notif = document.getElementById("notif-success");
            if (notif) {
                setTimeout(() => {
                    notif.classList.add("opacity-0", "translate-y-2", "transition-all", "duration-700");

                    // Hapus dari DOM setelah animasi selesai
                    setTimeout(() => {
                        notif.remove();
                    }, 700);
                }, 3000); // Notifikasi muncul selama 3 detik
            }
        });
    </script>

    <!-- Pembatas -->

    <!-- Kode script untuk animasi mengedit data karyawan -->
    <script>
        setTimeout(() => {
            const notif = document.getElementById('notif-success');
            if (notif) {
                notif.classList.add('opacity-0', 'translate-y-2');
                setTimeout(() => notif.remove(), 700);
            }
        }, 3000); // Hilang dalam 3 detik
    </script>

    <!-- Pembatas -->

    <!-- Kode script untuk animasi menghapus data karyawan -->
    <script>
        function hapusData(event, element, id) {
            event.preventDefault();
            if (confirm("Yakin ingin menghapus?")) {
                const card = document.getElementById("karyawan-" + id);
                card.classList.add("opacity-0", "translate-x-4", "transition-all", "duration-500");

                setTimeout(() => {
                    window.location.href = element.getAttribute('href');
                }, 500);
            }
        }

        // Animasi untuk notifikasi sukses
        document.addEventListener("DOMContentLoaded", function () {
            const notif = document.getElementById("notif-success");
            if (notif) {
                setTimeout(() => {
                    notif.classList.add("opacity-0", "translate-y-2", "transition-all", "duration-700");

                    // Hapus dari DOM setelah animasi selesai
                    setTimeout(() => {
                        notif.remove();
                    }, 700);
                }, 3000); // Notifikasi muncul selama 3 detik
            }
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const notif = document.getElementById("notif-alert");
            if (notif) {
                setTimeout(() => {
                    // Tambahkan kelas fade-out
                    notif.classList.remove("show");
                    
                    // Hapus dari DOM setelah efek selesai (500ms dari Bootstrap)
                    setTimeout(() => {
                        notif.remove();
                    }, 500);
                }, 3000); // Tampilkan selama 3 detik
            }
        });
    </script>


    <!-- Kode untuk footer -->
    <?php include 'includes\footer.php'; ?>

</body>
</html>