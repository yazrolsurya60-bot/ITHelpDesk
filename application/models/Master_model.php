<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_model extends CI_Model {
    // Categories
    public function get_all_categories() {
        return $this->db->get('categories')->result();
    }
    
    public function get_category($id_kategori) {
        return $this->db->get_where('categories', ['id_kategori' => $id_kategori])->row();
    }
    
    public function create_category($data) {
        return $this->db->insert('categories', $data);
    }

    public function update_category($id, $data) {
        $this->db->where('id_kategori', $id);
        return $this->db->update('categories', $data);
    }

    public function delete_category($id) {
        $this->db->where('id_kategori', $id);
        return $this->db->delete('categories');
    }
    
    // Locations
    public function get_all_locations() {
        return $this->db->get('locations')->result();
    }
    
    public function get_locations_paginated($limit, $start) {
        $this->db->limit($limit, $start);
        return $this->db->get('locations')->result();
    }
    
    public function count_all_locations() {
        return $this->db->count_all('locations');
    }
    
    public function get_location($id_lokasi) {
        return $this->db->get_where('locations', ['id_lokasi' => $id_lokasi])->row();
    }

    public function create_location($data) {
        return $this->db->insert('locations', $data);
    }

    public function update_location($id, $data) {
        $this->db->where('id_lokasi', $id);
        return $this->db->update('locations', $data);
    }

    public function delete_location($id) {
        $this->db->where('id_lokasi', $id);
        return $this->db->delete('locations');
    }
}
