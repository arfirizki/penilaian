<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_m extends CI_Model
{

    public function get($id = null)
    {
        $this->db->from('user_menu');
        if ($id != null) {
            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function edit($post)
    {
        $params['menu'] = $post['menu'];
        $this->db->where('id', $post['id']);
        $this->db->update('user_menu', $params);
    }

    public function del($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_menu');
    }
}
