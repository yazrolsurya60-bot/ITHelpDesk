<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ticket_model extends CI_Model {
    
    public function get_all_tickets() {
        return $this->db->select('tickets.*, categories.nama_kategori, users.nama_lengkap as pelapor, staf.nama_lengkap as nama_staf, locations.nama_ruangan, locations.lantai')
            ->from('tickets')
            ->join('categories', 'categories.id_kategori = tickets.kategori_id', 'left')
            ->join('users', 'users.id_user = tickets.pelapor_id', 'left')
            ->join('users staf', 'staf.id_user = tickets.staf_ditugaskan_id', 'left')
            ->join('locations', 'locations.id_lokasi = tickets.lokasi_id', 'left')
            ->order_by('waktu_dibuat', 'DESC')
            ->get()->result();
    }
    
    public function get_active_tickets_monitoring() {
        return $this->db->select('tickets.*, categories.nama_kategori, users.nama_lengkap as pelapor, staf.nama_lengkap as nama_staf, locations.nama_ruangan, locations.lantai')
            ->from('tickets')
            ->join('categories', 'categories.id_kategori = tickets.kategori_id', 'left')
            ->join('users', 'users.id_user = tickets.pelapor_id', 'left')
            ->join('users staf', 'staf.id_user = tickets.staf_ditugaskan_id', 'left')
            ->join('locations', 'locations.id_lokasi = tickets.lokasi_id', 'left')
            ->where_in('status_tiket', ['Menuju Lokasi', 'Dikerjakan'])
            ->order_by('waktu_dibuat', 'DESC')
            ->get()->result();
    }

    public function get_tickets_filtered($tahun = '', $kategori_id = '') {
        $this->db->select('tickets.*, categories.nama_kategori, users.nama_lengkap as pelapor, staf.nama_lengkap as nama_staf, locations.nama_ruangan, locations.lantai, assets.nama_asset')
            ->from('tickets')
            ->join('categories', 'categories.id_kategori = tickets.kategori_id', 'left')
            ->join('users', 'users.id_user = tickets.pelapor_id', 'left')
            ->join('users staf', 'staf.id_user = tickets.staf_ditugaskan_id', 'left')
            ->join('locations', 'locations.id_lokasi = tickets.lokasi_id', 'left')
            ->join('assets', 'assets.id_asset = tickets.asset_id', 'left');
            
        if (!empty($tahun)) {
            $this->db->where('YEAR(waktu_dibuat)', $tahun);
        }
        if (!empty($kategori_id)) {
            $this->db->where('kategori_id', $kategori_id);
        }
        
        return $this->db->order_by('waktu_dibuat', 'DESC')->get()->result();
    }

    public function get_top_broken_assets($limit = 5) {
        return $this->db->select('assets.nama_asset, assets.jenis_asset, COUNT(tickets.id_tiket) as total_rusak')
            ->from('tickets')
            ->join('assets', 'assets.id_asset = tickets.asset_id')
            ->where('tickets.asset_id IS NOT NULL', null, false)
            ->group_by('tickets.asset_id')
            ->order_by('total_rusak', 'DESC')
            ->limit($limit)
            ->get()->result();
    }

    public function get_tickets_by_staf($staf_id) {
        return $this->db->select('tickets.*, categories.nama_kategori, users.nama_lengkap as pelapor, locations.nama_ruangan, locations.lantai, assets.nama_asset')
            ->from('tickets')
            ->join('categories', 'categories.id_kategori = tickets.kategori_id', 'left')
            ->join('users', 'users.id_user = tickets.pelapor_id', 'left')
            ->join('locations', 'locations.id_lokasi = tickets.lokasi_id', 'left')
            ->join('assets', 'assets.id_asset = tickets.asset_id', 'left')
            ->where('staf_ditugaskan_id', $staf_id)
            ->order_by('waktu_dibuat', 'DESC')
            ->get()->result();
    }

    public function get_tickets_by_pelapor($pelapor_id) {
        return $this->db->select('tickets.*, categories.nama_kategori, staf.nama_lengkap as nama_staf, locations.nama_ruangan, locations.lantai')
            ->from('tickets')
            ->join('categories', 'categories.id_kategori = tickets.kategori_id', 'left')
            ->join('users staf', 'staf.id_user = tickets.staf_ditugaskan_id', 'left')
            ->join('locations', 'locations.id_lokasi = tickets.lokasi_id', 'left')
            ->join('assets', 'assets.id_asset = tickets.asset_id', 'left')
            ->where('pelapor_id', $pelapor_id)
            ->order_by('waktu_dibuat', 'DESC')
            ->get()->result();
    }
    
    public function get_ticket($id_tiket) {
        return $this->db->get_where('tickets', ['id_tiket' => $id_tiket])->row();
    }

    public function get_ticket_by_id($id_tiket) {
        return $this->db->get_where('tickets', ['id_tiket' => $id_tiket])->row();
    }

    public function update_ticket($id_tiket, $data) {
        $this->db->where('id_tiket', $id_tiket)->update('tickets', $data);
    }

    public function create_ticket($data) {
        $this->db->insert('tickets', $data);
        $insert_id = $this->db->insert_id();
        
        // Log history
        $this->add_history($insert_id, 'Menunggu', 'Tiket dibuat oleh pelapor.');
        return $insert_id;
    }
    
    public function update_status($id_tiket, $status, $keterangan = '') {
        $data = ['status_tiket' => $status];
        if ($status == 'Selesai') {
            $data['waktu_selesai'] = date('Y-m-d H:i:s');
        }
        $this->db->where('id_tiket', $id_tiket)->update('tickets', $data);
        
        // Log history
        $this->add_history($id_tiket, $status, $keterangan);
    }
    
    public function delete_ticket($id_tiket) {
        $this->db->where('id_tiket', $id_tiket)->delete('tickets');
    }

    public function add_history($tiket_id, $status_ubah, $keterangan) {
        $this->db->insert('ticket_histories', [
            'tiket_id' => $tiket_id,
            'status_ubah' => $status_ubah,
            'keterangan' => $keterangan
        ]);
    }
    
    public function count_tickets_by_status($status) {
        return $this->db->where('status_tiket', $status)->count_all_results('tickets');
    }
}
