<?php
namespace Models;
use Resources, Models;


class Pengaturan {
	
    //panggil library model terlebih dahulu
    public function __construct() {
        $this->db = new Resources\Database();		
    }    
	
	public function input_rekening($data_rekening){
        return $this->db->insert('rekening',$data_rekening);
    }
	public function hitung_jamaah(){
		return $this->db->getVar("SELECT count(id) FROM jamaah");
	}
	public function viewall_rekening(){
		return $this->db->results("SELECT * FROM rekening ORDER BY id DESC");
	}
	
	public function rekening_by_id($id){
		return $this->db->row("SELECT * FROM rekening WHERE id='".$id."'");
	}
	
	public function viewall_bank(){
		return $this->db->results("SELECT * FROM bank ORDER BY nama_bank ASC");
	}
	
	public function nama_bank_by_id($id){
		return $this->db->row("SELECT nama_bank FROM bank WHERE id='".$id."'");
	}
	
	//SLIDE
	
	public function viewall_slide(){
		return $this->db->results("SELECT * FROM slide ORDER BY id DESC");
	}
	
	public function input_slide($data_slide){
		return $this->db->insert('slide',$data_slide);
	}
	
	public function edit_slide($data_slide,$id){
		return $this->db->update('slide',$data_slide,array('id'=>$id));
	}
	
	public function view_id_slide_by_id($id){
		return $this->db->row("SELECT id FROM slide WHERE id='".$id."'");
	}
	
	public function image_slide_by_id($id){
		return $this->db->row("SELECT image FROM slide WHERE id='".$id."'");
	}
	
	public function hapus_slide($id){
		return $this->db->delete('slide',array('id'=>$id));
		
	}
	
	//END SLIDE
	
	//header image
	
	public function viewall_header(){
		return $this->db->results("SELECT * FROM img_header ORDER BY id DESC");
	}
	
	public function viewall_header_rand(){
		return $this->db->row("SELECT image FROM img_header ORDER BY RAND() LIMIT 1");
	}
	public function input_header($data_header){
		return $this->db->insert('img_header',$data_header);
	}
	
	
	public function edit_header($data_header,$id){
		return $this->db->update('img_header',$data_header,array('id'=>$id));
	}
	
	
	public function view_id_header_by_id($id){
		return $this->db->row("SELECT id FROM img_header WHERE id='".$id."'");
	}
	
	
	public function image_header_by_id($id){
		return $this->db->row("SELECT image FROM img_header WHERE id='".$id."'");
	}
	
	
	public function hapus_header($id){
		return $this->db->delete('img_header',array('id'=>$id));
		
	}	
	//END header image
	
	//partner
	public function viewall_partner_page($page = 1, $limit = 5){
		$offset = ($limit * $page) - $limit;
		return $this->db->results("SELECT * FROM partner ORDER BY id DESC LIMIT $offset,$limit	");
	}
	
	public function viewall_partner(){
		return $this->db->results("SELECT * FROM partner ORDER BY RAND() LIMIT 6");
	}
	
	public function hitung_partner(){
		return $this->db->getVar("SELECT count(id) FROM partner");
	}
	
	public function input_partner($data_partner){
		return $this->db->insert('partner',$data_partner);
	}
		
	public function edit_partner($data_partner,$id){
		return $this->db->update('partner',$data_partner,array('id'=>$id));
	}
	
	public function cek_partner_by_id($id){
		return $this->db->row("SELECT id,image FROM partner WHERE id='".$id."'");
	}
	
	public function hapus_partner($id){
		return $this->db->delete('partner',array('id'=>$id));
		
	}
	//END Partner
	
	
	
}