<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Asset_model extends CI_Model {

    public function get_all_assets() {
        $this->db->select('assets.*, locations.lantai, locations.nama_ruangan');
        $this->db->from('assets');
        $this->db->join('locations', 'locations.id_lokasi = assets.lokasi_id', 'left');
        $this->db->order_by('assets.kondisi', 'ASC');
        return $this->db->get()->result();
    }
    
    public function get_assets_paginated($limit, $start) {
        $this->db->select('assets.*, locations.lantai, locations.nama_ruangan');
        $this->db->from('assets');
        $this->db->join('locations', 'locations.id_lokasi = assets.lokasi_id', 'left');
        $this->db->order_by('assets.kondisi', 'ASC');
        $this->db->limit($limit, $start);
        return $this->db->get()->result();
    }
    
    public function count_all_assets() {
        return $this->db->count_all('assets');
    }

    public function get_asset_by_id($id) {
        return $this->db->get_where('assets', ['id_asset' => $id])->row();
    }

    public function get_assets_by_location($lokasi_id) {
        return $this->db->get_where('assets', ['lokasi_id' => $lokasi_id])->result();
    }

    public function create_asset($data) {
        return $this->db->insert('assets', $data);
    }

    public function update_asset($id, $data) {
        $this->db->where('id_asset', $id);
        return $this->db->update('assets', $data);
    }

    public function delete_asset($id) {
        $this->db->where('id_asset', $id);
        return $this->db->delete('assets');
    }

    public function count_by_kondisi($kondisi) {
        return $this->db->where('kondisi', $kondisi)->count_all_results('assets');
    }
}
