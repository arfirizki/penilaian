<?php
defined('BASEPATH') or exit('No direct script access allowed');
 
class Penilaian_m extends CI_Model
{

    public function get($id=null)
    {
        $this->db->from('nilai');
        if ($id != null) {
        $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function getdata($params,$bulan)
    {
        $this->db->select('*,karyawan.divisi as divisi_karyawan, jabatan.id as id_jabatan, divisi.id as id_divisi,SUM(nilai_detail.nilai) as nilai ');
        $this->db->from('karyawan');
        $this->db->join('divisi', 'divisi.id = karyawan.divisi');
        $this->db->join('jabatan', 'jabatan.id = karyawan.jabatan');
        $this->db->join('nilai_detail', 'nilai_detail.kode = karyawan.kode');
        $this->db->where('karyawan.divisi',$params);
        $this->db->where('nilai_detail.bulan',$bulan);
        $this->db->group_by('nilai_detail.kode');
        $query = $this->db->get();
        return $query;
    }

    public function getnilaipegawai($kode)
    {
        $this->db->select('*,karyawan.divisi as divisi_karyawan, SUM(nilai_detail.nilai) as nilai ');
        $this->db->from('karyawan');
        $this->db->join('nilai_detail', 'nilai_detail.kode = karyawan.kode');
        $this->db->where('nilai_detail.kode',$kode);
        $this->db->group_by('nilai_detail.bulan');
        $query = $this->db->get();
        return $query;
    }

    public function getdetail($params,$bulan)
    {
        $this->db->select('*,nilai_detail.kode as karyawan_kode, karyawan.kode as kode_karyawan');
        $this->db->from('nilai_detail');
        $this->db->join('karyawan', 'nilai_detail.kode = karyawan.kode');
        $this->db->join('divisi', 'divisi.id = karyawan.divisi');        
        $this->db->where('nilai_detail.kode',$params);
        $this->db->where('nilai_detail.bulan',$bulan);
        // $this->db->from('nilai_detail');
        // $this->db->where('kode',$params);
        // $this->db->where('bulan',$bulan);
        $query = $this->db->get();
        return $query;
    }

    public function getbulan($divisi=null)
    {
        $this->db->from('nilai_detail');
        $this->db->group_by('bulan');
        $this->db->order_by('id',"ASC"); 
        if ($divisi !=null) {
          $this->db->where('divisi',$divisi);
        }
        $query = $this->db->get();
        return $query;
    }

    public function getkategori()
    {
        $this->db->from('nilai_detail');
        $this->db->group_by('kategori');
        $this->db->order_by('id',"ASC"); 
        $query = $this->db->get();
        return $query;
    }

    public function getranking($bulan,$divisi)
    {
        $this->db->select('*,nilai_detail.kode as kode,SUM(nilai_detail.nilai) as nilai,nilai_detail.bulan as bulan');
        $this->db->from('nilai_detail');
        $this->db->join('karyawan','karyawan.kode = nilai_detail.kode');        
        $this->db->where('bulan',$bulan);
        $this->db->where('karyawan.divisi',$divisi);
        $this->db->group_by('bulan');
        $this->db->group_by('nilai_detail.kode');
        $this->db->order_by('nilai',"DESC");
        $query = $this->db->get();
        return $query;
    }

    public function getoverview($id)
    {
        $this->db->select('*,SUM(nilai) as nilai,bulan as bulan');
        $this->db->from('nilai_detail');
        $this->db->where('kode',$id);
        $this->db->group_by('bulan');
        $this->db->group_by('kode');
        $this->db->order_by('id',"ASC");
        $query = $this->db->get();
        return $query;
    }
    public function getoverviewdetail($id,$kategori)
    {
        $this->db->from('nilai_detail');
        $this->db->where('kode',$id);
        $this->db->where('kategori',$kategori);
        $this->db->group_by('bulan');
        $this->db->order_by('id',"ASC");
        $query = $this->db->get();
        return $query;
    }
    public function getoverview2($id)
    {
        $this->db->from('nilai_detail');
        $this->db->where('kode',$id);
        $query = $this->db->get();
        return $query;
    }


    // public function add($data)
    // {
    //     $data = [
    //             'penilai' => $this->input->post('penilai'),
    //             'kode' => $this->input->post('kode'),
    //             'bulan' => $this->input->post('bulan'),
    //             'kedisiplinan' => $this->input->post('kedisiplinan'),
    //             'kesetiaan' => $this->input->post('kesetiaan'),
    //             'prestasi_kerja' => $this->input->post('prestasi_kerja'),
    //             'tanggung_jawab' => $this->input->post('tanggung_jawab'),
    //             'ketaatan' => $this->input->post('ketaatan'),
    //             'kejujuran' => $this->input->post('kejujuran'),
    //             'kerjasama' => $this->input->post('kerjasama'),
    //             'prakarsa' => $this->input->post('prakarsa'),
    //             'kepemimpinan' => $this->input->post('kepemimpinan'),
    //             'status' => "1",
    //         ];
    //     $query = $this->db->insert('nilai_detail',$data);
    //     return $query;
    // }
    // public function hasil($post)
    // {
    //     $hasil = $post['kedisiplinan']+$post['kesetiaan']+$post['prestasi_kerja']+$post['tanggung_jawab']+$post['ketaatan']+$post['kejujuran']+$post['kerjasama']+$post['prakarsa']+$post['kepemimpinan'];
    //     $nilai = $hasil/9;
    //     $data = [
    //             'kode' => $this->input->post('kode'),
    //             'bulan' => $this->input->post('bulan'),
    //             'divisi' => $this->input->post('divisi'),
    //             'nilai' => $nilai,
    //         ];
    //     $query = $this->db->insert('nilai',$data);
    //     return $query;
    // }

    // public function edit($data)
    // {
    //      $data = [
    //             'kode' => $this->input->post('kode'),
    //             'nama' => $this->input->post('nama'),
    //             'nik' => $this->input->post('nik'),
    //             'email' => $this->input->post('email'),
    //             'ttl' => $this->input->post('ttl'),
    //             'alamat' => $this->input->post('alamat'),
    //             'telp' => $this->input->post('telp'),
    //             'jabatan' => $this->input->post('jabatan'),
    //             'divisi' => $this->input->post('divisi'),
    //         ];
    //     $this->db->where('kode',$this->input->post('kode'));
    //     $this->db->update('karyawan',$data);
    // }

    public function del($params = null)
    {
        if ($params != null) {
            $this->db->where($params);
        }
        $this->db->delete('nilai_detail');
    }
}	


    // public function getdata($params,$bulan)
    // {
    //     $this->db->select('*,karyawan.divisi as divisi_karyawan, jabatan.id as id_jabatan, divisi.id as id_divisi');
    //     $this->db->from('karyawan');
    //     $this->db->join('divisi', 'divisi.id = karyawan.divisi');
    //     $this->db->join('jabatan', 'jabatan.id = karyawan.jabatan');
    //     $this->db->join('nilai', 'nilai.kode = karyawan.kode');
    //     $this->db->where('karyawan.divisi',$params);
    //     $this->db->where('nilai.bulan',$bulan);
    //     $this->db->order_by('nilai.nilai','DESC');
    //     $query = $this->db->get();
    //     return $query;
    // }