<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_model extends CI_Model {

    public function save_report($data) {
        return $this->db->insert('reports', $data);
    }

    public function get_all_reports() {
        $this->db->select('reports.*, users.nama_lengkap as nama_admin');
        $this->db->from('reports');
        $this->db->join('users', 'users.id_user = reports.dibuat_oleh', 'left');
        $this->db->order_by('reports.created_at', 'DESC');
        return $this->db->get()->result();
    }

    public function get_report_by_id($id) {
        return $this->db->get_where('reports', ['id_report' => $id])->row();
    }

    public function delete_report($id) {
        $this->db->where('id_report', $id);
        return $this->db->delete('reports');
    }
}
