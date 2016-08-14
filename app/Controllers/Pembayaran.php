<?php
namespace Controllers;
use Resources, Models, Libraries;

class Pembayaran extends Resources\Controller
{
    public function __construct(){
        
        parent::__construct();
		$this->session = new Resources\Session;
		$this->request=new Resources\Request;
		$this->home = new Models\Home;
		$this->produk = new Models\Produk;
		$this->kabar = new Models\Kabar;
		$this->pesan = new Models\Pesan;
		$this->image = new Libraries\Image;		
		$this->readmore = new Libraries\Readmore;
		$this->registrasi = new Models\registrasi;
		$this->randomstring = new Libraries\Randomstring;
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
		$total_pembayaran=$this->pembayaran->hitung_pembayaran_user_id($user_id);
		
		
		$data['viewall_pembayaran_user_id']=$this->pembayaran->viewall_pembayaran_user_id($user_id,$page,$limit);
		$data['total_pembayaran'] = $total_pembayaran;
		$data['pageLinks'] = $this->pagination->setOption(
		array(
		    'limit' => $limit,
		    'base' => $this->uri->baseUri.'index.php/pembayaran/index/%#%/',
			'total' => $total_pembayaran,	
		    'current' => $page,
			)
					)->getUrl(); 
		
		$data['no'] = ($page * $this->pagination->limit) - $this->pagination->limit;
		// end pagination
		
		$data['title'] = 'Pembayaran';
		$data['subtitle']= 'Halaman utama';
		$data["page"]='pembayaran';
		$data['konten']='konten/user';
		$penerima=$this->session->getValue('user_id');
		$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
		$data['menu']='pembayaran';	
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
	
	public function konfirmasi(){
		
		if($_POST){
		$id_register=$this->request->post('id_register');
		$rekening_tujuan=$this->request->post('rekening_tujuan');
		$bank_pengirim=$this->request->post('bank_pengirim');
		$norek_pengirim=$this->request->post('norek_pengirim');
		$pemilik_bank=ucwords($this->request->post('pemilik_bank'));
		$jml_pembayaran=str_replace(",","",$this->request->post('jml_pembayaran'));
		$id_rekanan=$this->registrasi->view_id_rekanan_by_id_register($id_register)->id_rekanan;
		
		$tgl=$this->request->post('tgl_transfer');
		$jml_tgl=strlen($tgl);
		if($jml_tgl < 2){
			$tgl='0'.$tgl;
		}else{
			$tgl=$tgl;
		}
		
		$bln_transfer=$this->request->post('bln_transfer');
		$thn_transfer=$this->request->post('thn_transfer');
		
		$tgl_transfer=$thn_transfer.'-'.$bln_transfer.'-'.$tgl;
		$tgl_konfirm=date("Y-m-d");
		
		//prosesupload
				$this->upload->setOption(
					array(
						'folderLocation' => 'upload',
						'autoRename' => true,
						'autoCreateFolder' => true,
						'permittedFileType' => 'gif|png|jpg|jpeg',
						'maximumSize' => 5000000, //5Mb
					)
				);	
							
				
					if( isset($_FILES['bukti']) ) {										
						$file = $this->upload->now($_FILES['bukti']);
						$nama_foto=$this->upload->getFileInfo();						
						
						if($file) {
							$data_pembayaran=array(
								'id_register'=>$id_register,
								'id_rekanan'=>$id_rekanan,
								'rekening_tujuan'=>$rekening_tujuan,
								'bank_pengirim'=>$bank_pengirim,
								'norek_pengirim'=>$norek_pengirim,
								'pemilik_bank'=>$pemilik_bank,
								'jml_pembayaran'=>$jml_pembayaran,
								'tgl_transfer'=>$tgl_transfer,
								'tgl_konfirm'=>$tgl_konfirm,
								'Keterangan'=>'Pembayaran masih di proses ...',
								'user_id'=>$this->session->getValue('user_id'),							
								'bukti'=>$nama_foto['name'],
							);
							//input pembayaran
							$this->pembayaran->input_pembayaran($data_pembayaran);
								
							$data['alert']='
							<div class="alert alert-success alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-check"></i> Konfirmasi Berhasil</h4>
							Selamat anda berhasil Melakukan Konfirmasi Pembayaran. 
							<p>Tunggu beberapa saat, kami akan melakukan pengecekan pembayaran anda.</p>
							<p>Anda akan berhak mendapatkan Seat jika status pembayaran sudah berhasil kami Verifikasi.</p>
							
							<p>Cek kembali halaman pembayaran untuk melihat status pembayaran!</p>
							
							</div>
							<a href="'.$this->uri->baseUri.'index.php/pembayaran" type="button" class="btn btn-primary btn-lg btn-block">Halaman Pembayaran</a>
							';			
						}else{
						
							$data['alert']='
								<div class="alert alert-danger alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<h4>	<i class="icon fa fa-check"></i> Registrasi gagal</h4>
								'.$this->upload->getError('message').'
								</div>
								';
						//Tidak aeda file					
						}
											
					} //if isset $foto
				//END UPLOAD
				
		$data['title'] = 'Sukses konfirmasi';
		$data['subtitle']= 'Halaman utama';
		$data["page"]='pembayaran';
		$data['konten']='konten/error';
		$data['menu']='pembayaran';
		//wajib
		$data['menu_kategori_umroh']=$this->produk->viewall_produk_umroh();
		$data['menu_kategori_haji']=$this->produk->viewall_produk_haji();			
		$data['kategori_kabar']=$this->kabar->viewall_kategori();
		$data['img_header']=$this->pengaturan->viewall_header_rand();		
		$data['list_partner']=$this->pengaturan->viewall_partner();
		//end wajib
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
