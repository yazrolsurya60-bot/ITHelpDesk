<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staf extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('role') != 'Staf_IT') {
            redirect('auth');
        }
        $this->load->model('Ticket_model');
        $this->load->model('User_model');
        $this->load->model('Notification_model');
        $this->load->model('WorkLog_model');
    }

    public function index()
    {
        $data['title'] = 'Staf IT Dashboard';
        $user_id = $this->session->userdata('user_id');
        
        $data['tickets'] = $this->Ticket_model->get_tickets_by_staf($user_id);
        $data['notifications'] = $this->Notification_model->get_unread_notifications($user_id);
            
        $this->load->view('staf/header', $data);
        $this->load->view('staf/dashboard', $data);
        $this->load->view('staf/footer');
    }

    public function menuju_lokasi($ticket_id)
    {
        $this->Ticket_model->update_status($ticket_id, 'Menuju Lokasi', 'Staf IT sedang menuju lokasi kerusakan.');
        $this->session->set_flashdata('success', 'Status tiket diubah menjadi Menuju Lokasi.');
        redirect('staf');
    }

    public function kerjakan($ticket_id)
    {
        $staf_id = $this->session->userdata('user_id');
        // Start work log
        $this->WorkLog_model->start_log($ticket_id, $staf_id);
        $this->Ticket_model->update_status($ticket_id, 'Dikerjakan', 'Staf IT sedang mengerjakan perbaikan tiket.');
        $this->session->set_flashdata('success', 'Status tiket diubah menjadi Dikerjakan. Pencatat waktu dimulai.');
        redirect('staf');
    }

    public function selesaikan($tiket_id)
    {
        // Finish work log (calculate duration)
        $this->WorkLog_model->finish_log($tiket_id);
        // Update asset condition to Baik if linked
        $tiket = $this->Ticket_model->get_ticket_by_id($tiket_id);
        if ($tiket && $tiket->asset_id) {
            $this->load->model('Asset_model');
            $this->Asset_model->update_asset($tiket->asset_id, ['kondisi' => 'Baik']);
        }
        $data = ['status_tiket' => 'Selesai', 'waktu_selesai' => date('Y-m-d H:i:s')];
        $this->Ticket_model->update_ticket($tiket_id, $data);
        $this->session->set_flashdata('success', 'Tiket berhasil diselesaikan. Durasi kerja telah tersimpan.');
        redirect('staf');
    }

    public function hapus_spam($tiket_id)
    {
        $this->Ticket_model->delete_ticket($tiket_id);
        $this->session->set_flashdata('success', 'Tiket telah dihapus karena dianggap spam.');
        redirect('staf');
    }

    public function profil()
    {
        $data['title'] = 'Profil Staf IT';
        $user_id = $this->session->userdata('user_id');
        
        // Use Master_model or a modified query to get user details including specialization name
        $this->db->select('users.*, categories.nama_kategori as spesialisasi');
        $this->db->from('users');
        $this->db->join('categories', 'categories.id_kategori = users.spesialisasi_id', 'left');
        $this->db->where('users.id_user', $user_id);
        $data['user'] = $this->db->get()->row();
        
        $data['notifications'] = $this->Notification_model->get_unread_notifications($user_id);
        
        $this->load->view('staf/header', $data);
        $this->load->view('staf/profil', $data);
        $this->load->view('staf/footer');
    }
    
    public function update_profil()
    {
        $user_id = $this->session->userdata('user_id');
        $data = [
            'nama_lengkap' => $this->input->post('nama_lengkap'),
            'username' => $this->input->post('username')
        ];
        
        if (!empty($this->input->post('password'))) {
            $data['password'] = md5($this->input->post('password'));
        }
        
        // Handle Photo Upload
        if (!empty($_FILES['foto']['name'])) {
            $config['upload_path'] = './uploads/profil/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = 2048; // 2MB
            $config['encrypt_name'] = TRUE;
            
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('foto')) {
                $uploadData = $this->upload->data();
                $data['foto'] = $uploadData['file_name'];
            }
        }
        
        $this->User_model->update_user($user_id, $data);
        $this->session->set_userdata('name', $data['nama_lengkap']);
        $this->session->set_flashdata('success', 'Profil berhasil diperbarui!');
        redirect('staf/profil');
    }
    
    public function baca_notifikasi()
    {
        $user_id = $this->session->userdata('user_id');
        $this->Notification_model->mark_as_read($user_id);
        redirect('staf');
    }
}
