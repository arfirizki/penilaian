<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Karyawan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('karyawan_m');
        $this->load->model('divisi_m');
        $this->load->model('jabatan_m');
        $this->load->model('user_m');
        $this->load->model('penilaian_m');
    }

    public function index()
    {
        $data['title'] = 'Karyawan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['id'] =$this->karyawan_m->id();
        $data['karyawan'] =$this->karyawan_m->get()->result_array();
        $data['divisi'] =$this->divisi_m->get()->result();
        $data['jabatan'] =$this->jabatan_m->get()->result();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('karyawan/index', $data);
        $this->load->view('templates/footer');
    }
    public function kode($data)
    {
        $tgllahir = $this->input->post('tgl');
        $tglmasuk = $this->input->post('masuk');
        $subtgllahir = substr($tgllahir,0,4);
        $substrtgllahir = substr($subtgllahir,2);
        $subtglmasuk = substr($tglmasuk,0,4);
        $substrtglmasuk = substr($subtglmasuk,2);
        $this->db->select('RIGHT(karyawan.kode,2) as kode', FALSE);
        $this->db->order_by('kode','DESC');    
        $this->db->limit(1);     
        $query = $this->db->get('karyawan');      //cek dulu apakah ada sudah ada kode di tabel.    
        if($query->num_rows() <> 0){       
       //jika kode ternyata sudah ada.      
         $data = $query->row();      
         $kode = intval($data->kode) + 1;     
         }
        else{       
       //jika kode belum ada      
         $kode = 1;     
        }
        $kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT);    
        $kodejadi = "$substrtglmasuk.$substrtgllahir.$kodemax"; 
        return $kodejadi;
    }
    public function add()
    {   
        $data = $this->input->post(null, TRUE);
        $jabatan = $this->input->post('jabatan');
        $kode = $this->kode($data);
        $this->karyawan_m->add($data,$kode);
        $this->user_m->add($data,$level = "$jabatan",$kode);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Pegawai added!</div>');
        redirect('karyawan');
    }
    public function edit()
    {
        $data = $this->input->post(null, TRUE);
        if (isset($_POST['edit'])) 
        {
          $jabatan = $this->input->post('jabatan');
          $this->karyawan_m->edit($data);
          $this->user_m->edit_karyawan($data,$level = "$jabatan");
        }

        if ($this->db->affected_rows() > 0) 
        {
          $params = array("success" => true);
        } else {
          $params = array("success" => false);
        } 
        echo json_encode($params);
    }
    function print() {
        $data['karyawan'] = $this->karyawan_m->get()->result_array();
        $this->load->view('karyawan/print', $data);
    }

    public function del()
    {
        $id = $this->input->post('id');
        $this->karyawan_m->del(['kode' => $id]);
        $this->user_m->del(['kode' => $id]);
        if ($this->db->affected_rows() > 0) 
        {
          $params = array("success" => true);
        } else {
          $params = array("success" => false);
        } 
        echo json_encode($params);
    }
}
 