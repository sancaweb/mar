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
		$kepada=$this->session->getValue('user_id');
		$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_kepada($kepada);
		$data['loader_pesan']=$this->pesan->viewall_pesan_by_kepada($kepada);
		$data['menu']='home';
		$date=date("Y-m-d");
		//list user
		$data['user_list']=$this->user->viewall_page($page = 1, $limit = 9);	
		$data['user_terbaru']=$this->user->user_terbaru($date);
		//kabar		
		$data['kabar_list']=$this->kabar->viewall_kabar_page($page = 1, $limit = 4);
		$data['kabar_terbaru']=$this->kabar->kabar_terbaru($date);
		//produk		
		$data['produk_list']=$this->produk->viewall_produk_page($page = 1, $limit = 4);
		$data['produk_terbaru']=$this->produk->produk_terbaru($date);
		//registrasi		
		$data['registrasi_list']=$this->registrasi->viewall_registrasi($page = 1, $limit = 5);
		$data['registrasi_terbaru']=$this->registrasi->hitung_registrasi_by_date($date);
		
		//pembayaran		
		$data['pembayaran_list']=$this->pembayaran->viewall_pembayaran($page = 1, $limit = 5);
		$data['pembayaran_terbaru']=$this->pembayaran->hitung_pembayaran_by_date($date);
		

        $this->output('admin/index', $data);
		}else{
			$this->redirect('login');
		}
    }
}
