<?php
namespace Models;
use Resources, Models;


class Pesan {
	
    //panggil library model terlebih dahulu
    public function __construct() {
        $this->db = new Resources\Database();		
    }   
	

	public function viewall_pesan_page($page = 1, $limit = 5){
		$offset = ($limit * $page) - $limit;
		return $this->db->results("SELECT * FROM pesan ORDER BY status ASC LIMIT $offset,$limit	");
	}
	
	public function viewall_pesan_page_by_kepada($page = 1, $limit = 5,$kepada){
		$offset = ($limit * $page) - $limit;
		return $this->db->results("SELECT * FROM pesan WHERE kepada='".$kepada."' ORDER BY status ASC,id DESC LIMIT $offset,$limit");
	}
	
	public function viewall_pesan_page_by_pengirim($page = 1, $limit = 5,$pengirim){
		$offset = ($limit * $page) - $limit;
		return $this->db->results("SELECT * FROM pesan WHERE pengirim='".$pengirim."' ORDER BY status ASC,id DESC LIMIT $offset,$limit");
	}
	
	public function viewall_pesan_by_kepada($kepada){
		return $this->db->results("SELECT * FROM pesan WHERE kepada='".$kepada."' AND status=0 ORDER BY status ASC,id DESC");
	}
	public function hitung_pesan_status_by_kepada($kepada){
		return $this->db->getVar("SELECT count(id) FROM pesan WHERE kepada='".$kepada."' AND status=0");
	}
	
		
	public function hitung_pesan_by_kepada($kepada){
		return $this->db->getVar("SELECT count(id) FROM pesan WHERE kepada='".$kepada."'");
	}
	
	public function hitung_pesan_by_pengirim($pengirim){
		return $this->db->getVar("SELECT count(id) FROM pesan WHERE pengirim='".$pengirim."'");
	}
	
	public function hitung_pesan(){
		return $this->db->getVar("SELECT count(id) FROM pesan");
	}
	
	public function input_pesan($data_pesan){
		return $this->db->insert('pesan',$data_pesan);
	}
	
	public function edit_pesan($data_pesan,$id){
		return $this->db->update('pesan',$data_pesan,array('id'=>$id));
	}
	
	public function hapus_pesan($id){
		return $this->db->delete('pesan',array('id'=>$id));
		
	}
	
	public function view_by_id($id){
		return $this->db->row("SELECT * FROM pesan WHERE id='".$id."'");
	}
		
	public function view_by_id_pesan($id_pesan){
		return $this->db->results("SELECT * FROM pesan WHERE id_pesan='".$id_pesan."' ORDER by id DESC");
	}
	
	public function hitung_pesan_by_id_pesan($id_pesan){
		return $this->db->getVar("SELECT count(id) FROM pesan WHERE id_pesan='".$id_pesan."'");
	}
	
	public function cek_id($id){
		return $this->db->row("SELECT id FROM pesan WHERE id='".$id."'");
	}
	
	public function cek_id_pesan($id_pesan){
		return $this->db->row("SELECT id_pesan FROM pesan WHERE id_pesan='".$id_pesan."'");
	}
	
	
	
	
	
	
}