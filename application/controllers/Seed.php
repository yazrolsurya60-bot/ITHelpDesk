<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seed extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function run() {
        // Ensure categories exist
        $categories = ['Hardware', 'Software', 'Jaringan'];
        $kategori_ids = [];
        foreach ($categories as $cat) {
            $query = $this->db->get_where('categories', ['nama_kategori' => $cat]);
            if ($query->num_rows() == 0) {
                $this->db->insert('categories', ['nama_kategori' => $cat]);
                $kategori_ids[$cat] = $this->db->insert_id();
            } else {
                $kategori_ids[$cat] = $query->row()->id_kategori;
            }
        }

        // 1. Insert 25 Locations
        $locations = [
            ['Ruang Server', 'Lantai 1'], ['Ruang Meeting A', 'Lantai 1'], ['Ruang Meeting B', 'Lantai 1'],
            ['Lobby Utama', 'Lantai 1'], ['Ruang HRD', 'Lantai 2'], ['Ruang Keuangan', 'Lantai 2'],
            ['Ruang Operasional', 'Lantai 2'], ['Ruang Direksi', 'Lantai 3'], ['Ruang Marketing', 'Lantai 3'],
            ['Pantry', 'Lantai 2'], ['Gudang IT', 'Lantai 1'], ['Ruang Tunggu', 'Lantai 1'],
            ['Lab Komputer A', 'Lantai 2'], ['Lab Komputer B', 'Lantai 2'], ['Lab Komputer C', 'Lantai 3'],
            ['Ruang Dosen', 'Lantai 3'], ['Perpustakaan', 'Lantai 1'], ['Kantin', 'Lantai 1'],
            ['Ruang Kelas 101', 'Lantai 1'], ['Ruang Kelas 102', 'Lantai 1'], ['Ruang Kelas 201', 'Lantai 2'],
            ['Ruang Kelas 202', 'Lantai 2'], ['Ruang Kelas 301', 'Lantai 3'], ['Ruang Kelas 302', 'Lantai 3'],
            ['Ruang Seminar', 'Lantai 3']
        ];

        $location_ids = [];
        foreach ($locations as $loc) {
            $this->db->insert('locations', [
                'nama_ruangan' => $loc[0],
                'lantai' => $loc[1]
            ]);
            $location_ids[] = $this->db->insert_id();
        }

        // 2. Insert 25 Users (Karyawan & Staf IT)
        $names = [
            'Budi Santoso', 'Siti Aminah', 'Agus Setiawan', 'Dewi Lestari', 'Hendra Gunawan',
            'Rini Yulianti', 'Ahmad Rizal', 'Fitriani', 'Eko Prasetyo', 'Nina Safitri',
            'Yudi Hermawan', 'Maya Indah', 'Reza Pahlevi', 'Diana Susanti', 'Iwan Fals',
            'Sari Wulandari', 'Anton Syahputra', 'Rina Nose', 'Deny Cagur', 'Ayu Ting Ting',
            'Raffi Ahmad', 'Nagita Slavina', 'Baim Wong', 'Paula Verhoeven', 'Deddy Corbuzier'
        ];

        $pass = md5('password123'); // Default password

        foreach ($names as $i => $name) {
            $username = strtolower(str_replace(' ', '', $name)) . rand(10,99);
            $role = ($i % 5 == 0) ? 'Staf_IT' : 'Karyawan';
            
            $spesialisasi_id = NULL;
            if ($role == 'Staf_IT') {
                $spesialisasi_id = array_values($kategori_ids)[$i % 3];
            }
            
            $this->db->insert('users', [
                'nama_lengkap' => $name,
                'username' => $username,
                'password' => $pass,
                'role' => $role,
                'spesialisasi_id' => $spesialisasi_id
            ]);
        }

        // 3. Insert 25 Assets
        $assets = [
            ['PC Desktop Lenovo M720', 'Hardware'], ['Monitor Dell 24"', 'Hardware'], ['Printer Epson L3110', 'Hardware'],
            ['Router Mikrotik RB750', 'Jaringan'], ['Switch Cisco 2960', 'Jaringan'], ['Access Point Ubiquiti', 'Jaringan'],
            ['Server HP ProLiant', 'Hardware'], ['Microsoft Office 2021', 'Software'], ['Adobe Creative Cloud', 'Software'],
            ['Windows 11 Pro', 'Software'], ['Laptop Asus VivoBook', 'Hardware'], ['MacBook Pro M2', 'Hardware'],
            ['Kabel UTP Cat6', 'Jaringan'], ['UPS APC 1000VA', 'Hardware'], ['Projector Epson EB-X05', 'Hardware'],
            ['Webcam Logitech C920', 'Hardware'], ['Headset Jabra Evolve', 'Hardware'], ['AutoCAD 2024', 'Software'],
            ['CorelDraw Suite', 'Software'], ['Antivirus Kaspersky', 'Software'], ['NAS Synology DiskStation', 'Hardware'],
            ['Kabel Fiber Optic', 'Jaringan'], ['Firewall Fortinet', 'Jaringan'], ['IP Phone Yealink', 'Jaringan'],
            ['Smart TV Samsung 55"', 'Hardware']
        ];

        foreach ($assets as $i => $asset) {
            $kode_asset = 'AST-' . date('ymd') . '-' . str_pad($i + 1, 4, '0', STR_PAD_LEFT);
            $nama = $asset[0];
            $cat_name = $asset[1];
            
            $this->db->insert('assets', [
                'kode_asset' => $kode_asset,
                'nama_asset' => $nama,
                'kategori_id' => $kategori_ids[$cat_name],
                'lokasi_id' => $location_ids[array_rand($location_ids)]
            ]);
        }

        echo "Database seeded successfully via CI!";
    }
}
