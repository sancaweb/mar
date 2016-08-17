<?php
namespace Models;
use Resources, Models;


class Produk {
    // Data kas -------------------
    //panggil library model terlebih dahulu
    public function __construct() {
        $this->db = new Resources\Database();
		
    }    
	
	public function input_produk($data_produk){
        return $this->db->insert('produk',$data_produk);
    }
	public function hitung_produk(){
		return $this->db->getVar("SELECT count(id) FROM produk");
	}
	
	public function produk_terbaru(){
		return $this->db->getVar("SELECT count(id) FROM produk WHERE tgl_input > DATE(now()) - INTERVAL 1 WEEK");
	}
	
	public function viewall_produk(){
		return $this->db->results("SELECT * FROM produk ORDER BY id DESC");
	}
	public function viewall_produk_haji(){
		return $this->db->results("SELECT id,nama_produk FROM produk WHERE kategori='2' ORDER BY id DESC");
	}
	
	public function viewall_produk_umroh(){
		return $this->db->results("SELECT id,nama_produk FROM produk WHERE kategori='1' ORDER BY id DESC");
	}
	
	public function viewall_produk_by_id($id_produk){
		return $this->db->row("SELECT * FROM produk WHERE id='".$id_produk."'");
	}
	
	public function view_nama_produk_by_id($id_produk){
		return $this->db->row("SELECT nama_produk FROM produk WHERE id='".$id_produk."'");
	}
	
	public function viewall_produk_page($page = 1, $limit = 5){
		$offset = ($limit * $page) - $limit;
		return $this->db->results("SELECT * FROM produk ORDER BY id DESC LIMIT $offset,$limit	");
	}
	
	public function edit_produk($data_produk,$id){
		return $this->db->update("produk",$data_produk,array('id'=>$id));
	}	
	
	public function hapus_produk($id){
		return $this->db->delete('produk', array('id' => $id));
	}
	
	
	public function harga_by_id($id_produk){
		return $this->db->row("SELECT harga FROM produk WHERE id='".$id_produk."'");
	}
	
	public function view_seat_by_id($id_produk){
		return $this->db->row("SELECT seat FROM produk WHERE id='".$id_produk."'");
	}
	
	// kategori_produk
	public function hitung_kategori(){
		return $this->db->getVar("SELECT count(id) FROM kategori_produk");
	}
	
	public function nama_kategori($id){
		return $this->db->row("SELECT nama FROM kategori_produk WHERE id='".$id."'");
	}
	
	public function viewall_kategori(){
		return $this->db->results("SELECT * FROM kategori_produk ORDER BY nama ASC");
	}
	
	
	public function viewall_kategori_page($page = 1, $limit = 5){
		$offset = ($limit * $page) - $limit;
		return $this->db->results("SELECT * FROM kategori_produk ORDER BY id DESC LIMIT $offset,$limit	");
	}
	public function edit_kategori($data_kategori,$id){
		return $this->db->update("kategori_produk",$data_kategori,array('id'=>$id));
	}
	
	public function input_kategori($data_kategori){
        return $this->db->insert('kategori_produk',$data_kategori);
    }	
	
	public function hapus_kategori($id){
		return $this->db->delete('kategori_produk', array('id' => $id));
	}
	
	
}