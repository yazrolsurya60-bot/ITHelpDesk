<?php
class Landing extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('file');
    }

    public function index()
    {
        $data['title'] = 'Home';
        $data['active'] = 'home';
        $this->load->view('layout/landing/header', $data);
        $this->load->view('landing/index', $data);
        $this->load->view('layout/landing/footer');
    }

    public function home()
    {
        $data['title'] = 'Home';
        $data['active'] = 'home';
        $this->load->view('layout/landing/header', $data);
        $this->load->view('landing/index', $data);
        $this->load->view('layout/landing/footer');
    }

    public function profil()
    {
        $data['title'] = 'Profil';
        $data['active'] = 'profil';
        $this->load->view('layout/landing/header', $data);
        $this->load->view('landing/profil', $data);
        $this->load->view('layout/landing/footer');
    }


    public function hubungi()
    {
        $data['title'] = 'Hubungi Kami';
        $data['active'] = 'hubungi';
        $this->load->view('layout/landing/header', $data);
        $this->load->view('landing/hubungi', $data);
        $this->load->view('layout/landing/footer');
    }

    public function login()
    {
        redirect('auth');
    }
}
