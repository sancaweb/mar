<div class="box box-info">
<div class="box-header with-border">
  <h3 class="box-title">Registrasi Umroh online</h3>
  <div class="box-tools pull-right">
  <?php 
	if($registrasi_terbaru < 1){
		?>
		<span class="label label-warning"><?php echo $registrasi_terbaru;?> Registrasi Baru</span>
		<?php
	}else{
		?>
		<span class="label label-danger"><?php echo $registrasi_terbaru;?> Registrasi Baru</span>
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
	  <?php if($registrasi_list){
		  foreach($registrasi_list as $registrasi_list){
			  $nama_produk=$this->produk->view_nama_produk_by_id($registrasi_list->id_produk)->nama_produk;
			  $status=$this->pembayaran->cek_pembayaran_id_register($registrasi_list->id_register);
					if($status){
						$ket_stat=0;
						$status=$status->keterangan;
						$class="label-info";
					}else{
						$class="label-danger";
						$status='Belum ada pembayaran';
						$ket_stat=1;
					}
			  
			  ?>
				<tr>
				  <td><a href=""><?php echo $registrasi_list->id_register;?></a></td>
				  <td><?php echo $registrasi_list->id_rekanan;?></td>
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
  <a href="" class="btn btn-sm btn-info btn-flat pull-right"><i class="fa fa-users"></i>&nbsp;View All Registrasi Umroh</a>
</div><!-- /.box-footer -->
</div><!-- /.box -->