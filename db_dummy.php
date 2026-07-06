<?php
$servername = "localhost";
$username = "root";
$password = "";

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Recreate database
$conn->query("DROP DATABASE IF EXISTS it_helpdesk");
$conn->query("CREATE DATABASE it_helpdesk");
$conn->select_db("it_helpdesk");

// Read schema.sql
$sql = file_get_contents(__DIR__ . '/schema.sql');
$queries = explode(';', $sql);

foreach ($queries as $query) {
    $query = trim($query);
    if (!empty($query)) {
        if (!$conn->query($query)) {
            echo "Error executing query: " . $conn->error . "\nQuery: " . $query . "\n";
        }
    }
}

// Insert Dummy Data
$conn->query("INSERT INTO categories (nama_kategori, deskripsi_kategori) VALUES ('Jaringan', 'Masalah koneksi internet atau LAN'), ('Hardware', 'Kerusakan fisik PC, Printer, dll'), ('Software', 'Error aplikasi, Windows, dll')");
$conn->query("INSERT INTO locations (lantai, nama_ruangan) VALUES ('Lantai 1', 'Ruang Server'), ('Lantai 1', 'Lobi'), ('Lantai 2', 'Ruang Rapat Utama'), ('Lantai 3', 'Divisi HR')");

// Insert users (password 'staf123' and 'karyawan123')
$conn->query("INSERT INTO users (nama_lengkap, username, password, role, spesialisasi_id, status_kehadiran) VALUES ('Budi Staf Jaringan', 'budi_net', md5('staf123'), 'Staf_IT', 1, 'Aktif')");
$conn->query("INSERT INTO users (nama_lengkap, username, password, role, spesialisasi_id, status_kehadiran) VALUES ('Ani Staf Hardware', 'ani_hw', md5('staf123'), 'Staf_IT', 2, 'Aktif')");
$conn->query("INSERT INTO users (nama_lengkap, username, password, role, spesialisasi_id) VALUES ('Andi Karyawan', 'andi', md5('karyawan123'), 'Karyawan', NULL)");

echo "Database recreated and dummy data inserted successfully!\n";
$conn->close();
?>
