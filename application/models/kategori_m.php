<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori_m extends CI_Model
{

    public function get($id=null)
    {
        $this->db->from('kategori');
        if ($id != null) {
        $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    
    public function add($data)
    {
        $data = [
                'kategori' => $this->input->post('nama')
            ];
        $query = $this->db->insert('kategori',$data);
        return $query;
    }

    public function edit($post)
    {
        $params = array(
            'kategori' => $post['nama']
        );
        $this->db->where('id',$post['id']);
        $this->db->update('kategori',$params);
    }

    public function del($params = null)
    {
        if ($params != null) {
            $this->db->where($params);
        }
        $this->db->delete('kategori');
    }
}	