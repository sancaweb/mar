<?php
namespace Models;
use Resources, Models;


class Registrasi {
	
    //panggil library model terlebih dahulu
    public function __construct() {
        $this->db = new Resources\Database();		
    }
	
	
	public function edit_registrasi($data_registrasi,$id){
		return $this->db->update("registrasi",$data_registrasi,array('id'=>$id));
	}

	public function viewall_registrasi($page = 1, $limit = 5){
		$offset = ($limit * $page) - $limit;
		return $this->db->results("SELECT * FROM registrasi ORDER BY id DESC LIMIT $offset,$limit	");
	}
	
	public function hitung_registrasi(){
		return $this->db->getVar("SELECT count(id) FROM registrasi");
	}
	
	public function hitung_registrasi_by_date(){
		return $this->db->getVar("SELECT count(id) FROM registrasi WHERE tgl_register > DATE(now()) - INTERVAL 1 WEEK");
	}
	
	
	public function input_registrasi($data_registrasi){
        return $this->db->insert('registrasi',$data_registrasi);
    }
	
	public function cek_id_register($id_register){
		return $this->db->row("SELECT id_register FROM registrasi WHERE id_register='".$id_register."'");
	}
	
	public function viewall_registrasi_user_id($user_id, $page = 1, $limit = 5){
		$offset = ($limit * $page) - $limit;
		return $this->db->results("SELECT * FROM registrasi WHERE user_id='".$user_id."' ORDER BY id DESC LIMIT $offset,$limit	");
	}
	public function viewall_registrasi_id_rekanan($id_rekanan, $page = 1, $limit = 5){
		$offset = ($limit * $page) - $limit;
		return $this->db->results("SELECT * FROM registrasi WHERE id_rekanan='".$id_rekanan."' ORDER BY id DESC LIMIT $offset,$limit	");
	}
	
	public function hitung_registrasi_user_id($user_id){
		return $this->db->getVar("SELECT count(id) FROM registrasi WHERE user_id='".$user_id."' ");
	}
	
	public function nama_jamaah_by_id_register($id_register){
		return $this->db->row("SELECT nama_jamaah FROM registrasi WHERE id_register='".$id_register."'");
	}
	
	public function id_produk_by_id_register($id_register){
		return $this->db->row("SELECT id_produk FROM registrasi WHERE id_register='".$id_register."'");
	}
	
	public function harga_produk_by_id_register($id_register){
		return $this->db->row("SELECT harga_produk FROM registrasi WHERE id_register='".$id_register."'");
	}
	
	public function potongan_by_id_register($id_register){
		return $this->db->row("SELECT potongan FROM registrasi WHERE id_register='".$id_register."'");
	}
	public function biaya_by_id_register($id_register){
		return $this->db->row("SELECT biaya FROM registrasi WHERE id_register='".$id_register."'");
	}
	public function pembayaran_by_id_register($id_register){
		return $this->db->row("SELECT pembayaran FROM registrasi WHERE id_register='".$id_register."'");
	}
	
	public function view_id_rekanan_by_id_register($id_register){
		return $this->db->row("SELECT id_rekanan FROM registrasi WHERE id_register='".$id_register."'");
	}
	
	public function hitung_register_terbaru(){
		return $this->db->getVar("SELECT count(id) FROM registrasi WHERE tgl_register > DATE(now()) - INTERVAL 1 WEEK");
	}
}