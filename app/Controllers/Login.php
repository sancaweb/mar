<?php
namespace Controllers;
use Resources, Models;

class Login extends Resources\Controller
{
    public function __construct(){
        
        parent::__construct();
		$this->session = new Resources\Session;
		$this->home = new Models\Home;
		$this->produk = new Models\Produk;
		$this->kabar = new Models\Kabar;
		$this->pengaturan = new Models\Pengaturan;
		$this->session = new Resources\Session;
		$this->request=new Resources\Request;
        $this->user = new Models\User;
		$this->voucher=new Models\Voucher;
		$this->rekanan=new Models\Rekanan;
		
    }
	
	public function index($no_voucher='')
    {
		
		$no_voucher=base64_decode($no_voucher);
		if($no_voucher==''){
			
		}else{
			$data['no_voucher']=$no_voucher;
			
		}
        $data['title'] = 'Login';
		
		$data['page']='login';
		

        $this->output(TEMPLATE.'login', $data);
    }
	
	public function pro_login(){
		if($_POST){
			
		$username=$this->request->post('username',FILTER_SANITIZE_MAGIC_QUOTES);
		$password=md5($this->request->post('password'));
		$no_voucher=$this->request->post('no_voucher');
		
		if ($username=='' || $password==''){
			$this->redirect('login');
		}
		
		$cek_user=$this->user->cek_user($username,$password);
		
		if ($cek_user){
			$ambil_userid=$this->user->ambil_userid($username)->id;
				$cek_user_level=$this->user->cek_user_level($username,$password)->user_level;
			if($no_voucher==''){
				$session=array(
				'user_id'=>$ambil_userid,
				'username'=>$username,
				'user_level'=>$cek_user_level,
			);
			$this->session->setValue($session);
			
			if($cek_user_level==1 || $cek_user_level==2 || $cek_user_level==3){
				$this->redirect('index.php/admin/home');
			}else{
				$this->redirect('index.php/home');
			}
			
			
			
			
			}else{
				//no_voucher ada di form
			
			$id_voucher=$this->voucher->id_voucher($no_voucher)->id;	
			$potongan=$this->voucher->potongan($no_voucher);
			$id_rekanan=$this->voucher->id_rekanan($no_voucher);
			$nama_rekanan=$this->rekanan->view_nama_rekanan_by_id($id_rekanan->id_rekanan);
			$jenis_rekanan=$this->rekanan->jenis_rekanan($id_rekanan->id_rekanan);
			$user_id_log=$this->user->ambil_userid($username)->id;
			$ambil_userid=$this->user->ambil_userid($username);
			$penerima_voucher_by_user_id_log=$this->voucher->penerima_voucher_by_user_id_log($user_id_log);
			$cek_cocok_user_id=$this->voucher->cek_cocok_user_id($user_id_log,$id_voucher);
			
			if($jenis_rekanan->jenis=='rekanan'){
				//jenis voucher rekanan belum beres
				
					if($cek_cocok_user_id){
					//user sesuai
					$status_aktif=$this->voucher->status_aktif($user_id_log)->aktif;
					
					if($status_aktif=='1'){
						//voucher activated
						$ambil_userid=$this->user->ambil_userid($username)->id;
						$cek_user_level=$this->user->cek_user_level($username,$password)->user_level;
						$session=array(
							'user_id'=>$ambil_userid,
							'username'=>$username,
							'user_level'=>$cek_user_level,
						);
					
					$this->session->setValue($session);
					
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
							$data_penerima_voucher=$this->voucher->penerima_voucher_by_user_id_log($user_id_log);
														
							$data['user_id']=$user_id_log;
							$data['id_rekanan'] = $this->voucher->id_rekanan($no_voucher);
							$data['potongan'] = $potongan;
							$data['page']='form_penerima_voucher';
							$data['title'] = 'Form penerima Voucher';
							$data['menu']='klaim_voucher';
							$data['nama_rekanan']=$nama_rekanan;
							$data['no_voucher']=$no_voucher;
							$data['data_penerima_voucher']=$data_penerima_voucher;
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
						<p>Silahkan hubungi '.$nama_rekanan->nama_rekanan.', tempat anda mendapatkan Voucher.</p>
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
				
				
			}else{	//jenis rekanan umum
				//cek user id di penerima voucher ada atau tidak (pernah dapat voucher tidak)
										
				$user_id_log=$this->user->ambil_userid($username)->id;
				if($penerima_voucher_by_user_id_log){
					//user_id pernah dapat voucher
					$status_guna=$this->voucher->status_guna($user_id_log)->status;
					if($status_guna=='1'){
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
						//belum digunakan vouchernya
						
						$data['alert']='
							<div class="alert alert-warning alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-check"></i> Error Voucher Ganda</h4>
							<p><h5>Maaf, Akun yang sedang login ini masih memiliki Voucher yang belum digunakan. </h5></p>
							<ol>
								<li>Jika ini adalah akun anda, maka silahkan gunakan voucher diskon anda terlebih dahulu
								Untuk mendapatkan potongan saat mendaftarkan sebagai jamaah umroh ...!</li>
								<li>Silahkan login atau registrasi dengan akun lain</li>
								
							</ol>
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
					//user_id tidak pernah dapat voucher
					$ambil_userid=$this->user->ambil_userid($username)->id;
				$cek_user_level=$this->user->cek_user_level($username,$password)->user_level;
					$session=array(
						'user_id'=>$ambil_userid,
						'username'=>$username,
						'user_level'=>$cek_user_level,
					);
					
					$this->session->setValue($session);
					
					$potongan=$this->voucher->potongan($no_voucher);
					$id_rekanan=$this->voucher->id_rekanan($no_voucher);
					$nama_rekanan=$this->rekanan->view_nama_rekanan_by_id($id_rekanan->id_rekanan);
					$user_id_log=$this->user->ambil_userid($username)->id;
					$data['alert']='
						<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-check"></i>Selamat, Voucher Berhasil di klaim ..!</h4>
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
			}
			
			
			
			
			}
			
		}else{
			//echo "Gagal Login";
			$data['alert']='
				<div class="alert alert-warning alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4><i class="icon fa fa-check"></i> Error, Username dan Password tidak sesuai </h4>
				<ol>
				<li>Silahkan masukkan username dan password yang sesuai.</li>
				</ol>
				</div>
				';
			$data['title'] = 'Gagal Login';
			$data['page']='login';

			$this->output(TEMPLATE.'login', $data);
		}
			
		}else{
			$this->redirect('login');
		}		
		
	}
	
	public function register($no_voucher=''){
		$no_voucher=base64_decode($no_voucher);
		
		if($no_voucher==''){
			
		}else{
			$data['no_voucher']=$no_voucher;
			
		}	
		
		
		$data['title'] = 'Register Akun';
		$data['page']='register';

			$this->output(TEMPLATE.'login', $data);
	}
	
	public function pro_register(){
		if($_POST){
			
		$username=$this->request->post('username');
		$password=md5($this->request->post('password'));
		$no_voucher=$this->request->post('no_voucher');
		$nama=ucwords($this->request->post('nama'));
		
		if ($username=='' || $password==''){
			$this->redirect('login');
		}
		
		$cek_username=$this->user->cek_username($username);
		
		if ($cek_username){
			//username ditemukan, gagal register 
			$this->session->destroy();
			$data['alert']='
				<div class="alert alert-warning alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4><i class="icon fa fa-check"></i> Error, Username sudah digunakan! </h4>
				<ol>
				<li>Silahkan gunakan username yang lain.</li>
				<li>Atau klik tombol "Login" dibawah ini untuk login dengan akun anda.</li>
				</ol>
				<p><p><a href="'.$this->uri->baseUri.'index.php/login/index/'.base64_encode($no_voucher).'" type="button" class="btn btn-primary btn-lg btn-block">Login</a></p>
				</div>
				';
			
			$data['title'] = 'Gagal Register';
			$data['page']='register';

			$this->output(TEMPLATE.'login', $data);
		}else{
			//echo "Berhasil Register ";
			$cek_user_level='3';
			$ambil_user_level=$this->user->ambil_user_level($cek_user_level)->level;
			
			
			//simpan username
			$data_user=array(
				'username'=>$username,
				'password'=>$password,
				'tgl_register'=>date("Y-m-d"),
			);
			$ambil_userid=$this->user->input_user($data_user);
			
			//simpan pengguna
			$data_pengguna=array(
				'nama_lengkap'=>$nama,
				'user_id'=>$ambil_userid,
				'tgl_input'=>date("Y-m-d"),
			);
			$this->user->input_pengguna($data_pengguna);
			
			if($no_voucher==''){
				$ambil_userid=$this->user->ambil_userid($username)->id;
				$cek_user_level=$this->user->cek_user_level($username,$password)->user_level;
				$session=array(
					'user_id'=>$ambil_userid,
					'username'=>$username,
					'user_level'=>$cek_user_level,
				);
			
			$this->session->setValue($session);
			$this->redirect('home');
			
			}else{
				$ambil_userid=$this->user->ambil_userid($username)->id;
				$cek_user_level=$this->user->cek_user_level($username,$password)->user_level;
				$session=array(
					'user_id'=>$ambil_userid,
					'username'=>$username,
					'user_level'=>$cek_user_level,
				);
			
			$this->session->setValue($session);
			
				
				
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
		}
			
		}else{
			$this->redirect('login/register');
		}		
		
	}
	
	public function logout(){
		$this->session->destroy();
		$this->redirect('home');
	}
}
