<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jabatan_m extends CI_Model
{

    public function get($id=null)
    {
        $this->db->from('jabatan');
        if ($id != null) {
        $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    public function get2()
    {
        $this->db->select('jabatan.id as id_jabatan,jabatan.jabatan as nama,karyawan.jabatan as jabatan_karyawan, COUNT(karyawan.jabatan) as jml');
        $this->db->group_by('jabatan_karyawan');
        $this->db->from('karyawan');
        $this->db->join('jabatan', 'jabatan.id = karyawan.jabatan', 'jabatan.jabatan');
        $hasil = $this->db->get();
        return $hasil;
    }

    public function add($data)
    {
        $data = [
                'jabatan' => $this->input->post('jabatan')
            ];
        $query = $this->db->insert('jabatan',$data);
        return $query;
    }

    public function edit($post)
    {
        $params = array(
            'jabatan' => $post['jabatan']
        );
        $this->db->where('id',$post['id']);
        $this->db->update('jabatan',$params);
    }

    public function del($params = null)
    {
        if ($params != null) {
            $this->db->where($params);
        }
        $this->db->delete('jabatan');
    }
}	