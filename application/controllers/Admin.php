<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('role_m');
       $this->load->model('admin_m');
        $this->load->model('user_m');
        $this->load->model('penilaian_m');
        $this->load->model('divisi_m');
        $this->load->model('karyawan_m');
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function data()
    {
        $data['title'] = 'Admin';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['id'] =$this->admin_m->id();
        $data['admin'] =$this->admin_m->get();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/admin', $data);
        $this->load->view('templates/footer');
    }

    public function add()
    {
        $data = $this->input->post(null, TRUE);
        $this->admin_m->add($data);
        $this->user_m->addadmin($data,$level = "1");
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New sub menu added!</div>');
        redirect('admin');
    }
    public function edit()
    {
        $data = $this->input->post(null, TRUE);
        if (isset($_POST['edit'])) 
        {
          $this->admin_m->edit($data);
          $this->user_m->edit($data);
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
        $this->admin_m->del(['kode' => $id]);
        $this->user_m->del(['kode' => $id]);
        if ($this->db->affected_rows() > 0) 
        {
          $params = array("success" => true);
        } else {
          $params = array("success" => false);
        } 
        echo json_encode($params);
    }

    public function overview($id)
    {
        $data['title'] = 'Overview Kinerja';
        $data['user'] = $this->db->get_where('user', ['kode' => $this->session->userdata('kode')])->row_array();
        $query = $this->penilaian_m->getoverview($id)->result_array();
        $data['query'] = $this->penilaian_m->getoverview($id)->result_array();
        $data['getkategori'] =$this->penilaian_m->getkategori()->result();
        // $data['query2'] = $this->penilaian_m->getoverview2($id)->result_array();
        // $query2 = $this->penilaian_m->getoverview2($id)->result_array();
        $data['pegawai'] = $this->karyawan_m->get2($id)->row();
        $data['chart'] = json_encode($query);
        // $data['chart2'] = json_encode($query2);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/overview', $data);
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
        $this->load->view('admin/overviewdetail', $data);
        $this->load->view('templates/footer');
    }
    public function role()
    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get('user_role')->result_array();

        $this->form_validation->set_rules('role', 'Role', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/role', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('user_role', ['role' => $this->input->post('role')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New role added!</div>');
            redirect('admin/role');
        }
    }

    public function roleAccess($level)
    {
        $data['title'] = 'Role Access';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get_where('user_role', ['id' => $level])->row_array();

        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer');
    }

    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $level = $this->input->post('roleId');

        $data = [
            'level' => $level,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Access Changed!</div>');
    }

    public function RoleEdit($id)
    {
        $data['title'] = 'Role Edit';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $query = $this->role_m->get($id);
        $data['row'] = $query->row();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-edit', $data);
        $this->load->view('templates/footer');
    }

    public function roleproses()
    {
        $post = $this->input->post(null, TRUE);
        $this->role_m->edit($post);
        if ($this->db->affected_rows() > 0) {
            echo "<script>
                alert('Data berhasil disimpan');
            </script>";
        }
        echo "<script>
                window.location='" . site_url('admin/role') . "';
            </script>";
    }

    public function roledel($id)
    {
        $this->role_m->del($id);
        if ($this->db->affected_rows() > 0) {
            echo "<script>
            window.location='" . site_url('admin/role') . "';
            </script>";
        }
    }
}
