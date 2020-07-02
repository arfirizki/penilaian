<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Submenu_m extends CI_Model
{

    public function get($id = null)
    {
        $this->db->from('user_sub_menu');
        if ($id != null) {
            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function edit($post)
    {
        $params['menu_id'] = $post['menu_id'];
        $params['title'] = $post['title'];
        $params['url'] = $post['url'];
        $params['icon'] = ucfirst($post['icon']);
        $params['is_active'] = ucfirst($post['active']);
        $this->db->where('id', $post['id']);
        $this->db->update('user_sub_menu', $params);
    }

    public function del($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_sub_menu');
    }
}
