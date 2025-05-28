<?php
include 'koneksi.php';
include 'includes\header.php';
include 'includes\sidebar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <title>Document</title>
</head>
<body>
    
<div class="container mt-4" style="width: 900px;">
    <h3>DAFTAR GAJI KARYAWAN</h3>

    <!-- Kode untuk menambahkan data karyawan -->
        <?php if (isset($_GET['tambah']) && $_GET['tambah'] === 'sukses') : ?>
            <div id="notif-success" class="transition-all duration-700 ease-in-out mb-3 mx-2 p-3 bg-green-100 text-green-800 border border-green-300 rounded shadow">
                ✅ Data karyawan berhasil ditambahkan.
            </div>
        <?php endif; ?>


        <!-- Kode untuk menghapus data karyawan -->
        <?php if (isset($_GET['hapus']) && $_GET['hapus'] === 'sukses') : ?>
            <div id="notif-alert" class="transition-all duration-700 ease-in-out mb-3 mx-2 p-3 bg-green-100 text-green-800 border border-green-300 rounded shadow"">
                ✅ Data karyawan berhasil dihapus.
            </div>
        <?php endif; ?>


        <!-- Kode untuk mengedit data karyawan -->
        <?php if (isset($_GET['edit']) && $_GET['edit'] == 'sukses') : ?>
            <div id="notif-success" class="transition-all duration-700 ease-in-out mb-3 mx-2 p-3 bg-green-100 text-green-800 border border-green-300 rounded shadow">
                ✅ Data karyawan berhasil diperbarui.
            </div>
        <?php endif; ?>

    <a href="gaji_tambah.php" class="btn btn-primary mb-3">+ Tambah Gaji</a>

    <table class="table table-bordered">
        <thead class="table-primary">
            <tr>
                <th>No</th>
                <th>Nama Karyawan</th>
                <th>Bulan</th>
                <th>Total Gaji</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $query = mysqli_query($conn, "SELECT gaji.id, karyawan.nama, gaji.nama_karyawan, gaji.bulan, gaji.total_gaji 
                                             FROM gaji 
                                             JOIN karyawan ON gaji.karyawan_id = karyawan.id 
                                             ORDER BY gaji.bulan DESC");
            while($data = mysqli_fetch_array($query)) {
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $data['nama_karyawan'] ?></td>
                <td><?= $data['bulan'] ?></td>
                <td>Rp <?= number_format($data['total_gaji'], 0, ',', '.') ?></td>
                <td>
                    <a href="gaji_edit.php?id=<?= $data['id'] ?>" class="btn btn-warning btn-sm">Edit</a> <a href="gaji_detail.php?id=<?= $data['id'] ?>" class="btn btn-info btn-sm">Detail</a>
                    <a href="gaji_hapus.php?id=<?= $data['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
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

    <!--  -->

</body>
</html>

