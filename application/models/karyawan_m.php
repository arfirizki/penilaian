<?php
defined('BASEPATH') or exit('No direct script access allowed');
 
class Karyawan_m extends CI_Model
{

    public function get($params = null)
    {
        $this->db->select('*,karyawan.divisi as divisi_karyawan, jabatan.id as id_jabatan, divisi.id as id_divisi');
        $this->db->from('karyawan');
        $this->db->join('divisi', 'divisi.id = karyawan.divisi');
        $this->db->join('jabatan', 'jabatan.id = karyawan.jabatan');
        if($params !=null) {
            $this->db->where('karyawan.divisi',$params);
        }
        $query = $this->db->get();
        return $query;
    }

    public function jumlahpegawai($divisi)
    {
        $this->db->from('karyawan');
        $this->db->where('divisi', $divisi);
        $query = $this->db->get();
        return $query;   
    }
    public function getpegawai($divisi=null)
    {
        $this->db->from('karyawan');
        if ($divisi != null) {
        $this->db->where('divisi', $divisi);
        $this->db->where('jabatan', 4);
        }
        $query = $this->db->get();
        return $query;
    }

    public function get2($id=null)
    {
        $this->db->from('karyawan');
        if ($id != null) {
        $this->db->where('kode', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function get3($bulan,$divisi)
    {
        $sql = "SELECT kode,nama,divisi,jabatan
        FROM karyawan 
        WHERE kode NOT IN (SELECT kode FROM nilai_detail WHERE bulan = '$bulan') AND divisi='$divisi' AND jabatan=4" ;
        $query = $this->db->query($sql);
        return $query;
    }

    public function id()
    {
        $sql = "SELECT MAX(MID(kode,9,4)) AS kode 
        FROM karyawan 
        WHERE MID(kode,3,6) = DATE_FORMAT(CURDATE(), '%y%m%d')";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $n   = ((int)$row->kode) +1;
            $no  = sprintf("%'.03d" , $n);
        }else{
            $no = "001";
        }
        $kode = "KY".date('ymd').$no;
        return $kode;
    }
    public function add($data,$kode)
    { 
        $data = [
                'kode' => $kode,
                'nama' => $this->input->post('nama'),
                'nik' => $this->input->post('nik'),
                'email' => $this->input->post('email'),
                'ttl' => $this->input->post('ttl'),
                'tgl' => $this->input->post('tgl'),
                'alamat' => $this->input->post('alamat'),
                'telp' => $this->input->post('telp'),
                'masuk' => $this->input->post('masuk'),
                'jabatan' => $this->input->post('jabatan'),
                'divisi' => $this->input->post('divisi'),
            ];
        $query = $this->db->insert('karyawan',$data);
        return $query;
    }

    public function edit($data)
    {
         $data = [
                'kode' => $this->input->post('kode'),
                'nama' => $this->input->post('nama'),
                'nik' => $this->input->post('nik'),
                'email' => $this->input->post('email'),
                'ttl' => $this->input->post('ttl'),
                'alamat' => $this->input->post('alamat'),
                'telp' => $this->input->post('telp'),
                'jabatan' => $this->input->post('jabatan'),
                'divisi' => $this->input->post('divisi'),
            ];
        $this->db->where('kode',$this->input->post('kode'));
        $this->db->update('karyawan',$data);
    }

    public function del($params = null)
    {
        if ($params != null) {
            $this->db->where($params);
        }
        $this->db->delete('karyawan');
    }
}	