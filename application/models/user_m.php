<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_m extends CI_Model {

	public function get($id=null)
	{
		$this->db->from('user');
		if($id !=null){
			$this->db->where('kode', $id);
		}
		$query = $this->db->get();
		return $query;
	}
	public function add($data,$level,$kode)
    {
    	// if ($level == 1) {
    	// 	$level = 1;
     //        $password = $this->input->post('password');
    	// }else if($level == 2){
    	// 	$level = 2;
    	// }else if($level == 3){
    	// 	$level = 3;
    	// }else{
     //        $level = 4;
     //    }
        
        $data = [
                'email' => htmlspecialchars($this->input->post('email')),
                'kode' => $kode,
                'image' => 'default.jpg',
                'password' => password_hash($kode, PASSWORD_DEFAULT),
                'level' => $level,
                'name' => htmlspecialchars($this->input->post('nama')),
                'divisi' => $this->input->post('divisi'),
                'status' => 1,
                'createdDate' => time()
            ];
        $query = $this->db->insert('user',$data);
        return $query;
    }
    public function addadmin($data,$level)
    {        
        $data = [
                'email' => htmlspecialchars($this->input->post('email')),
                'kode' => $this->input->post('id'),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('id'), PASSWORD_DEFAULT),
                'level' => $level,
                'name' => htmlspecialchars($this->input->post('nama')),
                'divisi' => $this->input->post('divisi'),
                'status' => 1,
                'createdDate' => time()
            ];
        $query = $this->db->insert('user',$data);
        return $query;
    }
    public function edit($post)
    {
        $params = array(
            'name' => $post['nama'],
            'email' => $post['email'],
        );
        $this->db->where('kode',$post['kode']);
        $this->db->update('user',$params);
    }
    public function edit_karyawan($post,$level)
    {
        if ($level == 1) {
            $level = 1;
        }else if($level == 2){
            $level = 2;
        }else if($level == 3){
            $level = 3;
        }else{
            $level = 4;
        }
        $params = array(
            'level' => $level,
            'name' => $post['nama'],
            'email' => $post['email']
        );
        $this->db->where('kode',$post['kode']);
        $this->db->update('user',$params);
    }
    public function del($params = null)
    {
        if ($params != null) {
            $this->db->where($params);
        }
        $this->db->delete('user');
    }
}	