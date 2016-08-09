<?php
namespace Controllers;
use Resources, Libraries, Models;

class Klaim_voucher extends Resources\Controller
{
    public function __construct(){
        
        parent::__construct();
		$this->session = new Resources\Session;
		$this->request=new Resources\Request;
		$this->voucher=new Models\Voucher;
		$this->rekanan=new Models\Rekanan;
		$this->user=new Models\User;
		$this->produk=new Models\Produk;
		$this->pengaturan=new Models\Pengaturan;
		$this->kabar=new Models\Kabar;
		
		$this->image = new Libraries\Image;
		$this->readmore = new Libraries\Readmore;
		$this->randomstring = new Libraries\Randomstring;
    }
	
	public function index()
    {
		$data['title'] = 'Klaim Voucher';
		$data['konten']='konten/klaim_voucher';
		$data['menu']='klaim_voucher';
		//wajib
		$data['menu_kategori_umroh']=$this->produk->viewall_produk_umroh();
		$data['menu_kategori_haji']=$this->produk->viewall_produk_haji();			
		$data['kategori_kabar']=$this->kabar->viewall_kategori();
		$data['img_header']=$this->pengaturan->viewall_header_rand();		
		$data['list_partner']=$this->pengaturan->viewall_partner();
		//end wajib
		$data['page']='klaim_voucher';
		
		$this->output(TEMPLATE.'index',$data);
    }
	
	public function cek_voucher(){
		$no_voucher=trim($this->request->post('no_voucher'));
		$cek_voucher=$this->voucher->cek_voucher($no_voucher);
		
		//$cek_penerima_voucher=$this->voucher->cek_penerima_voucher($no_voucher);
		
		
		if($cek_voucher==''){
			
			//voucher tidak ada
			$data['alert']='
			<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4><i class="icon fa fa-check"></i> Voucher tidak ditemukan ...</h4>
			Maaf, voucher yang anda masukan tidak cocok. Pastikan anda memasukan nomer voucher dengan benar.
			Silahkan masukan kembali No Voucher anda di bawah ini..!
			</div>
			';
			$data['page']='error_klaim';
			$data['konten']='konten/klaim_voucher';
		}else{
			//voucher ada
			
			$id_rekanan=$this->voucher->id_rekanan($no_voucher)->id_rekanan;
			$nama_rekanan=$this->rekanan->view_nama_rekanan_by_id($id_rekanan);
			$data['alert']='
			<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4><i class="icon fa fa-check"></i> Voucher ditemukan ...</h4>
			Selamat, Voucher yang anda masukan benar.
			<p>Apakah anda ingin kalim voucher ini ..? </p>
			<p>Klik "Klaim" jika ingin klaim voucher, klik "Batal" jika ingin membatalkan klaim voucher.</p>
			</div>
			<a href="'.$this->uri->baseUri.'index.php/klaim_voucher/klaim/'.base64_encode($no_voucher).'" type="button" class="btn btn-primary btn-lg btn-block">Klaim Voucher</a>
			<a href="'.$this->uri->baseUri.'index.php/klaim_voucher" type="button" class="btn btn-primary btn-lg btn-danger btn-block">Batal</a>
			';
			$data['page']='sukses_klaim';
			$data['konten']='konten/klaim_voucher';
				
		}
		
		$data['title'] = 'Cek Voucher';
		$data['menu']='klaim_voucher';
		//wajib
		$data['menu_kategori_umroh']=$this->produk->viewall_produk_umroh();
		$data['menu_kategori_haji']=$this->produk->viewall_produk_haji();			
		$data['kategori_kabar']=$this->kabar->viewall_kategori();
		$data['img_header']=$this->pengaturan->viewall_header_rand();		
		$data['list_partner']=$this->pengaturan->viewall_partner();
		//end wajib
		$this->output(TEMPLATE.'index',$data);
	}
	
