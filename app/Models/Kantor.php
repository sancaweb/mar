<?php
namespace Models;
use Resources, Models;


class Kantor {
	
    //panggil library model terlebih dahulu
    public function __construct() {
        $this->db = new Resources\Database();		
    }   

	public function viewall_kantor_page($page = 1, $limit = 5){
		$offset = ($limit * $page) - $limit;
		return $this->db->results("SELECT * FROM kantor ORDER BY nama_kantor ASC LIMIT $offset,$limit	");
	}
	
	
	public function hitung_kantor(){
		return $this->db->getVar("SELECT count(id) FROM kantor");
	}
	
	public function input_kantor($data_kantor){
		return $this->db->insert('kantor',$data_kantor);
	}
	
	public function edit_kantor($data_kantor,$id){
		return $this->db->update('kantor',$data_kantor,array('id'=>$id));
	}
	
	public function hapus_kantor($id){
		return $this->db->delete('kantor',array('id'=>$id));
		
	}
	
	public function view_by_id($id){
		return $this->db->row("SELECT id FROM kantor WHERE id='".$id."'");
	}
	
	
	
	
	
}