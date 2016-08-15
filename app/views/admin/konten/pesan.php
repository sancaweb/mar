<?php if(isset($alert)){
	echo $alert;
}
?>
<div class="row">
	<div class="col-md-12">
	  <div class="box">
		<div class="box-header with-border">
		  <h3 class="box-title">Tools</h3>
		  <div class="box-tools pull-right">
			<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>			
			<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
		  </div>
		</div><!-- /.box-header -->
		<div class="box-body">	
		<?php $this->output('admin/form/tools_pesan');?>
		
		</div>
	</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
	  <div class="box">
		<div class="box-header with-border">
		  <h3 class="box-title">Data Pesan</h3>
		  <div class="box-tools pull-right">
			<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>			
			<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
		  </div>
		</div><!-- /.box-header -->
		<div class="box-body">
		
		<!-- Nav tabs -->
		  <ul class="nav nav-tabs" role="tablist">
			<li role="presentation" <?php if($page=='inbox'){echo 'class="active"';}?>><a href="<?php echo $this->uri->baseUri;?>index.php/admin/pesan" >Inbox</a></li>
			<li role="presentation" <?php if($page=='sentitems'){echo 'class="active"';}?>><a href="<?php echo $this->uri->baseUri;?>index.php/admin/pesan/sentitems" >Sent Items</a></li>
		  </ul>

		  <!-- Tab panes -->
		  <div class="tab-content">
			<?php if($page=='inbox'){
				?>
				<div role="tabpanel" class="tab-pane active" id="inbox">
				<table class="table table-bordered table-hover">
				<tr>
				  <th >No</th>
				  <th >ID Pesan</th>
				  <th >Pengirim</th>
				  <th >Email</th>
				  <th >Subjek</th>
				  <th >Status</th>
				  <th >Tgl Terkirim</th>
				  <th >Action</th>
				</tr>
					<?php if($data_pesan){
						if(isset($no)){
							$no=$no;
						}else{
							$no=0;
						}
						
						foreach($data_pesan as $data){
							$no++;
							$pengirim=$data->pengirim;
							if($pengirim==0){
								$nama_pengirim='Guest';
							}else{
								$nama_pengguna=$this->user->view_nama_lengkap($pengirim);
								if($nama_pengguna->nama_lengkap==''){								
									$nama_pengirim=$this->user->ambil_username($pengirim)->username;
								}else{
									$nama_pengirim=$nama_pengguna->nama_lengkap;
								}
							}
					?>
						<tr>
						<td><?php echo $no;?></td>
						<td><?php echo $data->id_pesan;?></td>
						<td><?php echo $nama_pengirim;?></td>
						<td><?php echo $data->email;?></td>
						<td><?php echo $data->subjek;?></td>
						<td><?php if($data->status==0){
							echo '<p class="bg-danger">Belum Dibaca</p>';
						}else{
							echo '<p class="bg-primary">Sudah Dibaca</p>';
						}						
						?></td>					
						<td><?php 
						echo date('d-M-Y',strtotime($data->tgl_input));					
						?></td>	
						<td>
						<a class="btn btn-app" href="<?php echo $this->uri->baseUri;?>index.php/admin/pesan/view_pesan/<?php echo base64_encode($data->id_pesan).'/'.base64_encode($data->id);?>">
							<i class="fa fa-folder-open"></i> View
							</a>
							
						<a class="btn btn-app" data-toggle="modal" data-target="#myModalconfirm<?php echo $data->id;?>">
							<i class="fa fa-trash"></i> Hapus Pesan
							</a>
						</td>
						</tr>
							<!-- Modal Confirm-->
						<div class="modal fade" id="myModalconfirm<?php echo $data->id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						  <div class="modal-dialog " role="document">
							<div class="modal-content">
							  <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="myModalLabel">Alert Hapus Pesan</h4>
							  </div>
							  <div class="modal-body">
							<div class="callout callout-danger">
							<h4>Menghapus Pesan </h4>
							<p>Apakah anda yakin akan menghapus pesan ..?</p>
						  </div>					  
							  <div class="modal-footer">					
								<a href="#" type="button" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</a>	
								<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
							  </div>
							  </div>
							</div>
						  </div>
						</div>
						<!-- END Modal confirm -->

							<?php
						}
					}else{
						?>
						
					<tr>
					<td colspan="6">Data tidak ada</td>
					</tr>
						<?php
					}?>
			  </table>
			  <div class="box-footer clearfix">
			  <?php echo 'Total Pesan: '.$total_pesan.' ';?>
			  <ul class="pagination pagination-sm no-margin pull-right">
			  <?php if(isset($pageLinks)){
				  ?>
				<?php if ($pageLinks): ?>
						
						<?php foreach ($pageLinks as $paging): ?>
							<?php echo '<li>'.$paging; ?></li>
							
						<?php endforeach; ?>
					
							<?php endif; ?>
				<?php  } ?>
			  </ul>
			  
			</div> 
			</div> <!-- End Tabs Inbox -->
				<?php
			}else{
				?>
				<div role="tabpanel" class="tab-pane" id="inbox">
			
				
				</div>
				<?php
			}?>
			
			<?php if($page=='sentitems'){
				?>
				<table class="table table-bordered table-hover">
				<tr>
				  <th >No</th>
				  <th >ID Pesan</th>
				  <th >Penerima</th>
				  <th >Email</th>
				  <th >Subjek</th>
				  <th >Status</th>
				  <th >Tgl Terkirim</th>
				  <th >Action</th>
				</tr>
					<?php if($data_sentitems){
						if(isset($no)){
							$no=$no;
						}else{
							$no=0;
						}
						
						foreach($data_sentitems as $data_sentitems){
							$no++;
							$penerima=$data_sentitems->penerima;
							if($penerima==0){
								$nama_penerima='Guest';
							}else{
								$nama_pengguna=$this->user->view_nama_lengkap($penerima);
								if($nama_pengguna->nama_lengkap==''){								
									$nama_penerima=$this->user->ambil_username($penerima)->username;
								}else{
									$nama_penerima=$nama_pengguna->nama_lengkap;
								}
							}
					?>
						<tr>
						<td><?php echo $no;?></td>
						<td><?php echo $data_sentitems->id_pesan;?></td>
						<td><?php echo $nama_penerima;?></td>
						<td><?php echo $data_sentitems->email;?></td>
						<td><?php echo $data_sentitems->subjek;?></td>
						<td><?php if($data_sentitems->status==0){
							echo '<p class="bg-danger">Belum Dibaca</p>';
						}else{
							echo '<p class="bg-primary">Sudah Dibaca</p>';
						}						
						?></td>					
						<td><?php 
						echo date('d-M-Y',strtotime($data_sentitems->tgl_input));					
						?></td>	
						<td>
						<a class="btn btn-app" href="<?php echo $this->uri->baseUri;?>index.php/admin/pesan/view_pesan/<?php echo base64_encode($data_sentitems->id_pesan).'/'.base64_encode($data_sentitems->id);?>">
							<i class="fa fa-folder-open"></i> View
							</a>
							
						<a class="btn btn-app" data-toggle="modal" data-target="#myModalconfirm<?php echo $data_sentitems->id;?>">
							<i class="fa fa-trash"></i> Hapus Pesan
							</a>
						</td>
						</tr>
							<!-- Modal Confirm-->
						<div class="modal fade" id="myModalconfirm<?php echo $data_sentitems->id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						  <div class="modal-dialog " role="document">
							<div class="modal-content">
							  <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="myModalLabel">Alert Hapus Pesan</h4>
							  </div>
							  <div class="modal-body">
							<div class="callout callout-danger">
							<h4>Menghapus Pesan </h4>
							<p>Apakah anda yakin akan menghapus pesan ..?</p>
						  </div>					  
							  <div class="modal-footer">					
								<a href="#" type="button" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</a>	
								<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
							  </div>
							  </div>
							</div>
						  </div>
						</div>
						<!-- END Modal confirm -->

							<?php
						}
					}else{
						?>
						
					<tr>
					<td colspan="6">Data tidak ada</td>
					</tr>
						<?php
					}?>
			  </table>
			  <div class="box-footer clearfix">
			  <?php echo 'Total Pesan: '.$total_pesan_sentitems.' ';?>
			  <ul class="pagination pagination-sm no-margin pull-right">
			  <?php if(isset($pageLinks)){
				  ?>
				<?php if ($pageLinks): ?>
						
						<?php foreach ($pageLinks as $paging): ?>
							<?php echo '<li>'.$paging; ?></li>
							
						<?php endforeach; ?>
					
							<?php endif; ?>
				<?php  } ?>
			  </ul>
			  
			</div> 
				<?php
			}else{
				?>
				<div role="tabpanel" class="tab-pane" id="sentitems">
				...			
				</div>
				<?php
			}?>
			
			
			
		  </div>
		
		 
		</div><!-- ./box-body -->
	  </div><!-- /.box -->
	</div><!-- /.col -->
</div>