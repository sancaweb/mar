<ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
			<?php if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2){?>
			<li <?php if($menu=='rekanan'){echo 'class="active"';}?>">
              <a href="<?php echo $this->uri->baseUri;?>index.php/admin/rekanan/">
                <i class="fa fa-user-secret"></i> <span>Rekanan</span> 
              </a>
            </li>
			<?php
			}
			?>
            <li class="treeview <?php if($menu=='voucher' || $menu=='generate_voucher' || $menu=='penerima_voucher'){echo 'active';}?>">
              <a href="#">
                <i class="fa fa-edit"></i> <span>Voucher</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
			  <?php 
				if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2){
			  ?>
				<li <?php if($menu=='generate_voucher'){echo 'class="active"';}?>><a href="<?php echo $this->uri->baseUri;?>index.php/admin/voucher/generate_voucher"><i class="fa fa-circle-o"></i> Generate Voucher</a></li>
                <?php
				}
				?>
				<li <?php if($menu=='voucher'){echo 'class="active"';}?>><a href="<?php echo $this->uri->baseUri;?>index.php/admin/voucher"><i class="fa fa-circle-o"></i> View Voucher</a></li>
                
                <li <?php if($menu=='penerima_voucher'){echo 'class="active"';}?>><a href="<?php echo $this->uri->baseUri;?>index.php/admin/voucher/penerima_voucher"><i class="fa fa-circle-o"></i> Penerima Voucher</a></li>
                
              </ul>
            </li>
			<?php 
				if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2){
			?>
            <li class="treeview <?php if($menu=='produk' || $menu=='kategori'){echo 'active';}?>">
              <a href="#">
                <i class="fa fa-edit"></i> <span>Produk</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                
			   <li <?php if($menu=='produk'){echo 'class="active"';}?>>
              <a href="<?php echo $this->uri->baseUri;?>index.php/admin/produk/">
                <i class="fa fa-list"></i> <span>List Produk</span> 
              </a>
				</li>
				<li <?php if($menu=='kategori'){echo 'class="active"';}?>>
				  <a href="<?php echo $this->uri->baseUri;?>index.php/admin/produk/kategori">
					<i class="fa fa-list"></i> <span>Kategori Produk</span> 
				  </a>
				</li>
              </ul>
            </li>
				<?php }?>
			
			<li class="treeview <?php if($menu=='register' || $menu=='pembayaran' ){echo 'active';}?>" >
              <a href="#">
                <i class="fa fa-share"></i> <span>Registrasi Umroh</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li <?php if($menu=='register'){echo 'class="active"';}?>><a href="<?php echo $this->uri->baseUri;?>index.php/admin/registrasi"><i class="fa fa-users"></i>Data Registrasi</a></li>
                <li <?php if($menu=='pembayaran'){echo 'class="active"';}?>><a href="<?php echo $this->uri->baseUri;?>index.php/admin/pembayaran"><i class="fa fa-money"></i>Data Konfirmasi Pembayaran</a></li>
              </ul>
            </li>
			<?php 
				if($this->session->getValue('user_level')==1 || $this->session->getValue('user_level')==2){
			?>
			<li <?php if($menu=='pesan'){echo 'class="active"';}?>>
			<a href="<?php echo $this->uri->baseUri;?>index.php/admin/pesan"><i class="fa fa-envelope-o"></i>
			<span>Pesan</span>				
                <span class="label label-primary pull-right"><?php echo $total_pesan_belum_terbaca;?></span>
			</a>
			
			</li>
			
			<li class="header">WEB CONTENT</li>
			<li class="treeview <?php if($menu=='kabar' || $menu=='kategori_kabar'){echo 'active';}?>" >
              <a href="#">
                <i class="fa fa-file-text"></i> <span>Kabar</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li <?php if($menu=='kabar'){echo 'class="active"';}?>><a href="<?php echo $this->uri->baseUri;?>index.php/admin/kabar"><i class="fa fa-file-text"></i>Tulis Kabar</a></li>
                <li <?php if($menu=='kategori_kabar'){echo 'class="active"';}?>><a href="<?php echo $this->uri->baseUri;?>index.php/admin/kabar/kategori"><i class="fa fa-money"></i>Kategori Kabar</a></li>
              </ul>
            </li>
			<li <?php if($menu=='gallery'){echo 'class="active"';}?>><a href="<?php echo $this->uri->baseUri;?>index.php/admin/gallery"><i class="fa fa-picture-o"></i><span>View Gallery</span></a></li>
					
			
			<li class="header">Pengaturan Website</li>
			<li class="treeview <?php if($menu=='about' || $menu=='kantor'){echo 'active';}?>" >
              <a href="#">
                <i class="fa fa-university"></i> <span>Info Perusahaan</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li <?php if($menu=='kantor'){echo 'class="active"';}?>><a href="<?php echo $this->uri->baseUri;?>index.php/admin/about/kantor"><i class="fa fa-university"></i>Data Kantor</a></li>
                <li <?php if($menu=='about'){echo 'class="active"';}?>><a href="<?php echo $this->uri->baseUri;?>index.php/admin/about"><i class="fa fa-car"></i>Profile</a></li>
              </ul>
            </li>
			<li class="treeview <?php if($menu=='slide' || $menu=='header'){echo 'active';}?>" >
              <a href="#">
                <i class="fa fa-link"></i> <span>Pengaturan Style</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li <?php if($menu=='slide'){echo 'class="active"';}?>><a href="<?php echo $this->uri->baseUri;?>index.php/admin/pengaturan/slide"><i class="fa fa-list-alt"></i>Home Slider</a></li>
                <li <?php if($menu=='header'){echo 'class="active"';}?>><a href="<?php echo $this->uri->baseUri;?>index.php/admin/pengaturan/img_header"><i class="fa fa-header"></i>Header Image</a></li>
              </ul>
            </li>
			
			
			<li <?php if($menu=='partner'){echo 'class="active"';}?>>
			<a href="<?php echo $this->uri->baseUri;?>index.php/admin/pengaturan/partner">
			<i class="fa fa-usd"></i><span>Data Partner</span></a> 
			</li>
			
			<?php 
				}
			?>
			<li <?php if($menu=='user'){echo 'class="active"';}?>><a href="<?php echo $this->uri->baseUri;?>index.php/admin/user"><i class="fa fa-user"></i><span>Data User</span></a></li>
			
			
            
          </ul>