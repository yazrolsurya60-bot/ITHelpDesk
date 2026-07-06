<?php
$conn = new mysqli('localhost', 'root', '', 'it_helpdesk');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ensure at least some categories exist
$categories = ['Hardware', 'Software', 'Jaringan'];
$kategori_ids = [];
foreach ($categories as $cat) {
    $stmt = $conn->prepare("SELECT id_kategori FROM categories WHERE nama_kategori = ?");
    $stmt->bind_param("s", $cat);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($res->num_rows == 0) {
        $conn->query("INSERT INTO categories (nama_kategori) VALUES ('$cat')");
        $kategori_ids[$cat] = $conn->insert_id;
    } else {
        $kategori_ids[$cat] = $res->fetch_assoc()['id_kategori'];
    }
}

// 1. Insert 25 Locations
$locations = [
    ['Ruang Server', 'Lantai 1'],
    ['Ruang Meeting A', 'Lantai 1'],
    ['Ruang Meeting B', 'Lantai 1'],
    ['Lobby Utama', 'Lantai 1'],
    ['Ruang HRD', 'Lantai 2'],
    ['Ruang Keuangan', 'Lantai 2'],
    ['Ruang Operasional', 'Lantai 2'],
    ['Ruang Direksi', 'Lantai 3'],
    ['Ruang Marketing', 'Lantai 3'],
    ['Pantry', 'Lantai 2'],
    ['Gudang IT', 'Lantai 1'],
    ['Ruang Tunggu', 'Lantai 1'],
    ['Lab Komputer A', 'Lantai 2'],
    ['Lab Komputer B', 'Lantai 2'],
    ['Lab Komputer C', 'Lantai 3'],
    ['Ruang Dosen', 'Lantai 3'],
    ['Perpustakaan', 'Lantai 1'],
    ['Kantin', 'Lantai 1'],
    ['Ruang Kelas 101', 'Lantai 1'],
    ['Ruang Kelas 102', 'Lantai 1'],
    ['Ruang Kelas 201', 'Lantai 2'],
    ['Ruang Kelas 202', 'Lantai 2'],
    ['Ruang Kelas 301', 'Lantai 3'],
    ['Ruang Kelas 302', 'Lantai 3'],
    ['Ruang Seminar', 'Lantai 3']
];

$location_ids = [];
foreach ($locations as $loc) {
    $stmt = $conn->prepare("INSERT INTO locations (nama_ruangan, lantai) VALUES (?, ?)");
    $stmt->bind_param("ss", $loc[0], $loc[1]);
    $stmt->execute();
    $location_ids[] = $conn->insert_id;
}

// 2. Insert 25 Users (Karyawan & Staf IT)
$names = [
    'Budi Santoso', 'Siti Aminah', 'Agus Setiawan', 'Dewi Lestari', 'Hendra Gunawan',
    'Rini Yulianti', 'Ahmad Rizal', 'Fitriani', 'Eko Prasetyo', 'Nina Safitri',
    'Yudi Hermawan', 'Maya Indah', 'Reza Pahlevi', 'Diana Susanti', 'Iwan Fals',
    'Sari Wulandari', 'Anton Syahputra', 'Rina Nose', 'Deny Cagur', 'Ayu Ting Ting',
    'Raffi Ahmad', 'Nagita Slavina', 'Baim Wong', 'Paula Verhoeven', 'Deddy Corbuzier',
    'Cak Lontong'
];

$pass = md5('password123'); // Default password

foreach ($names as $i => $name) {
    $username = strtolower(str_replace(' ', '', $name)) . rand(10,99);
    $role = ($i % 5 == 0) ? 'Staf_IT' : 'Karyawan';
    
    $spesialisasi_id = NULL;
    if ($role == 'Staf_IT') {
        $spesialisasi_id = array_values($kategori_ids)[$i % 3];
    }
    
    $stmt = $conn->prepare("INSERT INTO users (nama_lengkap, username, password, role, spesialisasi_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $name, $username, $pass, $role, $spesialisasi_id);
    $stmt->execute();
}

// 3. Insert 25 Assets
$assets = [
    ['PC Desktop Lenovo M720', 'Hardware'],
    ['Monitor Dell 24"', 'Hardware'],
    ['Printer Epson L3110', 'Hardware'],
    ['Router Mikrotik RB750', 'Jaringan'],
    ['Switch Cisco 2960', 'Jaringan'],
    ['Access Point Ubiquiti', 'Jaringan'],
    ['Server HP ProLiant', 'Hardware'],
    ['Microsoft Office 2021', 'Software'],
    ['Adobe Creative Cloud', 'Software'],
    ['Windows 11 Pro', 'Software'],
    ['Laptop Asus VivoBook', 'Hardware'],
    ['MacBook Pro M2', 'Hardware'],
    ['Kabel UTP Cat6', 'Jaringan'],
    ['UPS APC 1000VA', 'Hardware'],
    ['Projector Epson EB-X05', 'Hardware'],
    ['Webcam Logitech C920', 'Hardware'],
    ['Headset Jabra Evolve', 'Hardware'],
    ['AutoCAD 2024', 'Software'],
    ['CorelDraw Suite', 'Software'],
    ['Antivirus Kaspersky', 'Software'],
    ['NAS Synology DiskStation', 'Hardware'],
    ['Kabel Fiber Optic', 'Jaringan'],
    ['Firewall Fortinet', 'Jaringan'],
    ['IP Phone Yealink', 'Jaringan'],
    ['Smart TV Samsung 55"', 'Hardware']
];

foreach ($assets as $i => $asset) {
    $kode_asset = 'AST-' . date('ymd') . '-' . str_pad($i + 1, 4, '0', STR_PAD_LEFT);
    $nama = $asset[0];
    $cat_name = $asset[1];
    $kategori_id = $kategori_ids[$cat_name];
    $lokasi_id = $location_ids[array_rand($location_ids)];
    
    $stmt = $conn->prepare("INSERT INTO assets (kode_asset, nama_asset, kategori_id, lokasi_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssii", $kode_asset, $nama, $kategori_id, $lokasi_id);
    $stmt->execute();
}

echo "Database seeded successfully with 25 locations, 25 users, and 25 assets!";
?>
