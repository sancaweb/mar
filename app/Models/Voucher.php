<?php
namespace Models;
use Resources, Models;


class Voucher {
    // Data kas -------------------
    //panggil library model terlebih dahulu
    public function __construct() {
        $this->db = new Resources\Database();
		
    }    
	
	public function input_voucher($data_voucher){
        return $this->db->insert('voucher',$data_voucher);
    }
	
	public function hitung_voucher(){
		return $this->db->getVar("SELECT count(id) FROM voucher");
	}
	public function hitung_voucher_by(){
		return $this->db->getVar("SELECT count(id) FROM voucher");
	}
	
	public function viewall_voucher(){
		return $this->db->results("SELECT * FROM voucher ORDER BY id DESC");
	}
	
	public function viewall_voucher_page($page = 1, $limit = 5){
		$offset = ($limit * $page) - $limit;
		return $this->db->results("SELECT * FROM voucher ORDER BY id ASC LIMIT $offset,$limit	");
	}
	
	public function viewall_voucher_page_id_rekanan($id_rekanan,$page = 1, $limit = 5){
		$offset = ($limit * $page) - $limit;
		return $this->db->results("SELECT * FROM voucher WHERE id_rekanan='".$id_rekanan."' ORDER BY id ASC LIMIT $offset,$limit");
	}
	
	public function edit_voucher($data_voucher,$id,$no_voucher){
		return $this->db->update("voucher",$data_voucher,array('id'=>$id,'no_voucher'=>$no_voucher));
	}	
	
	public function no_cetak_akhir(){
		return $this->db->row("SELECT no_cetak FROM voucher ORDER BY id DESC LIMIT 1");
	}
	
	public function cari_voucher($no_voucher){
		return $this->db->results("SELECT * FROM voucher WHERE no_voucher='".$no_voucher."' ORDER BY id DESC");
	}
	
	public function hasil_cari_voucher($no_voucher){
		return $this->db->getVar("SELECT count(id) FROM voucher WHERE no_voucher='".$no_voucher."'");
	}
	
	
	public function cek_voucher($no_voucher){
		return $this->db->row("SELECT no_voucher FROM voucher WHERE no_voucher='".$no_voucher."'");
	}
	
	public function id_rekanan($no_voucher){
		return $this->db->row("SELECT id_rekanan FROM voucher WHERE no_voucher='".$no_voucher."'");
	}
	
	public function potongan($no_voucher){
		return $this->db->row("SELECT potongan FROM voucher WHERE no_voucher='".$no_voucher."'");
	}
	
	public function potongan_by_id($id_voucher){
		return $this->db->row("SELECT potongan FROM voucher WHERE id='".$id_voucher."'");
	}
	
	
	public function id_voucher($no_voucher){
		return $this->db->row("SELECT id FROM voucher WHERE no_voucher='".$no_voucher."'");
	}
	
	public function view_no_voucher($id){
		return $this->db->row("SELECT no_voucher FROM voucher WHERE id='".$id."'");
	}
	
	
	// PENERIMA VOUCHER
	public function viewall_penerima(){
		return $this->db->results("SELECT * FROM penerima_voucher ORDER BY id DESC");
	}
	
	
	public function penerima_voucher_by_user_id_log($user_id_log){
		return $this->db->row("SELECT * FROM penerima_voucher WHERE user_id='".$user_id_log."' AND status='0'");
	}
	
	public function penerima_voucher_by_id_voucher($id_voucher){
		return $this->db->row("SELECT * FROM penerima_voucher WHERE id_voucher='".$id_voucher."' AND status='0'");
	}
	
	public function view_penerima_voucher($page = 1, $limit = 5){
		$offset = ($limit * $page) - $limit;
		return $this->db->results("SELECT * FROM penerima_voucher ORDER BY id DESC LIMIT $offset,$limit	");
	}
	
