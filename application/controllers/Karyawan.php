<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('role') != 'Karyawan') {
            redirect('auth');
        }
        $this->load->model('Ticket_model');
        $this->load->model('Master_model');
        $this->load->model('User_model');
        $this->load->model('Notification_model');
        $this->load->model('Evaluation_model');
        $this->load->model('Asset_model');
        $this->load->library('upload');
    }

    public function index()
    {
        $data['title'] = 'Karyawan Dashboard';
        $user_id = $this->session->userdata('user_id');
        $data['tickets'] = $this->Ticket_model->get_tickets_by_pelapor($user_id);
            
        $data['categories'] = $this->Master_model->get_all_categories();
        $data['locations']  = $this->Master_model->get_all_locations();
        $data['assets']     = $this->Asset_model->get_all_assets();
        
        // Build JSON map: { kategori_id: has_asset } for JS usage
        $map = [];
        foreach($data['categories'] as $cat) {
            $map[$cat->id_kategori] = (bool)$cat->has_asset;
        }
        $data['category_asset_map'] = json_encode($map);
            
        $this->load->view('karyawan/header', $data);
        $this->load->view('karyawan/dashboard', $data);
        $this->load->view('karyawan/footer');
    }

    public function lapor()
    {
        $category_id = $this->input->post('category_id');
        $location_id = $this->input->post('location_id');
        $description = $this->input->post('description');
        $photo_path = null;

        // Upload config
        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 2048;
        $config['encrypt_name']         = TRUE;

        $this->upload->initialize($config);
        
        if (!is_dir('./uploads/')) {
            mkdir('./uploads/', 0777, TRUE);
        }

        if ($this->upload->do_upload('photo')) {
            $upload_data = $this->upload->data();
            $photo_path = $upload_data['file_name'];
        }

        // Auto Routing: Find active IT Staf for this category
        $staf = $this->User_model->get_staf_by_specialty($category_id);
                         
        $staf_id = $staf ? $staf->id_user : null;

        $data_insert = [
            'pelapor_id'         => $this->session->userdata('user_id'),
            'kategori_id'        => $category_id,
            'lokasi_id'          => $location_id,
            'asset_id'           => $this->input->post('asset_id') ?: null,
            'deskripsi_masalah'  => $description,
            'foto_kerusakan'     => $photo_path,
            'staf_ditugaskan_id' => $staf_id,
            'status_tiket'       => 'Menunggu'
        ];

        // Jika ada aset yang dilaporkan, update kondisi aset menjadi Rusak
        if (!empty($this->input->post('asset_id'))) {
            $this->Asset_model->update_asset($this->input->post('asset_id'), ['kondisi' => 'Rusak']);
        }

        $tiket_id = $this->Ticket_model->create_ticket($data_insert);
        
        if ($staf_id) {
            $this->Notification_model->add_notification($staf_id, $tiket_id, 'Anda ditugaskan pada tiket baru.');
        }

        $this->session->set_flashdata('success', 'Laporan berhasil dikirim.');
        redirect('karyawan');
    }
    
    public function evaluasi()
    {
        $tiket_id = $this->input->post('tiket_id');
        $rating = $this->input->post('rating');
        $this->Evaluation_model->add_evaluation($tiket_id, $rating);
        $this->session->set_flashdata('success', 'Terima kasih atas penilaian Anda.');
        redirect('karyawan');
    }

    public function profil()
    {
        $data['title'] = 'Profil Saya';
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->User_model->get_user_by_id($user_id);
        
        $this->load->view('karyawan/header', $data);
        $this->load->view('karyawan/profil', $data);
        $this->load->view('karyawan/footer');
    }

    public function update_profil()
    {
        $user_id = $this->session->userdata('user_id');
        $data = [
            'nama_lengkap' => $this->input->post('nama_lengkap')
        ];
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
        redirect('karyawan/profil');
    }

    public function chatbot()
    {
        $data['title'] = 'AI Assistant';
        $this->load->library('ai_agent');

        $data['pertanyaan'] = '';
        $data['jawaban'] = '';
        $data['error'] = '';

        if ($this->input->post('pertanyaan')) {
            $pertanyaan = trim($this->input->post('pertanyaan'));
            if (empty($pertanyaan)) {
                $data['error'] = 'Pertanyaan tidak boleh kosong!';
            } else {
                $data['pertanyaan'] = $pertanyaan;
                $data['jawaban'] = $this->ai_agent->get_response($pertanyaan);
            }
        }
        
        $this->load->view('karyawan/header', $data);
        $this->load->view('karyawan/chatbot', $data);
        $this->load->view('karyawan/footer');
    }
}
