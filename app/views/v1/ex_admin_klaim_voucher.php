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
		<div class="alert alert-success" role="alert">
		<form id="form_produk" data-toggle="validator" enctype="multipart/form-data" role="form" method="POST" action="<?php echo $this->uri->baseUri;?>index.php/admin/klaim_voucher/cek_voucher">
		<div class="row" style="border-bottom:2px solid #B8B8B8; border-top:2px solid #B8B8B8; margin-bottom:10px;border-bottom-right-radius: 15em 1em; border-bottom-left-radius: 1em 3em;border-top-left-radius: 1em 3em; border-top-right-radius: 1em 3em;">
			<div class="col-md-12">					
			<div class="form-group">
			  <label>Input Nomer Voucher:</label>
			  <div class="input-group col-xs-12" >
			  <input name="no_voucher" class="form-control input-lg" type="text" placeholder="XXXXXXXX-XXXX-XXXX-XXXX" required>
			  
			  </div>
			</div>				  
			</div>			
		</div>
		
		</div>
		
		<div class="box-footer clearfix">
			<input type="submit" class="btn btn btn-primary" value="Cek Voucher">
		</div>
		</form>
		 
		</div><!-- ./box-body -->
	  </div><!-- /.box -->
	</div><!-- /.col -->
</div>