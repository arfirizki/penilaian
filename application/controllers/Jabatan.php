<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jabatan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('jabatan_m');
    }

    public function index()
    {
        $data['title'] = 'Jabatan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $user = $data['user'];
            $data['jabatan'] =$this->jabatan_m->get();
            $data['jabatan2'] =$this->jabatan_m->get2()->result_array();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            if ($user['level'] == 1 ) {
            $this->load->view('jabatan/index', $data);
            }else{
             $this->load->view('jabatan/data', $data);
            }
            $this->load->view('templates/footer');
        
       
    }
    public function add()
    {
        $data = $this->input->post(null, TRUE);
        $this->jabatan_m->add($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Jabatan Added!</div>');
        redirect('jabatan');
    }
    public function edit()
    {
        $data = $this->input->post(null, TRUE);
        if (isset($_POST['edit'])) 
        {
          $this->jabatan_m->edit($data);
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
        $data['jabatan'] = $this->jabatan_m->get();
        $this->load->view('jabatan/cart_data', $data);
    }

    public function del()
    {
        $id = $this->input->post('id');
        $this->jabatan_m->del(['id' => $id]);
        if ($this->db->affected_rows() > 0) 
        {
          $params = array("success" => true);
        } else {
          $params = array("success" => false);
        } 
        echo json_encode($params);
    }
}
