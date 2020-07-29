<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kepaladivisi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
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
        $params = $user['divisi']; 
        $prevN = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
        $data['bulan'] = $this->tglIndonesia(date('F Y', $prevN));
        $bulan = $data['bulan'];
        $divisi = $user['divisi'];
        $query = $this->karyawan_m->get3($bulan,$divisi);
        if ($query->num_rows() >0 ) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><marquee>ADA PEGAWAI YANG BELUM DINILAI!</marquee></div>');
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><marquee>Semua Pegawai Sudah Di Nilai</marquee></div>');
        }
        $data['pegawai'] = $this->karyawan_m->jumlahpegawai($divisi)->num_rows();
        $data['data'] = $this->karyawan_m->get3($bulan,$divisi)->result_array();
        $data['karyawan'] = $this->karyawan_m->get($params)->row();
        $data['query'] = $this->penilaian_m->getranking($bulan,$divisi)->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kepala_divisi/index', $data);
        $this->load->view('templates/footer');
    }

    public function pegawai()
    {
        $data['title'] = 'Pegawai';
        $data['user'] = $this->db->get_where('user', ['kode' => $this->session->userdata('kode')])->row_array();
        $user = $data['user'];
        $divisi = $user['divisi']; 
        $data['id'] =$this->karyawan_m->id();        
        $data['jabatan'] =$this->jabatan_m->get()->result();
        $data['pegawai'] = $this->karyawan_m->getpegawai($divisi)->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kepala_divisi/pegawai', $data);
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
        redirect('kepaladivisi/pegawai');
    }

    //PEnilaian
    public function penilaian()
    {
        $data['title'] = 'Penilaian';
        $data['user'] = $this->db->get_where('user', ['kode' => $this->session->userdata('kode')])->row_array();
        $user = $data['user'];
        $divisi = $user['divisi']; 
        $data['karyawan'] = $this->karyawan_m->getpegawai($divisi)->result_array();
        $data['kategori'] = $this->kategori_m->get()->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kepala_divisi/penilaian', $data);
        $this->load->view('templates/footer');
    }
    public function insert_keDB()
    { 
        if ($this->check() == FALSE) {
             $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Pegawai Sudah dinilai..!!</div>');
                redirect('kepaladivisi/penilaian');
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
                redirect('kepaladivisi/penilaian'); }else{
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

    //DATA PENILAIAN
    public function data()
    {
        $data['title'] = 'Data Nilai';
        $data['user'] = $this->db->get_where('user', ['kode' => $this->session->userdata('kode')])->row_array();
        $user = $data['user'];
        $params = $user['divisi'];
        // $prevN = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
        // $data['bulan'] = $this->tglIndonesia(date('F Y', $prevN));
        // $bulan = $data['bulan'];
        $bulan = $this->input->post('bulan');
        // $params = $this->input->post('divisi');
        $data['divisi'] =$this->divisi_m->get($params)->result();
        $data['nilai'] =$this->penilaian_m->getdata($params,$bulan)->result();
        $data['getbulan'] =$this->penilaian_m->getbulan()->result();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kepala_divisi/data', $data);
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
        $this->load->view('kepala_divisi/detail_data', $data);
        $this->load->view('templates/footer');
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
        $this->load->view('kepala_divisi/overview', $data);
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
        $this->load->view('kepala_divisi/overviewdetail', $data);
        $this->load->view('templates/footer');
    }

    function tglIndonesia($str){
    $tr   = trim($str);
    $str    = str_replace(array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'), array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'), $tr);
    return $str;
    }

    
}
