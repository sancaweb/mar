<div class="box box-info">
<div class="box-header with-border">
  <h3 class="box-title">Konfirmasi Pembyaran </h3>
  <div class="box-tools pull-right">
  <?php 
	if($pembayaran_terbaru < 1){
		?>
		<span class="label label-warning"><?php echo $pembayaran_terbaru;?> Pembayaran Baru</span>
		<?php
	}else{
		?>
		<span class="label label-danger"><?php echo $pembayaran_terbaru;?> Pembayaran Baru</span>
		<?php
	}
  ?>
	<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
	<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
  </div>
</div><!-- /.box-header -->
<div class="box-body">
  <div class="table-responsive">
	<table class="table no-margin">
	  <thead>
		<tr>
		  <th>ID Register</th>
		  <th>ID Rekanan</th>
		  <th>Produk</th>
		  <th>Status</th>
		</tr>
	  </thead>
	  <tbody>
	  <?php if($pembayaran_list){
		  foreach($pembayaran_list as $pembayaran_list){
			  $id_produk=$this->registrasi->id_produk_by_id_register($pembayaran_list->id_register)->id_produk;
			  $nama_produk=$this->produk->view_nama_produk_by_id($id_produk)->nama_produk;
			  
					if($pembayaran_list->status=='1'){
						$ket_stat=0;
						$status=$pembayaran_list->keterangan;
						$class="label-info";
					}else{
						$class="label-danger";
						$status=$pembayaran_list->keterangan;
						$ket_stat=1;
					}
			  
			  ?>
				<tr>
				  <td><a href=""><?php echo $pembayaran_list->id_register;?></a></td>
				  <td><?php echo $pembayaran_list->id_rekanan;?></td>
				  <td><?php echo $nama_produk;?></td>
				  <td><span class="label <?php echo $class;?>"><?php echo $status;?></span></td>
				</tr>			  
			  <?php
		  }
	  }else{
		  ?>
		  
		<tr>
		  <td colspan="4">Data Tidak ada</td>
		</tr>
		  <?php
		  
	  }?>
		
	  </tbody>
	</table>
  </div><!-- /.table-responsive -->
</div><!-- /.box-body -->
<div class="box-footer clearfix">
  <a href="" class="btn btn-sm btn-info btn-flat pull-right"><i class="fa fa-money"></i>&nbsp;View All Pembayaran</a>
</div><!-- /.box-footer -->
</div><!-- /.box -->