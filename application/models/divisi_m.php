<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Divisi_m extends CI_Model
{

    public function get($id=null)
    {
        $this->db->from('divisi');
        if ($id != null) {
        $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function add($data)
    {
        $data = [
                'divisi' => $this->input->post('divisi')
            ];
        $query = $this->db->insert('divisi',$data);
        return $query;
    }

    public function edit($post)
    {
        $params = array(
            'divisi' => $post['divisi']
        );
        $this->db->where('id',$post['id']);
        $this->db->update('divisi',$params);
    }

    public function del($params = null)
    {
        if ($params != null) {
            $this->db->where($params);
        }
        $this->db->delete('divisi');
    }
}	