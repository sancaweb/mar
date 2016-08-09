<aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
			<?php
				  $foto=$this->user->view_foto($this->session->getValue('user_id'));
					if($foto->foto){
						?>
						<img src="<?php echo $this->uri->baseUri;?>upload/user/<?php echo $foto->foto;?>" class="img-circle" alt="User Image">
						<?php
					}else{
						?>
						<img src="<?php echo $this->uri->baseUri;?>upload/user/blank.png" class="img-circle" alt="User Image">
						<?php
					}
				  ?>
            </div>
            <div class="pull-left info">
              <p><?php echo $this->user->view_nama_lengkap($this->session->getValue('user_id'))->nama_lengkap;?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <?php $this->output('admin/menu');?>
        </section>
        <!-- /.sidebar -->
      </aside>