<?php
namespace Controllers;
use Resources, Models, Libraries;

class Registrasi extends Resources\Controller
{
    public function __construct(){
        
        parent::__construct();
		$this->session = new Resources\Session;
		$this->request=new Resources\Request;
		$this->home = new Models\Home;
		$this->produk = new Models\Produk;
		$this->kabar = new Models\Kabar;
		$this->pesan = new Models\Pesan;
		$this->rekanan = new Models\Rekanan;
		$this->image = new Libraries\Image;		
		$this->readmore = new Libraries\Readmore;
		$this->registrasi = new Models\Registrasi;
		$this->randomstring = new Libraries\Randomstring;
		$this->voucher = new Models\Voucher;
		$this->pengaturan = new Models\Pengaturan;
		$this->pembayaran = new Models\Pembayaran;
		$this->upload = new Resources\Upload; 
    }
	
	public function index($page=1)
    {
		if($this->session->getValue('username')){
		$user_id=$this->session->getValue('user_id');
		
		//pagination
		$this->pagination = new Resources\Pagination();
        $page = (int) $page;
        $limit = 10;
		$total_registrasi=$this->registrasi->hitung_registrasi_user_id($user_id);
		
		
		$data['viewall_registrasi_user_id']=$this->registrasi->viewall_registrasi_user_id($user_id,$page,$limit);
		$data['total_registrasi'] = $total_registrasi;
		$data['pageLinks'] = $this->pagination->setOption(
		array(
		    'limit' => $limit,
		    'base' => $this->uri->baseUri.'index.php/registrasi/index/%#%/',
			'total' => $total_registrasi,	
		    'current' => $page,
			)
					)->getUrl(); 
		
		$data['no'] = ($page * $this->pagination->limit) - $this->pagination->limit;
		// end pagination
		
		$data['title'] = 'List Registrasi';
		$data['subtitle']= 'Halaman utama';
		$data["page"]='registrasi';
		$data['konten']='konten/user';
		$penerima=$this->session->getValue('user_id');
		$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
		$data['menu']='registrasi';
		//wajib		
		$data['menu_kategori_umroh']=$this->produk->viewall_produk_umroh();
		$data['menu_kategori_haji']=$this->produk->viewall_produk_haji();			
		$data['kategori_kabar']=$this->kabar->viewall_kategori();
		$data['img_header']=$this->pengaturan->viewall_header_rand();
		$data['list_partner']=$this->pengaturan->viewall_partner();
		//end wajib
		
		$data['rekening_tujuan']=$this->pengaturan->viewall_rekening();
		$data['viewall_bank']=$this->pengaturan->viewall_bank();

        $this->output(TEMPLATE.'index', $data);
		}else{
			//belum login
			$this->session->destroy();
			$data['alert']='
				<div class="alert alert-warning alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4><i class="icon fa fa-check"></i> Error, Anda harus login terlebih dahulu ! </h4>
				</div>
				';
			$data['title'] = 'Error Page';						
			$data['title_page']='';
			$data['page']='login';		
			
			$this->output(TEMPLATE.'login', $data);
		}
    }
	
	public function registrasi(){
		if($_POST){
		$jml_registrasi=$this->registrasi->hitung_registrasi()+1;
		$id_register=date("Ymd").'-'.$jml_registrasi.'-'.$this->randomstring->randomstring(4);		
		$id_register=$id_register;
		$id_penerima=$this->request->post('id_penerima');
		$nama_jamaah=ucwords($this->request->post('nama_jamaah',FILTER_SANITIZE_MAGIC_QUOTES));
		$alamat=$this->request->post('alamat');
		$tlp_jamaah=$this->request->post('tlp_jamaah',FILTER_SANITIZE_MAGIC_QUOTES);
		$potongan=$this->request->post('potongan');
		$id_produk=$this->request->post('id_produk');
		$harga_produk=$this->request->post('harga_produk');
		$biaya=$this->request->post('biaya');
		$pembayaran=str_replace(",","",$this->request->post('pembayaran'));
		$user_id=$this->session->getValue('user_id');
		$tgl_register=date("Y-m-d");
		$id_rekanan=$this->voucher->view_id_rekanan_by_id($id_penerima)->id_rekanan;
		
		$data_registrasi=array(
			'id_register'=>$id_register,
			'id_penerima'=>$id_penerima,
			'nama_jamaah'=>$nama_jamaah,
			'alamat'=>$alamat,
			'tlp_jamaah'=>$tlp_jamaah,
			'potongan'=>$potongan,
			'id_produk'=>$id_produk,
			'harga_produk'=>$harga_produk,
			'biaya'=>$biaya,
			'pembayaran'=>$pembayaran,
			'user_id'=>$user_id,
			'tgl_register'=>$tgl_register,
			'id_rekanan'=>$id_rekanan,
		);
		
			$this->registrasi->input_registrasi($data_registrasi);
		
		if($id_penerima==''){
			
		}else{
			$data_penerima=array(
				'status'=>'1',
			);
			
			$this->voucher->edit_penerima_voucher($data_penerima,$id_penerima);
		}
		
		
		$data['title'] = 'Registrasi';
		$data['subtitle']= 'Halaman utama';
		$data["page"]='registrasi';
		$data['konten']='konten/error';
		//wajib
		$data['menu_kategori_umroh']=$this->produk->viewall_produk_umroh();
		$data['menu_kategori_haji']=$this->produk->viewall_produk_haji();			
		$data['kategori_kabar']=$this->kabar->viewall_kategori();
		$data['img_header']=$this->pengaturan->viewall_header_rand();
		$data['list_partner']=$this->pengaturan->viewall_partner();
		//end wajib
		$data['menu']='home';
		
		$data['alert']='
			<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4><i class="icon fa fa-check"></i> Registrasi Berhasil</h4>
			Selamat anda berhasil registrasi Umroh.
			<p>Untuk mempermudah proses regsitrasi ulang, harap catat ID Register anda: '.$id_register.'</p>
			<p>Silahkan lakukan pembayaran sesuai nominal sebesar Rp. '.number_format($pembayaran,0,'','.').' pada rekening Bank kami dibawah ini.</p>
			<p>Silahkan lakukan konfirmasikan pembayaran anda.</p>			
			</div>
			<a href="'.$this->uri->baseUri.'index.php/registrasi/" type="button" class="btn btn-primary btn-lg btn-block">Konfirmasi Pembayaran</a>
			';
		
		$this->output(TEMPLATE.'index', $data);
		}else{
			$data['title'] = 'Error ...';
			$data['subtitle']= 'error';
			$data["page"]='error';
			$data['konten']='konten/error';
			$data['menu']='error';
			//wajib
			$data['menu_kategori_umroh']=$this->produk->viewall_produk_umroh();
			$data['menu_kategori_haji']=$this->produk->viewall_produk_haji();			
			$data['kategori_kabar']=$this->kabar->viewall_kategori();
			$data['img_header']=$this->pengaturan->viewall_header_rand();
			$data['list_partner']=$this->pengaturan->viewall_partner();		
			// END wajib
			
			$data['alert']='
				<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4><i class="icon fa fa-check"></i> Error ...!</h4>
				Halaman yang anda tuju salah.		
				</div>
				<a href="'.$this->uri->baseUri.'" type="button" class="btn btn-primary btn-lg btn-block">Back to Home</a>
				';
			
			$this->output(TEMPLATE.'index', $data);
		}
	}
}
