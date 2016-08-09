<?php
namespace Controllers;
use Resources, Models, Libraries;

class Home extends Resources\Controller
{
    public function __construct(){
        
        parent::__construct();
		$this->session = new Resources\Session;
		$this->home = new Models\Home;
		$this->produk = new Models\Produk;
		$this->kabar = new Models\Kabar;
		$this->user = new Models\User;
		$this->image = new Libraries\Image;		
		$this->readmore = new Libraries\Readmore;
		$this->voucher = new Models\Voucher;
		$this->pengaturan = new Models\Pengaturan;
    }
	
	public function index()
    {
        $data['title'] = 'Home';
		$data['subtitle']= 'Halaman utama';
		$data["page"]='home';
		$data['konten']='konten/home';
		$data['menu']='home';
		$data['menu_kategori_umroh']=$this->produk->viewall_produk_umroh();
		$data['menu_kategori_haji']=$this->produk->viewall_produk_haji();			
		$data['kategori_kabar']=$this->kabar->viewall_kategori();
		$data['produk']=$this->produk->viewall_produk();
		$data['slider']=$this->pengaturan->viewall_slide();
		$data['list_partner']=$this->pengaturan->viewall_partner();
		
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
		

        $this->output(TEMPLATE.'index', $data);
    }
}
