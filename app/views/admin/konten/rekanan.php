<?php if(isset($alert)){
	echo $alert;
}?>
<?php $this->output('admin/form/input_rekanan');?>

  <!-- View data -->
  <div class="row">
	<div class="col-xs-12">
	  <div class="box">
		<div class="box-header with-border">
		  <h3 class="box-title">List data rekanan</h3>
		</div><!-- /.box-header -->
		<div class="box-body">
		  <table class="table table-bordered table-hover">
			<tr>
			  <th style="width: 10px">No</th>
			  <th style="width: 200px">Nama Rekanan</th>
			  <th style="width: 100px">Jenis</th>
			  <th >Alamat</th>
			  <th style="width: 300px">Action</th>
			</tr>
			<?php if ($viewall_rekanan){
				$no=$no;
				foreach($viewall_rekanan as $data){
					$data_pengguna=$this->user->viewall_pengguna_by_user_id($data->user_id);
					if($data_pengguna){	
						$alamat=$data_pengguna->alamat;
					}else{
						$alamat='Alamat belum terisi';
					}
					$no++;
					?>
					<tr>
			  <td><?php echo $no;?></td>
			  <td><?php echo $data->nama_rekanan; ?></td>
			  <td><?php echo ucwords($data->jenis); ?></td>
			  <td><?php echo $alamat; ?></td>
			  <td><a class="btn btn-app" data-toggle="modal" data-target="#myModalview<?php echo $data->id;?>">
				<i class="fa fa-tv"></i> View
				</a><a class="btn btn-app" data-toggle="modal" data-target="#myModal<?php echo $data->id;?>">
				<i class="fa fa-edit"></i> Edit
				</a>
				<!--
				<a class="btn btn-app" data-toggle="modal" data-target="#myModalconfirm<?php //echo $data->id;?>">
				<i class="fa fa-trash"></i> Hapus
				</a>-->
				</td>
			</tr>

				<!-- Modal Confirm
				<div class="modal fade" id="myModalconfirm<?php //echo $data->id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog " role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Alert Hapus Rekanan</h4>
					  </div>
					  <div class="modal-body">
					<div class="callout callout-danger">
                    <h4>Menghapus data <?php //echo $data->nama_rekanan;?></h4>
                    <p>Apakah anda yakin ingin menghapus data <strong><?php //echo $data->nama_rekanan;?></strong> ?</p>
                  </div>					  
					  <div class="modal-footer">					
						<a href="<?php //echo $this->uri->baseUri;?>index.php/admin/rekanan/hapus_rekanan/<?php //echo base64_encode($data->id);?>" type="button" class="btn btn-danger">Hapus</a>	
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					  </div>
					  </div>
					</div>
				  </div>
				</div>
				 END Modal confirm -->
				
				<!-- Modal View-->
				<div class="modal fade bs-example-modal-lg" id="myModalview<?php echo $data->id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">View Rekanan. ID Rekanan : <?php echo $data->id_rekanan;?></h4>
					  </div>
					  <div class="modal-body">
						<!--FORM View-->
						<form data-toggle="validator" enctype="multipart/form-data" role="form" method="POST" action="#">
						<div class="row" style="border-bottom:2px solid #B8B8B8; border-top:2px solid #B8B8B8; margin-bottom:10px;border-bottom-right-radius: 15em 1em; border-bottom-left-radius: 1em 3em;border-top-left-radius: 1em 3em; border-top-right-radius: 1em 3em;">
						<input type="hidden" name="id" value="<?php echo $data->id;?>">
						<div class="col-md-6">					
						<div class="form-group">
						  <label>Nama rekanan:</label>
						  <div class="input-group col-xs-12" >
						  <input name="rekanan" type="text" class="form-control" value="<?php echo $data->nama_rekanan;?>" readonly>
						  </div>
						</div>				  
						</div>
						<div class="col-md-6 ">					
						<div class="form-group">
						  <label>Alamat:</label>
						  <div class="input-group col-xs-12" >
						  <textarea name="alamat" class="form-control" rows="3" readonly><?php echo $alamat;?> </textarea>
						  </div><!-- /.input group -->
						</div>					
						</div>
						<div class="col-md-6 ">					
						<div class="form-group">
						  <label>Warna rekanan (untuk keperluan report graph):</label>
						  
						  <div class="input-group my-colorpicker">
						  <input type="text" name="warna" value="<?php echo $data->warna;?>" class="form-control" readonly />
						</div>
						  </div><!-- /.input group -->
						</div>
						<div class="col-md-6 ">					
						<div class="form-group">
						  <label>Jenis</label>
						  
						  <div class="input-group">
						  <input type="text" name="jenis" value="<?php echo ucwords($data->jenis);?>" class="form-control" readonly />
						</div>
						  </div><!-- /.input group -->
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
						<h4 class="modal-title" id="myModalLabel">Edit Rekanan</h4>
					  </div>
					  <div class="modal-body">
						<!--FORM Edit-->
						<form data-toggle="validator" enctype="multipart/form-data" role="form" method="POST" action="<?php echo $this->uri->baseUri;?>index.php/admin/rekanan/pro_edit_rekanan">
						<div class="row" style="border-bottom:2px solid #B8B8B8; border-top:2px solid #B8B8B8; margin-bottom:10px;border-bottom-right-radius: 15em 1em; border-bottom-left-radius: 1em 3em;border-top-left-radius: 1em 3em; border-top-right-radius: 1em 3em;">
						<input type="hidden" name="id" value="<?php echo $data->id;?>">
						<input type="hidden" name="user_id" value="<?php echo $data->user_id;?>">
						<div class="col-md-6">					
						<div class="form-group">
						  <label>Nama rekanan:</label>
						  <div class="input-group col-xs-12" >
						  <input name="rekanan" type="text" class="form-control" value="<?php echo $data->nama_rekanan;?>" required>
						  </div>
						</div>				  
						</div>
						<div class="col-md-6 ">					
						<div class="form-group">
						  <label>Alamat:</label>
						  <div class="input-group col-xs-12" >
						  <textarea name="alamat" class="form-control" rows="3" ><?php echo $alamat;?> </textarea>
						  </div><!-- /.input group -->
						</div>					
						</div>
						<div class="col-md-6 ">					
						<div class="form-group">
						  <label>Warna rekanan (untuk keperluan report graph):</label>
						  
						  <div class="input-group my-colorpicker">
						  <input type="text" name="warna" value="<?php echo $data->warna;?>" class="form-control" required/>                      
						  
						  <div class="input-group-addon">
							<i></i>
						  </div>
						</div>
						  </div><!-- /.input group -->
						</div>
						
							<div class="col-md-6 ">					
							<div class="form-group">
							  <label>Jenis:</label>
							  
							  <div class="input-group">
								
								<select name="jenis">
								<option value="umum" <?php if($data->jenis=='umum'){echo 'selected';}?>>Umum</option>
								<option value="rekanan" <?php if($data->jenis=='rekanan'){echo 'selected';}?>">Rekanan</option>
								
								</select>
							</div>
							  </div><!-- /.input group -->
							</div>
						
						</div>
						
					  <div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<input type="submit" class="btn btn btn-primary" value="Save changes">
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