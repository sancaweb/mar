<table class="table table-bordered table-hover">
<tr>
  <th style="width: 10px">No</th>
  <th style="width: 100px">ID Rekanan</th>
  <th style="width: 300px">Nama Rekanan</th>
  <th style="width: 200px">Voucher</th>
  <th style="width: 50px">Jenis</th>
  <th style="width: 100px">Status</th>
  <th style="width: 50px">Action</th>
</tr>
<?php if($viewall_voucher){
	$no=0;
	foreach($viewall_voucher as $data){
		$no++;
		$nama_rekanan= $this->rekanan->view_nama_rekanan_by_id($data->id_rekanan)->nama_rekanan;
		$jenis_rekanan= $this->rekanan->view_jenis($data->id_rekanan)->jenis;
	?>
	
	<tr>
	<td> <?php echo $no;?> </td>
	<td> <?php echo $data->id_rekanan;?> </td>
	<td> <?php echo $nama_rekanan;?> </td>
	<td> <?php echo $data->no_voucher.'<br/>(Rp. '.number_format($data->potongan,0,'','.').')';?> </td>
	<td> <?php echo $jenis_rekanan;?> </td>
	<td> <?php if($data->status == '1'){
		echo 'Diterima';
	}else{
		echo 'Belum Diterima';
	}?></td>
	<td>
	<?php if($data->status == '1'){
		
	}else{
		?>
		<a class="btn btn-app" data-toggle="modal" data-target="#myModal<?php echo $data->id_rekanan;?>">
		<i class="fa fa-edit"></i> Input Penerima
		</a>
		<?php
	}?>
	
	
	</td>
	</tr>
	<!-- MODAL Edit -->
				<div class="modal fade bs-example-modal-lg" id="myModal<?php echo $data->id_rekanan;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Input Data Penerima Voucher <strong><?php echo $data->no_voucher;?></strong></h4>
					  </div>
					  <div class="modal-body">
						<form id="form_produk" data-toggle="validator" enctype="multipart/form-data" role="form" method="POST" action="<?php echo $this->uri->baseUri;?>index.php/admin/voucher/input_penerima_voucher">
						<div class="row" style="border-bottom:2px solid #B8B8B8; border-top:2px solid #B8B8B8; margin-bottom:10px;border-bottom-right-radius: 15em 1em; border-bottom-left-radius: 1em 3em;border-top-left-radius: 1em 3em; border-top-right-radius: 1em 3em;">
							<input type="hidden" name="id_rekanan" class="form-control" value="<?php echo $data->id_rekanan;?>" readonly>
							<input type="hidden" name="no_voucher" class="form-control" value="<?php echo $data->no_voucher;?>" readonly>
							<input type="hidden" name="id_voucher" class="form-control" value="<?php echo $data->id;?>" readonly>
						<div class="col-md-6">					
							<div class="form-group">
							  <label>Nama Rekanan:</label>
							  <div class="input-group col-xs-12" >
							  <input type="text" class="form-control" value="<?php echo $nama_rekanan;?>" readonly>
							  
							  </div>
							</div>				  
							</div>	
						<div class="col-md-6">					
							<div class="form-group">
							  <label>Nama Penerima:</label>
							  <div class="input-group col-xs-12" >
							  <input type="text" name="nama_penerima" class="form-control" Placeholder="Nama Penerima">
							  <p class="help-block">Nama Penerima Voucher</p>
							  </div>
							</div>				  
							</div>	
						<div class="col-md-6">					
							<div class="form-group">
							  <label>No Tlp/ HP:</label>
							  <div class="input-group col-xs-12" >
							  <input type="text" name="no_tlp" class="form-control" Placeholder="08xxxxxxxx">
							  <p class="help-block">No Telpon atau Handphone</p>
							  </div>
							</div>				  
							</div>
						<div class="col-md-6">					
							<div class="form-group">
							  <label>Aktifasi:</label>
							  <div class="input-group col-xs-12" >
							  <select class="form-control" name="status">
								<option value="1" <?php if($data->status=='1'){echo "selected";}?>>Aktif</option>
								<option value="0" <?php if($data->status=='0'){echo "selected";}?>>Tidak Aktif</option>
							  </select>
							  <p class="help-block">Aktifasi Voucher</p>
							  </div>
							</div>				  
							</div> 
						</div>
						
						
					  <div class="modal-footer">
						<input type="submit" class="btn btn btn-primary" value="Submit">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					  </div>
						
						</form>
						
					  </div>
					</div>
				  </div>
				</div>
				<!-- END Modal Edit -->
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