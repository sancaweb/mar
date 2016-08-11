<div class="box box-warning direct-chat direct-chat-warning">
<div class="box-header with-border">
  <h3 class="box-title">Direct Chat</h3>
  <div class="box-tools pull-right">
  <a href="<?php echo $this->uri->baseUri;?>index.php/admin/pesan" type="button" class="btn btn-primary btn-flat btn-xs">
	  <i class="fa fa-envelope-o" aria-hidden="true"></i>
	  &nbsp;View Inbox</a>
	  <a href="<?php echo $this->uri->baseUri;?>index.php/admin/pesan/sentitems" type="button" class="btn btn-primary btn-flat btn-xs">
	  <i class="fa fa-share" aria-hidden="true"></i> &nbsp;View Sentitems</a>
	<span data-toggle="tooltip" title="<?php echo $total_pesan;?> Pesan dalam percakapan ini" class="badge bg-yellow"><?php echo $total_pesan;?>&nbsp;<i class="fa fa-envelope-o"></i></span>	  
	<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
	<button class="btn btn-box-tool" data-toggle="tooltip" title="<?php echo $total_pesan_belum_terbaca;?> Pesan belum dibaca" data-widget="chat-pane-toggle"><i class="fa fa-comments"></i></button>
	<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
  </div>
</div><!-- /.box-header -->
<div class="box-body">
  <!-- Conversations are loaded here -->
  <div class="direct-chat-messages">
	<!-- Message. Default to the left -->
	<?php
		$user_id=$this->session->getValue('user_id');
		if($data_pesan){
			foreach($data_pesan as $data){
				if($data->pengirim==$user_id){
					$class="right";
					$cek_pengguna=$this->user->cek_pengguna_by_userid($user_id);
					if($cek_pengguna){
						$cek_user_level_by_userid=$this->user->cek_user_level_by_userid($user_id)->user_level;
						$user_level=$this->user->ambil_user_level($this->session->getValue('user_level'))->ket;
						$foto=$this->user->view_foto($user_id);
						if($foto->foto==''){
							$foto='blank.png';
						}else{
							$foto=$foto->foto;
						}
					}else{
						$foto='blank.png';
					}
				}else{
					$class="";
					$cek_pengguna=$this->user->cek_pengguna_by_userid($data->pengirim);
					if($cek_pengguna){
						$foto=$this->user->view_foto($data->pengirim);
						
						$cek_user_level_by_userid=$this->user->cek_user_level_by_userid($data->pengirim)->user_level;
						$user_level=$this->user->ambil_user_level($cek_user_level_by_userid)->ket;
						if($foto->foto==''){
							$foto='blank.png';
						}else{
							$foto=$foto->foto;
						}
					}else{
						$foto='blank.png';
						$user_level='Guest';
					}
				}
				
				
				
				?>
				<div class="direct-chat-msg <?php echo $class;?>">
				  <div class="direct-chat-info clearfix">
					<span class="direct-chat-name pull-left"><?php echo $data->nama.' ( '.$user_level.' )';?></span>
					<span class="direct-chat-timestamp pull-right"><?php echo date('d-M-Y',strtotime($data->tgl_input));?></span>
				  </div><!-- /.direct-chat-info -->
				  <img class="direct-chat-img" src="<?php echo $this->uri->baseUri;?>upload/user/<?php echo $foto;?>" alt="message user image"><!-- /.direct-chat-img -->
				  <div class="direct-chat-text">
					<?php echo $data->isi_pesan;?>
				  </div><!-- /.direct-chat-text -->
				</div><!-- /.direct-chat-msg -->
				<?php
			}
		}else{
			?>
			<!-- Message. Default to the left -->
			<div class="direct-chat-msg">
			  <div class="direct-chat-info clearfix">
				<span class="direct-chat-name pull-left">Tidak ada pesan</span>
				<span class="direct-chat-timestamp pull-right">Tidak ada pesan</span>
			  </div><!-- /.direct-chat-info -->
			  
			  <div class="direct-chat-text">
				Tidak ada pesan
			  </div><!-- /.direct-chat-text -->
			</div><!-- /.direct-chat-msg -->
			<?php
		}
	?>

	</div>

	
  <!-- Contacts are loaded here -->
  <div class="direct-chat-contacts">
	<ul class="contacts-list">
	<?php if($loader_pesan){
		foreach($loader_pesan as $loader_pesan){
			
					$cek_pengguna=$this->user->cek_pengguna_by_userid($loader_pesan->pengirim);
					if($cek_pengguna){
						$foto=$this->user->view_foto($loader_pesan->pengirim);
						
						$cek_user_level_by_userid=$this->user->cek_user_level_by_userid($loader_pesan->pengirim)->user_level;
						$user_level=$this->user->ambil_user_level($cek_user_level_by_userid)->ket;
						if($foto->foto==''){
							$foto='blank.png';
						}else{
							$foto=$foto->foto;
						}
					}else{
						$foto='blank.png';
						$user_level='Guest';
					}
			?>
			<li>
				<a href="<?php echo $this->uri->baseUri;?>index.php/admin/pesan/view_pesan/<?php echo base64_encode($loader_pesan->id_pesan).'/'.base64_encode($loader_pesan->id);?>">
				  <img class="contacts-list-img" src="<?php echo $this->uri->baseUri;?>upload/user/<?php echo $foto;?>">
				  <div class="contacts-list-info">
					<span class="contacts-list-name">
					  <?php echo $loader_pesan->nama;?>
					  <small class="contacts-list-date pull-right"><?php echo date('d-M-Y',strtotime($loader_pesan->tgl_input));?></small>
					</span>
					<span class="contacts-list-msg"><?php echo $this->readmore->readmore($loader_pesan->isi_pesan,20);?> ...</span>
				  </div><!-- /.contacts-list-info -->
				</a>
			  </li><!-- End Contact Item -->
			<?php
		}
	}else{
		?>
		<li>
			<a href="#">
			  <img class="contacts-list-img" src="<?php echo $this->uri->baseUri;?>upload/user/blank.png">
			  <div class="contacts-list-info">
				<span class="contacts-list-name">
				  Tidak ada pesan baru yang belum dijawab...
				</span>
			  </div><!-- /.contacts-list-info -->
			</a>
		  </li><!-- End Contact Item -->
		<?php
	}
		
	?>
	  
	</ul><!-- /.contatcts-list -->
  </div><!-- /.direct-chat-pane -->
