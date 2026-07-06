-- Data Dummy untuk ITHelpDesk
-- Berisi minimal 25 Lokasi, 25 User, dan 25 Asset

-- 1. Insert Categories (Abaikan jika sudah ada, atau gunakan INSERT IGNORE)
INSERT IGNORE INTO `categories` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Hardware'),
(2, 'Software'),
(3, 'Jaringan');

-- 2. Insert 25 Locations
INSERT INTO `locations` (`nama_ruangan`, `lantai`) VALUES
('Ruang Server', 'Lantai 1'),
('Ruang Meeting A', 'Lantai 1'),
('Ruang Meeting B', 'Lantai 1'),
('Lobby Utama', 'Lantai 1'),
('Ruang HRD', 'Lantai 2'),
('Ruang Keuangan', 'Lantai 2'),
('Ruang Operasional', 'Lantai 2'),
('Ruang Direksi', 'Lantai 3'),
('Ruang Marketing', 'Lantai 3'),
('Pantry', 'Lantai 2'),
('Gudang IT', 'Lantai 1'),
('Ruang Tunggu', 'Lantai 1'),
('Lab Komputer A', 'Lantai 2'),
('Lab Komputer B', 'Lantai 2'),
('Lab Komputer C', 'Lantai 3'),
('Ruang Dosen', 'Lantai 3'),
('Perpustakaan', 'Lantai 1'),
('Kantin', 'Lantai 1'),
('Ruang Kelas 101', 'Lantai 1'),
('Ruang Kelas 102', 'Lantai 1'),
('Ruang Kelas 201', 'Lantai 2'),
('Ruang Kelas 202', 'Lantai 2'),
('Ruang Kelas 301', 'Lantai 3'),
('Ruang Kelas 302', 'Lantai 3'),
('Ruang Seminar', 'Lantai 3');

-- 3. Insert 15 Users (Karyawan & Staf IT)
-- KETERANGAN PASSWORD:
-- Semua user di bawah ini menggunakan password default yaitu: password123
-- Password langsung di-hash menggunakan fungsi MD5('password123') di dalam query.
INSERT INTO `users` (`nama_lengkap`, `username`, `password`, `role`, `spesialisasi_id`, `status_kehadiran`) VALUES
('Budi Santoso', 'budisantoso12', MD5('password123'), 'Staf_IT', 1, 'Aktif'),
('Siti Aminah', 'sitiaminah34', MD5('password123'), 'Karyawan', NULL, 'Aktif'),
('Agus Setiawan', 'agussetiawan56', MD5('password123'), 'Karyawan', NULL, 'Aktif'),
('Dewi Lestari', 'dewilestari78', MD5('password123'), 'Karyawan', NULL, 'Aktif'),
('Hendra Gunawan', 'hendragunawan90', MD5('password123'), 'Karyawan', NULL, 'Aktif'),
('Rini Yulianti', 'riniyulianti23', MD5('password123'), 'Staf_IT', 2, 'Aktif'),
('Ahmad Rizal', 'ahmadrizal45', MD5('password123'), 'Karyawan', NULL, 'Aktif'),
('Fitriani', 'fitriani67', MD5('password123'), 'Karyawan', NULL, 'Aktif'),
('Eko Prasetyo', 'ekoprasetyo89', MD5('password123'), 'Karyawan', NULL, 'Aktif'),
('Nina Safitri', 'ninasafitri10', MD5('password123'), 'Karyawan', NULL, 'Aktif'),
('Yudi Hermawan', 'yudihermawan32', MD5('password123'), 'Staf_IT', 3, 'Aktif'),
('Maya Indah', 'mayaindah54', MD5('password123'), 'Karyawan', NULL, 'Aktif'),
('Reza Pahlevi', 'rezapahlevi76', MD5('password123'), 'Karyawan', NULL, 'Aktif'),
('Diana Susanti', 'dianasusanti98', MD5('password123'), 'Karyawan', NULL, 'Aktif'),
('Iwan Fals', 'iwanfals21', MD5('password123'), 'Karyawan', NULL, 'Aktif');


