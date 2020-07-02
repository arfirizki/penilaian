<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_m extends CI_Model
{

    public function get($id=null)
    {
        $this->db->from('admin');
        if ($id != null) {
        $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function id()
    {
        $sql = "SELECT MAX(MID(kode,9,4)) AS kode 
        FROM admin 
        WHERE MID(kode,3,6) = DATE_FORMAT(CURDATE(), '%y%m%d')";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $n   = ((int)$row->kode) +1;
            $no  = sprintf("%'.02d" , $n);
        }else{
            $no = "01";
        }
        $kode = "AD".date('ymd').$no;
        return $kode;
    }
    public function add($data) 
    {
        $data = [
                'kode' => $this->input->post('id'),
                'nama' => $this->input->post('nama'),
                'email' => $this->input->post('email'),
            ];
        $query = $this->db->insert('admin',$data);
        return $query;
    }

    public function edit($post)
    {
        $params = array(
            'nama' => $post['nama'],
            'email' => $post['email']
        );
        $this->db->where('kode',$post['kode']);
        $this->db->update('admin',$params);
    }

    public function del($params = null)
    {
        if ($params != null) {
            $this->db->where($params);
        }
        $this->db->delete('admin');
    }
}	