	public function klaim($no_voucher=''){
		$no_voucher=base64_decode($no_voucher);	
		$cek_voucher=$this->voucher->cek_voucher($no_voucher);
		$username=$this->session->getValue('username');
		if($cek_voucher){
			$no_voucher=$no_voucher;
			$id_rekanan=$this->voucher->id_rekanan($no_voucher);
			if($id_rekanan){
				//id rekanan ada
				$id_rekanan=$id_rekanan->id_rekanan;
				$jenis_rekanan=$this->rekanan->jenis_rekanan($id_rekanan)->jenis;
				
				if($jenis_rekanan=='rekanan'){
					//jenis rekanan
					if($username){
						//sudah login
						$id_voucher=$this->voucher->id_voucher($no_voucher)->id;						
						$user_id_log=$this->user->ambil_userid($username)->id;
						$cek_cocok_user_id=$this->voucher->cek_cocok_user_id($user_id_log,$id_voucher);
						$id_rekanan=$this->voucher->id_rekanan($no_voucher)->id_rekanan;
						$nama_rekanan=$this->rekanan->view_nama_rekanan_by_id($id_rekanan)->nama_rekanan;
						
						if($cek_cocok_user_id){
							//user sesuai
							$status_aktif=$this->voucher->status_aktif($user_id_log)->aktif;
							
							if($status_aktif=='1'){
								//voucher activated
								$potongan=$this->voucher->potongan($no_voucher);	
						
								$id_rekanan=$this->voucher->id_rekanan($no_voucher);
								$nama_rekanan=$this->rekanan->view_nama_rekanan_by_id($id_rekanan->id_rekanan);
								$user_id_log=$this->user->ambil_userid($username)->id;
								
								$data['alert']='
									<div class="alert alert-success alert-dismissable">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<h4><i class="icon fa fa-check"></i> Selamat, Voucher Berhasil di klaim ..!</h4>
									Selamat, Voucher dengan potongan sebesar Rp. '.number_format($potongan->potongan,0,'','.').' akan segera masuk ke akun anda setelah anda melengkapi data penerima voucher dibawah ini untuk keperluan verifikasi.				
									</div>
									';
									
									$data['user_id']=$user_id_log;
									$data['id_rekanan'] = $this->voucher->id_rekanan($no_voucher);
									$data['potongan'] = $potongan;
									$data['page']='form_penerima_voucher';
									$data['title'] = 'Form penerima Voucher';
									$data['menu']='klaim_voucher';
									$data['nama_rekanan']=$nama_rekanan;
									$data['no_voucher']=$no_voucher;
									$data['data_penerima_voucher']=$this->voucher->penerima_voucher_by_user_id_log($user_id_log);
									$data['konten']='form/form_penerima';
									
									//wajib
									$data['menu_kategori_umroh']=$this->produk->viewall_produk_umroh();
									$data['menu_kategori_haji']=$this->produk->viewall_produk_haji();			
									$data['kategori_kabar']=$this->kabar->viewall_kategori();
									$data['img_header']=$this->pengaturan->viewall_header_rand();		
									$data['list_partner']=$this->pengaturan->viewall_partner();
									//end wajib
								$this->output(TEMPLATE.'index',$data);
								
								
							}else{
								//not activated
								$data['alert']='
								<div class="alert alert-warning alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<h4><i class="icon fa fa-check"></i> Error Aktifasi</h4>
								<p>Maaf, voucher anda belum di aktifasi. </p>
								<p>Silahkan hubungi '.$nama_rekanan.', tempat anda mendapatkan Voucher.</p>
								</div>
								';
								
								$data['page']='Error Page';
								$data['title'] = 'Error Page';
								$data['menu']='klaim_voucher';													
								$data['konten']='konten/error';
								
								//wajib
								$data['menu_kategori_umroh']=$this->produk->viewall_produk_umroh();
								$data['menu_kategori_haji']=$this->produk->viewall_produk_haji();			
								$data['kategori_kabar']=$this->kabar->viewall_kategori();
								$data['img_header']=$this->pengaturan->viewall_header_rand();		
								$data['list_partner']=$this->pengaturan->viewall_partner();							
								//end wajib
								
								$this->output(TEMPLATE.'index',$data);
							
							}
							
							
							
						}else{
							//user tidak sesuai
							$this->session->destroy();
							$data['alert']='
							<div class="alert alert-warning alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-check"></i> Error, User tidak sesuai </h4>
							
							<p>Maaf, user yang saat ini login tidak sesuai dengan user yang berhak mendapatkan voucher ini: '.$no_voucher.'<p>
							<p>Silahkan masukkan Username dan Password yang terdapat pada voucher anda...!<p>
							<p>Atau bisa anda dapatkan di tempat anda mendapatkan voucher.<p>
							</div>
							';
						$data['no_voucher']=$no_voucher;
						$data['title'] = 'Error Page';						
						$data['title_page']='';
						$data['page']='login';		

						$this->output(TEMPLATE.'login', $data);
							
						}
						
						
					}else{
						//belum login
						$this->session->destroy();
						$data['alert']='
							<div class="alert alert-warning alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-check"></i> Error, Anda harus login terlebih dahulu ! </h4>
							
							<p>Silahkan masukkan Username dan Password yang bisa anda dapatkan di tempat anda mendapatkan voucher.<p>
							</div>
							';
						$data['no_voucher']=$no_voucher;
						$data['title'] = 'Error Page';						
						$data['title_page']='';
						$data['page']='login';		
						
						$this->output(TEMPLATE.'login', $data);
					}
					
				}else{
					//voucher jenis umum						
						
					if($username){
						$id_voucher=$this->voucher->id_voucher($no_voucher)->id;						
						$user_id_log=$this->user->ambil_userid($username)->id;
						$cek_cocok_user_id=$this->voucher->cek_cocok_user_id($user_id_log,$id_voucher);
						$id_rekanan=$this->voucher->id_rekanan($no_voucher)->id_rekanan;
						$nama_rekanan=$this->rekanan->view_nama_rekanan_by_id($id_rekanan)->nama_rekanan;
						$penerima_voucher_by_user_id_log=$this->voucher->penerima_voucher_by_user_id_log($user_id_log);
					//sudah login umum
						//cek user id di penerima voucher ada atau tidak (pernah dapat voucher tidak)
						if($penerima_voucher_by_user_id_log){
							//user_id pernah dapat voucher
							$status_guna=$this->voucher->status_guna($user_id_log)->status;
							if($status_guna =='1'){
								//sudah digunakan vouchernya
								$potongan=$this->voucher->potongan($no_voucher);
							
								$id_rekanan=$this->voucher->id_rekanan($no_voucher);
								$nama_rekanan=$this->rekanan->view_nama_rekanan_by_id($id_rekanan->id_rekanan);
								$user_id_log=$this->user->ambil_userid($username)->id;
								
								$data['alert']='
									<div class="alert alert-success alert-dismissable">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<h4><i class="icon fa fa-check"></i> Selamat, Voucher Berhasil di klaim ..!</h4>
									Selamat, Voucher dengan potongan sebesar Rp. '.number_format($potongan->potongan,0,'','.').' akan segera masuk ke akun anda setelah anda melengkapi data penerima voucher dibawah ini untuk keperluan verifikasi.				
									</div>
									';
								
								$data['user_id']=$user_id_log;
								$data['id_rekanan'] = $id_rekanan;
								$data['potongan'] = $potongan;
								$data['page']='form_penerima_voucher';
								$data['title'] = 'Form penerima Voucher';
								$data['menu']='klaim_voucher';
								
								
								//wajib
								$data['menu_kategori_umroh']=$this->produk->viewall_produk_umroh();
								$data['menu_kategori_haji']=$this->produk->viewall_produk_haji();			
								$data['kategori_kabar']=$this->kabar->viewall_kategori();
								$data['img_header']=$this->pengaturan->viewall_header_rand();		
								$data['list_partner']=$this->pengaturan->viewall_partner();							
								//end wajib
								
								$data['nama_rekanan']=$nama_rekanan;
								$data['no_voucher']=$no_voucher;
								$data['data_penerima_voucher']=$this->voucher->penerima_voucher_by_user_id_log($user_id_log);
								$data['konten']='form/form_penerima';
								
								$this->output(TEMPLATE.'index',$data);
								
							}else{
								//belum digunakan vouchernya
								
								$data['alert']='
									<div class="alert alert-warning alert-dismissable">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<h4><i class="icon fa fa-check"></i> Error Voucher Ganda</h4>
									<h5>Maaf, Akun yang sedang login ini masih memiliki Voucher yang belum digunakan. </h5>
									<ol>
										<li>Jika ini adalah akun anda, maka silahkan gunakan voucher diskon anda terlebih dahulu
										Untuk mendapatkan potongan saat mendaftarkan sebagai jamaah umroh ...!</li>
										<li>Namun jika ini bukan akun anda, silahkan logout terlebih dahulu.</li>
										<li>Lalu login atau registrasi dengan akun lain</li>
										
									</ol>
									</div>
									';
								
								$data['page']='Error Page';
								$data['title'] = 'Error Page';
								$data['menu']='klaim_voucher';
								//wajib
								$data['menu_kategori_umroh']=$this->produk->viewall_produk_umroh();
								$data['menu_kategori_haji']=$this->produk->viewall_produk_haji();			
								$data['kategori_kabar']=$this->kabar->viewall_kategori();
								$data['img_header']=$this->pengaturan->viewall_header_rand();		
								$data['list_partner']=$this->pengaturan->viewall_partner();							
								//end wajib
													
								$data['konten']='konten/error';
								
								$this->output(TEMPLATE.'index',$data);
							}
							
						}else{
							//user_id tidak pernah dapat voucher
							$potongan=$this->voucher->potongan($no_voucher);
							
							$id_rekanan=$this->voucher->id_rekanan($no_voucher);
							$nama_rekanan=$this->rekanan->view_nama_rekanan_by_id($id_rekanan->id_rekanan);
							$user_id_log=$this->user->ambil_userid($username)->id;
							
							$data['alert']='
								<div class="alert alert-success alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<h4><i class="icon fa fa-check"></i> Selamat, Voucher Berhasil di klaim ..!</h4>
								Selamat, Voucher dengan potongan sebesar Rp. '.number_format($potongan->potongan,0,'','.').' akan segera masuk ke akun anda setelah anda melengkapi data penerima voucher dibawah ini untuk keperluan verifikasi.				
								</div>
								';
							
							$data['user_id']=$user_id_log;
							$data['id_rekanan'] = $id_rekanan;
							$data['potongan'] = $potongan;
							$data['page']='form_penerima_voucher';
							$data['title'] = 'Form penerima Voucher';
							$data['menu']='klaim_voucher';
							$data['nama_rekanan']=$nama_rekanan;
							$data['no_voucher']=$no_voucher;
							$data['data_penerima_voucher']=$this->voucher->penerima_voucher_by_user_id_log($user_id_log);
							$data['konten']='form/form_penerima';
							//wajib
							$data['menu_kategori_umroh']=$this->produk->viewall_produk_umroh();
							$data['menu_kategori_haji']=$this->produk->viewall_produk_haji();			
							$data['kategori_kabar']=$this->kabar->viewall_kategori();
							$data['img_header']=$this->pengaturan->viewall_header_rand();			
							$data['list_partner']=$this->pengaturan->viewall_partner();						
							//end wajib
							
							$this->output(TEMPLATE.'index',$data);
							
						}
					
					
					
					}else{
						//belum login umum
						$this->session->destroy();						
						
						$data['alert']='
						<div class="alert alert-warning alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-check"></i> Error, Anda harus login terlebih dahulu ! </h4>
						<ol>
						<li>Silahkan klik tombol login dibawah ini jika anda sudah memiliki username dan password.</li>
						<li>Jika anda belum memiliki Akun di website kami, silahkan klik tombol registrasi akun dengan klik tombol "Register akun" dibawah ini.</li>
						<li>Lalu silahkan masukan kembali no_voucher anda.</li>
						</ol>
						<p></p>
						<p><a href="'.$this->uri->baseUri.'index.php/login/index/'.base64_encode($no_voucher).'" type="button" class="btn btn-primary btn-lg btn-block">Login</a>
						<a href="'.$this->uri->baseUri.'index.php/login/register/'.base64_encode($no_voucher).'" type="button" class="btn btn-primary btn-lg btn-block">Register Akun</a>
						
						</p>
						</div>
						';
					$data['page']='Error Page';
					$data['title'] = 'Error Page';
					$data['menu']='klaim_voucher';
					//wajib
					$data['menu_kategori_umroh']=$this->produk->viewall_produk_umroh();
					$data['menu_kategori_haji']=$this->produk->viewall_produk_haji();			
					$data['kategori_kabar']=$this->kabar->viewall_kategori();
					$data['img_header']=$this->pengaturan->viewall_header_rand();		
					$data['list_partner']=$this->pengaturan->viewall_partner();							
					//end wajib
					$data['konten']='konten/error';
					$this->output(TEMPLATE.'index',$data);
						
					}
				}
				
			}else{
				//id rekanan gak ada
				$data['alert']='
				<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4><i class="icon fa fa-check"></i> Voucher tidak ditemukan ...</h4>
				Maaf, voucher yang anda masukan tidak cocok. Pastikan anda memasukan nomer voucher dengan benar.
				Silahkan masukan kembali No Voucher anda di bawah ini..!
				</div>
				';
				$data['page']='error_klaim';
				$data['konten']='konten/klaim_voucher';
				$this->output(TEMPLATE.'index',$data);
			}
		}else{
			
			$data['alert']='
			<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4><i class="icon fa fa-check"></i> Voucher tidak ditemukan ...</h4>
			Maaf, voucher yang anda masukan tidak cocok. Pastikan anda memasukan nomer voucher dengan benar.
			Silahkan masukan kembali No Voucher anda di bawah ini..!
			</div>
			';
			$data['page']='error_klaim';
			$data['konten']='konten/klaim_voucher';
			$this->output(TEMPLATE.'index',$data);
		}
		
		
		//$this->output(TEMPLATE.'index',$data);
	}
	
