<div class="box box-primary">
<div class="box-header with-border">
  <h3 class="box-title">Kabar Terbaru</h3>
  <div class="box-tools pull-right">
  <?php 
	if($kabar_terbaru < 1){
		?>
		<span class="label label-warning"><?php echo $kabar_terbaru;?> Kabar Baru</span>
		<?php
	}else{
		?>
		<span class="label label-danger"><?php echo $kabar_terbaru;?> Kabar Baru</span>
		<?php
	}
  ?>
	<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
	<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
  </div>
</div><!-- /.box-header -->
<div class="box-body">
  <ul class="products-list product-list-in-box">
	<?php if($kabar_list){
		foreach ($kabar_list as $kabar_list){
			$tgl=date('d',strtotime($kabar_list->tgl_input));
			$bulan=date('M',strtotime($kabar_list->tgl_input));
			$tahun=date('Y',strtotime($kabar_list->tgl_input));
			?>
		<li class="item">
		  <div class="product-img">
			<img src="<?php echo $this->image->ambil_gambar($kabar_list->keterangan);?>" alt="Product Image">
		  </div>
		  <div class="product-info">
			<a target="_blank" href="<?php echo $this->uri->baseUri;?>index.php/kabar/view/<?php echo base64_encode($kabar_list->kategori)?>/<?php echo base64_encode($kabar_list->id);?>" class="product-title"><?php echo $kabar_list->judul;?>
			<span class="label label-success pull-right"><?php echo $tgl.'-'.$bulan.'-'.$tahun;?></span></a>
			<span class="product-description">
			  <?php echo $this->readmore->readmore($this->image->del_img($kabar_list->keterangan),90);?>
			</span>
		  </div>
		</li><!-- /.item -->
			
			<?php
		}
	}else{
		?>
		<li class="item">
	  <div class="product-img">
		<img src="<?php echo $this->uri->baseUri.ADM_STYLE;?>dist/img/default-50x50.gif" alt="Product Image">
	  </div>
	  <div class="product-info">
		<a href="javascript::;" class="product-title">Kosong <span class="label label-info pull-right">$700</span></a>
		
	  </div>
	</li><!-- /.item -->
		<?php
	}?>
	
  </ul>
</div><!-- /.box-body -->
<div class="box-footer text-center">
  <a href="<?php echo $this->uri->baseUri;?>index.php/admin/kabar" class="btn btn-sm btn-info btn-flat">
  <i class="fa fa-file-text"></i>&nbsp;View All Kabar</a>
</div><!-- /.box-footer -->
</div><!-- /.box -->