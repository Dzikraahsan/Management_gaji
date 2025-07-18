<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Jabatan</title>
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
            font-size: 25px;
            margin-bottom: 10px;
        }

        .no {
            font-size: 15px;
        }

        .name {
            font-size: 12.5px;
        }

        .number {
            font-size: 12.5px;
        }

        .aksi-btn {
            display: inline-block;
            width: auto;
            text-align: center;
            margin: 2px 3px;
            font-size: 11px;             /* Ukuran teks lebih kecil */
            padding: 3px 6px;            /* Padding kecil biar tombol gak gede */
            white-space: nowrap;
            line-height: 1.2;            /* Biar vertikal spacing-nya rapet */
            border-radius: 5px;          /* (Opsional) Biar tombol lebih modern */
        }

        .table-primary {
            font-size: 10px;
        }

        .col-no {
            width: 5%;
            text-align: center;
        }

        .col-nama {
            width: 22%;
        }

        .col-gaji {
            width: 30%;
            text-align: left;
        }

        .col-aksi {
            width: 30%;
            text-align: center;
            white-space: nowrap; /* Biar tombol gak bikin kolom melebar */
        }

    }

    </style>
</head>
<body>
<div class="d-flex">
    <?php include 'sidebar.php'; ?>
    <div class="container mt-4" style="width: 900px;">
        <h3 class="h3 fw-bold">DAFTAR JABATAN</h3>

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

        <a href="jabatan_tambah.php" class="btn btn-outline-primary mb-3">+ Tambah Jabatan</a>
        <table class="table table-bordered">
            <thead>
               <tr class="table-primary">
                    <th class="col-no">No</th>
                    <th class="col-nama">Nama Jabatan</th>
                    <th class="col-gaji">Gaji Pokok</th>
                    <th class="col-aksi">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $query = mysqli_query($conn, "SELECT * FROM jabatan");
                while ($row = mysqli_fetch_assoc($query)) {
                    echo "<tr>
                        <td class='no'>" . $no . "</td>
                        <td class='name'>" . $row['nama_jabatan'] . "</td>
                        <td class='number'>Rp " . number_format(is_numeric($row['gaji_pokok']) ? $row['gaji_pokok'] : 0, 0, ',', '.') . "</td>
                        <td class='button'>
                            <a href='jabatan_edit.php?id=" . $row['id'] . "' class='btn btn-sm btn-outline-warning aksi-btn'>Edit</a> 
                            <a href='jabatan_detail.php?id=" . $row['id'] . "' class='btn btn-outline-info btn-sm aksi-btn'>Detail</a>
                            <a href='jabatan_hapus.php?id=" . $row['id'] . "' class='btn btn-sm btn-outline-danger aksi-btn' onclick=\"return confirm('Yakin ingin menghapus?')\">Hapus</a>
                        </td>
                    </tr>";
                    $no++;
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

    <!-- Kode untuk footer -->
    <?php include 'footer.php'; ?>

</body>
</html>
