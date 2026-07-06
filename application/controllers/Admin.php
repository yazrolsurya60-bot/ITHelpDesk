<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('role') !== 'Admin') {
            redirect('auth');
        }
        $this->load->model('Ticket_model');
        $this->load->model('Master_model');
        $this->load->model('User_model');
        $this->load->model('Asset_model');
        $this->load->model('WorkLog_model');
        $this->load->model('Report_model');
    }

    public function index()
    {
        $data['title'] = 'Admin Dashboard';
        $data['tickets_in_progress'] = $this->Ticket_model->count_tickets_by_status('Dikerjakan') + $this->Ticket_model->count_tickets_by_status('Menuju Lokasi');
        $data['tickets_pending'] = $this->Ticket_model->count_tickets_by_status('Menunggu');
        $data['tickets_done'] = $this->Ticket_model->count_tickets_by_status('Selesai');
        $data['tickets_monitoring'] = $this->Ticket_model->get_active_tickets_monitoring();
        
        $data['chart_data'] = [
            'Menunggu' => $data['tickets_pending'],
            'Dikerjakan' => $data['tickets_in_progress'],
            'Selesai' => $data['tickets_done']
        ];
        $data['top_assets'] = $this->Ticket_model->get_top_broken_assets(5);
        
        // Example for reports
        $this->load->view('admin/header', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('admin/footer');
    }

    public function kategori()
    {
        $data['title'] = 'Manajemen Kategori';
        $data['categories'] = $this->Master_model->get_all_categories();
        
        $this->load->view('admin/header', $data);
        $this->load->view('admin/kategori', $data);
        $this->load->view('admin/footer');
    }

    public function add_kategori()
    {
        $data = [
            'nama_kategori'     => $this->input->post('nama_kategori'),
            'deskripsi_kategori'=> $this->input->post('deskripsi_kategori'),
            'has_asset'         => $this->input->post('has_asset') ? 1 : 0
        ];
        $this->Master_model->create_category($data);
        $this->session->set_flashdata('success', 'Kategori berhasil ditambahkan.');
        redirect('admin/kategori');
    }

    public function delete_kategori($id)
    {
        $this->Master_model->delete_category($id);
        $this->session->set_flashdata('success', 'Kategori berhasil dihapus.');
        redirect('admin/kategori');
    }

    public function update_kategori()
    {
        $id = $this->input->post('id_kategori');
        $data = [
            'nama_kategori'     => $this->input->post('nama_kategori'),
            'deskripsi_kategori'=> $this->input->post('deskripsi_kategori'),
            'has_asset'         => $this->input->post('has_asset') ? 1 : 0
        ];
        $this->Master_model->update_category($id, $data);
        $this->session->set_flashdata('success', 'Kategori berhasil diperbarui.');
        redirect('admin/kategori');
    }

    public function lokasi()
    {
        $this->load->library('pagination');
        
        $total_rows = $this->Master_model->count_all_locations();
        $config = $this->_get_pagination_config('admin/lokasi', $total_rows);
        $this->pagination->initialize($config);
        
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data['title'] = 'Manajemen Lokasi';
        $data['locations'] = $this->Master_model->get_locations_paginated($config['per_page'], $page);
        $data['pagination'] = $this->pagination->create_links();
        
        $this->load->view('admin/header', $data);
        $this->load->view('admin/lokasi', $data);
        $this->load->view('admin/footer');
    }

    public function add_lokasi()
    {
        $data = [
            'lantai' => $this->input->post('lantai'),
            'nama_ruangan' => $this->input->post('nama_ruangan')
        ];
        $this->Master_model->create_location($data);
        $this->session->set_flashdata('success', 'Lokasi berhasil ditambahkan.');
        redirect('admin/lokasi');
    }

    public function delete_lokasi($id)
    {
        $this->Master_model->delete_location($id);
        $this->session->set_flashdata('success', 'Lokasi berhasil dihapus.');
        redirect('admin/lokasi');
    }

    public function update_lokasi()
    {
        $id = $this->input->post('id_lokasi');
        $data = [
            'lantai' => $this->input->post('lantai'),
            'nama_ruangan' => $this->input->post('nama_ruangan')
        ];
        $this->Master_model->update_location($id, $data);
        $this->session->set_flashdata('success', 'Lokasi berhasil diperbarui.');
        redirect('admin/lokasi');
    }

    public function laporan()
    {
        $data['title'] = 'Laporan & Analitik';
        $tahun = $this->input->get('tahun');
        $kategori_id = $this->input->get('kategori_id');
        
        $data['selected_tahun'] = $tahun;
        $data['selected_kategori'] = $kategori_id;
        
        // Populate filter dropdowns
        $data['categories'] = $this->Master_model->get_all_categories();
        
        // Get unique years from created tickets for the year filter
        $years_query = $this->db->query("SELECT DISTINCT YEAR(waktu_dibuat) as tahun FROM tickets ORDER BY tahun DESC")->result();
        $data['years'] = [];
        foreach($years_query as $y) {
            if($y->tahun) $data['years'][] = $y->tahun;
        }
        
        // If no years found, just put current year
        if(empty($data['years'])) $data['years'][] = date('Y');
        
        $data['tickets'] = $this->Ticket_model->get_tickets_filtered($tahun, $kategori_id);
        
        // Data for Chart
        $status_counts = ['Menunggu' => 0, 'Menuju Lokasi' => 0, 'Dikerjakan' => 0, 'Selesai' => 0];
        foreach($data['tickets'] as $t) {
            if(isset($status_counts[$t->status_tiket])) {
                $status_counts[$t->status_tiket]++;
            }
        }
        $data['chart_data'] = $status_counts;
        
        $data['top_assets'] = $this->Ticket_model->get_top_broken_assets(5);
        
        $this->load->view('admin/header', $data);
        $this->load->view('admin/laporan', $data);
        $this->load->view('admin/footer');
    }
    
    public function export_pdf()
    {
        $tahun = $this->input->get('tahun');
        $kategori_id = $this->input->get('kategori_id');
        $data['tickets'] = $this->Ticket_model->get_tickets_filtered($tahun, $kategori_id);
        
        $status_counts = ['Menunggu' => 0, 'Menuju Lokasi' => 0, 'Dikerjakan' => 0, 'Selesai' => 0];
        foreach($data['tickets'] as $t) {
            if(isset($status_counts[$t->status_tiket])) {
                $status_counts[$t->status_tiket]++;
            }
        }
        $data['chart_data'] = $status_counts;
        $data['top_assets'] = $this->Ticket_model->get_top_broken_assets(5);
        $data['title'] = 'Laporan Bantuan IT HelpDesk';
        $data['tahun'] = $tahun;

        $this->load->view('admin/report_print', $data);
    }

    public function export_excel()
    {
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=Laporan_IT_HelpDesk.xls");
        
        $tahun = $this->input->get('tahun');
        $kategori_id = $this->input->get('kategori_id');
        $tickets = $this->Ticket_model->get_tickets_filtered($tahun, $kategori_id);
        
        echo '<table border="1">';
        echo '<tr>
                <th>ID Tiket</th>
                <th>Tanggal</th>
                <th>Aset</th>
                <th>Kategori</th>
                <th>Detail Masalah</th>
                <th>Pelapor</th>
                <th>Ruangan</th>
                <th>Staf IT</th>
                <th>Status</th>
                <th>Waktu Penyelesaian</th>
              </tr>';
              
        foreach ($tickets as $t) {
            $durasi = '-';
            if($t->status_tiket == 'Selesai' && $t->waktu_selesai) {
                $start = strtotime($t->waktu_dibuat);
                $end = strtotime($t->waktu_selesai);
                $diff = $end - $start;
                $jam = floor($diff / 3600);
                $menit = floor(($diff % 3600) / 60);
                $durasi = $jam . 'j ' . $menit . 'm';
            }
            
            echo '<tr>
                    <td>#'.str_pad($t->id_tiket, 4, '0', STR_PAD_LEFT).'</td>
                    <td>'.date('d M Y H:i', strtotime($t->waktu_dibuat)).'</td>
                    <td>'.($t->nama_asset ? $t->nama_asset : '-').'</td>
                    <td>'.$t->nama_kategori.'</td>
                    <td>'.$t->deskripsi_masalah.'</td>
                    <td>'.$t->pelapor.'</td>
                    <td>'.$t->lantai.' - '.$t->nama_ruangan.'</td>
                    <td>'.($t->nama_staf ? $t->nama_staf : '-').'</td>
                    <td>'.$t->status_tiket.'</td>
                    <td>'.$durasi.'</td>
                  </tr>';
        }
        echo '</table>';
    }

    public function users()
    {
        $this->load->library('pagination');

        $config['base_url'] = base_url('admin/users');
        $config['total_rows'] = $this->User_model->count_all_users();
        $config['per_page'] = 5;
        $config['uri_segment'] = 3;

        // Custom styling for Tailwind pagination
        $config['full_tag_open'] = '<div class="flex items-center justify-end space-x-1 mt-6">';
        $config['full_tag_close'] = '</div>';
        $config['num_tag_open'] = '<span class="w-10 h-10 flex items-center justify-center rounded-lg bg-white border border-slate-200 text-slate-600 hover:bg-emerald-50 hover:text-emerald-600 hover:border-emerald-200 transition-all cursor-pointer shadow-sm mx-1 font-medium">';
        $config['num_tag_close'] = '</span>';
        $config['cur_tag_open'] = '<span class="w-10 h-10 flex items-center justify-center rounded-lg bg-emerald-600 text-white font-bold shadow-md mx-1 ring-2 ring-emerald-600/20">';
        $config['cur_tag_close'] = '</span>';
        
        $config['prev_link'] = '<i class="fas fa-chevron-left text-xs"></i>';
        $config['prev_tag_open'] = '<span class="w-10 h-10 flex items-center justify-center rounded-lg bg-white border border-slate-200 text-slate-600 hover:bg-emerald-50 hover:text-emerald-600 hover:border-emerald-200 transition-all cursor-pointer shadow-sm mx-1">';
        $config['prev_tag_close'] = '</span>';
        
        $config['next_link'] = '<i class="fas fa-chevron-right text-xs"></i>';
        $config['next_tag_open'] = '<span class="w-10 h-10 flex items-center justify-center rounded-lg bg-white border border-slate-200 text-slate-600 hover:bg-emerald-50 hover:text-emerald-600 hover:border-emerald-200 transition-all cursor-pointer shadow-sm mx-1">';
        $config['next_tag_close'] = '</span>';
        
        $config['first_link'] = '<i class="fas fa-angle-double-left text-xs"></i>';
        $config['first_tag_open'] = '<span class="w-10 h-10 flex items-center justify-center rounded-lg bg-white border border-slate-200 text-slate-600 hover:bg-emerald-50 hover:text-emerald-600 hover:border-emerald-200 transition-all cursor-pointer shadow-sm mx-1">';
        $config['first_tag_close'] = '</span>';
        
        $config['last_link'] = '<i class="fas fa-angle-double-right text-xs"></i>';
        $config['last_tag_open'] = '<span class="w-10 h-10 flex items-center justify-center rounded-lg bg-white border border-slate-200 text-slate-600 hover:bg-emerald-50 hover:text-emerald-600 hover:border-emerald-200 transition-all cursor-pointer shadow-sm mx-1">';
        $config['last_tag_close'] = '</span>';

        $this->pagination->initialize($config);
        
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
        $data['title'] = 'Manajemen User';
        $data['users'] = $this->User_model->get_users_paginated($config['per_page'], $page);
        $data['pagination'] = $this->pagination->create_links();
        $data['categories'] = $this->Master_model->get_all_categories(); // for staf specialization
        
        $this->load->view('admin/header', $data);
        $this->load->view('admin/users', $data);
        $this->load->view('admin/footer');
    }

    public function add_user()
    {
        $data = [
            'nama_lengkap' => $this->input->post('nama_lengkap'),
            'username' => $this->input->post('username'),
            'password' => md5($this->input->post('password')),
            'role' => $this->input->post('role')
        ];
        
        if ($data['role'] == 'Staf_IT') {
            $data['spesialisasi_id'] = $this->input->post('spesialisasi_id');
            $data['status_kehadiran'] = 'Aktif';
        }

        $this->User_model->create_user($data);
        $this->session->set_flashdata('success', 'User berhasil ditambahkan.');
        redirect('admin/users');
    }

    public function delete_user($id)
    {
        $this->User_model->delete_user($id);
        $this->session->set_flashdata('success', 'User berhasil dihapus.');
        redirect('admin/users');
    }

    public function update_user()
    {
        $id_user = $this->input->post('id_user');
        $data = [
            'nama_lengkap' => $this->input->post('nama_lengkap'),
            'username' => $this->input->post('username'),
            'role' => $this->input->post('role')
        ];
        
        if (!empty($this->input->post('password'))) {
            $data['password'] = md5($this->input->post('password'));
        }
        
        if ($data['role'] == 'Staf_IT') {
            $data['spesialisasi_id'] = $this->input->post('spesialisasi_id') ? $this->input->post('spesialisasi_id') : null;
            $data['status_kehadiran'] = $this->input->post('status_kehadiran');
        } else {
            $data['spesialisasi_id'] = null;
            $data['status_kehadiran'] = null;
        }

        $this->db->where('id_user', $id_user)->update('users', $data);
        $this->session->set_flashdata('success', 'Data User berhasil diperbarui.');
        redirect('admin/users');
    }

    // ============================================================
    // ASSETS MODULE
    // ============================================================
    public function assets()
    {
        $this->load->library('pagination');
        
        $total_rows = $this->Asset_model->count_all_assets();
        $config = $this->_get_pagination_config('admin/assets', $total_rows);
        $this->pagination->initialize($config);
        
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data['title'] = 'Manajemen Aset IT';
        $data['assets']    = $this->Asset_model->get_assets_paginated($config['per_page'], $page);
        $data['pagination'] = $this->pagination->create_links();
        $data['locations'] = $this->Master_model->get_all_locations();
        $data['total_baik']      = $this->Asset_model->count_by_kondisi('Baik');
        $data['total_rusak']     = $this->Asset_model->count_by_kondisi('Rusak');
        $data['total_perbaikan'] = $this->Asset_model->count_by_kondisi('Dalam Perbaikan');

        $this->load->view('admin/header', $data);
        $this->load->view('admin/assets', $data);
        $this->load->view('admin/footer');
    }

    public function add_asset()
    {
        $data = [
            'nama_asset'  => $this->input->post('nama_asset'),
            'jenis_asset' => $this->input->post('jenis_asset'),
            'lokasi_id'   => $this->input->post('lokasi_id') ?: null,
            'no_seri'     => $this->input->post('no_seri'),
            'kondisi'     => $this->input->post('kondisi'),
            'keterangan'  => $this->input->post('keterangan'),
        ];
        $this->Asset_model->create_asset($data);
        $this->session->set_flashdata('success', 'Aset berhasil ditambahkan.');
        redirect('admin/assets');
    }

    public function update_asset()
    {
        $id   = $this->input->post('id_asset');
        $data = [
            'nama_asset'  => $this->input->post('nama_asset'),
            'jenis_asset' => $this->input->post('jenis_asset'),
            'lokasi_id'   => $this->input->post('lokasi_id') ?: null,
            'no_seri'     => $this->input->post('no_seri'),
            'kondisi'     => $this->input->post('kondisi'),
            'keterangan'  => $this->input->post('keterangan'),
        ];
        $this->Asset_model->update_asset($id, $data);
        $this->session->set_flashdata('success', 'Aset berhasil diperbarui.');
        redirect('admin/assets');
    }

    public function delete_asset($id)
    {
        $this->Asset_model->delete_asset($id);
        $this->session->set_flashdata('success', 'Aset berhasil dihapus.');
        redirect('admin/assets');
    }

    // ============================================================
    // REPORTS MODULE
    // ============================================================
    public function generate_report()
    {
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');

        // Hitung statistik tiket pada periode yang dipilih
        $this->db->where("MONTH(waktu_dibuat)", $bulan);
        $this->db->where("YEAR(waktu_dibuat)", $tahun);
        $total = $this->db->count_all_results('tickets');

        $this->db->where("MONTH(waktu_dibuat)", $bulan);
        $this->db->where("YEAR(waktu_dibuat)", $tahun);
        $this->db->where('status_tiket', 'Selesai');
        $selesai = $this->db->count_all_results('tickets');

        $pending = $total - $selesai;

        // Rata-rata durasi kerja (dari work_logs di periode ini)
        $avg_row = $this->db->query("
            SELECT AVG(wl.durasi_menit) as avg_dur
            FROM work_logs wl
            JOIN tickets t ON t.id_tiket = wl.tiket_id
            WHERE MONTH(t.waktu_dibuat) = ? AND YEAR(t.waktu_dibuat) = ?
            AND wl.durasi_menit IS NOT NULL
        ", [$bulan, $tahun])->row();
        $avg_durasi = $avg_row ? round($avg_row->avg_dur) : null;

        $nama_bulan = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                       'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        $report_data = [
            'judul'           => 'Laporan Bulan ' . $nama_bulan[$bulan] . ' ' . $tahun,
            'periode_bulan'   => $bulan,
            'periode_tahun'   => $tahun,
            'total_tiket'     => $total,
            'tiket_selesai'   => $selesai,
            'tiket_pending'   => $pending,
            'avg_durasi_menit'=> $avg_durasi,
            'dibuat_oleh'     => $this->session->userdata('user_id'),
        ];

        $this->Report_model->save_report($report_data);
        $this->session->set_flashdata('success', 'Laporan berhasil disimpan ke sistem!');
        redirect('admin/riwayat_laporan');
    }

    public function riwayat_laporan()
    {
        $data['title']   = 'Riwayat Laporan';
        $data['reports'] = $this->Report_model->get_all_reports();

        $this->load->view('admin/header', $data);
        $this->load->view('admin/riwayat_laporan', $data);
        $this->load->view('admin/footer');
    }

    public function delete_report($id)
    {
        $this->Report_model->delete_report($id);
        $this->session->set_flashdata('success', 'Laporan dihapus.');
        redirect('admin/riwayat_laporan');
    }
    private function _get_pagination_config($base_url, $total_rows, $per_page = 5, $uri_segment = 3)
    {
        $config['base_url'] = base_url($base_url);
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $per_page;
        $config['uri_segment'] = $uri_segment;

        $config['full_tag_open'] = '<div class="flex items-center justify-end space-x-1 mt-6">';
        $config['full_tag_close'] = '</div>';
        $config['num_tag_open'] = '<span class="w-10 h-10 flex items-center justify-center rounded-lg bg-white border border-slate-200 text-slate-600 hover:bg-emerald-50 hover:text-emerald-600 hover:border-emerald-200 transition-all cursor-pointer shadow-sm mx-1 font-medium">';
        $config['num_tag_close'] = '</span>';
        $config['cur_tag_open'] = '<span class="w-10 h-10 flex items-center justify-center rounded-lg bg-emerald-600 text-white font-bold shadow-md mx-1 ring-2 ring-emerald-600/20">';
        $config['cur_tag_close'] = '</span>';
        
        $config['prev_link'] = '<i class="fas fa-chevron-left text-xs"></i>';
        $config['prev_tag_open'] = '<span class="w-10 h-10 flex items-center justify-center rounded-lg bg-white border border-slate-200 text-slate-600 hover:bg-emerald-50 hover:text-emerald-600 hover:border-emerald-200 transition-all cursor-pointer shadow-sm mx-1">';
        $config['prev_tag_close'] = '</span>';
        
        $config['next_link'] = '<i class="fas fa-chevron-right text-xs"></i>';
        $config['next_tag_open'] = '<span class="w-10 h-10 flex items-center justify-center rounded-lg bg-white border border-slate-200 text-slate-600 hover:bg-emerald-50 hover:text-emerald-600 hover:border-emerald-200 transition-all cursor-pointer shadow-sm mx-1">';
        $config['next_tag_close'] = '</span>';
        
        $config['first_link'] = '<i class="fas fa-angle-double-left text-xs"></i>';
        $config['first_tag_open'] = '<span class="w-10 h-10 flex items-center justify-center rounded-lg bg-white border border-slate-200 text-slate-600 hover:bg-emerald-50 hover:text-emerald-600 hover:border-emerald-200 transition-all cursor-pointer shadow-sm mx-1">';
        $config['first_tag_close'] = '</span>';
        
        $config['last_link'] = '<i class="fas fa-angle-double-right text-xs"></i>';
        $config['last_tag_open'] = '<span class="w-10 h-10 flex items-center justify-center rounded-lg bg-white border border-slate-200 text-slate-600 hover:bg-emerald-50 hover:text-emerald-600 hover:border-emerald-200 transition-all cursor-pointer shadow-sm mx-1">';
        $config['last_tag_close'] = '</span>';

        return $config;
    }
}