</div><!-- /.box-body -->
<div class="box-footer">
  <form id="form_penerima_voucher" data-toggle="validator" enctype="multipart/form-data" role="form" method="POST" action="<?php echo $this->uri->baseUri;?>index.php/admin/pesan/balas_pesan">
	<input name="id_pesan" class="form-control" value="<?php echo $id_pesan;?>" type="hidden">
	<input name="pengirim" class="form-control" value="<?php echo $this->session->getValue('user_id');?>" type="hidden">
	<input name="kepada" class="form-control" value="<?php echo $data_balas_pesan->pengirim;?>" type="hidden">
	<input name="nama" class="form-control" value="<?php echo $nama;?>" type="hidden">
	<input name="email" class="form-control" value="<?php echo $email;?>" type="hidden">
	<input name="subjek" class="form-control" value="<?php echo 'Replay:'.$data_balas_pesan->subjek;?>" type="hidden">
	<input name="id" class="form-control" value="<?php echo $data_balas_pesan->id;?>" type="hidden">
	<div class="input-group">
	  <input name="isi_pesan" placeholder="Type Message ..." class="form-control" type="text" required>
	  <span class="input-group-btn">
		<button type="submit" class="btn btn-warning btn-flat">Send</button>
	  </span>
	</div>
  </form>
</div><!-- /.box-footer-->
</div>