<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penilaian extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('karyawan_m');
        $this->load->model('penilaian_m');
        $this->load->model('kategori_m');
    }

    public function index()
    {
        $data['title'] = 'Penilaian';
        $data['user'] = $this->db->get_where('user', ['kode' => $this->session->userdata('kode')])->row_array();
        $data['kategori'] = $this->kategori_m->get()->result_array();
        $data['karyawan'] =$this->karyawan_m->get()->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('penilaian/index', $data);
        $this->load->view('templates/footer');
    }
    // public function process()
    // {

    //     $data = $this->input->post(null, TRUE);
    //     if (isset($_POST['add'])) {   
    //             if ($this->check() == FALSE) {
    //                  $params = array("success" => false);
    //             }else{
    //                 $this->penilaian_m->add($data);
    //                 $this->penilaian_m->hasil($data);  
    //                 $params = array("success" => true);
    //             }
                
    //     }
    //     echo json_encode($params);
    // }

    // function check(){
    //         $post = $this->input->post(null, TRUE);
    //         $query = $this->db->query("SELECT * FROM nilai WHERE kode = '$post[kode]' AND bulan = '$post[bulan]'");
    //         if($query->num_rows()>0){
    //             return FALSE;
    //         }else{
    //             return TRUE;
    //         }
    // }
     public function insert_keDB()
    { 
        if ($this->check() == FALSE) {
             $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Pegawai Sudah dinilai..!!</div>');
                redirect('penilaian');
        }else{
                $nilai = $this->input->post('nilai');
                $penilai = $this->input->post('penilai');
                $kode = $this->input->post('idpegawai');
                $bulan = $this->input->post('bulan');
                $divisi = $this->input->post('divisi');
                $kategori = $this->input->post('kategori');
                $kelebihan = $this->input->post('kelebihan');
                $kekurangan = $this->input->post('kekurangan');
                $pelatihan = $this->input->post('pelatihan');
                $row = [];
                foreach ($nilai as $key => $value) {
                    array_push($row, array(
                         'kategori' => $_POST['kategori'][$key],
                         'nilai'    => $_POST['nilai'][$key],
                         'kode'    => $kode,
                         'bulan'    => $bulan,
                         'penilai'    => $penilai,
                    )
                );
                }
                $data = [
                    'kode' =>$kode,
                    'bulan' => $bulan,
                    'kelebihan' => $kelebihan,
                    'kekurangan' => $kekurangan,
                    'pelatihan' => $pelatihan,
                ];
                $tanggapan = $this->db->insert('tanggapan',$data);
                $test= $this->db->insert_batch('nilai_detail', $row); // fungsi dari codeigniter untuk menyimpan multi array
            
                if($test){
                 $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil Melakukan Penilaian</div>');
                redirect('penilaian'); }else{
                 echo "gagal di input";
                }     
        }
       

    }

    function check(){
            $kode = $this->input->post('idpegawai');
            $bulan = $this->input->post('bulan');
            $query = $this->db->query("SELECT * FROM nilai_detail WHERE kode = '$kode' AND bulan = '$bulan'");
            if($query->num_rows()>0){
                return FALSE;
            }else{
                return TRUE;
            }
    }

     public function kategori()
    {
        $data['title'] = 'Kategori Penilaian';
        $data['user'] = $this->db->get_where('user', ['kode' => $this->session->userdata('kode')])->row_array();
        $data['kategori'] =$this->kategori_m->get()->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kategori/index', $data);
        $this->load->view('templates/footer');
    }
    public function kategoriadd()
    {
        $kategori = $this->input->post('nama');
        $this->kategori_m->add($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Kategori added!</div>');
        redirect('penilaian/kategori');
    }
    public function kategoriedit()
    {
        $data = $this->input->post(null, TRUE);
        if (isset($_POST['edit'])) 
        {
          $kategori = $this->input->post('nama');
          $this->kategori_m->edit($data);
        }

        if ($this->db->affected_rows() > 0) 
        {
          $params = array("success" => true);
        } else {
          $params = array("success" => false);
        } 
        echo json_encode($params);
    }
     public function kategoridel()
    {
        $id = $this->input->post('id');
        $this->kategori_m->del(['id' => $id]);
        if ($this->db->affected_rows() > 0) 
        {
          $params = array("success" => true);
        } else {
          $params = array("success" => false);
        } 
        echo json_encode($params);
    }
}
