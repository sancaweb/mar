<?php if(isset($alert)){
	echo $alert;
}
?>
<div class="row">
	<div class="col-md-12">
	  <div class="box">
		<div class="box-header with-border">
		  <h3 class="box-title">Data Voucher</h3>
		  <div class="box-tools pull-right">
			<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>			
			<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
		  </div>
		</div><!-- /.box-header -->
		<div class="box-body">
		
		<!-- search form -->
          <form data-toggle="validator" enctype="multipart/form-data" role="form" method="POST" class="sidebar-form" action="<?php echo $this->uri->baseUri;?>index.php/admin/voucher/cari_voucher">
            <div class="input-group">
              <input type="text" name="no_voucher" class="form-control" placeholder="Input nomer Voucher">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
		  <?php if(isset($page)){
			  if($page=='cari_voucher'){
				  $this->output('admin/konten/cari_voucher');
			  }else{
				  ?>
				<table class="table table-bordered table-hover">
			<tr>
			  <th style="width: 10px">No</th>
			  <th style="width: 100px">ID Rekanan</th>
			  <th style="width: 300px">Nama Rekanan</th>
			  <th style="width: 100px">Voucher</th>
			  <th style="width: 100px">Jenis</th>
			  <th style="width: 100px">Status</th>
			  <th style="width: 50px">Action</th>
			</tr>
			<?php if($viewall_voucher){
				$no=$no;
				foreach($viewall_voucher as $data){
					$no++;
					$nama_rekanan= $this->rekanan->view_nama_rekanan_by_id($data->id_rekanan)->nama_rekanan;
					$jenis_rekanan= $this->rekanan->view_jenis($data->id_rekanan)->jenis;
					
				?>
				
				<tr>
				<td> <?php echo $no;?> </td>
				<td> <?php echo $data->id_rekanan;?> </td>
				<td> <?php echo $nama_rekanan;?> </td>
				<td> <?php echo $data->no_voucher;?> </td>
				<td> <?php echo $jenis_rekanan;?> </td>
				<td> <?php if($data->status == '1'){
					echo 'Diterima';
				}else{
					echo 'Belum Diterima';
				}?></td>
				<td><a class="btn btn-app" data-toggle="modal" data-target="#myModal<?php echo $data->id_rekanan;?>">
					<i class="fa fa-edit"></i> Input Penerima
					</a>
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
						<form id="form_produk" data-toggle="validator" enctype="multipart/form-data" role="form" method="POST" action="<?php echo $this->uri->baseUri;?>index.php/admin/produk/pro_input_produk">
						<div class="row" style="border-bottom:2px solid #B8B8B8; border-top:2px solid #B8B8B8; margin-bottom:10px;border-bottom-right-radius: 15em 1em; border-bottom-left-radius: 1em 3em;border-top-left-radius: 1em 3em; border-top-right-radius: 1em 3em;">
							<input type="hidden" name="id_rekanan" class="form-control" value="<?php echo $data->id_rekanan;?>" readonly>
							<input type="hidden" name="no_voucher" class="form-control" value="<?php echo $data->no_voucher;?>" readonly>
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
							  <label>Nama Jamaah:</label>
							  <div class="input-group col-xs-12" >
							  <input type="text" name="nama_jamaah" class="form-control" Placeholder="Nama Jamaah">
							  <p class="help-block">Nama Jamaah yang akan di daftarkan.</p>
							  </div>
							</div>				  
							</div>
						<div class="col-md-6">					
							<div class="form-group">
							  <label>Status Jamaah:</label>
							  <div class="input-group col-xs-12" >
							  <select class="form-control" name="status_jamaah">
								<option value="">Silahkan Pilih</option>
								<option value="Ayah">Ayah</option>
								<option value="Ibu">Ibu</option>
								<option value="Kakak">Kakak</option>
								<option value="Adik">Adik</option>
								<option value="Saudara">Saudara</option>
								<option value="Teman">Teman</option>
							  </select>
							  <p class="help-block">Hubungan antara Penerima Voucher dengan Jamaah yang di daftarkan.</p>
							  </div>
							</div>				  
							</div>
							
						<div class="col-md-6">					
							<div class="form-group">
							  <label>Potongan:</label>
							  <div class="input-group col-xs-12" >
							  <input type="text" name="potongan" class="form-control" value="<?php echo $data->potongan;?>" readonly>
							  <p class="help-block">Potongan Harga</p>
							  </div>
							</div>				  
							</div>
							
							<div class="col-md-12 ">					
							<div class="form-group">
							  <label>Alamat:</label>
							  <div class="input-group col-xs-12" >
							  <textarea id="mytextarea" name="alamat" class="form-control" rows="3" > </textarea>
							  </div><!-- /.input group -->
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
		  <div class="box-footer clearfix">
		  <ul class="pagination pagination-sm no-margin pull-right">
			<?php if ($pageLinks): ?>
					
					<?php foreach ($pageLinks as $paging): ?>
						<?php echo '<li>'.$paging; ?></li>
						
					<?php endforeach; ?>
				
						<?php endif; ?>
		  </ul>
		</div> 
				  <?php
			  }
		  }?>
		
		
		 
		</div><!-- ./box-body -->
	  </div><!-- /.box -->
	</div><!-- /.col -->
</div>