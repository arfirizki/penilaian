<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Divisi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('divisi_m');
    }

    public function index()
    {
        $data['title'] = 'Divisi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['divisi'] =$this->divisi_m->get();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('divisi/index', $data);
        $this->load->view('templates/footer');
    }
    public function add()
    {
        $data = $this->input->post(null, TRUE);
        $this->divisi_m->add($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Divisi Added!</div>');
        redirect('divisi');
    }
    public function edit()
    {
        $data = $this->input->post(null, TRUE);
        if (isset($_POST['edit'])) 
        {
          $this->divisi_m->edit($data);
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
        $data['divisi'] = $this->divisi_m->get();
        $this->load->view('divisi/cart_data', $data);
    }

    public function del()
    {
        $id = $this->input->post('id');
        $this->divisi_m->del(['id' => $id]);
        if ($this->db->affected_rows() > 0) 
        {
          $params = array("success" => true);
        } else {
          $params = array("success" => false);
        } 
        echo json_encode($params);
    }
}
