<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Rating - Sistem Manajemen Gaji</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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

        body h3 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 30px;
        }

        /* kode responsive */
        @media (max-width: 768px) {
        body {
            font-size: 14px;
            padding: 0px;
            width: 678px;
        }

        .h3 {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .no {
            font-size: 12.5px;
        }

        .nama {
            font-size: 12.5px;
        }

        .bulan {
            font-size: 12.5px;
        }

        .nilai {
            font-size: 12.5px;
        }

        .aksi {
            font-size: 12.5px;
        }

        .table-primary {
            font-size: 10px;
        }

        .col-no {
            width: 5%;
            text-align: center;
        }

        .col-nama {
            width: 25%;
        }

        .col-bulan {
            width: 15%;
            text-align: left;
        }

        .col-nilai {
            width: 10%;
            text-align: left;
        }

        .col-aksi {
            width: 30%;
            text-align: center;
            white-space: nowrap; /* Biar tombol gak bikin kolom melebar */
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
    <?php include 'sidebar.php'; ?>
    <div class="container mt-4" style="width: 900px;">
        <h3 class="h3 fw-bold">DAFTAR RATING KARYAWAN</h3>

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

        <a href="rating_tambah.php" class="btn btn-outline-primary mb-3">+ Tambah Rating</a>
        <table class="table table-bordered table-striped">
            <thead>
                <tr class="table-primary">
                    <th class="col-no">No</th>
                    <th class="col-nama">Nama Karyawan</th>
                    <th class="col-bulan">Bulan</th>
                    <th class="col-nilai">Rating</th>
                    <th class="col-aksi">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $query = mysqli_query($conn, "SELECT rating.*, karyawan.nama FROM rating 
                                              JOIN karyawan ON rating.karyawan_id = karyawan.id 
                                              ORDER BY rating.id DESC");
                while ($row = mysqli_fetch_assoc($query)) {
                    echo '
                    <tr>
                        <td class="no">' . $no++ . '</td>
                        <td class="nama">' . $row['nama'] . '</td>
                        <td class="bulan">' . $row['bulan'] . '</td>
                        <td class="nilai">' . $row['nilai_rating'] . '</td>
                        <td>
                            <a href="rating_edit.php?id=' . $row['id'] . '" class="btn btn-sm btn-outline-warning aksi-btn">Edit</a> 
                            <a href="rating_detail.php?id=' . $row['id'] . '" class="btn btn-outline-info btn-sm aksi-btn">Detail</a>
                            <a href="rating_hapus.php?id=' . $row['id'] . '" class="btn btn-sm btn-outline-danger aksi-btn" onclick="return confirm(\'Yakin ingin menghapus?\')">Hapus</a>
                        </td>
                    </tr>';
                }
                ?>
            </tbody>
        </table>
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

    <?php include 'footer.php'; ?>

</body>
</html>
