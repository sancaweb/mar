<?php
namespace Controllers;
use Resources, Models, Libraries;

class Produk extends Resources\Controller
{
    public function __construct(){
        
        parent::__construct();
		$this->session = new Resources\Session;
		$this->request=new Resources\Request;
		$this->home = new Models\Home;
		$this->produk = new Models\Produk;
		$this->kabar = new Models\Kabar;
		$this->voucher = new Models\Voucher;
		$this->pengaturan = new Models\Pengaturan;
		$this->image = new Libraries\Image;		
		$this->readmore = new Libraries\Readmore;
    }
	
	public function index($id='')
    {
		
			$data['title'] = 'Error Produk';
			$data['subtitle']= 'Halaman utama';
			$data["page"]='produk';
			$data['konten']='konten/error';
			$data['menu']='home';
			
			//wajib
			$data['menu_kategori_umroh']=$this->produk->viewall_produk_umroh();
			$data['menu_kategori_haji']=$this->produk->viewall_produk_haji();			
			$data['kategori_kabar']=$this->kabar->viewall_kategori();
			$data['img_header']=$this->pengaturan->viewall_header_rand();		
			$data['list_partner']=$this->pengaturan->viewall_partner();
			//end wajib
			
			$data['alert']='
			<div class="alert alert-warning alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4><i class="icon fa fa-check"></i> Produk tidak ditemukan</h4>
			<p>Maaf, produk yang anda tuju tidak ada. </p>
			</div>
			';

        $this->output(TEMPLATE.'index', $data);
    }
	
	public function view($id=1){
		$id_produk=$id;
		
		$view_produk=$this->produk->viewall_produk_by_id($id_produk);
		
		if($view_produk){
			$kategori_produk=$view_produk->kategori;
			$nama_kategori=$this->produk->nama_kategori($kategori_produk)->nama;
			$page=1;
			$limit=3;
			$all_produk=$this->produk->viewall_produk_page($page, $limit);
			
			$data['title'] = $view_produk->nama_produk;
			$data['subtitle']= 'Halaman utama';
			$data["page"]='produk';
			$data['konten']='konten/single_produk';
			$data['menu']=$nama_kategori;
			//wajib
			$data['menu_kategori_umroh']=$this->produk->viewall_produk_umroh();
			$data['menu_kategori_haji']=$this->produk->viewall_produk_haji();			
			$data['kategori_kabar']=$this->kabar->viewall_kategori();
			$data['img_header']=$this->pengaturan->viewall_header_rand();		
			$data['list_partner']=$this->pengaturan->viewall_partner();
			//end wajib
			$data['view_produk']=$view_produk;
			$data['all_produk']=$all_produk;
			
			if($this->session->getValue("username")){
				$data['log']='yes';
				$user_id=$this->session->getValue("user_id");
				$data_penerima_voucher=$this->voucher->penerima_voucher_by_user_id_log($user_id);
				$cek_penerima_user_id=$this->voucher->cek_penerima_user_id($user_id);
				if($cek_penerima_user_id){
					
						$status_aktif=$this->voucher->status_aktif($user_id)->aktif;
						$status_guna=$this->voucher->status_guna($user_id)->status;
						
					if($status_aktif=='1' AND $status_guna=='0'){
						
						$data['data_penerima_voucher']=$data_penerima_voucher;
						$data['alert']='
						<div class="alert alert-info alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-check"></i> Anda Memiliki voucher yang bisa digunakan</h4>
						<p>Selamat, anda memiliki voucher yang bisa digunakan.</p>
						<p>Anda akan otomatis memiliki potongan dalam pembayaran sesuai voucher anda.</p>
						</div>
						';
					}else{
						$data['alert']='
						<div class="alert alert-warning alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-check"></i> Anda Tidak Memiliki voucher yang bisa digunakan</h4>
						<p>Anda tidak memiliki voucher yang bisa digunakan.</p>
						<p>Anda tidak memiliki pemotongan harga dalam registrasi umroh kali ini.</p>
						</div>';
					}
				}else{
					$data['alert']='
						<div class="alert alert-warning alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-check"></i> Anda Tidak Memiliki voucher yang bisa digunakan</h4>
						<p>Anda tidak memiliki voucher yang bisa digunakan.</p>
						<p>Anda tidak memiliki pemotongan harga dalam registrasi umroh kali ini.</p>
						</div>';
				}
				
				
				///
				
			}else{
				$data['log']='no';
			}
			
			
		}else{
			$data['title'] = 'Error Produk';
			$data['subtitle']= 'Halaman utama';
			$data["page"]='produk';
			$data['konten']='konten/error';
			$data['menu']='home';	
			//wajib
			$data['menu_kategori_umroh']=$this->produk->viewall_produk_umroh();
			$data['menu_kategori_haji']=$this->produk->viewall_produk_haji();
			$data['img_header']=$this->pengaturan->viewall_header_rand();			
			$data['kategori_kabar']=$this->kabar->viewall_kategori();		
			$data['list_partner']=$this->pengaturan->viewall_partner();
			//end wajib
			$data['alert']='
			<div class="alert alert-warning alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4><i class="icon fa fa-check"></i> Produk tidak ditemukan</h4>
			<p>Maaf, produk yang anda tuju tidak ada. </p>
			</div>
			';
			
		}
        $this->output(TEMPLATE.'index', $data);
	}
}
