<?php
namespace Models;
use Resources, Models;


class Kabar {
    // Data kas -------------------
    //panggil library model terlebih dahulu
    public function __construct() {
        $this->db = new Resources\Database();
		
    }    
	
	public function input_kabar($data_kabar){
        return $this->db->insert('kabar',$data_kabar);
    }
	public function hitung_kabar(){
		return $this->db->getVar("SELECT count(id) FROM kabar");
	}
	
	public function kabar_terbaru(){
		return $this->db->getVar("SELECT count(id) FROM kabar WHERE tgl_input > DATE(now()) - INTERVAL 1 WEEK");
	}
	
	public function viewall_kabar(){
		return $this->db->results("SELECT * FROM kabar ORDER BY id DESC");
	}
	
	public function viewall_kabar_by_id($id){
		return $this->db->results("SELECT * FROM kabar WHERE id='".$id."' ORDER BY id DESC");
	}	
	
	public function view_judul_by_id($id_kabar){
		return $this->db->row("SELECT judul FROM kabar WHERE id='".$id_kabar."'");
	}
	
	public function viewall_kabar_page($page = 1, $limit = 5){
		$offset = ($limit * $page) - $limit;
		return $this->db->results("SELECT * FROM kabar ORDER BY id DESC LIMIT $offset,$limit	");
	}
	
	public function viewall_kabar_by_kat($kat_id=1,$limit=5){
		return $this->db->results("SELECT * FROM kabar WHERE kategori='".$kat_id."'ORDER BY id DESC LIMIT $limit");
	}
	
	public function edit_kabar($data_kabar,$id){
		return $this->db->update("kabar",$data_kabar,array('id'=>$id));
	}	
	
	public function hapus_kabar($id){
		return $this->db->delete('kabar', array('id' => $id));
	}
	
	public function single_kabar($kat_id,$id){
		return $this->db->row("SELECT * FROM kabar WHERE kategori='".$kat_id."' AND id='".$id."'");
	}
	
	public function id_akhir_by_kat($kat_id){
		return $this->db->row("SELECT id FROM kabar WHERE kategori='".$kat_id."' ORDER BY id DESC LIMIT 1");
	}
	
	// kategori_kabar
	public function hitung_kategori(){
		return $this->db->getVar("SELECT count(id) FROM kategori_kabar");
	}
	
	public function nama_kategori($id){
		return $this->db->row("SELECT nama_kategori FROM kategori_kabar WHERE id='".$id."'");
	}
	
	public function viewall_kategori(){
		return $this->db->results("SELECT * FROM kategori_kabar ORDER BY nama_kategori ASC");
	}
	
	
	public function viewall_kategori_page($page = 1, $limit = 5){
		$offset = ($limit * $page) - $limit;
		return $this->db->results("SELECT * FROM kategori_kabar ORDER BY id DESC LIMIT $offset,$limit	");
	}
	
	public function edit_kategori($data_kategori,$id){
		return $this->db->update("kategori_kabar",$data_kategori,array('id'=>$id));
	}
	
	public function input_kategori($data_kategori){
        return $this->db->insert('kategori_kabar',$data_kategori);
    }	
	
	public function hapus_kategori($id){
		return $this->db->delete('kategori_kabar', array('id' => $id));
	}
	
	
}