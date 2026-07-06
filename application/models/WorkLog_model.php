<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WorkLog_model extends CI_Model {

    public function start_log($tiket_id, $staf_id) {
        // Only create a log if one doesn't exist yet for this ticket
        $existing = $this->db->get_where('work_logs', ['tiket_id' => $tiket_id])->row();
        if (!$existing) {
            $this->db->insert('work_logs', [
                'tiket_id'    => $tiket_id,
                'staf_id'     => $staf_id,
                'waktu_mulai' => date('Y-m-d H:i:s')
            ]);
        }
    }

    public function finish_log($tiket_id) {
        $log = $this->db->get_where('work_logs', ['tiket_id' => $tiket_id])->row();
        if ($log && !$log->waktu_selesai) {
            $mulai    = strtotime($log->waktu_mulai);
            $selesai  = time();
            $durasi   = round(($selesai - $mulai) / 60); // in minutes
            $this->db->where('id_log', $log->id_log);
            $this->db->update('work_logs', [
                'waktu_selesai'  => date('Y-m-d H:i:s'),
                'durasi_menit'   => $durasi
            ]);
        }
    }

    public function get_log_by_ticket($tiket_id) {
        return $this->db->get_where('work_logs', ['tiket_id' => $tiket_id])->row();
    }

    public function get_all_logs_with_detail() {
        $this->db->select('work_logs.*, tickets.deskripsi_masalah, users.nama_lengkap as nama_staf, categories.nama_kategori');
        $this->db->from('work_logs');
        $this->db->join('tickets', 'tickets.id_tiket = work_logs.tiket_id', 'left');
        $this->db->join('users', 'users.id_user = work_logs.staf_id', 'left');
        $this->db->join('categories', 'categories.id_kategori = tickets.kategori_id', 'left');
        $this->db->order_by('work_logs.waktu_mulai', 'DESC');
        return $this->db->get()->result();
    }

    public function get_avg_duration_by_staf($staf_id) {
        $this->db->select_avg('durasi_menit', 'avg_durasi');
        $this->db->where('staf_id', $staf_id);
        $this->db->where('durasi_menit IS NOT NULL', null, false);
        return $this->db->get('work_logs')->row();
    }
}
