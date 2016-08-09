<?php
namespace Controllers\admin;
use Resources, Libraries, Models;

class About extends Resources\Controller
{
    public function __construct(){
        
        parent::__construct();
		$this->session = new Resources\Session;
		$this->home = new Models\Home;
		$this->kantor = new Models\Kantor;	
		$this->user=new Models\User;	
		$this->pesan=new Models\Pesan;	
		$this->profile = new Models\Profile;		
		$this->request=new Resources\Request;
		$this->readmore = new Libraries\Readmore;				
		$this->upload = new Resources\Upload; 
    }
	
	public function index($page=1)
    {
		if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2){
        $data['title'] = 'Data Profile';
		$data['subtitle']= 'Halaman utama';
		$data['konten']='admin/konten/profile';
		$kepada=$this->session->getValue('user_id');
		$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_kepada($kepada);
		$data['loader_pesan']=$this->pesan->viewall_pesan_by_kepada($kepada);
		$data['menu']='about';
		$data['page']='about';
		
		//pagination
		$this->pagination = new Resources\Pagination();
        $page = (int) $page;
        $limit = 5;
		$total_profile=$this->profile->hitung_profile();
		
				
		$data['viewall_profile_page']=$this->profile->viewall_profile_page($page, $limit);
		$data['total_profile'] = $total_profile;
		$data['pageLinks'] = $this->pagination->setOption(
		array(
		    'limit' => $limit,
		    'base' => $this->uri->baseUri.'index.php/admin/about/index/%#%/',
			'total' => $total_profile,	
		    'current' => $page,
			)
					)->getUrl(); 
		
		$data['no'] = ($page * $this->pagination->limit) - $this->pagination->limit;
		// end pagination
		

        $this->output('admin/index', $data);
		}else{
			$this->redirect('login');
		}
    }
	
	public function input_profile($page=1){
		if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2){
		if($_POST){
				$judul=ucwords($this->request->post('judul'));
				$keterangan=$this->request->post('keterangan');
				$featured=$this->request->post('featured');
		//prosesupload
			$this->upload->setOption(
				array(
					'folderLocation' => 'upload/profile',
					'autoRename' => true,
					'autoCreateFolder' => true,
					'permittedFileType' => 'gif|png|jpg|jpeg',
					'maximumSize' => 5000000, //5Mb
				)
			);	
						
			
				if( isset($_FILES['image']) ) {										
					$file = $this->upload->now($_FILES['image']);
					$nama_foto=$this->upload->getFileInfo();						
					
					if($file) {
						
						
						if($featured==1){
							
							$view_featured=$this->profile->view_featured();
							if($view_featured){
								//featured 1 dan ada featured 1 lainnya
								// maka edit featured sebelumnya dulu, baru input
								$view_featured=$view_featured->id;
								$data_featured=array(
									'featured'=>0,
								);
								
								$this->profile->edit_profile($data_featured,$view_featured);
								
								$data_profile=array(
									'judul'=>$judul,
									'image'=>$nama_foto['name'],
									'keterangan'=>$keterangan,
									'featured'=>$featured,
								);
								
								$this->profile->input_profile($data_profile);
								
								
								
							}else{
								//featured 1 dan tidak ada featured 1 lainnya
								$data_profile=array(
									'judul'=>$judul,
									'image'=>$nama_foto['name'],
									'keterangan'=>$keterangan,
									'featured'=>$featured,
								);
								
								$this->profile->input_profile($data_profile);
								
								
							}
							
							
						}else{
							//featured nol
							$data_profile=array(
							'judul'=>$judul,
							'image'=>$nama_foto['name'],
							'keterangan'=>$keterangan,
							'featured'=>$featured,
						);
						
						$this->profile->input_profile($data_profile);
						}
						
						
						$data['alert']='
							<div class="alert alert-success alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4>	<i class="icon fa fa-check"></i> Sukses..!</h4>
							Anda berhasil input Data Informasi Profile.
							</div>
						';
						
						$data['title'] = 'Data Profile';
						$data['subtitle']= 'Halaman utama';
						$data['konten']='admin/konten/profile';
						$kepada=$this->session->getValue('user_id');
						$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_kepada($kepada);
						$data['loader_pesan']=$this->pesan->viewall_pesan_by_kepada($kepada);
						$data['menu']='about';
						$data['page']='about';
						
						//pagination
						$this->pagination = new Resources\Pagination();
						$page = (int) $page;
						$limit = 5;
						$total_profile=$this->profile->hitung_profile();
						
								
						$data['viewall_profile_page']=$this->profile->viewall_profile_page($page, $limit);
						$data['total_profile'] = $total_profile;
						$data['pageLinks'] = $this->pagination->setOption(
						array(
							'limit' => $limit,
							'base' => $this->uri->baseUri.'index.php/admin/about/index/%#%/',
							'total' => $total_profile,	
							'current' => $page,
							)
									)->getUrl(); 
						
						$data['no'] = ($page * $this->pagination->limit) - $this->pagination->limit;
						// end pagination
						

						$this->output('admin/index', $data);
					}else{
					
						$data['alert']='
							<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<h4>	<i class="icon fa fa-check"></i> Registrasi gagal</h4>
							'.$this->upload->getError('message').'
							</div>
							';
							$data['title'] = 'Error';
							$data['subtitle']= 'Halaman utama';
							$data["page"]='error';
							$data['konten']='admin/konten/error';
							$kepada=$this->session->getValue('user_id');
							$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_kepada($kepada);
							$data['loader_pesan']=$this->pesan->viewall_pesan_by_kepada($kepada);
							$data['menu']='about';
			
							$this->output('admin/index', $data);
					//Tidak aeda file					
					}
										
				} //if isset $foto
			//END UPLOAD
		}else{
			
			
			$data['alert']='
			<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4><i class="icon fa fa-check"></i> Error ...!</h4>
			<p>Halaman yang anda tuju tidak ada</p>
			</div>';
			$data['title'] = 'Error';
			$data['subtitle']= 'Halaman utama';
			$data["page"]='error';
			$data['konten']='admin/konten/error';
			$kepada=$this->session->getValue('user_id');
			$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_kepada($kepada);
			$data['loader_pesan']=$this->pesan->viewall_pesan_by_kepada($kepada);
			$data['menu']='about';
			$this->output('admin/index', $data);
		}
		}else{
			$this->redirect('login');
		}
		
	}
	
	public function edit_profile($page=1){
		if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2){
		if($_POST){
				$id=$this->request->post('id');
				$judul=ucwords($this->request->post('judul'));
				$keterangan=$this->request->post('keterangan');
				$featured=$this->request->post('featured');
		//prosesupload
			$this->upload->setOption(
				array(
					'folderLocation' => 'upload/profile',
					'autoRename' => true,
					'autoCreateFolder' => true,
					'permittedFileType' => 'gif|png|jpg|jpeg',
					'maximumSize' => 5000000, //5Mb
				)
			);	
						
			
				if( isset($_FILES['image']) ) {
					$file = $this->upload->now($_FILES['image']);
					$nama_foto=$this->upload->getFileInfo();						
					
					if($file) {
						
						if($featured==1){
							
							$view_featured=$this->profile->view_featured();
							if($view_featured){
								//featured 1 dan ada featured 1 lainnya
								// maka edit featured sebelumnya dulu, baru input
								$view_featured=$view_featured->id;
								$data_featured=array(
									'featured'=>0,
								);
								
								$this->profile->edit_profile($data_featured,$view_featured);
								
								//edit profile normal
								$image_old=$this->request->post('image_old');
								if(file_exists('upload/profile/'.$image_old)){
									unlink('upload/profile/'.$image_old);
								}else{
									
								}
								
								
								$data_profile=array(
									'judul'=>$judul,
									'image'=>$nama_foto['name'],
									'keterangan'=>$keterangan,
									'featured'=>$featured,
								);
								
								$this->profile->edit_profile($data_profile,$id);
								
								
							}else{
								//featured 1 dan tidak ada featured 1 lainnya
								//edit profile normal
								$image_old=$this->request->post('image_old');
								if(file_exists('upload/profile/'.$image_old)){									
									unlink('upload/profile/'.$image_old);
								}else{
									
								}
								
								$data_profile=array(
									'judul'=>$judul,
									'image'=>$nama_foto['name'],
									'keterangan'=>$keterangan,
									'featured'=>$featured,
								);
								
								$this->profile->edit_profile($data_profile,$id);
								
							}
							
							
						}else{
							//featured nol
							//edit profile normal
							
							$image_old=$this->request->post('image_old');
							
							if(file_exists('upload/profile/'.$image_old)){
								unlink('upload/profile/'.$image_old);
							}else{
								
							}
							
							
							$data_profile=array(
								'judul'=>$judul,
								'image'=>$nama_foto['name'],
								'keterangan'=>$keterangan,
								'featured'=>$featured,
							);
							
							$this->profile->edit_profile($data_profile,$id);
							
						}
						
						
						$data['alert']='
							<div class="alert alert-success alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4>	<i class="icon fa fa-check"></i> Sukses..!</h4>
							Anda berhasil Edit Data Informasi Profile.
							</div>
						';
						
						$data['title'] = 'Data Profile';
						$data['subtitle']= 'Halaman utama';
						$data['konten']='admin/konten/profile';
						$kepada=$this->session->getValue('user_id');
						$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_kepada($kepada);
						$data['loader_pesan']=$this->pesan->viewall_pesan_by_kepada($kepada);
						$data['menu']='about';
						$data['page']='about';
						
						//pagination
						$this->pagination = new Resources\Pagination();
						$page = (int) $page;
						$limit = 5;
						$total_profile=$this->profile->hitung_profile();
						
								
						$data['viewall_profile_page']=$this->profile->viewall_profile_page($page, $limit);
						$data['total_profile'] = $total_profile;
						$data['pageLinks'] = $this->pagination->setOption(
						array(
							'limit' => $limit,
							'base' => $this->uri->baseUri.'index.php/admin/about/index/%#%/',
							'total' => $total_profile,	
							'current' => $page,
							)
									)->getUrl(); 
						
						$data['no'] = ($page * $this->pagination->limit) - $this->pagination->limit;
						// end pagination
						

						$this->output('admin/index', $data);
					}else{
						
						if($featured==1){
							
							$view_featured=$this->profile->view_featured();
							if($view_featured){
								//featured 1 dan ada featured 1 lainnya
								// maka edit featured sebelumnya dulu, baru input
								$view_featured=$view_featured->id;
								$data_featured=array(
									'featured'=>0,
								);
								
								$this->profile->edit_profile($data_featured,$view_featured);
								
								//edit profile normal
								$data_profile=array(
								'judul'=>$judul,
								'keterangan'=>$keterangan,
								'featured'=>$featured,
								);
								
								$this->profile->edit_profile($data_profile,$id);
								
								
							}else{
								//featured 1 dan tidak ada featured 1 lainnya
								//edit profile normal
								$data_profile=array(
								'judul'=>$judul,
								'keterangan'=>$keterangan,
								'featured'=>$featured,
								);
								
								$this->profile->edit_profile($data_profile,$id);

								
							}
							
							
						}else{
							//featured nol
							//edit profile normal
							$data_profile=array(
								'judul'=>$judul,
								'keterangan'=>$keterangan,
								'featured'=>$featured,
							);
							
							$this->profile->edit_profile($data_profile,$id);
							
						}
					
						
						
						
						$data['alert']='
							<div class="alert alert-success alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4>	<i class="icon fa fa-check"></i> Sukses..!</h4>
							Anda berhasil Edit Data Informasi Profile.
							</div>
						';
						
						$data['title'] = 'Data Profile';
						$data['subtitle']= 'Halaman utama';
						$data['konten']='admin/konten/profile';
						$kepada=$this->session->getValue('user_id');
						$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_kepada($kepada);
						$data['loader_pesan']=$this->pesan->viewall_pesan_by_kepada($kepada);
						$data['menu']='about';
						$data['page']='about';
						
						//pagination
						$this->pagination = new Resources\Pagination();
						$page = (int) $page;
						$limit = 5;
						$total_profile=$this->profile->hitung_profile();
						
								
						$data['viewall_profile_page']=$this->profile->viewall_profile_page($page, $limit);
						$data['total_profile'] = $total_profile;
						$data['pageLinks'] = $this->pagination->setOption(
						array(
							'limit' => $limit,
							'base' => $this->uri->baseUri.'index.php/admin/about/index/%#%/',
							'total' => $total_profile,	
							'current' => $page,
							)
									)->getUrl(); 
						
						$data['no'] = ($page * $this->pagination->limit) - $this->pagination->limit;
						// end pagination
						

						$this->output('admin/index', $data);
					//Tidak ada file					
					}
										
				} //if isset $foto
			//END UPLOAD
		}else{
			
			
			$data['alert']='
			<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4><i class="icon fa fa-check"></i> Error ...!</h4>
			<p>Halaman yang anda tuju tidak ada</p>
			</div>';
			$data['title'] = 'Error';
			$data['subtitle']= 'Halaman utama';
			$data["page"]='error';
			$data['konten']='admin/konten/error';
			$kepada=$this->session->getValue('user_id');
			$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_kepada($kepada);
			$data['loader_pesan']=$this->pesan->viewall_pesan_by_kepada($kepada);
			$data['menu']='about';
			$this->output('admin/index', $data);
		}
		}else{
			$this->redirect('login');
		}
		
	}
	
	public function hapus_profile($id=''){
		if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2){
		$page=1;
		$id=base64_decode($id);
		
		$cek_id=$this->profile->view_by_id($id);
		
		if($cek_id){
			$image=$this->profile->image_by_id($id)->image;
			if(file_exists('upload/profile/'.$image)){
			unlink('upload/profile/'.$image);
				
			}else{
				
			}
			
			$this->profile->hapus_profile($id);
		
		
			$data['alert']='
				<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4>	<i class="icon fa fa-check"></i> Sukses..!</h4>
				Anda berhasil Hapus Data Informasi Profile.
				</div>
			';
			
			$data['title'] = 'Data Profile';
			$data['subtitle']= 'Halaman utama';
			$data['konten']='admin/konten/profile';
			$kepada=$this->session->getValue('user_id');
			$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_kepada($kepada);
			$data['loader_pesan']=$this->pesan->viewall_pesan_by_kepada($kepada);
			$data['menu']='about';
			$data['page']='about';
			
			//pagination
			$this->pagination = new Resources\Pagination();
			$page = (int) $page;
			$limit = 5;
			$total_profile=$this->profile->hitung_profile();
			
					
			$data['viewall_profile_page']=$this->profile->viewall_profile_page($page, $limit);
			$data['total_profile'] = $total_profile;
			$data['pageLinks'] = $this->pagination->setOption(
			array(
				'limit' => $limit,
				'base' => $this->uri->baseUri.'index.php/admin/about/index/%#%/',
				'total' => $total_profile,	
				'current' => $page,
				)
						)->getUrl(); 
			
			$data['no'] = ($page * $this->pagination->limit) - $this->pagination->limit;
			// end pagination
			

			$this->output('admin/index', $data);
		}else{
			
			
			$data['alert']='
			<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4><i class="icon fa fa-check"></i> Error ...!</h4>
			<p>Halaman yang anda tuju tidak ada</p>
			</div>';
			$data['title'] = 'Error';
			$data['subtitle']= 'Halaman utama';
			$data["page"]='error';
			$data['konten']='admin/konten/error';
			$kepada=$this->session->getValue('user_id');
			$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_kepada($kepada);
			$data['loader_pesan']=$this->pesan->viewall_pesan_by_kepada($kepada);
			$data['menu']='about';
			$this->output('admin/index', $data);
		}
		}else{
			$this->redirect('login');
		}
		
	}
	
	
	public function kantor($page=1)
    {
		if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2){
        $data['title'] = 'Data Kantor';
		$data['subtitle']= 'Halaman utama';
		$data['konten']='admin/konten/kantor';
		$kepada=$this->session->getValue('user_id');
		$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_kepada($kepada);
		$data['loader_pesan']=$this->pesan->viewall_pesan_by_kepada($kepada);
		$data['menu']='kantor';
		$data['page']='about';
		
		//pagination
		$this->pagination = new Resources\Pagination();
        $page = (int) $page;
        $limit = 5;
		$total_kantor=$this->kantor->hitung_kantor();
		
				
		$data['viewall_kantor_page']=$this->kantor->viewall_kantor_page($page, $limit);
		$data['total_kantor'] = $total_kantor;
		$data['pageLinks'] = $this->pagination->setOption(
		array(
		    'limit' => $limit,
		    'base' => $this->uri->baseUri.'index.php/admin/about/kantor/%#%/',
			'total' => $total_kantor,	
		    'current' => $page,
			)
					)->getUrl(); 
		
		$data['no'] = ($page * $this->pagination->limit) - $this->pagination->limit;
		// end pagination
		

        $this->output('admin/index', $data);
		}else{
			$this->redirect('login');
		}
    }
	
	public function input_kantor($page=1){
		if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2){
		if($_POST){
			$nama_kantor=ucwords($this->request->post('nama_kantor'));
			$tlp=$this->request->post('tlp');
			$email=$this->request->post('email');
			$alamat=$this->request->post('alamat');
			
			$data_kantor=array(
				'nama_kantor'=>$nama_kantor,
				'tlp'=>$tlp,
				'email'=>$email,
				'alamat'=>$alamat,
			);
			
			$this->kantor->input_kantor($data_kantor);
			
			$data['alert']='
				<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4>	<i class="icon fa fa-check"></i> Sukses..!</h4>
				Anda berhasil input Data Kantor.
				</div>
			';
			
			$data['title'] = 'Data Kantor';
			$data['subtitle']= 'Halaman utama';
			$data['konten']='admin/konten/kantor';
			$kepada=$this->session->getValue('user_id');
			$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_kepada($kepada);
			$data['loader_pesan']=$this->pesan->viewall_pesan_by_kepada($kepada);
			$data['menu']='kantor';
			$data['page']='about';
			
			//pagination
			$this->pagination = new Resources\Pagination();
			$page = (int) $page;
			$limit = 5;
			$total_kantor=$this->kantor->hitung_kantor();
			
					
			$data['viewall_kantor_page']=$this->kantor->viewall_kantor_page($page, $limit);
			$data['total_kantor'] = $total_kantor;
			$data['pageLinks'] = $this->pagination->setOption(
			array(
				'limit' => $limit,
				'base' => $this->uri->baseUri.'index.php/admin/about/kantor/%#%/',
				'total' => $total_kantor,	
				'current' => $page,
				)
						)->getUrl(); 
			
			$data['no'] = ($page * $this->pagination->limit) - $this->pagination->limit;
			// end pagination
			

			$this->output('admin/index', $data);
		}else{
			
			
			$data['alert']='
			<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4><i class="icon fa fa-check"></i> Error ...!</h4>
			<p>Halaman yang anda tuju tidak ada</p>
			</div>';
			$data['title'] = 'Error';
			$data['subtitle']= 'Halaman utama';
			$data["page"]='error';
			$data['konten']='admin/konten/error';
			$kepada=$this->session->getValue('user_id');
			$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_kepada($kepada);
			$data['loader_pesan']=$this->pesan->viewall_pesan_by_kepada($kepada);
			$data['menu']='kantor';
			$this->output('admin/index', $data);
		}
		}else{
			$this->redirect('login');
		}
		
	}
	
	public function edit_kantor($page=1){
		if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2){
		if($_POST){
			$nama_kantor=ucwords($this->request->post('nama_kantor'));
			$tlp=$this->request->post('tlp');
			$email=$this->request->post('email');
			$alamat=$this->request->post('alamat');
			
			$id=$this->request->post('id');
			
			$data_kantor=array(
				'nama_kantor'=>$nama_kantor,
				'tlp'=>$tlp,
				'email'=>$email,
				'alamat'=>$alamat,
			);
			
			$this->kantor->edit_kantor($data_kantor,$id);
			
			$data['alert']='
				<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4>	<i class="icon fa fa-check"></i> Sukses..!</h4>
				Anda berhasil Edit Data Kantor.
				</div>
			';
			
			$data['title'] = 'Data Kantor';
			$data['subtitle']= 'Halaman utama';
			$data['konten']='admin/konten/kantor';
			$kepada=$this->session->getValue('user_id');
			$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_kepada($kepada);
			$data['loader_pesan']=$this->pesan->viewall_pesan_by_kepada($kepada);
			$data['menu']='kantor';
			$data['page']='about';
			
			//pagination
			$this->pagination = new Resources\Pagination();
			$page = (int) $page;
			$limit = 5;
			$total_kantor=$this->kantor->hitung_kantor();
			
					
			$data['viewall_kantor_page']=$this->kantor->viewall_kantor_page($page, $limit);
			$data['total_kantor'] = $total_kantor;
			$data['pageLinks'] = $this->pagination->setOption(
			array(
				'limit' => $limit,
				'base' => $this->uri->baseUri.'index.php/admin/about/kantor/%#%/',
				'total' => $total_kantor,	
				'current' => $page,
				)
						)->getUrl(); 
			
			$data['no'] = ($page * $this->pagination->limit) - $this->pagination->limit;
			// end pagination
			

			$this->output('admin/index', $data);
		}else{
			
			
			$data['alert']='
			<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4><i class="icon fa fa-check"></i> Error ...!</h4>
			<p>Halaman yang anda tuju tidak ada</p>
			</div>';
			$data['title'] = 'Error';
			$data['subtitle']= 'Halaman utama';
			$data["page"]='error';
			$data['konten']='admin/konten/error';
			$kepada=$this->session->getValue('user_id');
			$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_kepada($kepada);
			$data['loader_pesan']=$this->pesan->viewall_pesan_by_kepada($kepada);
			$data['menu']='kantor';
			$this->output('admin/index', $data);
		}
		}else{
			$this->redirect('login');
		}
	}
	
	public function hapus_kantor($id='',$page=1){
		if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2){
		$id=base64_decode($id);
		
		$view_id=$this->kantor->view_by_id($id);
		
		if($view_id){
			$id=$id;
			$this->kantor->hapus_kantor($id);
			
			$data['alert']='
				<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4>	<i class="icon fa fa-check"></i> Sukses..!</h4>
				Anda berhasil Hapus Data Kantor.
				</div>
			';
			
			$data['title'] = 'Data Kantor';
			$data['subtitle']= 'Halaman utama';
			$data['konten']='admin/konten/kantor';
			$kepada=$this->session->getValue('user_id');
			$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_kepada($kepada);
			$data['loader_pesan']=$this->pesan->viewall_pesan_by_kepada($kepada);
			$data['menu']='kantor';
			$data['page']='about';
			
			//pagination
			$this->pagination = new Resources\Pagination();
			$page = (int) $page;
			$limit = 5;
			$total_kantor=$this->kantor->hitung_kantor();
			
					
			$data['viewall_kantor_page']=$this->kantor->viewall_kantor_page($page, $limit);
			$data['total_kantor'] = $total_kantor;
			$data['pageLinks'] = $this->pagination->setOption(
			array(
				'limit' => $limit,
				'base' => $this->uri->baseUri.'index.php/admin/about/kantor/%#%/',
				'total' => $total_kantor,	
				'current' => $page,
				)
						)->getUrl(); 
			
			$data['no'] = ($page * $this->pagination->limit) - $this->pagination->limit;
			// end pagination
			

			$this->output('admin/index', $data);
			
			
			
			
		}else{
			$data['alert']='
			<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4><i class="icon fa fa-check"></i> Error ...!</h4>
			<p>Data tidak ada</p>
			</div>';
			
			$data['title'] = 'Error';
			$data['subtitle']= 'Halaman utama';
			$data["page"]='error';
			$data['konten']='admin/konten/error';
			$kepada=$this->session->getValue('user_id');
			$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_kepada($kepada);
			$data['loader_pesan']=$this->pesan->viewall_pesan_by_kepada($kepada);
			$data['menu']='kantor';
			$this->output('admin/index', $data);
		}
		}else{
			$this->redirect('login');
		}
		
	}
}
