
<div class="row">
<div class="col-xs-12 table-responsive">
<?php if(isset($alert)){
	echo $alert;
}
?>
<table class="table table-bordered table-hover">
<tr>
  <th>No</th>
  <th>Id Registrasi</th>
  <th>Transfer Ke</th>
  <th>Nama Bank Pengirim</th>
  <th>Nama Pemilik Rekening</th>			  
  <th>Jumlah yang di transfer ke</th>			  
  <th>Keterangan</th>
  <th>Action</th>
</tr>
<?php if ($viewall_pembayaran_user_id){
$no=$no;
foreach($viewall_pembayaran_user_id as $data){
	$no++;
	$nama_jamaah=$this->registrasi->nama_jamaah_by_id_register($data->id_register)->nama_jamaah;
	$id_produk=$this->registrasi->id_produk_by_id_register($data->id_register)->id_produk;
	$nama_produk=$this->produk->view_nama_produk_by_id($id_produk)->nama_produk;
	$harga=$this->registrasi->harga_produk_by_id_register($data->id_register)->harga_produk;
	$potongan=$this->registrasi->potongan_by_id_register($data->id_register)->potongan;
	$biaya=$this->registrasi->biaya_by_id_register($data->id_register)->biaya;
	$pembayaran=$this->registrasi->pembayaran_by_id_register($data->id_register)->pembayaran;
	
	$bank_tujuan=$this->pengaturan->rekening_by_id($data->rekening_tujuan)->nama_bank;
	$pemilik_bank_tujuan=$this->pengaturan->rekening_by_id($data->rekening_tujuan)->nama_pemilik;
	$norek_tujuan=$this->pengaturan->rekening_by_id($data->rekening_tujuan)->norek;
	$rekening_tujuan=$bank_tujuan.', '.$pemilik_bank_tujuan.', '.$norek_tujuan;
	$bank_pengirim=$this->pengaturan->nama_bank_by_id($data->bank_pengirim)->nama_bank;
	?>
	<tr>
	  <td><?php echo $no;?></td>
	  <td><?php echo $data->id_register; ?></td>
	  <td><?php echo $rekening_tujuan; ?></td>
	  <td><?php echo $bank_pengirim; ?></td>
	  <td><?php echo $data->pemilik_bank; ?></td>
	  <td><?php echo 'Rp. '.number_format($data->jml_pembayaran,0,'','.'); ?></td>
	  <td><?php echo $data->keterangan; ?></td>
	  <td><a class="btn btn-primary" data-toggle="modal" data-target="#myModalview<?php echo $data->id;?>">
		<i class="fa fa-camera"></i> View Detail
		</a>
		</td>
	</tr>
	<tr>
	<td colspan="8">
	<ul class="pagination pagination-sm no-margin pull-right">
		<?php if ($pageLinks): ?>
				
				<?php foreach ($pageLinks as $paging): ?>
					<?php echo '<li>'.$paging; ?></li>
					
				<?php endforeach; ?>
			
					<?php endif; ?>
	  </ul>
	</td>
	</tr>
	<!-- Modal View-->
<div class="modal fade bs-example-modal-lg" id="myModalview<?php echo $data->id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="myModalLabel">Pembayaran untuk id registrasi : <?php echo $data->id_register;?></h4>
		</div>
		<div class="modal-body">
		<form data-toggle="validator" enctype="multipart/form-data" role="form" method="POST" action="#">
<div class="row" style="border-bottom:2px solid #B8B8B8; border-top:2px solid #B8B8B8; margin-bottom:10px;border-bottom-right-radius: 15em 1em; border-bottom-left-radius: 1em 3em;border-top-left-radius: 1em 3em; border-top-right-radius: 1em 3em;">

	<div class="col-md-6">					
		<div class="form-group">
		<label>Nama Produk:</label>
			<div class="input-group col-xs-12" >
				<input type="text" class="form-control" value="<?php echo $nama_produk;?>" readonly>
			</div>
		</div>				  
	</div>
<?php if($potongan=='0'){
?>
	<div class="col-md-6">					
		<div class="form-group">
		<label>Harga:</label>
			<div class="input-group col-xs-12" >
				<input type="text" class="form-control" value="<?php echo number_format($harga,0,'','.');?>" readonly>
			</div>
		</div>				  
	</div>

<?php
}else{
?>
	<div class="col-md-3">					
		<div class="form-group">
		<label>Harga:</label>
			<div class="input-group col-xs-12" >
				<input type="text" class="form-control" value="<?php echo number_format($harga,0,'','.');?>" readonly>
			</div>
		</div>				  
	</div>
	<div class="col-md-3">					
		<div class="form-group">
		<label>Potongan:</label>
			<div class="input-group col-xs-12" >
				<input type="text" class="form-control" value="<?php echo number_format($potongan,0,'','.');?>" readonly>
			</div>
		</div>				  
	</div>
<?php
}?>

	<div class="col-md-6">					
		<div class="form-group">
		<label>Total Budget:</label>
			<div class="input-group col-xs-12" >
				<input type="text" class="form-control" value="<?php echo number_format($biaya,0,'','.');?>" readonly>
			</div>
		</div>				  
	</div>
	<div class="col-md-6">					
		<div class="form-group">
		<label>Pembayaran awal yang harus dilakukan:</label>
			<div class="input-group col-xs-12" >
				<input type="text" class="form-control" value="<?php echo number_format($pembayaran,0,'','.');?>" readonly>
			</div>
		</div>				  
	</div>

	<div class="col-md-6">					
		<div class="form-group">
		<label>Nama Jamaah:</label>
			<div class="input-group col-xs-12" >
				<input type="text" class="form-control" value="<?php echo $nama_jamaah;?>" readonly>
			</div>
		</div>				  
	</div>

</div>
<div class="row" style="border-bottom:2px solid #B8B8B8; border-top:2px solid #B8B8B8; margin-bottom:10px;border-bottom-right-radius: 15em 1em; border-bottom-left-radius: 1em 3em;border-top-left-radius: 1em 3em; border-top-right-radius: 1em 3em;">
	<div class="col-md-6">					
		<div class="form-group">
		<label>Rekening Tujuan:</label>
			<div class="input-group col-xs-12" >
				<input type="text" class="form-control" value="<?php echo $rekening_tujuan;?>" readonly>
			</div>
		</div>				  
	</div>

	<div class="col-md-6">					
		<div class="form-group">
		<label>Nama Bank Pengirim:</label>
			<div class="input-group col-xs-12" >
				<input type="text" class="form-control" value="<?php echo $bank_pengirim;?>" readonly>
			</div>
		</div>				  
	</div>

	<div class="col-md-6">					
		<div class="form-group">
		<label>Nama Pemilik Rekening:</label>
			<div class="input-group col-xs-12" >
				<input type="text" class="form-control" value="<?php echo $data->pemilik_bank;?>" readonly>
			</div>
		</div>				  
	</div>

	<div class="col-md-6">					
		<div class="form-group">
		<label>Nomer Rekening Pengirim:</label>
			<div class="input-group col-xs-12" >
				<input type="text" class="form-control" value="<?php echo $data->norek_pengirim;?>" readonly>
			</div>
		</div>				  
	</div>

	<div class="col-md-6">					
		<div class="form-group">
		<label>Jumlah yang di transfer:</label>
			<div class="input-group col-xs-12" >
				<input type="text" class="form-control" value="<?php echo number_format($data->jml_pembayaran,0,'','.');?>" readonly>
			</div>
		</div>				  
	</div>

	<div class="col-md-6">					
		<div class="form-group">
		<label>Tanggal transfer:</label>
			<div class="input-group col-xs-12" >
				<input type="text" class="form-control" value="<?php echo $data->tgl_transfer;?>" readonly>
			</div>
		</div>				  
	</div>
	
	<div class="col-md-12">					
		<div class="form-group">
		<label>Keterangan:</label>
			<div class="input-group col-xs-12" >
				<textarea class="form-control" readonly><?php echo $data->keterangan;?></textarea>
			</div>
		</div>				  
	</div>
	
</div>		
		</form>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
		</div> <!-- END modal body -->
		</div> <!-- end modal content -->
	</div><!-- end modal dialog -->
</div>
	<!-- END Modal View -->
	<?php
}
}else{
	?>
	<tr>
	  <td colspan="5">Data tidak ada</td>
	</tr>
	<?php
}
	?>
</table>

</div> <!-- /.col-xs-12 -->
</div> <!-- /.row -->


