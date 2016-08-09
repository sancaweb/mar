<?php if(isset($alert)){
	echo $alert;
}

?>
<!-- Default box -->
<div class="box">
<div class="box-header with-border">
  <h3 class="box-title"><?php echo $title;?></h3>
  <div class="box-tools pull-right">
	<button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
	<button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
  </div>
</div>
<div class="box-body">
  
  <div class="row">
  <?php if($data_produk){
	  foreach ($data_produk as $data){
		  
		  ?>
		  <div class="col-sm-6 col-md-4">
		  <div class="thumbnail" >
		  <img alt="100%x200" src="<?php echo $this->image->gambar_pertama($data->keterangan,$this->uri->baseUri.'assets/filemanager/source/produk/default.jpg');?>" style="height: 200px; width: 100%; display: block;">
		  <div class="caption"><h3><?php echo $data->nama_produk;?></h3> 
		  <?php echo $this->image->del_img($this->readmore->potong($data->keterangan,400)).' ... ';?>
		  <p><a class="btn btn-app" data-toggle="modal" data-target="#myModal<?php echo $data->id;?>">
			<i class="fa fa-tv"></i> View Detail
			</a>
			<a class="btn btn-app btn-primary" data-toggle="modal" data-target="#myModalinput<?php echo $data->id;?>">
			<i class="fa fa-registered"></i> Registrasi
			</a>
		  </p> 
		  </div>  
		  </div>
		  </div>
		  
  
		  <!-- Modal View-->
				<div class="modal fade bs-example-modal-lg" id="myModal<?php echo $data->id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel"><?php echo $data->nama_produk;?></h4>
					  </div>
					  <div class="modal-body">
					  <div>
					  
						<?php echo $data->keterangan;?>
						</div>
					  </div>
					  
					  <div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					  </div>
					</div>
					
				  </div>
				</div>
				<!-- END Modal View-->
				
				<!-- MODAL input regis umroh -->
				<div class="modal fade bs-example-modal-lg" id="myModalinput<?php echo $data->id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Input Data Jamaah </h4>
					  </div>
					  <div class="modal-body">
						<form id="form_produk" data-toggle="validator" enctype="multipart/form-data" role="form" method="POST" action="<?php echo $this->uri->baseUri;?>index.php/admin/voucher/input_penerima_voucher">
						<div class="row" style="border-bottom:2px solid #B8B8B8; border-top:2px solid #B8B8B8; margin-bottom:10px;border-bottom-right-radius: 15em 1em; border-bottom-left-radius: 1em 3em;border-top-left-radius: 1em 3em; border-top-right-radius: 1em 3em;">
							<input type="hidden" name="id_rekanan" class="form-control" value="" readonly>
							<input type="hidden" name="no_voucher" class="form-control" value="" readonly>
							<input type="hidden" name="id_voucher" class="form-control" value="" readonly>
						<div class="col-md-6">					
							<div class="form-group">
							  <label>Nama Rekanan:</label>
							  <div class="input-group col-xs-12" >
							  <input type="text" class="form-control" value="" readonly>
							  
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
						</div>
						
						
					  <div class="modal-footer"><!--
						<input type="submit" class="btn btn btn-primary" value="Submit"> -->
						<a href="<?php echo $this->uri->baseUri;?>index.php/admin/klaim_voucher/pro_order_produk" class="btn btn btn-primary"> Submit </a>
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					  </div>
						
						</form>
						
					  </div>
					</div>
				  </div>
				</div>
				<!-- END Modal input regis umroh -->
		  <?php
	  }
  }?>
  </div> <!-- END .row -->
</div><!-- /.box-body -->
<div class="box-footer">

</div><!-- /.box-footer-->
</div><!-- /.box -->