-- 4. Insert 25 Assets
-- Menggunakan subquery dinamis untuk mendapatkan ID kategori dan ID lokasi agar selalu valid
INSERT INTO `assets` (`nama_asset`, `jenis_asset`, `lokasi_id`, `no_seri`, `kondisi`, `keterangan`, `created_at`) VALUES
('PC Desktop Lenovo M720', 'Hardware', (SELECT id_lokasi FROM locations ORDER BY RAND() LIMIT 1), 'AST-2401-0001', 'Baik', 'Aset baru dari pengadaan 2024', NOW()),
('Monitor Dell 24 Inch', 'Hardware', (SELECT id_lokasi FROM locations ORDER BY RAND() LIMIT 1), 'AST-2401-0002', 'Baik', 'Aset aktif digunakan', NOW()),
('Printer Epson L3110', 'Hardware', (SELECT id_lokasi FROM locations ORDER BY RAND() LIMIT 1), 'AST-2401-0003', 'Baik', 'Pemakaian reguler', NOW()),
('Router Mikrotik RB750', 'Jaringan', (SELECT id_lokasi FROM locations ORDER BY RAND() LIMIT 1), 'AST-2401-0004', 'Baik', 'Terpasang di rak server', NOW()),
('Switch Cisco 2960', 'Jaringan', (SELECT id_lokasi FROM locations ORDER BY RAND() LIMIT 1), 'AST-2401-0005', 'Baik', 'Terpasang', NOW()),
('Access Point Ubiquiti', 'Jaringan', (SELECT id_lokasi FROM locations ORDER BY RAND() LIMIT 1), 'AST-2401-0006', 'Baik', 'Menyala normal', NOW()),
('Server HP ProLiant', 'Hardware', (SELECT id_lokasi FROM locations WHERE nama_ruangan = 'Ruang Server' LIMIT 1), 'AST-2401-0007', 'Baik', 'Server utama aplikasi', NOW()),
('Microsoft Office 2021', 'Software', (SELECT id_lokasi FROM locations ORDER BY RAND() LIMIT 1), 'AST-2401-0008', 'Baik', 'Lisensi aktif', NOW()),
('Adobe Creative Cloud', 'Software', (SELECT id_lokasi FROM locations ORDER BY RAND() LIMIT 1), 'AST-2401-0009', 'Baik', 'Lisensi tahunan', NOW()),
('Windows 11 Pro', 'Software', (SELECT id_lokasi FROM locations ORDER BY RAND() LIMIT 1), 'AST-2401-0010', 'Baik', 'Lisensi per PC', NOW()),
('Laptop Asus VivoBook', 'Hardware', (SELECT id_lokasi FROM locations ORDER BY RAND() LIMIT 1), 'AST-2401-0011', 'Dalam Perbaikan', 'Masalah pada baterai', NOW()),
('MacBook Pro M2', 'Hardware', (SELECT id_lokasi FROM locations ORDER BY RAND() LIMIT 1), 'AST-2401-0012', 'Baik', 'Aset khusus direksi', NOW()),
('Kabel UTP Cat6 100m', 'Jaringan', (SELECT id_lokasi FROM locations ORDER BY RAND() LIMIT 1), 'AST-2401-0013', 'Baik', 'Persediaan', NOW()),
('UPS APC 1000VA', 'Hardware', (SELECT id_lokasi FROM locations ORDER BY RAND() LIMIT 1), 'AST-2401-0014', 'Rusak Ringan', 'Baterai mulai drop', NOW()),
('Projector Epson EB-X05', 'Hardware', (SELECT id_lokasi FROM locations ORDER BY RAND() LIMIT 1), 'AST-2401-0015', 'Baik', 'Terpasang di ruang meeting', NOW()),
('Webcam Logitech C920', 'Hardware', (SELECT id_lokasi FROM locations ORDER BY RAND() LIMIT 1), 'AST-2401-0016', 'Baik', 'Siap pakai', NOW()),
('Headset Jabra Evolve', 'Hardware', (SELECT id_lokasi FROM locations ORDER BY RAND() LIMIT 1), 'AST-2401-0017', 'Baik', 'Terpakai', NOW()),
('AutoCAD 2024 License', 'Software', (SELECT id_lokasi FROM locations ORDER BY RAND() LIMIT 1), 'AST-2401-0018', 'Baik', 'Aktif', NOW()),
('CorelDraw Suite', 'Software', (SELECT id_lokasi FROM locations ORDER BY RAND() LIMIT 1), 'AST-2401-0019', 'Baik', 'Aktif', NOW()),
('Antivirus Kaspersky', 'Software', (SELECT id_lokasi FROM locations ORDER BY RAND() LIMIT 1), 'AST-2401-0020', 'Baik', 'Expired bulan depan', NOW()),
('NAS Synology DiskStation', 'Hardware', (SELECT id_lokasi FROM locations ORDER BY RAND() LIMIT 1), 'AST-2401-0021', 'Baik', 'Berfungsi normal', NOW()),
('Kabel Fiber Optic', 'Jaringan', (SELECT id_lokasi FROM locations ORDER BY RAND() LIMIT 1), 'AST-2401-0022', 'Baik', 'Kondisi baik', NOW()),
('Firewall Fortinet', 'Jaringan', (SELECT id_lokasi FROM locations ORDER BY RAND() LIMIT 1), 'AST-2401-0023', 'Baik', 'Berjalan normal', NOW()),
('IP Phone Yealink', 'Jaringan', (SELECT id_lokasi FROM locations ORDER BY RAND() LIMIT 1), 'AST-2401-0024', 'Baik', 'Siap pakai', NOW()),
('Smart TV Samsung 55 Inch', 'Hardware', (SELECT id_lokasi FROM locations ORDER BY RAND() LIMIT 1), 'AST-2401-0025', 'Baik', 'Terpasang di ruang tunggu', NOW());
