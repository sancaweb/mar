<div class="site-header">
	<div class="container">
		<div class="main-header">
			<div class="row">
				<div class="col-md-3 col-sm-5 col-xs-9">
					<div class="logo">
						<a href="<?php echo $this->uri->baseUri;?>">
							<img src="<?php echo $this->uri->baseUri.STYLE;?>images/logo.png" alt="travel html5 template" title="travel html5 template">
						</a>
					</div> <!-- /.logo -->
				</div> <!-- /.col-md-4-->
				
				<div class="col-md-9 col-sm-7 col-xs-3">
				<!-- <div class="col-md-12 col-sm-12 col-xs-12"> -->
					<div class="main-menu">
						<ul class="visible-lg visible-md">
							<li <?php if($menu=='home'){echo 'class="active"';}?>><a href="<?php echo $this->uri->baseUri;?>">Home</a></li>
							
							<li class="dropdown <?php if($menu=='Umroh'){echo 'active';}?>">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-folder-open"></i>&nbsp;Umroh
								<b class="caret hidden-phone"></b>
								</a>
								<ul class="dropdown-menu">
								<?php if($menu_kategori_umroh){
									foreach($menu_kategori_umroh as $data){
										?>
										<li>
										<a href="<?php echo $this->uri->baseUri.'index.php/produk/view/'.$data->id.'/'.$data->nama_produk;?>"><i class="fa fa-hand-o-right" aria-hidden="true"></i>&nbsp;<?php echo $data->nama_produk;?></a>
									</li>
										<?php
									}
								}else{
									?>
									<li>
										<a href="#"><i class="fa fa-hand-o-right" aria-hidden="true"></i>&nbsp;Data Tidak ada</a>
									</li>
									<?php
								}?>
								</ul>
							</li>
							
							<li class="dropdown <?php if($menu=='Haji'){echo 'active';}?>">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-folder-open"></i>&nbsp;Haji
								<b class="caret hidden-phone"></b>
								</a>
								<ul class="dropdown-menu">
								<?php if($menu_kategori_haji){
									foreach($menu_kategori_haji as $data){
										?>
										<li>
										<a href="<?php echo $this->uri->baseUri.'index.php/produk/view/'.$data->id.'/'.$data->nama_produk;?>"><i class="fa fa-hand-o-right" aria-hidden="true"></i>&nbsp;<?php echo $data->nama_produk;?></a>
									</li>
										<?php
									}
								}else{
									?>
									<li>
										<a href="#"><i class="fa fa-hand-o-right" aria-hidden="true"></i>&nbsp;Data Tidak ada</a>
									</li>
									<?php
								}?>
								</ul>
							</li>
							
							<li class="dropdown <?php if($menu=='kabar'){echo 'active';}?>">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-folder-open"></i>&nbsp;Kabar
								<b class="caret hidden-phone"></b>
								</a>
								<ul class="dropdown-menu">
								<?php if($kategori_kabar){
									foreach($kategori_kabar as $data){
										?>
										<li>
											<a href="<?php echo $this->uri->baseUri;?>index.php/kabar/view/<?php echo base64_encode($data->id);?>"><i class="fa fa-hand-o-right" aria-hidden="true"></i>&nbsp;<?php echo $data->nama_kategori;?></a>
										</li>
										<?php
									}
								}else{
									?>
									
									<li>
										<a href="#"><i class="fa fa-hand-o-right"></i>&nbsp;Tidak ada kabar</a>
									</li>
									<?php
								}?>
									<li>
										
									</li>
									<li>
										
									</li>
									<li>
										<a href="<?php echo $this->uri->baseUri;?>index.php/kabar"><i class="fa fa-angle-double-right"></i>&nbsp;View All&nbsp;<i class="fa fa-angle-double-left"></i></a>
									</li>
								</ul>
							</li>
							<li <?php if($menu=='gallery'){echo 'class="active"';}?>><a href="<?php echo $this->uri->baseUri;?>index.php/gallery">Gallery</a></li>
							
							<li <?php if($menu=='klaim_voucher'){echo 'class="active"';}?>><a href="<?php echo $this->uri->baseUri;?>index.php/klaim_voucher">Klaim Voucher</a></li>
							
							<li class="dropdown <?php if($menu=='profile'){echo 'active';}?>">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-folder-open"></i>&nbsp;Call Us
								<b class="caret hidden-phone"></b>
								</a>
								<ul class="dropdown-menu">
									<li>
										<a href="<?php echo $this->uri->baseUri;?>index.php/profile"><i class="fa fa-hand-o-right" ></i>&nbsp;Profile</a>
									</li>
									<li>
										<a href="<?php echo $this->uri->baseUri;?>index.php/kantor"><i class="fa fa-hand-o-right"></i>&nbsp;Contact Us</a>
									</li>
								</ul>
							</li>
							<?php
							if($this->session->getValue('username')){
								?>
								<li class="dropdown <?php if($menu=='pembayaran' || $menu=='registrasi' || $menu=='user' || $menu=='pesan' ){echo 'active';}?>">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-folder-open"></i>&nbsp;Member Area
								<b class="caret hidden-phone"></b>
								</a>
								<ul class="dropdown-menu">
								<?php
									$user_level=$this->session->getValue('user_level');
									if($user_level==1 || $user_level==2 || $user_level==3){
										?>
										<li>
										<a href="<?php echo $this->uri->baseUri;?>index.php/admin"><i class="fa fa-hand-o-right" ></i>&nbsp;Administration Panel</a>
										</li>
										<li>
										<a href="<?php echo $this->uri->baseUri;?>index.php/login/logout"><i class="fa fa-hand-o-right" ></i>&nbsp;Logout</a>
										</li>
										<?php
									}else{
										?>
										<li>
										<a href="<?php echo $this->uri->baseUri;?>index.php/user"><i class="fa fa-hand-o-right" ></i>&nbsp;<?php echo $this->session->getValue('username');?></a>
										</li>
										<li>
											<a href="<?php echo $this->uri->baseUri;?>index.php/registrasi"><i class="fa fa-hand-o-right" ></i>&nbsp;Data Registrasi</a>
										</li>
										<li>
											<a href="<?php echo $this->uri->baseUri;?>index.php/pembayaran"><i class="fa fa-hand-o-right" ></i>&nbsp;Data Pembayaran</a>
										</li>
										<li>
											<a href="<?php echo $this->uri->baseUri;?>index.php/login/logout"><i class="fa fa-hand-o-right" ></i>&nbsp;Logout</a>
										</li>
										
										<?php
									}
								?>
									
								</ul>
								</li>
								<?php
							}else{
								?>
								<li class="dropdown <?php if($menu=='login'){echo 'active';}?>">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-folder-open"></i>&nbsp;Member Area
								<b class="caret hidden-phone"></b>
								</a>
								<ul class="dropdown-menu">
									<li>
										<a href="<?php echo $this->uri->baseUri;?>index.php/login"><i class="fa fa-hand-o-right" ></i>&nbsp;Login</a>
									</li>
									<li>
										<a href="<?php echo $this->uri->baseUri;?>index.php/login/register"><i class="fa fa-hand-o-right" ></i>&nbsp;Registrasi</a>
									</li>
								</ul>
								</li>
								<?php
							}
							?>
							
						</ul>
						<a href="#" class="toggle-menu visible-sm visible-xs">
							<i class="fa fa-bars"></i>
						</a>
					</div> <!-- /.main-menu -->
				</div> <!-- /.col-md-8 -->
			</div> <!-- /.row -->
		</div> <!-- /.main-header -->
		<!-- Menu kecil -->
		<div class="row">
			<div class="col-md-12 visible-sm visible-xs">
				<div class="menu-responsive">
					
					<ul>
							<li <?php if($menu=='home'){echo 'class="active"';}?>><a href="<?php echo $this->uri->baseUri;?>">Home</a></li>
						<li class="dropdown <?php if($menu=='profile'){echo 'active';}?>">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-folder-open"></i>&nbsp;Profile
								<b class="caret hidden-phone"></b>
								</a>
								<ul class="dropdown-menu">
									<li>
										<a href="<?php echo $this->uri->baseUri;?>profile"><i class="fa fa-hand-o-right" ></i>&nbsp;About US</a>
									</li>
									<li>
										<a href="<?php echo $this->uri->baseUri;?>profile/legalitas"><i class="fa fa-hand-o-right"></i>&nbsp;Legalitas</a>
									</li>
								</ul>
							</li>
							
							<li class="dropdown <?php if($menu=='umroh'){echo 'active';}?>">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-folder-open"></i>&nbsp;Umroh
								<b class="caret hidden-phone"></b>
								</a>
								<ul class="dropdown-menu">
								<?php if($menu_kategori_umroh){
									foreach($menu_kategori_umroh as $data){
										?>
										<li>
										<a href="#link"><i class="fa fa-hand-o-right" aria-hidden="true"></i>&nbsp;<?php echo $data->nama_produk;?></a>
									</li>
										<?php
									}
								}else{
									?>
									<li>
										<a href="#"><i class="fa fa-hand-o-right" aria-hidden="true"></i>&nbsp;Data Tidak ada</a>
									</li>
									<?php
								}?>
								</ul>
							</li>
							
							<li class="dropdown <?php if($menu=='haji'){echo 'active';}?>">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-folder-open"></i>&nbsp;Haji
								<b class="caret hidden-phone"></b>
								</a>
								<ul class="dropdown-menu">
								<?php if($menu_kategori_haji){
									foreach($menu_kategori_haji as $data){
										?>
										<li>
										<a href="#link"><i class="fa fa-hand-o-right" aria-hidden="true"></i>&nbsp;<?php echo $data->nama_produk;?></a>
									</li>
										<?php
									}
								}else{
									?>
									<li>
										<a href="#"><i class="fa fa-hand-o-right" aria-hidden="true"></i>&nbsp;Data Tidak ada</a>
									</li>
									<?php
								}?>
								</ul>
							</li>
							
							<li class="dropdown <?php if($menu=='haji'){echo 'active';}?>">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-folder-open"></i>&nbsp;Kabar
								<b class="caret hidden-phone"></b>
								</a>
								<ul class="dropdown-menu">
									<li>
										<a href="#link"><i class="fa fa-hand-o-right" aria-hidden="true"></i>&nbsp;Kabar Umroh</a>
									</li>
									<li>
										<a href="#link"><i class="fa fa-hand-o-right"></i>&nbsp;Kabar Haji</a>
									</li>
									<li>
										<a href="#link"><i class="fa fa-hand-o-right"></i>&nbsp;Kabar Aktifitas</a>
									</li>
								</ul>
							</li>
						<li <?php if($menu=='gallery'){echo 'class="active"';}?>><a href="about.php">Gallery</a></li>
							<li <?php if($menu=='klaim_voucher'){echo 'class="active"';}?>><a href="<?php echo $this->uri->baseUri;?>index.php/klaim_voucher">Klaim Voucher</a></li>
							
							<?php
							if($this->session->getValue('username')){
								?>
								<li class="dropdown <?php if($menu=='pembayaran' || $menu=='registrasi'){echo 'active';}?>">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-folder-open"></i>&nbsp;Member Area
								<b class="caret hidden-phone"></b>
								</a>
								<ul class="dropdown-menu">
								<?php 
									$user_level=$this->session->getValue('user_level');
								if($user_level==1 || $user_level==2 || $user_level==3){
									?>
									<li>
										<a href="<?php echo $this->uri->baseUri;?>index.php/admin"><i class="fa fa-hand-o-right" ></i>&nbsp;Administration Panel</a>
									</li>
									<?php
								}else{
									?>
									<li>
										<a href="<?php echo $this->uri->baseUri;?>index.php/user"><i class="fa fa-hand-o-right" ></i>&nbsp;<?php echo $this->session->getValue('username');?></a>
									</li>
									<li>
										<a href="<?php echo $this->uri->baseUri;?>index.php/registrasi"><i class="fa fa-hand-o-right" ></i>&nbsp;Data Registrasi</a>
									</li>
									<li>
										<a href="<?php echo $this->uri->baseUri;?>index.php/pembayaran"><i class="fa fa-hand-o-right" ></i>&nbsp;Data Pembayaran</a>
									</li>
									<li>
										<a href="<?php echo $this->uri->baseUri;?>index.php/login/logout"><i class="fa fa-hand-o-right" ></i>&nbsp;Logout</a>
									</li>
									<?php
								}?>
									
									
								</ul>
								
								</li>
								<?php
							}else{
								?>							
								
								<li class="dropdown <?php if($menu=='login'){echo 'active';}?>">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-folder-open"></i>&nbsp;Member Area
								<b class="caret hidden-phone"></b>
								</a>
								<ul class="dropdown-menu">
									<li>
										<a href="<?php echo $this->uri->baseUri;?>index.php/login"><i class="fa fa-hand-o-right" ></i>&nbsp;Login</a>
									</li>
									<li>
										<a href="<?php echo $this->uri->baseUri;?>index.php/login/register"><i class="fa fa-hand-o-right" ></i>&nbsp;Registrasi</a>
									</li>
								</ul>
								</li>
								<?php
							}
							?>
							
						</ul>
				</div> <!-- /.menu-responsive -->
			</div> <!-- /.col-md-12 -->
		</div> <!-- /.row -->
	</div> <!-- /.container -->
</div> <!-- /.site-header -->