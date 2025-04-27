
CREATE DATABASE IF NOT EXISTS sistem_gaji;
USE management_gaji;

CREATE TABLE jabatan (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama_jabatan VARCHAR(100) NOT NULL,
  gaji_pokok DECIMAL(15,2) NOT NULL
);

CREATE TABLE karyawan (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100) NOT NULL,
  alamat TEXT,
  no_hp VARCHAR(20),
  jabatan_id INT,
  foto VARCHAR(255),
  FOREIGN KEY (jabatan_id) REFERENCES jabatan(id)
);

CREATE TABLE rating (
  id INT AUTO_INCREMENT PRIMARY KEY,
  karyawan_id INT,
  bulan VARCHAR(20),
  nilai_rating INT,
  FOREIGN KEY (karyawan_id) REFERENCES karyawan(id)
);

CREATE TABLE lembur (
  id INT AUTO_INCREMENT PRIMARY KEY,
  karyawan_id INT,
  bulan VARCHAR(20),
  jam_lembur INT,
  tarif_per_jam DECIMAL(15,2),
  FOREIGN KEY (karyawan_id) REFERENCES karyawan(id)
);

CREATE TABLE gaji (
  id INT AUTO_INCREMENT PRIMARY KEY,
  karyawan_id INT,
  bulan VARCHAR(20),
  total_gaji DECIMAL(15,2),
  FOREIGN KEY (karyawan_id) REFERENCES karyawan(id)
);
