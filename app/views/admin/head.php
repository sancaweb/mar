<header class="main-header">

        <!-- Logo -->
        <a href="<?php echo $this->uri->baseUri;?>index.php/admin" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>Bbb</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>mariumroh.com</b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              <li class="dropdown messages-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-envelope-o"></i>
                  <span class="label label-success"><?php echo $total_pesan_belum_terbaca;?></span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">Ada <?php echo $total_pesan_belum_terbaca;?> Pesan yang belum terbaca</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
					<?php if($loader_pesan){
						foreach ($loader_pesan as $data_loader_pesan){
							$cek_pengguna=$this->user->cek_pengguna_by_userid($data_loader_pesan->pengirim);
							if($cek_pengguna){
								$foto=$this->user->view_foto($data_loader_pesan->pengirim);
								
								$cek_user_level_by_userid=$this->user->cek_user_level_by_userid($data_loader_pesan->pengirim)->user_level;
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
							<li><!-- start message -->
								<a href="#">
								  <div class="pull-left">
									<img src="<?php echo $this->uri->baseUri;?>upload/user/<?php echo $foto;?>" class="img-circle" alt="User Image">
								  </div>
								  <h4>
									<?php echo $data_loader_pesan->nama;?>
									<small><i class="fa fa-clock-o"></i><?php echo date('d-M-Y',strtotime($data_loader_pesan->tgl_input));?></small>
								  </h4>
								  <p><?php echo $this->readmore->readmore($data_loader_pesan->isi_pesan,10);?> ...</p>
								</a>
							  </li><!-- end message -->
							<?php
							
						}
					}else{
						?>
						<li><!-- start message -->
                        <a href="#">
                          <div class="pull-left">
                            <img src="<?php echo $this->uri->baseUri;?>upload/user/blank.png" class="img-circle" alt="User Image">
                          </div>
                          <h4>
                            Tidak ada pesan baru.
                          </h4>
                        </a>
                      </li><!-- end message -->
						<?php
					}
						?>
                    </ul>
                  </li>
                  <li class="footer"><a href="<?php echo $this->uri->baseUri;?>index.php/admin/pesan">See All Messages</a></li>
                </ul>
              </li>
              <!-- Notifications: style can be found in dropdown.less -->
			  <?php
					$registrasi_terbaru=$this->registrasi->hitung_register_terbaru();
					$pembayaran_terbaru=$this->pembayaran->hitung_pembayaran_terbaru();
					$user_terbaru=$this->user->hitung_user_terbaru();
					
					$total_all=$registrasi_terbaru + $pembayaran_terbaru + $user_terbaru;
				?>
              <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                  <span class="label label-warning"><?php echo $total_all;?></span>
                </a>
                <ul class="dropdown-menu">
				
                  <li class="header">You have <?php echo $total_all;?> notifications</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
					
                    <ul class="menu">
                      <li>
                        <a href="#">
                          <i class="fa fa-users text-aqua"></i> <?php echo $registrasi_terbaru;?> Registrasi Umroh Baru Minggu Ini
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="fa fa-shopping-cart text-green"></i> <?php echo $pembayaran_terbaru;?> Konfirmasi Pembayaran Minggu Ini
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="fa fa-user-plus text-red"></i> <?php echo $user_terbaru;?> Members baru Minggu Ini
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="footer"><a >Klik task to view All data</a></li>
                </ul>
              </li>
              <!-- Tasks: style can be found in dropdown.less -->
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
				<?php
				  $foto=$this->user->view_foto($this->session->getValue('user_id'));
					if($foto){
						?>
						<img src="<?php echo $this->uri->baseUri;?>upload/user/<?php echo $foto->foto;?>" class="user-image" alt="User Image">
						<?php
					}else{
						?>
						<img src="<?php echo $this->uri->baseUri;?>upload/user/blank.png" class="user-image" alt="User Image">
						<?php
					}
					$nama_lengkap=$this->user->view_nama_lengkap($this->session->getValue('user_id'));
					if($nama_lengkap){
						$nama_lengkap=$nama_lengkap->nama_lengkap;
					}else{
						$nama_lengkap='Nama Tidak ada';
					}
				  ?>
                  <span class="hidden-xs"><?php echo $nama_lengkap;?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
				  <?php
				  $foto=$this->user->view_foto($this->session->getValue('user_id'));
					if($foto){
						?>
						<img src="<?php echo $this->uri->baseUri;?>upload/user/<?php echo $foto->foto;?>" class="img-circle" alt="User Image">
						<?php
					}else{
						?>
						<img src="<?php echo $this->uri->baseUri;?>upload/user/blank.png" class="img-circle" alt="User Image">
						<?php
					}
				  ?>
                    
                    <p>
					
                      <?php echo $nama_lengkap;?>
                      <small><?php echo $this->session->getValue('username');?></small>
                    </p>
                  </li>
                  <!-- Menu Body 
                  <li class="user-body">
                    <div class="col-xs-4 text-center">
                      <a href="#">Followers</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Sales</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Friends</a>
                    </div>
                  </li>
                  Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a data-toggle="modal" data-target="#myModalviewprofile" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="<?php echo $this->uri->baseUri;?>index.php/login/logout" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>
            </ul>
          </div>
		  
        </nav>
      </header>
	  <!-- Modal View-->
			  <?php
				$user_head=$this->user->view_by_id($this->session->getValue('user_id'));
				$cek_user_level=$this->user->cek_user_level($user_head->username,$user_head->password)->user_level;
				$ambil_user_level=$this->user->ambil_user_level($cek_user_level)->ket;
				$pengguna_head=$this->user->viewall_pengguna_by_user_id($user_head->id);
				if($pengguna_head){
					$nama_pengguna=$pengguna_head->nama_lengkap;
					$no_tlp=$pengguna_head->no_tlp;
					$email=$pengguna_head->email;
					$alamat=$pengguna_head->alamat;						
					$foto=$pengguna_head->foto;
				}else{
					$nama_pengguna='';
					$no_tlp='';
					$email='';
					$alamat='';						
					$foto='';
				}
			  ?>
			<div class="modal fade bs-example-modal-lg" id="myModalviewprofile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  <div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">View User <?php echo $nama_pengguna;?> dengan username: <?php echo $user_head->username;?></h4>
				  </div>
				  <div class="modal-body">
					<!--FORM View-->
					<form data-toggle="validator" enctype="multipart/form-data" role="form" method="POST" action="#">
					<div class="row" style="border-bottom:2px solid #B8B8B8; border-top:2px solid #B8B8B8; margin-bottom:10px;border-bottom-right-radius: 15em 1em; border-bottom-left-radius: 1em 3em;border-top-left-radius: 1em 3em; border-top-right-radius: 1em 3em;">
					
						<div class="form-group">	
						  <label class="col-sm-2 control-label">Username:</label>
						  <div class="col-sm-10" >
						  <input type="text" class="form-control" value="<?php echo $user_head->username;?>" readonly >
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
						  <?php if($foto){
							  ?>
							  <img class="img-responsive" src="<?php echo $this->uri->baseUri;?>upload/user/<?php echo $foto;?>" style="width:200px; height:200px;">
							
							<?php
						  }else{
							  ?>
							  <img class="img-responsive" src="<?php echo $this->uri->baseUri;?>upload/user/blank.png">
							
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
