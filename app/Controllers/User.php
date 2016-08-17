<?php
namespace Controllers;
use Resources, Models, Libraries;

class User extends Resources\Controller
{
    public function __construct(){
        
        parent::__construct();
		$this->session = new Resources\Session;
		$this->upload = new Resources\Upload;
		$this->home = new Models\Home;
		$this->produk = new Models\Produk;
		$this->pesan = new Models\Pesan;
		$this->kabar = new Models\Kabar;
		$this->image = new Libraries\Image;
		$this->voucher = new Models\Voucher;
		$this->pengaturan = new Models\Pengaturan;
		$this->user = new Models\User;
		$this->request=new Resources\Request;
		$this->registrasi = new Models\Registrasi;
    }
	
	public function index($page=1)
    {
		if($this->session->getValue('username')){
			
			$data['title'] = 'User Profile';
			$data['subtitle']= 'User Profile';
			$data["page"]='user';
			$data['konten']='konten/user';
			$penerima=$this->session->getValue('user_id');
			$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
			$data['menu']='user';
			//user_tab
			$user_id=$this->session->getValue('user_id');			
			$data_user=$this->user->view_by_id($user_id);
			
			$data['view_user']=$data_user;
			$data_pengguna=$this->user->viewall_pengguna_by_user_id($data_user->id);
			if($data_pengguna){
				$nama_pengguna=$data_pengguna->nama_lengkap;
				$no_tlp=$data_pengguna->no_tlp;
				$email=$data_pengguna->email;
				$alamat=$data_pengguna->alamat;						
				$foto=$data_pengguna->foto;
			}else{
				$nama_pengguna='';
				$no_tlp='';
				$email='';
				$alamat='';						
				$foto='';
			}
			$data['foto']=$foto;
			$data['nama_pengguna']=$nama_pengguna;
			$data['no_tlp']=$no_tlp;
			$data['no_tlp']=$no_tlp;
			$data['email']=$email;
			$data['alamat']=$alamat;
			$data['foto']=$foto;
			//wajib
			$data['menu_kategori_umroh']=$this->produk->viewall_produk_umroh();
			$data['menu_kategori_haji']=$this->produk->viewall_produk_haji();			
			$data['kategori_kabar']=$this->kabar->viewall_kategori();
			$data['img_header']=$this->pengaturan->viewall_header_rand();
			$data['list_partner']=$this->pengaturan->viewall_partner();		
			// END wajib

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
	
	public function edit_user()
    {
		
		if($this->session->getValue('username')){
		if($_POST){
		$username=$this->request->post('username');
		$password=$this->request->post('password');
		$nama_lengkap=ucwords($this->request->post('nama_lengkap'));
		$no_tlp=$this->request->post('no_tlp');
		$email=$this->request->post('email');
		$alamat=$this->request->post('alamat');
		
		
		$id=$this->request->post('id');
		
		if($password==''){
			$password=$this->request->post('password_old');
		}else{
			$password=md5($password);
		}
		$nama=ucwords($this->request->post('nama'));
		
		//prosesupload
		$this->upload->setOption(
			array(
				'folderLocation' => 'upload/user',
				'autoRename' => true,
				'autoCreateFolder' => true,
				'permittedFileType' => 'gif|png|jpg|jpeg',
				'maximumSize' => 5000000, //5Mb
			)
		);	
					
		
			if( isset($_FILES['foto']) ) {
				$file = $this->upload->now($_FILES['foto']);
				$nama_foto=$this->upload->getFileInfo();						
				
				if($file) {
					$foto_old=$this->request->post('foto_old');
					if(file_exists('upload/user/'.$foto_old)){
						unlink('upload/user/'.$foto_old);
					}else{
						
					}
					//sukses
					//edit user
					
					$data_user=array(
						'username'=>$username,
						'password'=>$password,
					);
					
					$this->user->edit_user($data_user,$id);
					
					$data_pengguna=array(
							'nama_lengkap'=>$nama_lengkap,
							'no_tlp'=>$no_tlp,
							'email'=>$email,
							'alamat'=>$alamat,
							'foto'=>$nama_foto['name'],
							
						);
						$this->user->edit_pengguna_by_userid($data_pengguna,$id);
					
					$data['alert']='
						<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4>	<i class="icon fa fa-check"></i> Sukses..!</h4>
						Anda berhasil Edit User.
						</div>
					';
				}else{
				
					$data_user=array(
						'username'=>$username,
						'password'=>$password,
					);
					
					$this->user->edit_user($data_user,$id);
					
					$data_pengguna=array(
							'nama_lengkap'=>$nama_lengkap,
							'no_tlp'=>$no_tlp,
							'email'=>$email,
							'alamat'=>$alamat,
							
						);
						$this->user->edit_pengguna_by_userid($data_pengguna,$id);
					
					$data['alert']='
						<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4>	<i class="icon fa fa-check"></i> Sukses..!</h4>
						Anda berhasil Edit User.
						</div>
					';
					
				//Tidak aeda file					
				}
									
			} //if isset $foto
			//END UPLOAD
		
			$data['title'] = 'User Profile';
			$data['subtitle']= 'User Profile';
			$data["page"]='user';
			$data['konten']='konten/user';
			$penerima=$this->session->getValue('user_id');
			$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
			$data['menu']='user';
			//user_tab
			$user_id=$this->session->getValue('user_id');
			$data_user=$this->user->view_by_id($user_id);
			
			$data['view_user']=$data_user;
			$data_pengguna=$this->user->viewall_pengguna_by_user_id($data_user->id);
			if($data_pengguna){
				$nama_pengguna=$data_pengguna->nama_lengkap;
				$no_tlp=$data_pengguna->no_tlp;
				$email=$data_pengguna->email;
				$alamat=$data_pengguna->alamat;						
				$foto=$data_pengguna->foto;
			}else{
				$nama_pengguna='';
				$no_tlp='';
				$email='';
				$alamat='';						
				$foto='';
			}
			$data['foto']=$foto;
			$data['nama_pengguna']=$nama_pengguna;
			$data['no_tlp']=$no_tlp;
			$data['no_tlp']=$no_tlp;
			$data['email']=$email;
			$data['alamat']=$alamat;
			$data['foto']=$foto;
			//wajib
			$data['menu_kategori_umroh']=$this->produk->viewall_produk_umroh();
			$data['menu_kategori_haji']=$this->produk->viewall_produk_haji();			
			$data['kategori_kabar']=$this->kabar->viewall_kategori();
			$data['img_header']=$this->pengaturan->viewall_header_rand();
			$data['list_partner']=$this->pengaturan->viewall_partner();		
			// END wajib

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
		}else{
			$this->redirect('login');
		}
    }
}
