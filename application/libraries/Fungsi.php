<?php 

Class Fungsi {

	protected $ci;

	public function __construct(){
		$this->ci =& get_instance();
	}

	function user_login(){
        $this->ci->load->model('user_m');
        $user_id = $this->ci->session->userdata('kode');
        $user_data = $this->ci->user_m->get($user_id)->row();
        return $user_data;
	} 
	// function profil(){
	// 	$this->ci->load->model('pelanggan_m');
	// 	$user_id = $this->user_login()->id_p;
	// 	$user_data = $this->ci->pelanggan_m->get($user_id)->row();
	// 	return $user_data;
	// } 
}