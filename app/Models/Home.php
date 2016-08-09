<?php
namespace Models;
use Resources, Models;


class Home {
    // Data kas -------------------
    //panggil library model terlebih dahulu
    public function __construct() {
        $this->db = new Resources\Database();
		
    }    
	
	public function data_cicilan(){
		return $this->db->results("SELECT * FROM cicilan ORDER BY id DESC LIMIT 10");
	}
	public function data_pinjaman(){
		return $this->db->results("SELECT * FROM pinjaman ORDER BY id DESC LIMIT 10");
	}
	
	
	
}