<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Rating - Sistem Manajemen Gaji</title>
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
            margin-bottom: 20px;
            font-size: 30px;
        }

    </style>
</head>
<body>
<div class="d-flex">
    <?php include 'includes/sidebar.php'; ?>
    <div class="container mt-4" style="width: 900px;">
        <h3>DAFTAR RATING KARYAWAN</h3>

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
                    <th>No</th>
                    <th>Nama Karyawan</th>
                    <th>Bulan</th>
                    <th>Nilai Rating</th>
                    <th>Aksi</th>
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
                        <td>' . $no++ . '</td>
                        <td>' . $row['nama'] . '</td>
                        <td>' . $row['bulan'] . '</td>
                        <td>' . $row['nilai_rating'] . '</td>
                        <td>
                            <a href="rating_edit.php?id=' . $row['id'] . '" class="btn btn-sm btn-outline-warning">Edit</a> 
                            <a href="rating_detail.php?id=' . $row['id'] . '" class="btn btn-outline-info btn-sm">Detail</a>
                            <a href="rating_hapus.php?id=' . $row['id'] . '" class="btn btn-sm btn-outline-danger" onclick="return confirm(\'Yakin ingin menghapus?\')">Hapus</a>
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

    <?php include 'includes\footer.php'; ?>

</body>
</html>
