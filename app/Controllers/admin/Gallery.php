<?php
namespace Controllers\admin;
use Resources, Libraries, Models;

class Gallery extends Resources\Controller
{
    public function __construct(){
        
        parent::__construct();
		$this->session = new Resources\Session;
		$this->home = new Models\Home;
		$this->gallery = new Models\Gallery;
		$this->user=new Models\User;
		$this->pesan=new Models\Pesan;
		$this->request=new Resources\Request;
		$this->randomstring = new Libraries\Randomstring;
		$this->readmore = new Libraries\Readmore;
		$this->image = new Libraries\Image;		
		$this->upload = new Resources\Upload; 
		$this->image = new Resources\Image; 
		$this->pembayaran=new Models\Pembayaran;
		$this->registrasi=new Models\Registrasi;
    }
	
	public function index($page=1)
    {
		if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2){
        //pagination
		$this->pagination = new Resources\Pagination();
        $page = (int) $page;
        $limit = 10;
		$total_kategori=$this->gallery->hitung_kategori();
		
				
		$data['viewall_kategori']=$this->gallery->viewall_kategori_page($page, $limit);
		$data['total_kategori'] = $total_kategori;
		$data['pageLinks'] = $this->pagination->setOption(
		array(
		    'limit' => $limit,
		    'base' => $this->uri->baseUri.'index.php/admin/gallery/index/%#%/',
			'total' => $total_kategori,	
		    'current' => $page,
			)
					)->getUrl(); 
		
		$data['no'] = ($page * $this->pagination->limit) - $this->pagination->limit;
		// end pagination
		
		$data['title'] = 'Data Gallery';
		$data['subtitle']= 'List data Gallery';
		$data['konten']='admin/konten/gallery';
		$penerima=$this->session->getValue('user_id');
		$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
		$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
		$data['menu']='gallery';
		$data['page']='gallery';
		$data['kategori_menu']=$this->gallery->viewall_kategori();
        $this->output('admin/index', $data);
		}else{
			$this->redirect('login');
		}
    }
	
	public function view($kategori='',$page=1)
    {
		if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2){
		$kategori=base64_decode($kategori);
		$kategori2=base64_encode($kategori);
        //pagination
		$this->pagination = new Resources\Pagination();
        $page = (int) $page;
        $limit = 5;
		$total_gallery=$this->gallery->hitung_gallery_by_id($kategori);
		
				
		$data['viewall_gallery']=$this->gallery->viewall_gallery_page_by_kat($kategori,$page,$limit);
		$data['total_gallery'] = $total_gallery;
		$data['pageLinks'] = $this->pagination->setOption(
		array(
		    'limit' => $limit,
		    'base' => $this->uri->baseUri.'index.php/admin/gallery/view/'.$kategori2.'/%#%/',
			'total' => $total_gallery,	
		    'current' => $page,
			)
					)->getUrl(); 
		
		$data['no'] = ($page * $this->pagination->limit) - $this->pagination->limit;
		// end pagination
		
		
		$data['title'] = 'Data Gallery';
		$data['subtitle']= 'List data Gallery';
		$data['konten']='admin/konten/view_gallery';
		$penerima=$this->session->getValue('user_id');
		$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
		$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
		$data['menu']='gallery';
		$data['page']='gallery';
		$data['kategori_menu']=$this->gallery->viewall_kategori();
		$data['nama_kategori']=$this->gallery->nama_kategori($kategori)->nama_kategori;
		
        $this->output('admin/index', $data);
		}else{
			$this->redirect('login');
		}
    }
	
	public function input_gallery($page=1)
    {
        if($_POST){
		$kat=$this->request->post('kat');
		
		if($kat=='yes'){
			//new gallery
			$nama_kategori=ucwords($this->request->post('nama_kategori'));
			$keterangan=$this->request->post('keterangan');
			
			//prosesupload image_kat
			
				if( isset($_FILES['image_kat']) ) {
					$this->upload->setOption(
						array(
							'folderLocation' => 'upload/gallery/kategori',
							'autoRename' => true,
							'autoCreateFolder' => true,
							'permittedFileType' => 'gif|png|jpg|jpeg',
							'maximumSize' => 5000000, //5Mb
							)
						);
					
					$file_kat = $this->upload->now($_FILES['image_kat']);
					$nama_foto_kat=$this->upload->getFileInfo();
					
					
					if($file_kat) {
						$this->image
						->setOption(
							array(
							'editType' => PIMG_RESIZE,
							'folder' => 'upload/gallery/kategori',
							'resizeWidth' => 250,
							'resizeHeight' => 250
							)
						)
						->edit($nama_foto_kat['name']);
						//input kategori gallery
						$data_kategori=array(
							'nama_kategori'=>$nama_kategori,
							'image_kat'=>$nama_foto_kat['name'],
							'keterangan'=>$keterangan,
							'tgl_input'=>date('Y-m-d'),
						);						
						$last_kat_id=$this->gallery->input_kategori($data_kategori);
						
						//mulai upload image
						$pengulang=$this->request->post('pengulang');
						$i=0;
						foreach($pengulang as $pengulang){
							
						$keterangan_foto=$this->request->post('keterangan_foto');
							//prosesupload gallery
							$foto=$_FILES['foto'.$i.''];
								if(isset($foto)) {
									$this->upload->setOption(
										array(
											'folderLocation' => 'upload/gallery',
											'autoRename' => true,
											'autoCreateFolder' => true,
											'permittedFileType' => 'gif|png|jpg|jpeg',
											'maximumSize' => 5000000, //5Mb
										)
									);
									
									$file = $this->upload->now($foto);
									$nama_foto=$this->upload->getFileInfo();						
									
									if($file) {
										$this->image
										->setOption(
											array(
											'editType' => PIMG_RESIZE,
											'folder' => 'upload/gallery',
											'resizeWidth' => 250,
											'resizeHeight' => 250,
											'saveTo'=>'upload/gallery/thumbs',
											)
										)
										->edit($nama_foto['name']);
										//proses input gallery
										$data_gallery=array(
											'foto'=>$nama_foto['name'],
											'thumbs'=>$nama_foto['name'],
											'kategori'=>$last_kat_id,
											'keterangan'=>$keterangan_foto[$i],
											'tgl_input'=>date('Y-m-d'),
										);
											$this->gallery->input_gallery($data_gallery);
									}else{
									
										$data['alert']='
											<div class="alert alert-danger alert-dismissable">
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
											<h4>	<i class="icon fa fa-check"></i> Upload Foto Gagal</h4>
											'.$this->upload->getError('message').'
											</div>
											';
									//Tidak aeda file					
									}
														
								}else{
									$data['alert']='
										<div class="alert alert-danger alert-dismissable">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
										<h4><i class="icon fa fa-check"></i> Upload Foto Gagal</h4>
										
										</div>
										';
								} //if isset $foto
							$i++;
						} //END foreach
						
							
							
						$data['alert']='
						<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-check"></i> Upload Berhasil</h4>
						<p>Selamat anda berhasil Upload gallery.</p>
							</div>
						';
									
					}else{
						
						$data['alert']='
							<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<h4>	<i class="icon fa fa-check"></i> Upload gagal </h4>
							'.$this->upload->getError('message').'
							</div>
							';
					//Tidak aeda file					
					}
										
				} //if isset kategori
			//END UPLOAD kategori
			
			
		}else{
			//kategori yang sudah ada
			
			//mulai upload image
			$pengulang=$this->request->post('pengulang');
			$i=0;
			
			$id_kategori=$this->request->post('kategori_id');
			$last_kat_id=$id_kategori;
			foreach($pengulang as $pengulang){
				
			$keterangan_foto=$this->request->post('keterangan_foto');
				//prosesupload gallery
				$foto=$_FILES['foto'.$i.''];
					if(isset($foto)) {
						$this->upload->setOption(
							array(
								'folderLocation' => 'upload/gallery',
								'autoRename' => true,
								'autoCreateFolder' => true,
								'permittedFileType' => 'gif|png|jpg|jpeg',
								'maximumSize' => 5000000, //5Mb
							)
						);
						
						$file = $this->upload->now($foto);
						$nama_foto=$this->upload->getFileInfo();						
						
						if($file) {
							$this->image
							->setOption(
								array(
								'editType' => PIMG_RESIZE,
								'folder' => 'upload/gallery',
								'resizeWidth' => 250,
								'resizeHeight' => 250,
								'saveTo'=>'upload/gallery/thumbs',
								)
							)
							->edit($nama_foto['name']);
							//proses input gallery
							$data_gallery=array(
								'foto'=>$nama_foto['name'],
								'thumbs'=>$nama_foto['name'],
								'kategori'=>$id_kategori,
								'keterangan'=>$keterangan_foto[$i],
								'tgl_input'=>date('Y-m-d'),
							);
								$this->gallery->input_gallery($data_gallery);
						}else{
						
							$data['alert']='
								<div class="alert alert-danger alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<h4>	<i class="icon fa fa-check"></i> Upload Foto Gagal</h4>
								'.$this->upload->getError('message').'
								</div>
								';
						//Tidak aeda file					
						}
											
					}else{
						$data['alert']='
							<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<h4><i class="icon fa fa-check"></i> Upload Foto Gagal</h4>
							
							</div>
							';
					} //if isset $foto
				$i++;
			} //END foreach
			
		}
		$kategori_id=$last_kat_id;
		$kategori_view=base64_encode($kategori_id);
		//pagination
		$this->pagination = new Resources\Pagination();
        $page = (int) $page;
        $limit = 10;
		$total_gallery=$this->gallery->hitung_gallery_by_id($kategori_id);
		
		
		$data['viewall_gallery']=$this->gallery->viewall_gallery_page_by_kat(base64_decode($kategori_view),$page, $limit);
		$data['total_gallery'] = $total_gallery;
		$data['pageLinks'] = $this->pagination->setOption(
		array(
		    'limit' => $limit,
		    'base' => $this->uri->baseUri.'index.php/admin/gallery/index/view/'.$kategori_id.'%#%/',
			'total' => $total_gallery,	
		    'current' => $page,
			)
					)->getUrl(); 
		
		$data['no'] = ($page * $this->pagination->limit) - $this->pagination->limit;
		// end pagination
		
			$data['title'] = 'Data Gallery';
			$data['subtitle']= 'List data Gallery';
			$data['konten']='admin/konten/view_gallery';
			$penerima=$this->session->getValue('user_id');
			$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
			$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
			$data['menu']='gallery';
			$data['page']='gallery';
			$data['kategori_menu']=$this->gallery->viewall_kategori();
			$data['nama_kategori']=$this->gallery->nama_kategori($kategori_id)->nama_kategori;
			
			
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
			$penerima=$this->session->getValue('user_id');
			$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
			$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
			$data['menu']='about';
			$this->output('admin/index', $data);
		}
    }
	
	public function edit($kategori='')
    {
		if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2){
		$kategori=base64_decode($kategori);
		//echo $kategori;exit;
		$total_gallery=$this->gallery->hitung_gallery_by_id($kategori);
		
				
		$data['viewall_gallery']=$this->gallery->viewall_gallery_by_kat($kategori);
		$data['total_gallery'] = $total_gallery;			
		
		$data['title'] = 'Data Gallery';
		$data['subtitle']= 'List data Gallery';
		$data['konten']='admin/konten/edit_gallery';
		$penerima=$this->session->getValue('user_id');
		$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
		$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
		$data['menu']='gallery';
		$data['page']='gallery';
		$data['kategori_menu']=$this->gallery->viewall_kategori();
		$data['nama_kategori']=$this->gallery->nama_kategori($kategori)->nama_kategori;
		$data['viewall_kategori_by_id']=$this->gallery->viewall_kategori_by_id($kategori);
		
        $this->output('admin/index', $data);
		}else{
			$this->redirect('login');
		}
    }
	
	public function pro_edit_kat($kategori=''){
		if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2){
		
		if($_POST){
		
		$id=$this->request->post('id');
		
		$nama_kategori=ucwords($this->request->post('nama_kategori'));
		$keterangan_foto=$this->request->post('keterangan_foto');
		
		
		//prosesupload kategori		
		$this->upload->setOption(
			array(
				'folderLocation' => 'upload/gallery/kategori',
				'autoRename' => true,
				'autoCreateFolder' => true,
				'permittedFileType' => 'gif|png|jpg|jpeg',
				'maximumSize' => 5000000, //5Mb
			)
		);
		if(isset($_FILES['image_kat'])) {
			$file = $this->upload->now($_FILES['image_kat']);
			$nama_foto=$this->upload->getFileInfo();						
			
			if($file) {
				$this->image
				->setOption(
					array(
					'editType' => PIMG_RESIZE,
					'folder' => 'upload/gallery/kategori',
					'resizeWidth' => 250,
					'resizeHeight' => 250,
					)
				)
				->edit($nama_foto['name']);
				
				$image_katold=$this->request->post('image_katold');	
					if(file_exists('upload/gallery/kategori/'.$image_katold)){
						unlink('upload/gallery/kategori/'.$image_katold);
					}else{
						
					}
				//proses edit kategori
				$data_kategori=array(
					'nama_kategori'=>$nama_kategori,
					'image_kat'=>$nama_foto['name'],
					'keterangan'=>$keterangan_foto,
				);
				
					$this->gallery->edit_kategori($data_kategori,$id);
			}else{
			
				//proses edit kategori
				$data_kategori=array(
					'nama_kategori'=>$nama_kategori,
					'keterangan'=>$keterangan_foto,
				);
				
					$this->gallery->edit_kategori($data_kategori,$id);
					
			//Tidak ada file					
			}
								
		}else{
			$data['alert']='
				<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h4><i class="icon fa fa-check"></i> Upload Foto Gagal</h4>
				'.$this->upload->getError('message').'
				</div>
				';
		}
		
		$data['alert']='
			<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4>	<i class="icon fa fa-check"></i> Sukses..!</h4>
			Anda berhasil Edit Data Kategori.
			</div>
			';
		
		$kategori=base64_decode($kategori);
		
		$total_gallery=$this->gallery->hitung_gallery_by_id($kategori);
		
				
		$data['viewall_gallery']=$this->gallery->viewall_gallery_by_kat($kategori);
		$data['total_gallery'] = $total_gallery;			
		
		$data['title'] = 'Data Gallery';
		$data['subtitle']= 'List data Gallery';
		$data['konten']='admin/konten/edit_gallery';
		$penerima=$this->session->getValue('user_id');
		$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
		$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
		$data['menu']='gallery';
		$data['page']='gallery';
		$data['kategori_menu']=$this->gallery->viewall_kategori();
		$data['nama_kategori']=$this->gallery->nama_kategori($kategori)->nama_kategori;
		$data['viewall_kategori_by_id']=$this->gallery->viewall_kategori_by_id($kategori);
		
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
			$penerima=$this->session->getValue('user_id');
			$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
			$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
			$data['menu']='about';
			$this->output('admin/index', $data);
		}
		}else{
			$this->redirect('login');
		}
	}
	
	public function pro_edit_gallery($kategori=''){
		if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2){
		
		$kategori=base64_decode($kategori);
		if($_POST){
		
		$id=$this->request->post('id');
		
		$keterangan_foto=$this->request->post('keterangan_foto');
		
		
		//prosesupload gallery		
		$this->upload->setOption(
			array(
				'folderLocation' => 'upload/gallery',
				'autoRename' => true,
				'autoCreateFolder' => true,
				'permittedFileType' => 'gif|png|jpg|jpeg',
				'maximumSize' => 5000000, //5Mb
			)
		);
		if(isset($_FILES['foto'])) {
			$file = $this->upload->now($_FILES['foto']);
			$nama_foto=$this->upload->getFileInfo();						
			
			if($file) {
				$this->image
				->setOption(
					array(
					'editType' => PIMG_RESIZE,
					'folder' => 'upload/gallery',
					'resizeWidth' => 250,
					'resizeHeight' => 250,
					'saveTo'=>'upload/gallery/thumbs',
					)
				)
				->edit($nama_foto['name']);
				
				$foto_old=$this->request->post('foto_old');	
					if(file_exists('upload/gallery/'.$foto_old)){
						unlink('upload/gallery/'.$foto_old);						
					}else{
						
					}
					if(file_exists('upload/gallery/thumbs/'.$foto_old)){
							unlink('upload/gallery/thumbs/'.$foto_old);
						}else{
							
						}
				//proses edit gallery
				$data_gallery=array(
					'foto'=>$nama_foto['name'],
					'thumbs'=>$nama_foto['name'],
					'kategori'=>$kategori,
					'keterangan'=>$keterangan_foto,
				);
				
					$this->gallery->edit_gallery($data_gallery,$id);
			}else{
			//Tidak ada file	
				//proses edit kategori
				$data_gallery=array(
					'kategori'=>$kategori,
					'keterangan'=>$keterangan_foto,
				);
				
					$this->gallery->edit_gallery($data_gallery,$id);
					
							
			}
								
		}else{
			$data['alert']='
				<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h4><i class="icon fa fa-check"></i> Upload Foto Gagal</h4>
				'.$this->upload->getError('message').'
				</div>
				';
		}
		
		$data['alert']='
			<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4>	<i class="icon fa fa-check"></i> Sukses..!</h4>
			Anda berhasil Edit Data Kategori.
			</div>
			';
				
		$total_gallery=$this->gallery->hitung_gallery_by_id($kategori);
		
				
		$data['viewall_gallery']=$this->gallery->viewall_gallery_by_kat($kategori);
		$data['total_gallery'] = $total_gallery;			
		
		$data['title'] = 'Data Gallery';
		$data['subtitle']= 'List data Gallery';
		$data['konten']='admin/konten/edit_gallery';
		$penerima=$this->session->getValue('user_id');
		$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
		$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
		$data['menu']='gallery';
		$data['page']='gallery';
		$data['kategori_menu']=$this->gallery->viewall_kategori();
		$data['nama_kategori']=$this->gallery->nama_kategori($kategori)->nama_kategori;
		$data['viewall_kategori_by_id']=$this->gallery->viewall_kategori_by_id($kategori);
		
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
			$penerima=$this->session->getValue('user_id');
			$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
			$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
			$data['menu']='about';
			$this->output('admin/index', $data);
		}
		}else{
			$this->redirect('login');
		}
	}
	
	
	public function hapus_gallery($id='',$kategori='')
    {
		if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2){
		$id=base64_decode($id);
		$kategori=base64_decode($kategori);
		$cek_id_and_kategori=$this->gallery->cek_id_and_kategori($id,$kategori);
		
		if($cek_id_and_kategori){
			$foto=$this->gallery->view_foto_by_id($id)->foto;
			if($foto){
				if(file_exists('upload/gallery/'.$foto)){
						unlink('upload/gallery/'.$foto);						
					}else{
						
					}
					if(file_exists('upload/gallery/thumbs/'.$foto)){
							unlink('upload/gallery/thumbs/'.$foto);
					}else{
						
					}
				
				$this->gallery->hapus_gallery($id);
				$data['alert']='
				<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4>	<i class="icon fa fa-check"></i> Sukses..!</h4>
				Anda berhasil Hapus Gallery.
				</div>
				';
			}else{
			}			
			
			
		}else{
			$data['alert']='
			<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4>	<i class="icon fa fa-check"></i> Gagal..!</h4>
			Maaf foto yang anda pilih tidak ada.
			</div>
			';
		}
		
				
		$total_gallery=$this->gallery->hitung_gallery_by_id($kategori);
		
				
		$data['viewall_gallery']=$this->gallery->viewall_gallery_by_kat($kategori);
		$data['total_gallery'] = $total_gallery;			
		
		$data['title'] = 'Data Gallery';
		$data['subtitle']= 'List data Gallery';
		$data['konten']='admin/konten/edit_gallery';
		$penerima=$this->session->getValue('user_id');
		$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
		$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
		$data['menu']='gallery';
		$data['page']='gallery';
		$data['kategori_menu']=$this->gallery->viewall_kategori();
		$data['nama_kategori']=$this->gallery->nama_kategori($kategori)->nama_kategori;
		$data['viewall_kategori_by_id']=$this->gallery->viewall_kategori_by_id($kategori);
		
        $this->output('admin/index', $data);
		}else{
			$this->redirect('login');
		}
    }
}
