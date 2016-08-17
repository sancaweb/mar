<div class="box box-primary">
<div class="box-header with-border">
  <h3 class="box-title">Penerima Voucher</h3>
  <div class="box-tools pull-right">
  <?php 
		if($penerima_voucher < 1){
			?>
			<span class="label label-warning"><?php echo $penerima_voucher;?> Penerima Baru </span>
			<?php
		}else{
			?>
			<span class="label label-danger"><?php echo $penerima_voucher;?> Penerima Baru</span>
			<?php
		}
	  ?>
	<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
	<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
  </div>
</div><!-- /.box-header -->
<div class="box-body">
  <ul class="products-list product-list-in-box">
  <?php if($penerima_voucher_list){
	  foreach($penerima_voucher_list as $penerima_voucher_list){
		  $data_pengguna=$this->user->viewall_pengguna_by_user_id($penerima_voucher_list->user_id);
			if($data_pengguna){
				$foto=$data_pengguna->foto;
			}else{
				$foto='blank.png';
			}
		  ?>						  
			<li class="item">
			  <div class="product-img">
				<img src="<?php echo $this->uri->baseUri;?>upload/user/<?php echo $foto;?>" alt="Product Image">
			  </div>
			  <div class="product-info">
				<a target="_blank" href="#" class="product-title">
				<?php echo $penerima_voucher_list->nama_penerima;?>
				<span class="label label-success pull-right"> <?php echo date('d-M-y',strtotime($penerima_voucher_list->tgl_terima));?></span></a>
				<span class="product-description">
				<?php echo $penerima_voucher_list->alamat;?>
				</span>
			  </div>
			</li><!-- /.item -->
		  <?php
	  }
  }else{
	  ?>
	  <li class="item">
		  <div class="product-img">
			<img src="<?php echo $this->uri->baseUri;?>upload/user/blank.png" alt="Product Image">
		  </div>
		  <div class="product-info">
			<a target="_blank" href="#" class="product-title">
			Tidak ada data
			<span class="label label-success pull-right"> </span></a>
			<span class="product-description">
			Data tidak ada
			</span>
		  </div>
		</li><!-- /.item -->
	  <?php
  }?>
  
  </ul>
</div><!-- /.box-body -->
<div class="box-footer text-center">
  <a href="<?php echo $this->uri->baseUri;?>index.php/admin/voucher/penerima_voucher" class="btn btn-sm btn-info btn-flat"><i class="fa fa-edit"></i>&nbsp;View All Penerima Voucher</a>
</div><!-- /.box-footer -->
</div><!-- /.box -->