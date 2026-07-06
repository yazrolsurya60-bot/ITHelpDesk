<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification_model extends CI_Model {
    
    public function add_notification($user_id, $tiket_id, $pesan) {
        $this->db->insert('notifications', [
            'user_id' => $user_id,
            'tiket_id' => $tiket_id,
            'pesan_notifikasi' => $pesan
        ]);
    }
    
    public function get_unread_notifications($user_id) {
        return $this->db->where('user_id', $user_id)
            ->where('status_baca', 'Belum')
            ->order_by('created_at', 'DESC')
            ->get('notifications')->result();
    }
    
    public function mark_as_read($user_id) {
        $this->db->where('user_id', $user_id)
            ->update('notifications', ['status_baca' => 'Sudah']);
    }
}
