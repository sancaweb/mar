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
	
	public function viewall_pesan_page_by_penerima($page = 1, $limit = 5,$penerima){
		$offset = ($limit * $page) - $limit;
		return $this->db->results("SELECT * FROM pesan WHERE penerima='".$penerima."' ORDER BY status ASC,id DESC LIMIT $offset,$limit");
	}
	
	public function viewall_pesan_page_by_pengirim($page = 1, $limit = 5,$pengirim){
		$offset = ($limit * $page) - $limit;
		return $this->db->results("SELECT * FROM pesan WHERE pengirim='".$pengirim."' ORDER BY status ASC,id DESC LIMIT $offset,$limit");
	}
	
	public function viewall_pesan_by_penerima($penerima){
		return $this->db->results("SELECT * FROM pesan WHERE penerima='".$penerima."' AND status=0 ORDER BY status ASC,id DESC");
	}
		
	
	public function hitung_pesan_status_by_penerima($penerima){
		return $this->db->getVar("SELECT count(id) FROM pesan WHERE penerima='".$penerima."' AND status=0");
	}
	
		
	public function hitung_pesan_by_penerima($penerima){
		return $this->db->getVar("SELECT count(id) FROM pesan WHERE penerima='".$penerima."'");
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
	
	public function view_pengirim($id){
		return $this->db->row("SELECT pengirim FROM pesan WHERE id='".$id."'");
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
	
	//export excel
	
	public function view_inbox_by_date($dari_tgl,$ke_tgl,$penerima){
		return $this->db->results("SELECT pengirim,email,subjek,isi_pesan,tgl_input FROM pesan WHERE penerima='".$penerima."' AND tgl_input BETWEEN '".$dari_tgl."' AND '".$ke_tgl."' ORDER BY id DESC");
	}
	
	public function view_sent_by_date($dari_tgl,$ke_tgl,$pengirim){
		return $this->db->results("SELECT penerima,email,subjek,isi_pesan,tgl_input FROM pesan WHERE pengirim='".$pengirim."' AND tgl_input BETWEEN '".$dari_tgl."' AND '".$ke_tgl."' ORDER BY id DESC");
	}
	
	public function viewall_inbox($penerima){
		return $this->db->results("SELECT pengirim,email,subjek,isi_pesan,tgl_input FROM pesan WHERE penerima='".$penerima."' ORDER BY id DESC");
	}
	
	public function viewall_sent($pengirim){
		return $this->db->results("SELECT penerima,email,subjek,isi_pesan,tgl_input FROM pesan WHERE pengirim='".$pengirim."' ORDER BY id DESC");
	}
	
	
	
}