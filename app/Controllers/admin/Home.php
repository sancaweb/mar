<?php
namespace Controllers\admin;
use Resources, Libraries, Models;

class Home extends Resources\Controller
{
    public function __construct(){
        
        parent::__construct();
		$this->session = new Resources\Session;
		$this->user = new Models\User;
		$this->kabar = new Models\Kabar;
		$this->pesan = new Models\Pesan;
		$this->registrasi = new Models\Registrasi;
		$this->pembayaran = new Models\Pembayaran;
		$this->produk = new Models\Produk;
		$this->voucher = new Models\Voucher;
		$this->image = new Libraries\Image;
		$this->readmore = new Libraries\Readmore;
		
		//$this->home = new Models\Home;
    }
	
	public function index()
    {
		if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2 || $this->session->getValue('user_level')==3){
        $data['title'] = 'Admin Dashboard';
		$data['subtitle']= 'Halaman utama';
		$data['konten']='admin/konten/home';
		$data['page']='home';
		$penerima=$this->session->getValue('user_id');
		$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
		$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
		$data['menu']='home';
		//list user
		$data['user_list']=$this->user->viewall_page($page = 1, $limit = 9);	
		$data['user_terbaru']=$this->user->hitung_user_terbaru();
		//kabar		
		$data['kabar_list']=$this->kabar->viewall_kabar_page($page = 1, $limit = 4);
		$data['kabar_terbaru']=$this->kabar->kabar_terbaru();
		//produk		
		$data['produk_list']=$this->produk->viewall_produk_page($page = 1, $limit = 4);
		$data['produk_terbaru']=$this->produk->produk_terbaru();
		
		//penerima voucher
		if($this->session->getValue('user_level')==3){
			$user_id=$this->session->getValue('user_id');
			$id_rekanan=$this->rekanan->view_id_rekanan($user_id)->id_rekanan;
			$data['penerima_voucher_list']=$this->voucher->penerima_voucher_list_by_id_rekanan($id_rekanan,$page = 1, $limit = 5);
			$data['penerima_voucher']=$this->voucher->penerima_voucher_terbaru_by_id_rekanan($id_rekanan);
		}else{
			$data['penerima_voucher_list']=$this->voucher->view_penerima_voucher_list($page = 1, $limit = 5);
			$data['penerima_voucher']=$this->voucher->penerima_voucher_terbaru();
		}
		
		//registrasi terbaru
		$data['registrasi_list']=$this->registrasi->viewall_registrasi($page = 1, $limit = 5);
		$data['registrasi_terbaru']=$this->registrasi->hitung_registrasi_by_date();
		
		//pembayaran		
		$data['pembayaran_list']=$this->pembayaran->viewall_pembayaran($page = 1, $limit = 5);
		$data['pembayaran_terbaru']=$this->pembayaran->hitung_pembayaran_by_date();
		

        $this->output('admin/index', $data);
		}else{
			$this->redirect('login');
		}
    }
	
	
}
