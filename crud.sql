-- Membuat database STB_1
CREATE DATABASE IF NOT EXISTS STB_1;
USE STB_1;

-- Hapus tabel jika sudah ada untuk menghindari konflik
DROP TABLE IF EXISTS KRS;
DROP TABLE IF EXISTS Mahasiswa;
DROP TABLE IF EXISTS MataKuliah;
DROP TABLE IF EXISTS Dosen;

-- Tabel Mahasiswa
CREATE TABLE Mahasiswa (
    NIM VARCHAR(10) PRIMARY KEY,
    Nama VARCHAR(100),
    Alamat VARCHAR(255)
);

-- Tabel Mata Kuliah
CREATE TABLE MataKuliah (
    KodeMataKuliah VARCHAR(10) PRIMARY KEY,
    NamaMataKuliah VARCHAR(100),
    SKS INT,
    Semester INT
);

-- Tabel Dosen
CREATE TABLE Dosen (
    NIP VARCHAR(15) PRIMARY KEY,
    Nama VARCHAR(100),
    Alamat VARCHAR(255)
);

-- Tabel KRS (Menghubungkan Mahasiswa, Mata Kuliah, dan Dosen)
CREATE TABLE KRS (
    ID_KRS MEDIUMINT NOT NULL AUTO_INCREMENT,
    NIM VARCHAR(10),
    KodeMataKuliah VARCHAR(10),
    NIP VARCHAR(15),
    Nilai CHAR(2),
    PRIMARY KEY (ID_KRS), 
    FOREIGN KEY (NIM) REFERENCES Mahasiswa(NIM) ON DELETE CASCADE,
    FOREIGN KEY (KodeMataKuliah) REFERENCES MataKuliah(KodeMataKuliah) ON DELETE CASCADE,
    FOREIGN KEY (NIP) REFERENCES Dosen(NIP) ON DELETE CASCADE
);

-- Insert ke tabel Mahasiswa
INSERT INTO Mahasiswa (NIM, Nama, Alamat) VALUES
('L0122001', 'Ahmad Fauzan', 'Jl. Merdeka No. 10'),
('L0122002', 'Rina Sari', 'Jl. Sudirman No. 20'),
('L0122003', 'Budi Santoso', 'Jl. Diponegoro No. 30'),
('L0122004', 'Siti Aminah', 'Jl. Gatot Subroto No. 40'),
('L0122005', 'Dewi Lestari', 'Jl. Thamrin No. 50');

-- Insert ke tabel MataKuliah
INSERT INTO MataKuliah (KodeMataKuliah, NamaMataKuliah, SKS, Semester) VALUES
('MK001', 'Basis Data', 3, 3),
('MK002', 'Pemrograman Web', 4, 3),
('MK003', 'Kecerdasan Buatan', 3, 5),
('MK004', 'Jaringan Komputer', 4, 4),
('MK005', 'Sistem Operasi', 3, 4);

-- Insert ke tabel Dosen
INSERT INTO Dosen (NIP, Nama, Alamat) VALUES
('19780101', 'Dr. Andi Wijaya', 'Jl. Imam Bonjol No. 10'),
('19790202', 'Prof. Siti Rahmah', 'Jl. Kartini No. 20'),
('19800303', 'Dr. Bambang Saputra', 'Jl. Dipatiukur No. 30'),
('19810404', 'Dr. Lestari Kusuma', 'Jl. Cendana No. 40'),
('19820505', 'Prof. Zainal Arifin', 'Jl. Mangga No. 50');

-- Insert ke tabel KRS
INSERT INTO KRS (NIM, KodeMataKuliah, NIP, Nilai) VALUES
('L0122001', 'MK001', '19780101', 'A'),
('L0122001', 'MK002', '19790202', 'B'),
('L0122001', 'MK003', '19800303', 'A'),
('L0122002', 'MK002', '19810404', 'B'),
('L0122002', 'MK001', '19820505', 'C');
