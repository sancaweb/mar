<?php
namespace Controllers\admin;
use Resources, Libraries, Models;

class User extends Resources\Controller
{
    public function __construct(){
        
        parent::__construct();
		$this->session = new Resources\Session;
		$this->home = new Models\Home;
		$this->pesan = new Models\Pesan;
		$this->request=new Resources\Request;
		$this->upload=new Resources\Upload;
		$this->user=new Models\User;
		$this->readmore = new Libraries\Readmore;
    }
	
	public function index($page=1)
    {
		if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2 || $this->session->getValue('user_level')==3){
        //pagination
		$this->pagination = new Resources\Pagination();
        $page = (int) $page;
        $limit = 10;
		
		
		if($this->session->getValue('user_level')==3){
			$user_id=$this->session->getValue('user_id');
			
			$total_user=$this->user->total_user_by_id($user_id);
			$data['viewall_page']=$this->user->viewall_page_by_id($user_id,$page, $limit);
		}else{
			
			$total_user=$this->user->total_user();
			$data['viewall_page']=$this->user->viewall_page($page, $limit);
		}
				
		
		$data['total_user'] = $total_user;
		$data['pageLinks'] = $this->pagination->setOption(
		array(
		    'limit' => $limit,
		    'base' => $this->uri->baseUri.'index.php/admin/user/index/%#%/',
			'total' => $total_user,	
		    'current' => $page,
			)
					)->getUrl(); 
		
		$data['no'] = ($page * $this->pagination->limit) - $this->pagination->limit;
		// end pagination
		
		$data['title'] = 'Data User';
		$data['subtitle']= 'List data user';
		$data['konten']='admin/konten/user';
		$data['menu']='user';
		$data['page']='user';
		$data['user_level']=$this->user->viewall_user_grup();
		$penerima=$this->session->getValue('user_id');
		$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
		$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
		
        $this->output('admin/index', $data);
		}else{
			$this->redirect('login');
		}
    }
	
	public function input_user($page=1)
    {
		if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2){
        if($_POST){
		$username=$this->request->post('username');
        $password=$this->request->post('password');
		$user_level=$this->request->post('user_level');
		$tgl_register=date("Y-m-d");
		$cek_username=$this->user->cek_username($username);
		
		if($cek_username){
			$data['alert']='
				<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h4>	<i class="icon fa fa-check"></i> Input User gagal</h4>
				<p>Username yang anda masukan sudah digunakan</p>
				</div>
				';			
			}else{
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
							
							//sukses
							//input user
							$data_user=array(
								'username'=>$username,
								'password'=>md5($password),		
								'user_level'=>$user_level,
								'tgl_register'=>$tgl_register,
							);
							
							$ambil_user_id=$this->user->input_user($data_user);
							
							//input_pengguna						
							$nama_lengkap=ucwords($this->request->post('nama_lengkap'));
							$no_tlp=$this->request->post('no_tlp');
							$email=$this->request->post('email');
							$alamat=$this->request->post('alamat');
							$user_id=$ambil_user_id;
							
							$data_pengguna=array(
								'nama_lengkap'=>$nama_lengkap,
								'no_tlp'=>$no_tlp,
								'email'=>$email,
								'alamat'=>$alamat,
								'foto'=>$nama_foto['name'],
								'user_id'=>$ambil_user_id,
								'tgl_input'=>date("Y-m-d"),
								
							);
							$this->user->input_pengguna($data_pengguna);
							
							$data['alert']='
								<div class="alert alert-success alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<h4>	<i class="icon fa fa-check"></i> Sukses..!</h4>
								Anda berhasil input User.
								</div>
							';
						}else{
						
							$data['alert']='
								<div class="alert alert-danger alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<h4>	<i class="icon fa fa-check"></i> Input User gagal</h4>
								'.$this->upload->getError('message').'
								</div>
								';
						//Tidak aeda file					
						}
											
					} //if isset $foto
				//END UPLOAD
			}
		
		
			
		//pagination
		$this->pagination = new Resources\Pagination();
        $page = (int) $page;
        $limit = 5;
		$total_user=$this->user->total_user();
		
				
		$data['viewall_page']=$this->user->viewall_page($page, $limit);
		$data['total_user'] = $total_user;
		$data['pageLinks'] = $this->pagination->setOption(
		array(
		    'limit' => $limit,
		    'base' => $this->uri->baseUri.'index.php/admin/user/index/%#%/',
			'total' => $total_user,	
		    'current' => $page,
			)
					)->getUrl(); 
		
		$data['no'] = ($page * $this->pagination->limit) - $this->pagination->limit;
		// end pagination
		
		$data['title'] = 'Data User';
		$data['subtitle']= 'List data user';
		$data['konten']='admin/konten/user';
		$data['menu']='user';
		$data['page']='user';
		$data['user_level']=$this->user->viewall_user_grup();
		$penerima=$this->session->getValue('user_id');
		$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
		$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
		
        $this->output('admin/index', $data);
		
		}else{ //END $_POST
			$data['title'] = 'Error ...';
			$data['subtitle']= 'error';
			$data["page"]='error';
			$data['konten']='admin/konten/error';
			$data['menu']='error';
			$penerima=$this->session->getValue('user_id');
			$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
			$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
			
			$data['alert']='
				<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4><i class="icon fa fa-check"></i> Error ...!1</h4>
				Halaman yang anda tuju salah.		
				</div>
				<a href="'.$this->uri->baseUri.'index.php/admin/" type="button" class="btn btn-primary btn-lg btn-block">Back to Home</a>
				';
			
			$this->output('admin/index', $data);
		}
		}else{
			$this->redirect('login');
		}
    }
	
	public function edit_user($page=1)
    {
		if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2 || $this->session->getValue('user_level')==3){
		if($_POST){
		$password=$this->request->post('password');
		
		$nama_lengkap=ucwords($this->request->post('nama_lengkap'));
		$no_tlp=$this->request->post('no_tlp');
		$email=$this->request->post('email');
		$alamat=$this->request->post('alamat');
		
		
		if($password==''){
			$password=$this->request->post('password_old');
		}else{
			$password=md5($password);
		}
		$user_level=$this->request->post('user_level');		
		$id=$this->request->post('id');
		
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
						if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2){
						//edit user
						
						$data_user=array(
							'password'=>$password,		
							'user_level'=>$user_level,
						);
						
						$this->user->edit_user($data_user,$id);
						}else{
							$data_user=array(
							'password'=>$password,
						);
						
						$this->user->edit_user($data_user,$id);
						}
						
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
						if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2){
							$data_user=array(
								'password'=>$password,
								'user_level'=>$user_level,
							);
							
							$this->user->edit_user($data_user,$id);
						}else{
							$data_user=array(
							'password'=>$password,
							);
							
							$this->user->edit_user($data_user,$id);
						}
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
		
			
		//pagination
		$this->pagination = new Resources\Pagination();
        $page = (int) $page;
        $limit = 5;
		$total_user=$this->user->total_user();
		
				
		$data['viewall_page']=$this->user->viewall_page($page, $limit);
		$data['total_user'] = $total_user;
		$data['pageLinks'] = $this->pagination->setOption(
		array(
		    'limit' => $limit,
		    'base' => $this->uri->baseUri.'index.php/admin/user/index/%#%/',
			'total' => $total_user,	
		    'current' => $page,
			)
					)->getUrl(); 
		
		$data['no'] = ($page * $this->pagination->limit) - $this->pagination->limit;
		// end pagination
		
		$data['title'] = 'Data User';
		$data['subtitle']= 'List data user';
		$data['konten']='admin/konten/user';
		$data['menu']='user';
		$data['page']='user';
		$data['user_level']=$this->user->viewall_user_grup();
		$penerima=$this->session->getValue('user_id');
		$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
		$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
		
        $this->output('admin/index', $data);
		}else{
			$data['title'] = 'Error ...';
			$data['subtitle']= 'error';
			$data["page"]='error';
			$data['konten']='admin/konten/error';			
			$penerima=$this->session->getValue('user_id');
			$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
			$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
			$data['menu']='error';
			
			$data['alert']='
				<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4><i class="icon fa fa-check"></i> Error ...!1</h4>
				Halaman yang anda tuju salah.		
				</div>
				<a href="'.$this->uri->baseUri.'index.php/admin/" type="button" class="btn btn-primary btn-lg btn-block">Back to Home</a>
				';
			
			$this->output('admin/index', $data);
		}
		}else{
			$this->redirect('login');
		}
    }
	
	public function hapus_user($id='',$page=1)
    {
		if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2){
		if($id==''){
			$data['title'] = 'Error ...';
			$data['subtitle']= 'error';
			$data["page"]='error';
			$data['konten']='admin/konten/error';
			$penerima=$this->session->getValue('user_id');
			$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
			$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
			$data['menu']='error';
			
			$data['alert']='
				<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4><i class="icon fa fa-check"></i> Error ...!1</h4>
				Halaman yang anda tuju salah.		
				</div>
				<a href="'.$this->uri->baseUri.'index.php/admin/" type="button" class="btn btn-primary btn-lg btn-block">Back to Home</a>
				';
			
			$this->output('admin/index', $data);
		}else{
			$id=base64_decode($id);
			$user_id=$id;
			$foto=$this->user->view_foto($user_id)->foto;
			if($foto==''){
				echo 'kosong';
			}else{
				 if(file_exists('upload/user/'.$foto)){
					unlink('upload/user/'.$foto);
					}else{
					}
			}		
							
				$this->user->hapus_user($id);
				$this->user->hapus_pengguna($user_id);
				
			//pagination
			$this->pagination = new Resources\Pagination();
			$page = (int) $page;
			$limit = 5;
			$total_user=$this->user->total_user();
			
					
			$data['viewall_page']=$this->user->viewall_page($page, $limit);
			$data['total_user'] = $total_user;
			$data['pageLinks'] = $this->pagination->setOption(
			array(
				'limit' => $limit,
				'base' => $this->uri->baseUri.'index.php/admin/user/index/%#%/',
				'total' => $total_user,	
				'current' => $page,
				)
						)->getUrl(); 
			
			$data['no'] = ($page * $this->pagination->limit) - $this->pagination->limit;
			// end pagination
			
			$data['title'] = 'Data User';
			$data['subtitle']= 'List data user';
			$data['konten']='admin/konten/user';
			$data['menu']='user';
			$data['page']='user';
			$data['user_level']=$this->user->viewall_user_grup();
			$penerima=$this->session->getValue('user_id');
			$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
			$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
			$data['alert']='
				<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4>	<i class="icon fa fa-check"></i> Sukses..!</h4>
				Anda berhasil Hapus User.
				</div>
			';
			$this->output('admin/index', $data);
		}
		}else{
			$this->redirect('login');
		}
			
			
    }
	
	
}
