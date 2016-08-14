<div class="box box-warning direct-chat direct-chat-warning">
<div class="box-header with-border">
  <h3 class="box-title">Direct Chat</h3>
  <div class="box-tools pull-right">
  
	<span data-toggle="tooltip" title="<?php echo $total_pesan;?> Pesan dalam percakapan ini" class="badge bg-yellow">
	<?php echo $total_pesan;?>&nbsp;<i class="fa fa-envelope-o"></i> &nbsp; Pesan dalam percakapan ini
	</span>		
	<a class="btn btn-danger btn-xs" href="<?php echo $this->uri->baseUri;?>index.php/pesan/view_pesan/<?php echo base64_encode($id_pesan).'/'.base64_encode($data_balas_pesan->id);?>">
	
	<i class="fa fa-refresh" aria-hidden="true"></i> &nbsp; Reload Message	 
	</a>
	
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

</div><!-- /.box-body -->
<div class="box-footer">
  <form id="form_penerima_voucher" data-toggle="validator" enctype="multipart/form-data" role="form" method="POST" action="<?php echo $this->uri->baseUri;?>index.php/pesan/balas_pesan">
	<input name="id_pesan" class="form-control" value="<?php echo $id_pesan;?>" type="hidden">
	<input name="pengirim" class="form-control" value="<?php echo $this->session->getValue('user_id');?>" type="hidden">
	<input name="penerima" class="form-control" value="<?php echo $data_balas_pesan->pengirim;?>" type="hidden">
	<input name="nama" class="form-control" value="<?php echo $nama;?>" type="hidden">
	<input name="email" class="form-control" value="<?php echo $email;?>" type="hidden">
	<input name="subjek" class="form-control" value="<?php echo $data_balas_pesan->subjek;?>" type="hidden">
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