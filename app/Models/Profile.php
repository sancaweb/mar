<?php
namespace Models;
use Resources, Models;


class Profile {
	
    //panggil library model terlebih dahulu
    public function __construct() {
        $this->db = new Resources\Database();		
    }   

	public function viewall_profile_page($page = 1, $limit = 5){
		$offset = ($limit * $page) - $limit;
		return $this->db->results("SELECT * FROM profile ORDER BY featured DESC LIMIT $offset,$limit");
	}
	
	
	public function hitung_profile(){
		return $this->db->getVar("SELECT count(id) FROM profile");
	}
	
	public function input_profile($data_profile){
		return $this->db->insert('profile',$data_profile);
	}
	
	public function edit_profile($data_profile,$id){
		return $this->db->update('profile',$data_profile,array('id'=>$id));
	}
	
	public function hapus_profile($id){
		return $this->db->delete('profile',array('id'=>$id));
		
	}
	
	public function view_by_id($id){
		return $this->db->row("SELECT id FROM profile WHERE id='".$id."'");
	}
	
	public function image_by_id($id){
		return $this->db->row("SELECT image FROM profile WHERE id='".$id."'");
	}
	
	public function view_featured(){
		return $this->db->row("SELECT * FROM profile WHERE featured='1'");
	}
	
	public function view_profile_by_id($id){
		return $this->db->row("SELECT * FROM profile WHERE id='".$id."'");
	}
	
	
	
	
	
}