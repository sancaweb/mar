
<div class="row">
	<div class="col-md-12">
	  <div class="box">
		<div class="box-header with-border">
		  <h3 class="box-title">Tools</h3>
		  <div class="box-tools pull-right">
			
		  </div>
		</div><!-- /.box-header -->
		<div class="box-body">	
		<?php $this->output(TEMPLATE.'form/tools_pesan');?>
		
		</div>
	</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
	  <div class="box">
		<div class="box-header with-border">
		  <h3 class="box-title"><?php echo $title;?></h3>
		  <div class="box-tools pull-right">
		  
		  </div>
		</div><!-- /.box-header -->
		<div class="box-body table-responsive">
		
		<?php if ($page=='inbox'){
			?>
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
								$cek_user_level_by_userid=$this->user->cek_user_level_by_userid($pengirim)->user_level;
								$user_level=$this->user->ambil_user_level($cek_user_level_by_userid)->ket;
								if($nama_pengguna->nama_lengkap==''){								
									$nama_pengirim=$this->user->ambil_username($pengirim)->username.' ('.$user_level.' )';
								}else{
									$nama_pengirim=$nama_pengguna->nama_lengkap.' ('.$user_level.' )';
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
							echo '<p class="bg-success">Sudah Dibaca</p>';
						}						
						?></td>					
						<td><?php 
						echo date('d-M-Y',strtotime($data->tgl_input));					
						?></td>	
						<td>
						<a class="btn btn-primary btn-flat" href="<?php echo $this->uri->baseUri;?>index.php/pesan/view_pesan/<?php echo base64_encode($data->id_pesan).'/'.base64_encode($data->id);?>">
							<i class="fa fa-folder-open"></i> View
							</a>
							
						<a class="btn btn-primary btn-flat" data-toggle="modal" data-target="#myModalconfirm<?php echo $data->id;?>">
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
			
			<?php
		}?>
		
		<?php
			if($page=='sentitems'){
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
								$cek_user_level_by_userid=$this->user->cek_user_level_by_userid($penerima)->user_level;
								$user_level=$this->user->ambil_user_level($cek_user_level_by_userid)->ket;
								if($nama_pengguna->nama_lengkap==''){								
									$nama_penerima=$this->user->ambil_username($penerima)->username.' ('.$user_level.' )';
								}else{
									$nama_penerima=$nama_pengguna->nama_lengkap.' ('.$user_level.' )';
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
						<a class="btn btn-primary" href="<?php echo $this->uri->baseUri;?>index.php/pesan/view_pesan/<?php echo base64_encode($data_sentitems->id_pesan).'/'.base64_encode($data_sentitems->id);?>">
							<i class="fa fa-folder-open"></i> View
							</a>
							
						<a class="btn btn-primary" data-toggle="modal" data-target="#myModalconfirm<?php echo $data_sentitems->id;?>">
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
			}
		?>
		
		 
		</div><!-- ./box-body -->
	  </div><!-- /.box -->
	</div><!-- /.col -->
</div>