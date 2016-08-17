<?php
namespace Controllers\admin;
use Resources, Models, Libraries;

class Pengaturan extends Resources\Controller
{
    public function __construct(){
        
        parent::__construct();
		$this->session = new Resources\Session;
		$this->request=new Resources\Request;
		$this->readmore = new Libraries\Readmore;
		$this->randomstring = new Libraries\Randomstring;
		$this->pengaturan = new Models\Pengaturan;				
		$this->pesan = new Models\Pesan;				
		$this->user = new Models\User;				
		$this->upload = new Resources\Upload;
		$this->pembayaran=new Models\Pembayaran;
		$this->registrasi=new Models\Registrasi;
    }
	
	public function index()
    {
        if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2){
		$data['title'] = 'Pengaturan';
		$data['subtitle']= 'Pengaturan';
		$data["page"]='pengaturan';
		$data['konten']='admin/konten/pengaturan';
		$penerima=$this->session->getValue('user_id');
		$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
		$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
		$data['menu']='pengaturan';		

        $this->output('admin/index', $data);
		}else{
			$this->redirect('login');
		}
    }
		
	public function slide()
    {
        if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2){
		$data['title'] = 'Pengaturan Slider';
		$data['subtitle']= 'Pengaturan';
		$data["page"]='slide';
		$data['konten']='admin/konten/slide';
		$penerima=$this->session->getValue('user_id');
		$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
		$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
		$data['menu']='slide';
		$data['viewall_slide']=$this->pengaturan->viewall_slide();
		
		

        $this->output('admin/index', $data);
		}else{
			$this->redirect('login');
		}
    }
	
	public function input_slide()
    {
		if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2){
		if($_POST){
		$blok=$this->request->post('blok');
		$title=$this->request->post('title');
		$keterangan=$this->request->post('keterangan');
		$url=$this->request->post('url');
		$url_text=$this->request->post('url_text');
		
		//prosesupload
		
					
		
			if( isset($_FILES['image']) ) {
				$this->upload->setOption(
					array(
						'folderLocation' => 'upload/slider',
						'autoRename' => true,
						'autoCreateFolder' => true,
						'permittedFileType' => 'gif|png|jpg|jpeg',
						'maximumSize' => 5000000, //5Mb
						'editImage' => array(
							'editType' => PIMG_RESIZE,
							'resizeWidth' => 1600,
							'resizeHeight' => 780,
						),
					)
				);	
				
				$file = $this->upload->now($_FILES['image']);
				$nama_foto=$this->upload->getFileInfo();						
				
				if($file) {
					//input
						$data_slide=array(
							'blok'=>$blok,
							'title'=>$title,
							'keterangan'=>$keterangan,
							'url'=>$url,
							'url_text'=>$url_text,
							'image'=>$nama_foto['name'],
							
						);
						$this->pengaturan->input_slide($data_slide);
					$data['alert']='
						<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4>	<i class="icon fa fa-check"></i> Sukses..!</h4>
						Anda berhasil input Data Slider.
						</div>
					';		
				}else{
				
					$data['alert']='
						<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<h4>	<i class="icon fa fa-check"></i> Input gagal</h4>
						'.$this->upload->getError('message').'
						</div>
						';
				//Tidak ada file					
				}
									
			} //if isset $foto
		//END UPLOAD
				
		
		$data['title'] = 'Pengaturan Slider';
		$data['subtitle']= 'Pengaturan';
		$data["page"]='slide';
		$data['konten']='admin/konten/slide';
		$penerima=$this->session->getValue('user_id');
		$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
		$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
		$data['menu']='slide';
		$data['viewall_slide']=$this->pengaturan->viewall_slide();
		
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
	
	public function edit_slide()
    {
		if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2){
		if($_POST){
		$id=$this->request->post('id');
		$blok=$this->request->post('blok');
		$title=$this->request->post('title');
		$keterangan=$this->request->post('keterangan');
		$url=$this->request->post('url');
		$url_text=$this->request->post('url_text');
		//prosesupload
		$this->upload->setOption(
			array(
				'folderLocation' => 'upload/slider',
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
					$image_old=$this->request->post('image_old');	
					if(file_exists('upload/slider/'.$image_old)){
						unlink('upload/slider/'.$image_old);
					}else{
						
					}
									
						
					//input
						$data_slide=array(
							'blok'=>$blok,
							'title'=>$title,
							'keterangan'=>$keterangan,
							'url'=>$url,
							'url_text'=>$url_text,
							'image'=>$nama_foto['name'],
							
						);
						
						$this->pengaturan->edit_slide($data_slide,$id);
						
				
					$data['alert']='
						<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4>	<i class="icon fa fa-check"></i> Sukses..!</h4>
						Anda berhasil Edit Data Slider.
						</div>
					';		
				}else{
				$image_old=$this->request->post('image_old');
					$data_slide=array(
							'blok'=>$blok,
							'title'=>$title,
							'keterangan'=>$keterangan,
							'url'=>$url,
							'url_text'=>$url_text,
							'image'=>$image_old,
							
						);
						
						$this->pengaturan->edit_slide($data_slide,$id);
						
					$data['alert']='
						<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4>	<i class="icon fa fa-check"></i> Sukses..!</h4>
						Anda berhasil Edit Data Slider.
						</div>
					';	
				//Tidak ada file					
				}
									
			} //if isset $foto
		//END UPLOAD
				
		
		$data['title'] = 'Pengaturan Slider';
		$data['subtitle']= 'Pengaturan';
		$data["page"]='slide';
		$data['konten']='admin/konten/slide';
		$penerima=$this->session->getValue('user_id');
		$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
		$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
		$data['menu']='slide';
		$data['viewall_slide']=$this->pengaturan->viewall_slide();
		
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
	
	public function hapus_slide($id='')
    {
		if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2){
		$id=base64_decode($id);
        $cek_id=$this->pengaturan->view_id_slide_by_id($id);
		
		if($cek_id){
			$data['title'] = 'Pengaturan Slider';
			$data['subtitle']= 'Pengaturan';
			$data["page"]='slide';
			$data['konten']='admin/konten/slide';
			$penerima=$this->session->getValue('user_id');
			$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
			$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
			$data['menu']='slide';
			$data['viewall_slide']=$this->pengaturan->viewall_slide();
			
			$image=$this->pengaturan->image_slide_by_id($id)->image;
			if(file_exists('upload/slider/'.$image)){
			unlink('upload/slider/'.$image);
				
			}else{
				
			}
			
			$this->pengaturan->hapus_slide($id);
		
		
			$data['alert']='
				<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4>	<i class="icon fa fa-check"></i> Sukses..!</h4>
				Anda berhasil Hapus Data Informasi Profile.
				</div>
			';

			$this->output('admin/index', $data);
		}else{
			$data['alert']='
			<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4><i class="icon fa fa-check"></i> Error ...!</h4>
			<p>Slider yang anda tuju tidak ada</p>
			</div>';
			$data['title'] = 'Pengaturan Slider';
			$data['subtitle']= 'Pengaturan';
			$data["page"]='slide';
			$data['konten']='admin/konten/slide';
			$penerima=$this->session->getValue('user_id');
			$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
			$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
			$data['menu']='slide';
			$data['viewall_slide']=$this->pengaturan->viewall_slide();
		
			$this->output('admin/index', $data);
		}
		}else{
			$this->redirect('login');
		}
		
    }
	
	//header
	public function img_header(){
		if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2){
		$data['title'] = 'Pengaturan Header';
		$data['subtitle']= 'Pengaturan';
		$data["page"]='header';
		$data['konten']='admin/konten/header';
		$penerima=$this->session->getValue('user_id');
		$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
		$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
		$data['menu']='header';
		$data['viewall_header']=$this->pengaturan->viewall_header();
	
		$this->output('admin/index', $data);
		}else{
			$this->redirect('login');
		}
	}
	
	public function input_header()
    {
		
		if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2){
		if($_POST){
		//prosesupload
			if( isset($_FILES['image']) ) {
				$this->upload->setOption(
					array(
						'folderLocation' => 'upload/header',
						'autoRename' => true,
						'autoCreateFolder' => true,
						'permittedFileType' => 'gif|png|jpg|jpeg',
						'maximumSize' => 5000000, //5Mb
						'editImage' => array(
							'editType' => PIMG_RESIZE,
							'resizeWidth' => 1280,
							'resizeHeight' => 400,
							)
					)
				);	
				
				$file = $this->upload->now($_FILES['image']);
				$nama_foto=$this->upload->getFileInfo();						
				
				if($file) {
					//input
						$input_header=array(
							'image'=>$nama_foto['name'],
						);
						$this->pengaturan->input_header($input_header);
					$data['alert']='
						<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4>	<i class="icon fa fa-check"></i> Sukses..!</h4>
						Anda berhasil input Data Image Header.
						</div>
					';		
				}else{
				
					$data['alert']='
						<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<h4>	<i class="icon fa fa-check"></i> Input gagal</h4>
						'.$this->upload->getError('message').'
						</div>
						';
				//Tidak ada file					
				}
									
			} //if isset $foto
		//END UPLOAD
				
		
		$data['title'] = 'Pengaturan Header';
		$data['subtitle']= 'Pengaturan';
		$data["page"]='header';
		$data['konten']='admin/konten/header';
		$penerima=$this->session->getValue('user_id');
		$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
		$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
		$data['menu']='header';
		$data['viewall_header']=$this->pengaturan->viewall_header();
	
		$this->output('admin/index', $data);
		}else{
			$data['alert']='
			<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4><i class="icon fa fa-check"></i> Error ...!</h4>
			<p>Halaman yang anda tuju tidak ada.</p>
			</div>';
			$data['title'] = 'Error';
			$data['subtitle']= 'Halaman utama';
			$data["page"]='error';
			$data['konten']='admin/konten/error';
			$penerima=$this->session->getValue('user_id');
			$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
			$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
			$data['menu']='header';
			$this->output('admin/index', $data);
		}
		}else{
			$this->redirect('login');
		}
    }
	
	
	public function edit_header()
    {
		if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2){
		if($_POST){
		$id=$this->request->post('id');
		//prosesupload
		$this->upload->setOption(
			array(
				'folderLocation' => 'upload/header',
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
					$image_old=$this->request->post('image_old');	
					if(file_exists('upload/header/'.$image_old)){
						unlink('upload/header/'.$image_old);
					}else{
						
					}
									
						
					//Edit
						$data_header=array(
							'image'=>$nama_foto['name'],
							
						);
						
						$this->pengaturan->edit_header($data_header,$id);
						
				
					$data['alert']='
						<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4>	<i class="icon fa fa-check"></i> Sukses..!</h4>
						Anda berhasil Edit Data Header.
						</div>
					';		
				}else{
				$image_old=$this->request->post('image_old');
					$data_header=array(
							'image'=>$image_old,
							
						);
						
						$this->pengaturan->edit_header($data_header,$id);
						
					$data['alert']='
						<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4>	<i class="icon fa fa-check"></i> Sukses..!</h4>
						Anda berhasil Edit Data Header.
						</div>
					';	
				//Tidak ada file					
				}
									
			} //if isset $foto
		//END UPLOAD
				
		
		$data['title'] = 'Pengaturan Header';
		$data['subtitle']= 'Pengaturan';
		$data["page"]='header';
		$data['konten']='admin/konten/header';
		$penerima=$this->session->getValue('user_id');
		$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
		$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
		$data['menu']='header';
		$data['viewall_header']=$this->pengaturan->viewall_header();
	
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
	
	public function hapus_header($id='')
    {
		if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')){
		$id=base64_decode($id);
        $cek_id=$this->pengaturan->view_id_header_by_id($id);
		
		if($cek_id){
			
			
			$image=$this->pengaturan->image_header_by_id($id)->image;
			if(file_exists('upload/header/'.$image)){
			unlink('upload/header/'.$image);
				
			}else{
				
			}
			
			$this->pengaturan->hapus_header($id);
		
		
			$data['alert']='
				<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4>	<i class="icon fa fa-check"></i> Sukses..!</h4>
				Anda berhasil Hapus Data Header.
				</div>
			';
			$data['title'] = 'Pengaturan Header';
			$data['subtitle']= 'Pengaturan';
			$data["page"]='header';
			$data['konten']='admin/konten/header';
			$penerima=$this->session->getValue('user_id');
			$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
			$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
			$data['menu']='header';
			$data['viewall_header']=$this->pengaturan->viewall_header();
			$this->output('admin/index', $data);
		}else{
			$data['alert']='
			<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4><i class="icon fa fa-check"></i> Error ...!</h4>
			<p>Halaman yang anda tuju tidak ada</p>
			</div>';
			$data['title'] = 'Pengaturan Header';
			$data['subtitle']= 'Pengaturan';
			$data["page"]='header';
			$data['konten']='admin/konten/header';
			$penerima=$this->session->getValue('user_id');
			$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
			$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
			$data['menu']='header';
			$data['viewall_header']=$this->pengaturan->viewall_header();
		
			$this->output('admin/index', $data);
		}
		}else{
			$this->redirect('login');
		}
    }
	
	//PARTNER
	public function partner($page=1){
		if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2){
		
		 //pagination
		$this->pagination = new Resources\Pagination();
        $page = (int) $page;
        $limit = 6;
		$total_partner=$this->pengaturan->hitung_partner();
		
				
		$data['viewall_partner']=$this->pengaturan->viewall_partner_page($page, $limit);
		$data['total_partner'] = $total_partner;
		$data['pageLinks'] = $this->pagination->setOption(
		array(
		    'limit' => $limit,
		    'base' => $this->uri->baseUri.'index.php/admin/pengaturan/partner/%#%/',
			'total' => $total_partner,	
		    'current' => $page,
			)
					)->getUrl(); 
		
		$data['no'] = ($page * $this->pagination->limit) - $this->pagination->limit;
		// end pagination
		
		$data['title'] = 'Data Partner';
		$data['subtitle']= 'List data Partner';
		$data['konten']='admin/konten/partner';
		$penerima=$this->session->getValue('user_id');
		$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
		$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
		$data['menu']='partner';
		$data['page']='partner';
		
        $this->output('admin/index', $data);
		}else{
			$this->redirect('login');
		}
	}
	
	public function input_partner($page=1){
		if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2){
		if($_POST){
			
			$nama_partner=ucwords($this->request->post('nama_partner'));
			$url=$this->request->post('url');
		//prosesupload partner
			if(isset($_FILES['image'])) {
				$this->upload->setOption(
					array(
						'folderLocation' => 'upload/partner',
						'autoRename' => true,
						'autoCreateFolder' => true,
						'permittedFileType' => 'gif|png|jpg|jpeg',
						'maximumSize' => 5000000, //5Mb
						'editImage' => array(
							'editType' => PIMG_RESIZE,
							'resizeWidth' => 200,
							'resizeHeight' => 200,
							)
					)
				);
				
				$file = $this->upload->now($_FILES['image']);
				$nama_foto=$this->upload->getFileInfo();						
				
				if($file) {
					
					//proses input partner
					$data_partner=array(
						'image'=>$nama_foto['name'],
						'nama_partner'=>$nama_partner,
						'url'=>$url,
						'tgl_input'=>date('Y-m-d'),
					);
						$this->pengaturan->input_partner($data_partner);
						
					$data['alert']='
						<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-check"></i> Input Berhasil</h4>
						<p>Selamat anda berhasil Input Data Partner.</p>
							</div>
						';
						
				}else{
				
					$data['alert']='
						<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<h4>	<i class="icon fa fa-check"></i> Input Partner Gagal</h4>
						'.$this->upload->getError('message').'
						</div>
						';
				//Tidak aeda file					
				}
									
			}else{
				$data['alert']='
					<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h4><i class="icon fa fa-check"></i> Upload Data Partner Gagal</h4>
					
					</div>
					';
			} //end upload
			
		 //pagination
		$this->pagination = new Resources\Pagination();
        $page = (int) $page;
        $limit = 6;
		$total_partner=$this->pengaturan->hitung_partner();
		
				
		$data['viewall_partner']=$this->pengaturan->viewall_partner_page($page, $limit);
		$data['total_partner'] = $total_partner;
		$data['pageLinks'] = $this->pagination->setOption(
		array(
		    'limit' => $limit,
		    'base' => $this->uri->baseUri.'index.php/admin/pengaturan/partner/%#%/',
			'total' => $total_partner,	
		    'current' => $page,
			)
					)->getUrl(); 
		
		$data['no'] = ($page * $this->pagination->limit) - $this->pagination->limit;
		// end pagination
		
		$data['title'] = 'Data Partner';
		$data['subtitle']= 'List data Partner';
		$data['konten']='admin/konten/partner';
		$penerima=$this->session->getValue('user_id');
		$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
		$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
		$data['menu']='partner';
		$data['page']='partner';
		
        $this->output('admin/index', $data);
		}else{
			$data['alert']='
			<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4><i class="icon fa fa-check"></i> Error ...</h4>
			<p>Halaman yang anda tuju tidak ada.</p>
			
			
			</div></a>
			';
			
			$data['title'] = 'Error PAge';
			$data['subtitle']= 'Halaman utama';
			$data["page"]='error';
			$data['konten']='admin/konten/error';
			$penerima=$this->session->getValue('user_id');
			$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
			$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
			$data['menu']='partner';
			
			$this->output('admin/index', $data);
		}
		}else{
			$this->redirect('login');
		}
	}
	
	public function edit_partner($page=1){
		if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2){
		if($_POST){
			
			$nama_partner=ucwords($this->request->post('nama_partner'));
			$url=$this->request->post('url');
			$id=$this->request->post('id');
		//prosesupload partner
			if(isset($_FILES['image'])) {
				$this->upload->setOption(
					array(
						'folderLocation' => 'upload/partner',
						'autoRename' => true,
						'autoCreateFolder' => true,
						'permittedFileType' => 'gif|png|jpg|jpeg',
						'maximumSize' => 5000000, //5Mb
						'editImage' => array(
							'editType' => PIMG_RESIZE,
							'resizeWidth' => 200,
							'resizeHeight' => 200,
							)
					)
				);
				
				$file = $this->upload->now($_FILES['image']);
				$nama_foto=$this->upload->getFileInfo();						
				
				if($file) {
					$image_old=$this->request->post('image_old');
					if(file_exists('upload/partner/'.$image_old)){
						unlink('upload/partner/'.$image_old);
					}else{
						
					}
					//proses edit partner
					$data_partner=array(
						'image'=>$nama_foto['name'],
						'nama_partner'=>$nama_partner,
						'url'=>$url,
					);
						$this->pengaturan->edit_partner($data_partner,$id);
						
					$data['alert']='
						<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-check"></i> Edit Berhasil</h4>
						<p>Selamat anda berhasil Edit Data Partner.</p>
							</div>
						';
						
				}else{
				
				//Tidak aeda file
					//proses edit partner
					$data_partner=array(
						'nama_partner'=>$nama_partner,
						'url'=>$url,
					);
						$this->pengaturan->edit_partner($data_partner,$id);
						
					$data['alert']='
						<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-check"></i> Edit Berhasil</h4>
						<p>Selamat anda berhasil Edit Data Partner.</p>
							</div>
						';					
				}
									
			}else{
				$data['alert']='
					<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h4><i class="icon fa fa-check"></i> Edit Data Partner Gagal</h4>
					
					</div>
					';
			} //end upload
			
		 //pagination
		$this->pagination = new Resources\Pagination();
        $page = (int) $page;
        $limit = 6;
		$total_partner=$this->pengaturan->hitung_partner();
		
				
		$data['viewall_partner']=$this->pengaturan->viewall_partner_page($page, $limit);
		$data['total_partner'] = $total_partner;
		$data['pageLinks'] = $this->pagination->setOption(
		array(
		    'limit' => $limit,
		    'base' => $this->uri->baseUri.'index.php/admin/pengaturan/partner/%#%/',
			'total' => $total_partner,	
		    'current' => $page,
			)
					)->getUrl(); 
		
		$data['no'] = ($page * $this->pagination->limit) - $this->pagination->limit;
		// end pagination
		
		$data['title'] = 'Data Partner';
		$data['subtitle']= 'List data Partner';
		$data['konten']='admin/konten/partner';
		$penerima=$this->session->getValue('user_id');
		$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
		$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
		$data['menu']='partner';
		$data['page']='partner';
		
        $this->output('admin/index', $data);
		}else{
			$data['alert']='
			<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4><i class="icon fa fa-check"></i> Error ...</h4>
			<p>Halaman yang anda tuju tidak ada.</p>
			</div>
			';
			
			$data['title'] = 'Error PAge';
			$data['subtitle']= 'Halaman utama';
			$data["page"]='error';
			$data['konten']='admin/konten/error';
			$penerima=$this->session->getValue('user_id');
			$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
			$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
			$data['menu']='partner';
			
			$this->output('admin/index', $data);	
		}
		}else{
			$this->redirect('login');
		}
	}
	
	public function hapus_partner($id=''){
		if($this->session->getValue('user_level')==1 ||  $this->session->getValue('user_level')==2){
		$id=base64_decode($id);
		$cek_partner_by_id=$this->pengaturan->cek_partner_by_id($id);
		if($cek_partner_by_id){
			//id ada
			$image=$cek_partner_by_id->image;
			if(file_exists('upload/partner/'.$image)){
				unlink('upload/partner/'.$image);
			}else{
				
			}
			$this->pengaturan->hapus_partner($id);
			
			$page=1;
			 //pagination
			$this->pagination = new Resources\Pagination();
			$page = (int) $page;
			$limit = 6;
			$total_partner=$this->pengaturan->hitung_partner();
			
					
			$data['viewall_partner']=$this->pengaturan->viewall_partner_page($page, $limit);
			$data['total_partner'] = $total_partner;
			$data['pageLinks'] = $this->pagination->setOption(
			array(
				'limit' => $limit,
				'base' => $this->uri->baseUri.'index.php/admin/pengaturan/partner/%#%/',
				'total' => $total_partner,	
				'current' => $page,
				)
						)->getUrl(); 
			
			$data['no'] = ($page * $this->pagination->limit) - $this->pagination->limit;
			// end pagination
			
			$data['title'] = 'Data Partner';
			$data['subtitle']= 'List data Partner';
			$data['konten']='admin/konten/partner';
			$penerima=$this->session->getValue('user_id');
			$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
			$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
			$data['menu']='partner';
			$data['page']='partner';
			
			$this->output('admin/index', $data);
			
		}else{
			//id gk ada
			
			$data['alert']='
			<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4><i class="icon fa fa-check"></i> Error ...</h4>
			<p>Halaman yang anda tuju tidak ada.</p>
			
			
			</div></a>
			';
			
			$data['title'] = 'Error PAge';
			$data['subtitle']= 'Halaman utama';
			$data["page"]='error';
			$data['konten']='admin/konten/error';
			$penerima=$this->session->getValue('user_id');
			$data['total_pesan_belum_terbaca']=$this->pesan->hitung_pesan_status_by_penerima($penerima);
			$data['loader_pesan']=$this->pesan->viewall_pesan_by_penerima($penerima);
			$data['menu']='partner';
			
			$this->output('admin/index', $data);
		}
		}else{
			$this->redirect('login');
		}
		
		 
	}
	
	
}
