<?php if(isset($alert)){
	echo $alert;
}?>
<div class="middle-content">
	<div class="container">
  <!-- View data -->
  <div class="row">
	<div class="col-xs-12">
	  <div class="box">
		<div class="box-header with-border">
		  <h3 class="box-title">View images for <?php echo $nama_kategori;?></h3><br/>
		  <a href="<?php echo $this->uri->baseUri;?>index.php/gallery" class="btn btn-primary" type="button" >
		  
			<i class="fa fa-arrow-left"></i> Back
			</a>
		</div><!-- /.box-header -->
		<div class="box-body">
		  
			<div class="row">
			<?php if($viewall_gallery){
				foreach($viewall_gallery as $gallery){
					?>
			
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-4">					
				<div class="thumbnail"> 
				<a href="<?php echo $this->uri->baseUri;?>upload/gallery/<?php echo $gallery->foto;?>" data-lightbox="lightbox" data-title="<?php echo $gallery->keterangan;?>">
				<img class="img-responsive" src="<?php echo $this->uri->baseUri;?>upload/gallery/thumbs/<?php echo $gallery->foto;?>">
				</a>
					<div class="caption"> 
					
					<p><?php echo $gallery->keterangan;?></p>
					</div>
				</div>
			</div>
					<?php
				}
			}else{
				?>
            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
                <img class="img-responsive" src="<?php echo $this->uri->baseUri;?>upload/gallery/blank.jpg">
            </div>
			<?php
			} ?>
            
			 
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
  </div>
  </div>