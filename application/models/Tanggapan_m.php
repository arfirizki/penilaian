<?php
defined('BASEPATH') or exit('No direct script access allowed');
 
class Tanggapan_m extends CI_Model
{
public function get($params,$bulan)
    {
        $this->db->from('tanggapan');     
        $this->db->where('kode',$params);
        $this->db->where('bulan',$bulan);
        // $this->db->from('nilai_detail');
        // $this->db->where('kode',$params);
        // $this->db->where('bulan',$bulan);
        $query = $this->db->get();
        return $query;
    }
}