
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
  umur INT NOT NULL,
  jenis_kelamin enum('Laki-laki', 'Perempuan', '', '')
  alamat TEXT,
  no_hp VARCHAR(20),
  status_ VARCHAR NOT NULL,
  jabatan_id INT,
  foto VARCHAR(255),
  nilai_rating INT NOT NULL,
  tgl_bergabung DATE NOT NULL,
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
  jabatan_id INT,
  karyawan_id INT,
  nama_jabatan VARCHAR(100),
  bulan VARCHAR(20),
  jam_lembur INT,
  tarif_per_jam DECIMAL(15,2),
  FOREIGN KEY (karyawan_id) REFERENCES karyawan(id)
);

CREATE TABLE gaji (
  id INT AUTO_INCREMENT PRIMARY KEY,
  karyawan_id INT,
  nama_karyawan VARCHAR(64),
  gaji_pokok INT(16),
  tarif_lembur INT(16),
  bonus_rating INT(16),
  bulan VARCHAR(20),
  total_gaji DECIMAL(15,2),
  FOREIGN KEY (karyawan_id) REFERENCES karyawan(id)
);
