<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Role_m extends CI_Model
{

    public function get($id = null)
    {
        $this->db->from('user_role');
        if ($id != null) {
            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function edit($post)
    {
        $params['role'] = $post['role'];
        $this->db->where('id', $post['id']);
        $this->db->update('user_role', $params);
    }

    public function del($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_role');
    }
}
