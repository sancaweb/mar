<?php if(isset($alert)){
	echo $alert;
}?>


<?php $this->output('admin/form/input_kabar');?>

  <!-- View data -->
  <div class="row">
	<div class="col-xs-12">
	  <div class="box">
		<div class="box-header with-border">
		  <h3 class="box-title">List Kategori</h3>
		  <a class="btn btn-primary" type="button" data-toggle="modal" data-target="#myModalinput">
			<i class="fa fa-plus-square"></i> Tambah Kabar
			</a>
		</div><!-- /.box-header -->
		<div class="box-body table-responsive">
		  <table class="table table-bordered table-hover">
			<tr>
			  <th style="width: 10px">No</th>
			  <th style="width: 200px">Judul</th>
			  <th style="width: 200px">Kategori</th>
			  <th style="width: 300px">Action</th>
			</tr>
			<?php if ($viewall_kabar){
				$no=$no;
				foreach($viewall_kabar as $data){
					$no++;
					$nama_kategori=$this->kabar->nama_kategori($data->kategori);
					if($nama_kategori){
						$nama_kategori=$nama_kategori->nama_kategori;
					}else{
						$nama_kategori='Kategori tidak ditemukan';
					}
					?>
					<tr>
			  <td><?php echo $no;?></td>
			  <td><?php echo $data->judul; ?></td>
			  <td><?php echo $nama_kategori; ?></td>
			  <td><a class="btn btn-app" data-toggle="modal" data-target="#myModalview<?php echo $data->id;?>">
				<i class="fa fa-tv"></i> View
				</a><a class="btn btn-app" data-toggle="modal" data-target="#myModal<?php echo $data->id;?>">
				<i class="fa fa-edit"></i> Edit
				</a><a class="btn btn-app" data-toggle="modal" data-target="#myModalconfirm<?php echo $data->id;?>">
				<i class="fa fa-trash"></i> Hapus
				</a>
				</td>
			</tr>

				<!-- Modal Confirm-->
				<div class="modal fade" id="myModalconfirm<?php echo $data->id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog " role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Alert Hapus kabar</h4>
					  </div>
					  <div class="modal-body">
					<div class="callout callout-danger">
                    <h4>Menghapus <?php echo $data->judul;?></h4>
                    <p>Apakah anda yakin ingin menghapus <strong><?php echo $data->judul;?></strong> ?</p>
                  </div>					  
					  <div class="modal-footer">					
						<a href="<?php echo $this->uri->baseUri;?>admin/kabar/hapus_kabar/<?php echo base64_encode($data->id);?>" type="button" class="btn btn-danger">Hapus</a>	
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					  </div>
					  </div>
					</div>
				  </div>
				</div>
				<!-- END Modal confirm -->
				
				<!-- Modal View-->
				<div class="modal fade bs-example-modal-lg" id="myModalview<?php echo $data->id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">View kabar <?php echo $data->judul;?></h4>
					  </div>
					  <div class="modal-body">
						<!--FORM View-->
						<form data-toggle="validator" enctype="multipart/form-data" role="form" method="POST" action="#">
						<div class="row" style="border-bottom:2px solid #B8B8B8; border-top:2px solid #B8B8B8; margin-bottom:10px;border-bottom-right-radius: 15em 1em; border-bottom-left-radius: 1em 3em;border-top-left-radius: 1em 3em; border-top-right-radius: 1em 3em;">
												
						<div class="col-md-6">					
							<div class="form-group">
							  <label>Judul:</label>
							  <div class="input-group col-xs-12" >
							  <input type="text" class="form-control" value="<?php echo $data->judul;?>" readonly >
							  </div>
							</div>				  
							</div>
							
							<div class="col-md-6 ">					
							<div class="form-group">
							  <label>Kategori kabar</label>
							  
							  <div class="input-group col-xs-12">
							  <input type="text" class="form-control" value="<?php echo $nama_kategori;?>" readonly >							  
							  
							</div>
							  </div><!-- /.input group -->
							</div>
							
							
							<div class="col-md-12 ">					
							<div class="form-group">
							  <label>Keterangan:</label>
							  <div class="input-group col-xs-12" >
							  <?php echo $data->keterangan;?>
							  </div><!-- /.input group -->
							</div>					
							</div>
						
						</div>
						
					  <div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					  </div>
						</form>
						<!-- end form View-->
					  </div>
					</div>
				  </div>
				</div>
				<!-- END Modal View-->
				
				<!-- Modal Edit-->
				<div class="modal fade bs-example-modal-lg" id="myModal<?php echo $data->id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Edit kabar</h4>
					  </div>
					  <div class="modal-body">
						<!--FORM Edit-->
						<form data-toggle="validator" enctype="multipart/form-data" role="form" method="POST" action="<?php echo $this->uri->baseUri;?>index.php/admin/kabar/pro_edit_kabar">
						<div class="row" style="border-bottom:2px solid #B8B8B8; border-top:2px solid #B8B8B8; margin-bottom:10px;border-bottom-right-radius: 15em 1em; border-bottom-left-radius: 1em 3em;border-top-left-radius: 1em 3em; border-top-right-radius: 1em 3em;">
						<input type="hidden" name="id" value="<?php echo $data->id;?>">
						
						<div class="col-md-6">					
						<div class="form-group">
						  <label>Judul:</label>
						  <div class="input-group col-xs-12" >
						  <input name="judul" type="text" class="form-control" value="<?php echo $data->judul;?>" required>
						  </div>
						</div>				  
						</div>
						
						<div class="col-md-6 ">					
						<div class="form-group">
						  <label>Kategori kabar</label>
						  
						  <div class="input-group col-xs-12">
						  <select class="form-control" name="kategori" required>
						  <?php
							if($kategori){
								foreach($kategori as $kategori2){
									?>
									<option value="<?php echo $kategori2->id;?>" <?php if($kategori2->id == $data->kategori){echo 'selected';}?> ><?php echo $kategori2->nama_kategori;?></option>
									<?php
								}
							}else{
								?>
								<option value=''>tidak ada data. Input Kategori dulu</option>
								<?php
							}
						  ?>
						  </select>
						  
						  
						</div>
						  </div><!-- /.input group -->
						</div>
						
						
						<div class="col-md-12 ">					
						<div class="form-group">
						  <label>Keterangan:</label>
						  <div class="input-group col-xs-12" >
						  <textarea id="mytextarea2" name="keterangan" class="form-control" rows="3" > <?php echo $data->keterangan;?></textarea>
						  </div><!-- /.input group -->
						</div>					
						</div>

						
						
						
						</div>
						
					  <div class="modal-footer">
						<input type="submit" class="btn btn btn-primary" value="Save changes">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					  </div>
						</form>
						<!-- end form EDIT-->
					  </div>
					</div>
				  </div>
				</div>
				<!-- END Modal -->
					<?php
				}
			}else{
				?>
				<tr>
			  <td colspan="5">Data tidak ada</td>
			</tr>
				
				<?php
			}?>
		  </table>
		</div><!-- /.box-body -->
		<div class="box-footer clearfix">
		  <ul class="pagination pagination-sm no-margin pull-right">
			<?php if ($pageLinks): ?>
					
					<?php foreach ($pageLinks as $paging): ?>
						<?php echo '<li>'.$paging; ?></li>
						
					<?php endforeach; ?>
				
						<?php endif; ?>
		  </ul>
		</div>
	  </div><!-- /.box -->
	</div>
  </div>
  <!-- END View data -->