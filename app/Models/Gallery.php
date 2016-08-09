<?php
namespace Models;
use Resources, Models;


class Gallery {
    // Data kas -------------------
    //panggil library model terlebih dahulu
    public function __construct() {
        $this->db = new Resources\Database();
		
    }    
	
	public function input_gallery($data_gallery){
        return $this->db->insert('gallery',$data_gallery);
    }
	public function hitung_gallery(){
		return $this->db->getVar("SELECT count(id) FROM gallery");
	}
	
	public function hitung_gallery_by_id($kategori_id){
		return $this->db->getVar("SELECT count(id) FROM gallery WHERE kategori='".$kategori_id."'");
	}
	
	public function viewall_gallery(){
		return $this->db->results("SELECT * FROM gallery ORDER BY id DESC");
	}
	
	public function viewall_gallery_by_id($id_gallery){
		return $this->db->row("SELECT * FROM gallery WHERE id='".$id_gallery."'");
	}
	public function viewall_gallery_by_kat($kategori_id){
		return $this->db->results("SELECT * FROM gallery WHERE kategori='".$kategori_id."' ORDER BY id DESC");
	}
	
	public function view_judul_by_id($id_gallery){
		return $this->db->row("SELECT judul FROM gallery WHERE id='".$id_gallery."'");
	}
	
	public function viewall_gallery_page($page = 1, $limit = 5){
		$offset = ($limit * $page) - $limit;
		return $this->db->results("SELECT * FROM gallery ORDER BY id DESC LIMIT $offset,$limit	");
	}
	
	public function viewall_gallery_page_by_kat($kategori,$page = 1, $limit = 5){
		$offset = ($limit * $page) - $limit;
		return $this->db->results("SELECT * FROM gallery WHERE kategori='".$kategori."' ORDER BY id DESC LIMIT $offset,$limit	");
	}
	
	public function edit_gallery($data_gallery,$id){
		return $this->db->update("gallery",$data_gallery,array('id'=>$id));
	}	
	
	public function hapus_gallery($id){
		return $this->db->delete('gallery', array('id' => $id));
	}
	
	public function cek_id_and_kategori($id,$kategori){
		return $this->db->row("SELECT id,kategori FROM gallery WHERE id='".$id."' AND kategori='".$kategori."'");
	}
	
	public function harga_by_id($id_gallery){
		return $this->db->row("SELECT harga FROM gallery WHERE id='".$id_gallery."'");
	}
	
	public function view_seat_by_id($id_gallery){
		return $this->db->row("SELECT seat FROM gallery WHERE id='".$id_gallery."'");
	}
	
	public function view_foto_by_id($id){
		return $this->db->row("SELECT foto FROM gallery WHERE id='".$id."'");
	}
	
	// kategori_gallery
	public function hitung_kategori(){
		return $this->db->getVar("SELECT count(id) FROM kategori_gallery");
	}
	
	public function nama_kategori($id){
		return $this->db->row("SELECT nama_kategori FROM kategori_gallery WHERE id='".$id."'");
	}
	
	public function viewall_kategori(){
		return $this->db->results("SELECT * FROM kategori_gallery ORDER BY nama_kategori ASC");
	}
	
	public function viewall_kategori_by_id($id){
		return $this->db->row("SELECT * FROM kategori_gallery WHERE id='".$id."'");
	}
		
	
	public function viewall_kategori_page($page = 1, $limit = 5){
		$offset = ($limit * $page) - $limit;
		return $this->db->results("SELECT * FROM kategori_gallery ORDER BY id DESC LIMIT $offset,$limit	");
	}
	public function edit_kategori($data_kategori,$id){
		return $this->db->update("kategori_gallery",$data_kategori,array('id'=>$id));
	}
	
	public function input_kategori($data_kategori){
        $this->db->insert('kategori_gallery',$data_kategori);
		$id=$this->db->insertId();
		return $id;
    }

	
	public function hapus_kategori($id){
		return $this->db->delete('kategori_gallery', array('id' => $id));
	}
	
	
}