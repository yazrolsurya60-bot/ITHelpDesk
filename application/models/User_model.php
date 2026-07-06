<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
    public function get_user_by_username($username) {
        return $this->db->get_where('users', ['username' => $username])->row();
    }
    
    public function get_user_by_id($id_user) {
        return $this->db->get_where('users', ['id_user' => $id_user])->row();
    }
    
    public function create_user($data) {
        return $this->db->insert('users', $data);
    }
    
    public function update_user($id_user, $data) {
        $this->db->where('id_user', $id_user);
        return $this->db->update('users', $data);
    }
    
    public function get_staf_by_specialty($kategori_id) {
        // Metode Least Loaded: Cari teknisi aktif dengan beban kerja (tiket In Progress) paling sedikit
        $sql = "
            SELECT u.*, 
                   (SELECT COUNT(id_tiket) FROM tickets t 
                    WHERE t.staf_ditugaskan_id = u.id_user 
                    AND t.status_tiket IN ('Menunggu', 'Menuju Lokasi', 'Dikerjakan')) as active_tickets
            FROM users u
            WHERE u.role = 'Staf_IT' 
              AND u.status_kehadiran = 'Aktif'
              AND u.spesialisasi_id = ?
            ORDER BY active_tickets ASC
            LIMIT 1
        ";
        return $this->db->query($sql, [$kategori_id])->row();
    }
    
    public function get_all_users() {
        $this->db->select('users.*, categories.nama_kategori as spesialisasi');
        $this->db->from('users');
        $this->db->join('categories', 'categories.id_kategori = users.spesialisasi_id', 'left');
        $this->db->order_by('users.role', 'ASC');
        return $this->db->get()->result();
    }
    
    public function get_users_paginated($limit, $start) {
        $this->db->select('users.*, categories.nama_kategori as spesialisasi');
        $this->db->from('users');
        $this->db->join('categories', 'categories.id_kategori = users.spesialisasi_id', 'left');
        $this->db->order_by('users.role', 'ASC');
        $this->db->limit($limit, $start);
        return $this->db->get()->result();
    }
    
    public function count_all_users() {
        return $this->db->count_all('users');
    }
    
    public function delete_user($id_user) {
        $this->db->where('id_user', $id_user);
        return $this->db->delete('users');
    }
}
