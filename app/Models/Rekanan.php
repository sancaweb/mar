<?php
namespace Models;
use Resources, Models;


class Rekanan {
    // Data kas -------------------
    //panggil library model terlebih dahulu
    public function __construct() {
        $this->db = new Resources\Database();
		
    }
	public function viewall_nama_and_user_id(){
		return $this->db->results("SELECT nama_rekanan,user_id FROM rekanan order by nama_rekanan ASC");
	}
	
	public function input_rekanan($data_rekanan){
        return $this->db->insert('rekanan',$data_rekanan);
    }
	public function hitung_rekanan(){
		return $this->db->getVar("SELECT count(id) FROM rekanan");
	}
	
	public function viewall_rekanan(){
		return $this->db->results("SELECT * FROM rekanan ORDER BY id DESC");
	}
	public function viewall_rekanan_by_id($id_rekanan){
		return $this->db->row("SELECT * FROM rekanan WHERE id_rekanan='".$id_rekanan."'");
	}
	
	public function view_nama_rekanan_by_id($id_rekanan){
		return $this->db->row("SELECT nama_rekanan FROM rekanan WHERE id_rekanan='".$id_rekanan."'");
	}
		
	public function viewall_rekanan_page($page = 1, $limit = 5){
		$offset = ($limit * $page) - $limit;
		return $this->db->results("SELECT * FROM rekanan ORDER BY id DESC LIMIT $offset,$limit	");
	}
	public function edit_rekanan($data_rekanan,$id){
		return $this->db->update("rekanan",$data_rekanan,array('id'=>$id));
	}	
	
	public function hapus_rekanan($id){
		return $this->db->delete('rekanan', array('id' => $id));
	}
	
	public function jenis_rekanan($id_rekanan){
		return $this->db->row("SELECT jenis FROM rekanan WHERE id_rekanan='".$id_rekanan."'");
	}
	
	public function view_id_rekanan($user_id){
		return $this->db->row("SELECT id_rekanan FROM rekanan WHERE user_id='".$user_id."'");
	}
	
	
	
}