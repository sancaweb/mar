<?php
namespace Models;
use Resources, Models;


class User {
    // Data user -------------------
    //panggil library model terlebih dahulu
    public function __construct() {
        $this->db = new Resources\Database();
		
    }	
	
    public function input_user($data_user){
        $this->db->insert('user',$data_user);
		$id=$this->db->insertId();
		return $id;
    }
	
	public function hapus_user($id){
		return $this->db->delete('user',array('id'=>$id));		
	}
	public function user_terbaru(){
		return $this->db->getVar("SELECT count(id) FROM user WHERE tgl_register > DATE(now()) - INTERVAL 1 WEEK");
	}
	public function edit_user($data_user,$id){
		return $this->db->update("user",$data_user,array('id'=>$id));
	}
		
	public function total_user(){
		return $this->db->getVar("SELECT count(id) FROM user");
	}	
	
	public function total_user_by_id($id){
		return $this->db->getVar("SELECT count(id) FROM user WHERE id='".$id."'");
	}
	
	public function viewall(){	
		return $this->db->results("SELECT * FROM user ORDER BY id DESC");		
	}
	
	public function viewall_page($page = 1, $limit = 5){
		$offset = ($limit * $page) - $limit;
		return $this->db->results("SELECT * FROM user ORDER BY id DESC LIMIT $offset,$limit	");
	}
	
	
	public function viewall_page_by_id($id,$page = 1, $limit = 5){
		$offset = ($limit * $page) - $limit;
		return $this->db->results("SELECT * FROM user WHERE id='".$id."' ORDER BY id DESC LIMIT $offset,$limit");
	}
	
	
	public function cek_user($username,$password){
		return $this->db->row("SELECT * FROM user WHERE username='".$username."' AND password='".$password."'");
	}
	
	public function cek_username($username){
		return $this->db->row("SELECT username FROM user WHERE username='".$username."'");
	}
	
	public function cek_user_level($username,$password){
		return $this->db->row("SELECT user_level FROM user WHERE username='".$username."' AND password='".$password."'");
	}
	
	public function cek_user_level_by_userid($user_id){
		return $this->db->row("SELECT user_level FROM user WHERE id='".$user_id."'");
	}
	
	public function ambil_userid($username){
		return $this->db->row("SELECT id FROM user WHERE username='".$username."'");
	}
	
	public function ambil_username($id){
		return $this->db->row("SELECT username FROM user WHERE id='".$id."'");
	}
	
	public function viewall_username_and_id($user_level){
		return $this->db->results("SELECT username,id FROM user WHERE user_level='".$user_level."' ORDER BY id DESC");
	}
	
	
	public function hitung_user_terbaru(){
		return $this->db->getVar("SELECT count(id) FROM user WHERE tgl_register > DATE(now()) - INTERVAL 1 WEEK");
	}
	
	//user grup
	
	public function viewall_level_and_ket(){
		return $this->db->results("SELECT level,ket FROM user_grup ORDER BY level asc");
	}
	
	public function viewall_admin_sadmin(){
		return $this->db->results("SELECT level,ket FROM user_grup WHERE level=1 OR level=2 ORDER BY level asc");
	}
	public function ambil_user_level($cek_user_level){
		return $this->db->row("SELECT level,ket FROM user_grup WHERE level='".$cek_user_level."' ");
	}
		
	public function viewall_user_grup(){
		return $this->db->results("SELECT * FROM user_grup ORDER by level DESC");
	}
	
	public function view_by_id($user_id){
		return $this->db->row("SELECT * FROM user WHERE id='".$user_id."'");
	}
	
	
	//table pengguna
	
	public function view_nama_email($user_id){
		return $this->db->row("SELECT nama_lengkap,email FROM pengguna WHERE user_id='".$user_id."'");
	}
	
	public function view_email($user_id){
		return $this->db->row("SELECT email FROM pengguna WHERE user_id='".$user_id."'");
	}
	
	public function viewall_pengguna_by_user_id($user_id){
		return $this->db->row("SELECT * FROM pengguna WHERE user_id='".$user_id."'");
	}
	public function view_nama_lengkap($user_id){
		return $this->db->row("SELECT nama_lengkap FROM pengguna WHERE user_id='".$user_id."'");
	}
	
	public function viewall_nama_lengkap($user_id){
		return $this->db->results("SELECT nama_lengkap FROM pengguna WHERE user_id='".$user_id."'");
	}
	
	public function input_pengguna($data_pengguna){
		return $this->db->insert('pengguna',$data_pengguna);
	}
	
	public function edit_pengguna_by_userid($data_pengguna,$user_id){
		return $this->db->update('pengguna',$data_pengguna,array('user_id'=>$user_id));
		
	}
	
	public function view_foto($user_id){
		return  $this->db->row("SELECT foto FROM pengguna WHERE user_id='".$user_id."'");
	}
	
	public function hapus_pengguna($user_id){
		return $this->db->delete('pengguna',array('user_id'=>$user_id));		
	}
	
	public function cek_pengguna_by_userid($user_id){
		return $this->db->row("SELECT user_id FROM pengguna WHERE user_id='".$user_id."'");
	}
	
	
	
       
}