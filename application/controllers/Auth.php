<?php
class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Master_model');
    }

    public function index()
    {
        $this->load->view('login');
    }
    public function login_action()
    {
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        
        $user = $this->db->get_where('users', [
            'username' => $username,
            'password' => $password
        ])->row();
        
        if ($user) {
            $this->session->set_userdata([
                'user_id' => $user->id_user,
                'name' => $user->nama_lengkap,
                'role' => $user->role, 
                'logged_in' => TRUE
            ]);
            
            if ($user->role == 'Admin') {
                redirect('admin');
            } else if ($user->role == 'Staf_IT') {
                redirect('staf');
            } else {
                redirect('karyawan');
            }
        } else {
            // Simpan pesan error ke flashdata
            $this->session->set_flashdata('error', 'Username atau Password salah!');
            redirect('auth');
        }
    }

    public function register()
    {
        $data['categories'] = $this->Master_model->get_all_categories();
        $this->load->view('register', $data);
    }

    public function register_action()
    {
        $name = $this->input->post('name');
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        
        $data = [
            'nama_lengkap' => $name,
            'username' => $username,
            'password' => $password,
            'role' => $this->input->post('role') ?? 'Karyawan',
            'status_kehadiran' => 'Aktif',
            'foto' => null
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
        
        if ($data['role'] == 'Staf_IT') {
            $data['spesialisasi_id'] = $this->input->post('spesialisasi_id');
        }
        
        $this->User_model->create_user($data);
        $this->session->set_flashdata('success', 'Registrasi berhasil, silakan login!');
        redirect('auth');
    }
    
    public function logout()
    {
        // 1. Hapus semua data session
        $this->session->sess_destroy();
        // 2. Arahkan kembali ke halaman login (Auth)
        redirect('auth');
    }
}