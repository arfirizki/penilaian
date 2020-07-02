<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Informasi_m extends CI_Model
{

    public function get($id = null)
    {
        $this->db->from('informasi');
        if ($id != null) {
            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        $data = [
            'judul' => $post['judul'],
            'namafile' => $post['namafile'],
        ];
        $this->db->insert('informasi', $data);
    }

    public function edit($post)
    {
        $params['judul'] = $post['judul'];
        $params['namafile'] = $post['namafile'];
        $this->db->where('id', $post['id']);
        $this->db->update('informasi', $params);
    }

    public function del($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('informasi');
    }

    public function deldata($tabel, $where)
    {
        return $this->db->delete($tabel, $where);
    }
}