	public function view_penerima_voucher_list($page = 1, $limit = 5){
		$offset = ($limit * $page) - $limit;
		return $this->db->results("SELECT * FROM penerima_voucher WHERE aktif=1 ORDER BY id DESC LIMIT $offset,$limit	");
	}
	
	//hitung penerima voucher terbaru
	public function penerima_voucher_terbaru(){
		return $this->db->getVar("SELECT count(id) FROM penerima_voucher WHERE tgl_terima > DATE(now()) - INTERVAL 1 WEEK AND aktif=1");
	}
	
	public function penerima_voucher_list_by_id_rekanan($id_rekanan,$page = 1, $limit = 5){
		$offset = ($limit * $page) - $limit;
		return $this->db->results("SELECT * FROM penerima_voucher WHERE id_rekanan='".$id_rekanan."' AND aktif=1 ORDER BY id DESC LIMIT $offset,$limit");
	}
	
	public function view_penerima_voucher_by_id_rekanan($id_rekanan,$page = 1, $limit = 5){
		$offset = ($limit * $page) - $limit;
		return $this->db->results("SELECT * FROM penerima_voucher WHERE id_rekanan='".$id_rekanan."' ORDER BY id DESC LIMIT $offset,$limit");
	}
	
	//hitung penerima voucher terbaru by id_rekanan
	public function penerima_voucher_terbaru_by_id_rekanan($id_rekanan){
		return $this->db->getVar("SELECT count(id) FROM penerima_voucher WHERE tgl_terima > DATE(now()) - INTERVAL 1 WEEK AND id_rekanan='".$id_rekanan."' AND aktif=1");
	}
	
	
	public function view_penerima_voucher_by_id_rekanan_nopage($id_rekanan){
		return $this->db->results("SELECT * FROM penerima_voucher WHERE id_rekanan='".$id_rekanan."' ORDER BY id DESC");
	}
	
	public function hitung_penerima_voucher_by_id_rekanan($id_rekanan){
		return $this->db->getVar("SELECT count(id) FROM penerima_voucher WHERE id_rekanan='".$id_rekanan."'");
	}
	public function hitung_penerima_voucher(){
		return $this->db->getVar("SELECT count(id) FROM penerima_voucher");
	}
	
	public function input_penerima_voucher($data_penerima){
		return $this->db->insert('penerima_voucher',$data_penerima);
	}	
	
	public function cek_penerima_voucher($id){
		return $this->db->row("SELECT * FROM penerima_voucher WHERE id='".$id."'");
	}
	
	public function aktif_voucher($id_voucher){
		return $this->db->getVar("SELECT count(id) FROM penerima_voucher WHERE id_voucher='".$id_voucher."' AND aktif='1'");
	}
	
	public function hitung_penerima_by_id_voucher($id_voucher){
		return $this->db->getVar("SELECT count(id) FROM penerima_voucher WHERE id_voucher='".$id_voucher."'" );
	}
	
	public function id_penerima_voucher($id_voucher){
		return $this->db->row("SELECT id FROM penerima_voucher WHERE id_voucher='".$id_voucher."' AND aktif='0' ORDER by id ASC LIMIT 1");
	}
	
	public function edit_penerima_voucher($data_penerima,$id){
		return $this->db->update("penerima_voucher",$data_penerima,array('id'=>$id));
	}	
	
	public function status_aktif($user_id){
		return $this->db->row("SELECT aktif FROM penerima_voucher WHERE user_id='".$user_id."'");
	}
	
	public function status_guna($user_id){
		return $this->db->row("SELECT status FROM penerima_voucher WHERE user_id='".$user_id."'");
	}
	
	public function cek_cocok_user_id($user_id_log,$id_voucher){
		return $this->db->row("SELECT user_id,id_voucher FROM penerima_voucher WHERE user_id='".$user_id_log."' AND id_voucher='".$id_voucher."'");
	}
	
