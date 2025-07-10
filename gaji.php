<?php
include 'koneksi.php';
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
            font-size: 12.5px;
        }

        .nama {
            font-size: 12.5px;
        }

        .bulan {
            font-size: 12.5px;
        }

        .gaji {
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

        .col-gaji {
            width: 12.5%;
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
    <title>Document</title>
</head>
<body>

<div class="d-flex">
    <?php include 'sidebar.php'; ?>
        <div class="container mt-4" style="width: 900px;">
            <h3 class="h3">DAFTAR GAJI KARYAWAN</h3>

            <!-- Kode untuk menambahkan data karyawan -->
                <?php if (isset($_GET['tambah']) && $_GET['tambah'] === 'sukses') : ?>
                    <div id="notif-success" class="transition-all duration-700 ease-in-out mb-3 mx-2 p-3 bg-green-100 text-green-800 border border-green-300 rounded shadow">
                        ✅ Data karyawan berhasil ditambahkan.
                    </div>
                <?php endif; ?>


                <!-- Kode untuk menghapus data karyawan -->
                <?php if (isset($_GET['hapus']) && $_GET['hapus'] === 'sukses') : ?>
                    <div id="notif-alert" class="transition-all duration-700 ease-in-out mb-3 mx-2 p-3 bg-green-100 text-green-800 border border-green-300 rounded shadow">
                        ✅ Data karyawan berhasil dihapus.
                    </div>
                <?php endif; ?>


                <!-- Kode untuk mengedit data karyawan -->
                <?php if (isset($_GET['edit']) && $_GET['edit'] == 'sukses') : ?>
                    <div id="notif-edit" class="transition-all duration-700 ease-in-out mb-3 mx-2 p-3 bg-green-100 text-green-800 border border-green-300 rounded shadow">
                        ✅ Data karyawan berhasil diperbarui.
                    </div>
                <?php endif; ?>

            <a href="gaji_tambah.php" class="btn btn-outline-primary mb-3">+ Tambah Gaji</a>

            <table class="table table-bordered">
                <thead class="table-primary">
                    <tr>
                        <th class="col-no">No</th>
                        <th class="col-nama">Nama</th>
                        <th class="col-bulan">Bulan</th>
                        <th class="col-gaji">Total Gaji</th>
                        <th class="col-aksi">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <div class="d-flex flex-wrap">
                        <?php
                        $no = 1;
                        $query = mysqli_query($conn, "SELECT gaji.id, karyawan.nama, gaji.nama_karyawan, gaji.bulan, gaji.total_gaji 
                                                        FROM gaji 
                                                        JOIN karyawan ON gaji.karyawan_id = karyawan.id 
                                                        ORDER BY gaji.bulan DESC");

                        while($data = mysqli_fetch_array($query)) {
                            echo "<tr>
                                    <td class='no'>" . $no++ . "</td>
                                    <td class='nama'>" . $data['nama'] . "</td>
                                    <td class='bulan'>" . $data['bulan'] . "</td>
                                    <td class='gaji'>Rp " . number_format($data['total_gaji'], 0, ',', '.') . "</td>
                                    <td>
                                        <a href='gaji_edit.php?id=" . $data['id'] . "' class='btn btn-outline-warning btn-sm aksi-btn'>Edit</a> 
                                        <a href='gaji_detail.php?id=" . $data['id'] . "' class='btn btn-outline-info btn-sm aksi-btn'>Detail</a>
                                        <a href='gaji_hapus.php?id=" . $data['id'] . "' class='btn btn-outline-danger btn-sm aksi-btn' onclick=\"hapusDataGaji(event, this, " . $data['id'] . ")\">Hapus</a>
                                    </td>
                                </tr>";
                        }
                        ?>
                    </div>
                </tbody>
            </table>
        </div>

</div>
    


    <!-- Kode script untuk animasi menambahkan data karyawan -->
     <script>
        document.addEventListener("DOMContentLoaded", function () {
            const notif = document.getElementById("notif-tambah");
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
            const notif = document.getElementById('notif-edit');
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
            const notif = document.getElementById("notif-tambah");
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

    <!-- Pembatas -->

<?php include 'footer.php'; ?>
</body>
</html>

