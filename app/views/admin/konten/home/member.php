<div class="box box-danger">
<div class="box-header with-border">
  <h3 class="box-title">Latest Web Members</h3>
  <div class="box-tools pull-right">
  <?php 
	if($user_terbaru < 1){
		?>
		<span class="label label-warning"><?php echo $user_terbaru;?> New Members</span>
		<?php
	}else{
		?>
		<span class="label label-danger"><?php echo $user_terbaru;?> New Members</span>
		<?php
	}
  ?>
	
	<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
	<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
  </div>
</div><!-- /.box-header -->
<div class="box-body no-padding">
  <ul class="users-list clearfix">
  <?php if($user_list){
	  foreach($user_list as $user_list){
		  if($user_list->user_level==1){
			  
		  }else{
		  $foto=$this->user->view_foto($user_list->id);
		  $cek_user_level=$this->user->cek_user_level($user_list->username,$user_list->password)->user_level;
		$ambil_user_level=$this->user->ambil_user_level($cek_user_level)->ket;
		$data_pengguna=$this->user->viewall_pengguna_by_user_id($user_list->id);
		if($data_pengguna){
		$nama_pengguna=$data_pengguna->nama_lengkap;
		$no_tlp=$data_pengguna->no_tlp;
		$email=$data_pengguna->email;
		$alamat=$data_pengguna->alamat;
		}else{
			$nama_pengguna='';
			$no_tlp='';
			$email='';
			$alamat='';
		}
		?>								
		<li>
		<a class="users-list-name" data-toggle="modal" data-target="#myModalview<?php echo $user_list->id;?>" href="#">
			<?php
				if($foto->foto==''){
					?>
					<img src="<?php echo $this->uri->baseUri;?>upload/user/blank.png" alt="User Image">
					<?php
				}else{
					?>
					<img src="<?php echo $this->uri->baseUri;?>upload/user/<?php echo $foto->foto;?>" alt="User Image">
					<?php
				}
			?>							  
		  <p><?php echo $user_list->username;?></p></a>
		  <span class="users-list-date"><?php echo $user_list->tgl_register;?></span>
		</li>
		<!-- Modal View-->
		<div class="modal fade bs-example-modal-lg" id="myModalview<?php echo $user_list->id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">View User <?php echo $nama_pengguna;?> dengan username: <?php echo $user_list->username;?></h4>
			  </div>
			  <div class="modal-body">
				<!--FORM View-->
				<form data-toggle="validator" enctype="multipart/form-data" role="form" method="POST" action="#">
				<div class="row" style="border-bottom:2px solid #B8B8B8; border-top:2px solid #B8B8B8; margin-bottom:10px;border-bottom-right-radius: 15em 1em; border-bottom-left-radius: 1em 3em;border-top-left-radius: 1em 3em; border-top-right-radius: 1em 3em;">
				
					<div class="form-group">	
					  <label class="col-sm-2 control-label">Username:</label>
					  <div class="col-sm-10" >
					  <input type="text" class="form-control" value="<?php echo $user_list->username;?>" readonly >
					  </div>			  
					</div>
					
					<div class="form-group">	
					  <label class="col-sm-2 control-label">Password:</label>
					  <div class="col-sm-10" >
					  <input type="text" class="form-control" value="xxxxx" readonly>
					  </div>			  
					</div>
					
					
					<div class="form-group">	
					  <label class="col-sm-2 control-label">User Level:</label>
					  <div class="col-sm-10" >							  
					  <input type="text" class="form-control" value="<?php echo $ambil_user_level;?>" readonly>							  
					  </div>			  
					</div>	
					
				</div>
				<div class="row" style="border-bottom:2px solid #B8B8B8; border-top:2px solid #B8B8B8; margin-bottom:10px;border-bottom-right-radius: 15em 1em; border-bottom-left-radius: 1em 3em;border-top-left-radius: 1em 3em; border-top-right-radius: 1em 3em;">
					
					<div class="form-group">
					  <label class="col-sm-2 control-label">Foto:</label>
					  <div class="col-sm-10" >
					  <?php if($foto->foto==''){
						  ?>
						  <img class="img-responsive" src="<?php echo $this->uri->baseUri;?>upload/user/blank.png">
						<?php
					  }else{
						  ?>
						  
						<img class="img-responsive" src="<?php echo $this->uri->baseUri;?>upload/user/<?php echo $foto->foto;?>" style="width:200px; height:200px;">
						  <?php
					  }?>
					  </div>			  
					</div>
					
					<div class="form-group">	
					  <label class="col-sm-2 control-label">Nama Lengkap:</label>
					  <div class="col-sm-10" >
					  <input type="text" class="form-control" value="<?php echo $nama_pengguna;?>" readonly >
					  </div>			  
					</div>
					
					<div class="form-group">	
					  <label class="col-sm-2 control-label">No Telpon:</label>
					  <div class="col-sm-10" >
					  <input type="text" class="form-control" value="<?php echo $no_tlp;?>" readonly >
					  </div>			  
					</div>
					<div class="form-group">	
					  <label class="col-sm-2 control-label">Email:</label>
					  <div class="col-sm-10" >
					  <input type="text" class="form-control" value="<?php echo $email;?>" readonly >
					  </div>			  
					</div>
					<div class="form-group">	
					  <label class="col-sm-2 control-label">Alamat:</label>
					  <div class="col-sm-10" >
					  <textarea type="text" class="form-control" readonly ><?php echo $alamat;?></textarea>
					  </div>			  
					</div>
				
				</div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			  </div>
				</form>
				<!-- end form View-->
			  </div>
			</div>
		  </div>
		</div>
		<!-- END Modal View-->
		<?php
	  }
	  }
  }else{
	  ?>						  
		<li>
		  <img src="<?php echo $this->uri->baseUri;?>upload/user/blank.png" alt="User Image">
		  <a class="users-list-name" href="#">User Tidak ada</a>
		  <span class="users-list-date">User Tidak ada</span>
		</li>
	  
	  <?php						  
  }?>
  </ul><!-- /.users-list -->
</div><!-- /.box-body -->
<div class="box-footer text-center">
  <a href="<?php echo $this->uri->baseUri;?>index.php/admin/user" class="btn btn-sm btn-info btn-flat">
  <i class="fa fa-user" aria-hidden="true"></i>&nbsp;View All Users</a>
</div><!-- /.box-footer -->
</div>