	public function cek_penerima_user_id($user_id){
		return $this->db->row("SELECT user_id FROM penerima_voucher WHERE user_id='".$user_id."'");
	}
	public function hapus_penerima_by_user_id($user_id){
		return $this->db->delete('penerima_voucher',array('user_id' => $user_id));
	}
	
	public function view_id_rekanan_by_id($id){
		return $this->db->row("SELECT id_rekanan FROM penerima_voucher WHERE id='".$id."'");
	}
	
	public function search_penerima($berdasarkan,$kata_kunci){
		return $this->db->results("SELECT * FROM penerima_voucher WHERE ".$berdasarkan." LIKE '%".$kata_kunci."%' ORDER BY id DESC ");	
	}
	
	public function hitung_search_penerima($berdasarkan,$kata_kunci){
		return $this->db->getVar("SELECT count(id) FROM penerima_voucher WHERE ".$berdasarkan." LIKE '%".$kata_kunci."%'");
	}
	
	public function search_penerima_by_id_rekanan($berdasarkan,$kata_kunci,$id_rekanan){
		return $this->db->results("SELECT * FROM penerima_voucher WHERE ".$berdasarkan." LIKE '%".$kata_kunci."%' AND rekanan='".$id_rekanan."' ORDER BY id DESC ");	
	}
	
	public function hitung_search_penerima_by_id_rekanan($berdasarkan,$kata_kunci,$id_rekanan){
		return $this->db->getVar("SELECT count(id) FROM penerima_voucher WHERE ".$berdasarkan." LIKE '%".$kata_kunci."%' AND rekanan='".$id_rekanan."'");
	}
	
	public function view_penerima_by_nama_rekanan($berdasarkan,$kata_kunci){
		return $this->db->results("SELECT penerima_voucher.*, rekanan.nama_rekanan FROM penerima_voucher,rekanan WHERE penerima_voucher.id_rekanan=rekanan.id_rekanan AND $berdasarkan LIKE '%$kata_kunci%' ORDER BY id DESC");
	}
	
	public function hitung_penerima_by_nama_rekanan($berdasarkan,$kata_kunci){
		return $this->db->getVar("SELECT count(penerima_voucher.id) FROM penerima_voucher,rekanan WHERE penerima_voucher.id_rekanan=rekanan.id_rekanan AND $berdasarkan LIKE '%$kata_kunci%' ORDER BY penerima_voucher.id DESC");
	}
	
	public function view_penerima_by_nama_id_rekanan($berdasarkan,$kata_kunci,$id_rekanan){
		return $this->db->results("SELECT penerima_voucher.*, rekanan.nama_rekanan FROM penerima_voucher,rekanan WHERE penerima_voucher.id_rekanan=rekanan.id_rekanan AND $berdasarkan LIKE '%$kata_kunci%' penerima_voucher.id_rekanan='".$id_rekanan."' ORDER BY id DESC");
	}
	
	public function hitung_penerima_by_nama_id_rekanan($berdasarkan,$kata_kunci,$id_rekanan){
		return $this->db->getVar("SELECT count(penerima_voucher.id) FROM penerima_voucher,rekanan WHERE penerima_voucher.id_rekanan=rekanan.id_rekanan AND $berdasarkan LIKE '%$kata_kunci%' AND penerima_voucher.id_rekanan='".$id_rekanan."' ORDER BY penerima_voucher.id DESC");
	}
	
	public function view_penerima_by_date($dari_tgl,$ke_tgl){
		return $this->db->results("SELECT * FROM penerima_voucher WHERE tgl_terima BETWEEN '".$dari_tgl."' AND '".$ke_tgl."' ORDER BY id DESC");
	}
	public function view_penerima_by_date_id_rekanan($dari_tgl,$ke_tgl,$id_rekanan){
		return $this->db->results("SELECT * FROM penerima_voucher WHERE id_rekanan='".$id_rekanan."' AND tgl_terima BETWEEN '".$dari_tgl."' AND '".$ke_tgl."' ORDER BY id DESC");
	}
}