	public function input_penerima(){
		if($_POST){
			$nama_penerima=ucwords($this->request->post('nama_penerima'));
			$no_tlp=$this->request->post('no_tlp');
			$user_id=$this->request->post('user_id');
			$id_rekanan=$this->request->post('id_rekanan');
			$no_voucher=$this->request->post('no_voucher');
			$alamat=$this->request->post('alamat');
			$email=$this->request->post('email');
			$id_voucher=$this->voucher->id_voucher($no_voucher)->id;
			$tgl_terima=date("Y-m-d");
			
			$data_penerima=array(
				'user_id'=>$user_id,
				'id_rekanan'=>$id_rekanan,
				'id_voucher'=>$id_voucher,
				'nama_penerima'=>$nama_penerima,
				'no_tlp'=>$no_tlp,
				'email'=>$email,
				'alamat'=>$alamat,
				'aktif'=>'1',
				'tgl_terima'=>$tgl_terima,
				'editor'=>$this->session->getValue('username'),
				'change_date'=>date("Y-m-d"),
			);
	
		$this->voucher->input_penerima_voucher($data_penerima);
				
		$data['alert']='
				<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4><i class="icon fa fa-check"></i> Success ...!! </h4>
				<p>Selamat, anda telah berhasil Klaim Voucher ke Akun anda. Klik tombol dibawah ini untuk memilih produk Kami ...!</p>
				<p><a href="'.$this->uri->baseUri.'" type="button" class="btn btn-primary btn-lg btn-block">Pilih Produk</a></p>
				
				</p>
				</div>
				';
		$data['page']='Success Page';
		$data['title'] = 'Success Page';
		$data['menu']='klaim_voucher';
		//wajib
		$data['menu_kategori_umroh']=$this->produk->viewall_produk_umroh();
		$data['menu_kategori_haji']=$this->produk->viewall_produk_haji();			
		$data['kategori_kabar']=$this->kabar->viewall_kategori();
		$data['img_header']=$this->pengaturan->viewall_header_rand();				
		$data['list_partner']=$this->pengaturan->viewall_partner();					
		//end wajib
		$data['konten']='konten/error';
		$this->output(TEMPLATE.'index',$data);
		
		}else{
			$data['alert']='
				<div class="alert alert-warning alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4><i class="icon fa fa-check"></i> Error Page ...!</h4>
				<p></p>
				
				</p>
				</div>
				';
			$data['page']='Error Page';
			$data['title'] = 'Error Page';
			$data['menu']='klaim_voucher';
			//wajib
			$data['menu_kategori_umroh']=$this->produk->viewall_produk_umroh();
			$data['menu_kategori_haji']=$this->produk->viewall_produk_haji();			
			$data['kategori_kabar']=$this->kabar->viewall_kategori();
			$data['img_header']=$this->pengaturan->viewall_header_rand();			
			$data['list_partner']=$this->pengaturan->viewall_partner();						
			//end wajib
			$data['konten']='konten/error';
			$this->output(TEMPLATE.'index',$data);
			
		}
		
	}
	public function edit_penerima(){
		if($_POST){						
			$nama_penerima=ucwords($this->request->post('nama_penerima'));
			$no_tlp=$this->request->post('no_tlp');			
			$alamat=$this->request->post('alamat');			
			$email=$this->request->post('email');
			$id_penerima=$this->request->post('id_penerima');
			
		$data_penerima=array(
				'nama_penerima'=>$nama_penerima,
				'no_tlp'=>$no_tlp,
				'email'=>$email,
				'alamat'=>$alamat,
				'aktif'=>'1',
				'tgl_terima'=>$tgl_terima,
				'editor'=>$this->session->getValue('username'),
				'change_date'=>date("Y-m-d"),
			);
			
			$this->voucher->edit_penerima_voucher($data_penerima,$id_penerima);
		
		$data['alert']='
				<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4><i class="icon fa fa-check"></i> Success</h4>
				<p>Selamat, anda telah berhasil Klaim Voucher ke Akun anda. Klik tombol dibawah ini untuk memilih produk Kami ...!</p>
				<p><a href="'.$this->uri->baseUri.'" type="button" class="btn btn-primary btn-lg btn-block">Pilih Produk</a></p>
				
				</p>
				</div>
				';
		$data['page']='Success Page';
		$data['title'] = 'Success Page';
		$data['menu']='klaim_voucher';
		//wajib
		$data['menu_kategori_umroh']=$this->produk->viewall_produk_umroh();
		$data['menu_kategori_haji']=$this->produk->viewall_produk_haji();			
		$data['kategori_kabar']=$this->kabar->viewall_kategori();
		$data['img_header']=$this->pengaturan->viewall_header_rand();		
		$data['list_partner']=$this->pengaturan->viewall_partner();							
		//end wajib
		$data['konten']='konten/error';
		$this->output(TEMPLATE.'index',$data);
		
		}else{
			$data['alert']='
				<div class="alert alert-warning alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4><i class="icon fa fa-check"></i> Error Page ...!</h4>
				<p></p>
				
				</p>
				</div>
				';
			$data['page']='Error Page';
			$data['title'] = 'Error Page';
			$data['menu']='klaim_voucher';
			//wajib
			$data['menu_kategori_umroh']=$this->produk->viewall_produk_umroh();
			$data['menu_kategori_haji']=$this->produk->viewall_produk_haji();			
			$data['kategori_kabar']=$this->kabar->viewall_kategori();
			$data['img_header']=$this->pengaturan->viewall_header_rand();			
			$data['list_partner']=$this->pengaturan->viewall_partner();						
			//end wajib
			$data['konten']='konten/error';
			$this->output(TEMPLATE.'index',$data);
			
		}
		
	}
	
	
}
