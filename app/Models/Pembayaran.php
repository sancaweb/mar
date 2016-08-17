<?php
namespace Models;
use Resources, Models;


class Pembayaran {
	
    //panggil library model terlebih dahulu
    public function __construct() {
        $this->db = new Resources\Database();		
    }    
	
	
	public function viewall_pembayaran($page = 1, $limit = 5){
		$offset = ($limit * $page) - $limit;
		return $this->db->results("SELECT * FROM pembayaran ORDER BY id DESC LIMIT $offset,$limit	");
	}
	public function viewall_pembayaran_by_id_rekanan($id_rekanan, $page = 1, $limit = 5){
		$offset = ($limit * $page) - $limit;
		return $this->db->results("SELECT * FROM pembayaran WHERE id_rekanan='".$id_rekanan."' ORDER BY id DESC LIMIT $offset,$limit");
	}
	
	public function hitung_pembayaran(){
		return $this->db->getVar("SELECT count(id) FROM pembayaran ");
	}
	public function hitung_pembayaran_by_date(){
		return $this->db->getVar("SELECT count(id) FROM pembayaran WHERE tgl_konfirm > DATE(now()) - INTERVAL 1 WEEK");
	}
	
	public function input_pembayaran($data_pembayaran){
        return $this->db->insert('pembayaran',$data_pembayaran);
    }
	
	public function edit_pembayaran($data_pembayaran,$id){
		return $this->db->update("pembayaran",$data_pembayaran,array('id'=>$id));
	}
	
	public function cek_pembayaran_id_register($id_register){
		return $this->db->row("SELECT id_register,jml_pembayaran,keterangan FROM pembayaran WHERE id_register='".$id_register."'");
	}
	
	public function viewall_pembayaran_user_id($user_id, $page = 1, $limit = 5){
		$offset = ($limit * $page) - $limit;
		return $this->db->results("SELECT * FROM pembayaran WHERE user_id='".$user_id."' ORDER BY id DESC LIMIT $offset,$limit	");
	}
	
	public function hitung_pembayaran_user_id($user_id){
		return $this->db->getVar("SELECT count(id) FROM pembayaran WHERE user_id='".$user_id."' ");
	}
	
	
	public function hitung_pembayaran_terbaru(){
		return $this->db->getVar("SELECT count(id) FROM pembayaran WHERE tgl_konfirm > DATE(now()) - INTERVAL 1 WEEK");
	}
	
}