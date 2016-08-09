<?php if(isset($alert)){
	echo $alert;
}?>


<?php $this->output('admin/form/input_gallery');?>

  <!-- View data -->
  <div class="row">
	<div class="col-xs-12">
	  <div class="box">
		<div class="box-header with-border">
		  <h3 class="box-title">Gallery Manager</h3>
		  <a class="btn btn-primary" type="button" data-toggle="modal" data-target="#myModalinput">
		  
			<i class="fa fa-plus-square"></i> Tambah Foto
			</a>
		</div><!-- /.box-header -->
		<div class="box-body">
		  
		  <div class="row"> 
		  <?php if($viewall_kategori){
			  foreach($viewall_kategori as $data_kategori){
				  ?>
				  
			<div class="col-md-3">
				<div class="thumbnail"> 
				<img src="<?php echo $this->uri->baseUri;?>upload/gallery/kategori/<?php echo $data_kategori->image_kat;?>" style="height: 200px; width: 100%; display: block;" alt="100x200">
					<div class="caption"> 
					<h3><?php echo $data_kategori->nama_kategori.' ('.$this->gallery->hitung_gallery_by_id($data_kategori->id).' Foto)';?></h3> 
					<p><?php echo $data_kategori->keterangan;?></p>
						<p>
						<a href="<?php echo $this->uri->baseUri;?>index.php/admin/gallery/view/<?php echo base64_encode($data_kategori->id);?>" class="btn btn-primary" role="button">Open</a>
						<a href="<?php echo $this->uri->baseUri;?>index.php/admin/gallery/edit/<?php echo base64_encode($data_kategori->id);?>" class="btn btn-warning" role="button">Edit</a>
						<a href="<?php echo $this->uri->baseUri;?>index.php/admin/gallery/view/<?php echo base64_encode($data_kategori->id);?>" class="btn btn-danger" role="button" data-toggle="tooltip" data-placement="bottom" title="Anda akan menghapus semua foto di dalam kategori ini">
						Hapus
						</a>
						</p>
					</div>
				</div> 
			</div> 
				  <?php
			  }
		  }else{
			  ?>
			  <div class="col-md-3">
				<div class="thumbnail"> 
				<img src="<?php echo $this->uri->baseUri;?>upload/gallery/kategori/blank.jpg" style="height: 200px; width: 100%; display: block;" alt="100x200">
					<div class="caption"> 
					<h3>Data Gallery Tidak Ada.</h3>
					</div>
				</div> 
			</div> 
			  
			  <?php
		  }?> 
			 
		  </div>
		  
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