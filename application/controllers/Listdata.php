<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Listdata extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('karyawan_m');
        $this->load->model('divisi_m');
        $this->load->model('jabatan_m');
        $this->load->model('user_m');
    }

    public function index()
    {
        $data['title'] = 'List Divisi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['id'] =$this->karyawan_m->id();
        $data['karyawan'] =$this->karyawan_m->get()->result();
        $data['divisi'] =$this->divisi_m->get()->result();
        $data['jabatan'] =$this->jabatan_m->get()->result();
        $data['nilai'] =$this->penilaian_m->get()->result();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('list/index', $data);
        $this->load->view('templates/footer');
    }
    public function add()
    {
        $data = $this->input->post(null, TRUE);
        $jabatan = $this->input->post('jabatan');
        $this->karyawan_m->add($data);
        $this->user_m->add($data,$level = "$jabatan");
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New sub menu added!</div>');
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
    function cart_data() {
        $data['admin'] = $this->admin_m->get();
        $this->load->view('admin/cart_data', $data);
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
