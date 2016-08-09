<div class="box box-primary">
<div class="box-header with-border">
  <h3 class="box-title">Recently Added Products</h3>
  <div class="box-tools pull-right">
  <?php 
		if($produk_terbaru < 1){
			?>
			<span class="label label-warning"><?php echo $produk_terbaru;?> Kabar Baru</span>
			<?php
		}else{
			?>
			<span class="label label-danger"><?php echo $produk_terbaru;?> Kabar Baru</span>
			<?php
		}
	  ?>
	<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
	<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
  </div>
</div><!-- /.box-header -->
<div class="box-body">
  <ul class="products-list product-list-in-box">
  <?php if($produk_list){
	  foreach($produk_list as $produk_list){
		  ?>						  
			<li class="item">
			  <div class="product-img">
				<img src="<?php echo $this->image->ambil_gambar($produk_list->keterangan);?>" alt="Product Image">
			  </div>
			  <div class="product-info">
				<a target="_blank" href="<?php echo $this->uri->baseUri;?>index.php/produk/view/<?php echo $produk_list->id;?>/<?php echo $produk_list->nama_produk;?>" class="product-title"><?php echo $produk_list->nama_produk;?>
				<span class="label label-info pull-right"><?php echo 'Rp. '.number_format($produk_list->harga,0,'','.');?></span></a>
				<span class="product-description">
				  <?php echo $this->readmore->readmore($this->image->del_img($produk_list->keterangan),100);?>
				</span>
			  </div>
			</li><!-- /.item -->
		  <?php
	  }
  }else{
	  
  }?>
  
  </ul>
</div><!-- /.box-body -->
<div class="box-footer text-center">
  <a href="<?php echo $this->uri->baseUri;?>index.php/admin/produk" class="btn btn-sm btn-info btn-flat"><i class="fa fa-edit"></i>&nbsp;View All Products</a>
</div><!-- /.box-footer -->
</div><!-- /.box -->