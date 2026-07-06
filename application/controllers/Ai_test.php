<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ai_test extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Memuat library AI yang sudah menggunakan cURL
        $this->load->library('ai_agent');
        $this->load->helper('url');
    }
    public function index()
    {
        $data['pertanyaan'] = '';
        $data['jawaban'] = '';
        $data['error'] = '';
        // Jika ada input yang dikirim melalui POST
        if ($this->input->post('pertanyaan')) {
            $pertanyaan = trim($this->input->post('pertanyaan'));
            if (empty($pertanyaan)) {
                $data['error'] = 'Pertanyaan tidak boleh kosong!';
            } else {
                $data['pertanyaan'] = $pertanyaan;
                $data['jawaban'] = $this->ai_agent->get_response($pertanyaan);
            }
        }
        // Memanggil file view
        $this->load->view('ai_view', $data);
    }
}