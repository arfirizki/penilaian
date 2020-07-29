<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai extends CI_Controller
{
    public function __construct() 
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('karyawan_m');
        $this->load->model('kategori_m');
        $this->load->model('jabatan_m');
        $this->load->model('user_m');
        $this->load->model('divisi_m');
        $this->load->model('penilaian_m');
        $this->load->model('tanggapan_m');
    } 

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['kode' => $this->session->userdata('kode')])->row_array();
        $user = $data['user'];
        $id = $user['kode'];
        $data['query'] = $this->penilaian_m->getoverview($id)->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pegawai/index', $data);
        $this->load->view('templates/footer');
    }
    public function overview()
    {
        $data['title'] = 'Overview';
        $data['user'] = $this->db->get_where('user', ['kode' => $this->session->userdata('kode')])->row_array();
        $kode = $data['user'];
        $id = $kode['kode'];
        $query = $this->penilaian_m->getoverview($id)->result_array();
        $data['query'] = $this->penilaian_m->getoverview($id)->result_array();
        $data['getkategori'] =$this->penilaian_m->getkategori()->result();
        $data['pegawai'] = $this->karyawan_m->get2($id)->row();
        $data['chart'] = json_encode($query);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pegawai/overview', $data);
        $this->load->view('templates/footer');
    }
    public function overviewdetail()
    {
        $data['title'] = 'Overview Kinerja';
        $data['user'] = $this->db->get_where('user', ['kode' => $this->session->userdata('kode')])->row_array();
        $kategori = $this->input->post('kategori');
        $data['kategori'] = $kategori;
        $id = $this->input->post('kode');
        $query = $this->penilaian_m->getoverview($id,$kategori)->result_array();
        $data['query'] = $this->penilaian_m->getoverviewdetail($id,$kategori)->result_array();
        // $data['query2'] = $this->penilaian_m->getoverviewdetail($id,$kategori)->row();
        $data['getkategori'] =$this->penilaian_m->getkategori()->result();
        $data['pegawai'] = $this->karyawan_m->get2($id)->row();
        $data['chart'] = json_encode($query);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pegawai/overviewdetail', $data);
        $this->load->view('templates/footer');
    }

    public function nilai()
    {
        $data['title'] = 'Nilai';
        $data['user'] = $this->db->get_where('user', ['kode' => $this->session->userdata('kode')])->row_array();
        $user = $data['user'];
        $params = $user['divisi'];
        $kode = $user['kode'];
        // $prevN = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
        // $data['bulan'] = $this->tglIndonesia(date('F Y', $prevN));
        // $bulan = $data['bulan'];
        $bulan = $this->input->post('bulan');
        // $params = $this->input->post('divisi');
        $data['divisi'] =$this->divisi_m->get($params)->result();
        $data['nilai'] =$this->penilaian_m->getnilaipegawai($kode)->result();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pegawai/data', $data);
        $this->load->view('templates/footer');
    }
    public function detail()
    {
        $bulan = $this->input->get('bulan');
        $params = $this->input->get('kode');
        $data['title'] = 'Detail Nilai ';
        $data['user'] = $this->db->get_where('user', ['kode' => $this->session->userdata('kode')])->row_array();
        $data['nilai'] = $this->penilaian_m->getdetail($params,$bulan)->result_array();
        $data['data'] = $this->penilaian_m->getdetail($params,$bulan)->row();
        $data['tanggapan'] = $this->tanggapan_m->get($params,$bulan)->row();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pegawai/detail_data', $data);
        $this->load->view('templates/footer');
    }
}