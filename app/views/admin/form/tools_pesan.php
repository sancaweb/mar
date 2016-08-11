
		<div class="row">	
		<a class="btn btn-app btn-flat" data-toggle="modal" data-target="#myModalExcel">
		<i class="fa fa-file-excel-o"></i> Export To Excel
		</a>
				
		<a class="btn btn-app btn-flat" data-toggle="modal" data-target="#myModalSearch">
		<i class="fa fa-search"></i> Search
		</a>		
		<a class="btn btn-app btn-flat disabled" href="#">
		<i class="fa fa-file-text"></i> View All data
		</a>		
		<a data-toggle="modal" data-target="#myModalInput" class="btn btn-app btn-flat" href="<?php echo $this->uri->baseUri;?>index.php/admin/voucher/penerima_voucher">
		<i class="fa fa-pencil-square-o"></i> Tulis Pesan
		</a>
		</div>


<!-- Modal Search-->
<div class="modal fade" id="myModalSearch" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog " role="document">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="myModalLabel">Pencarian data Penerima Voucher</h4>
	  </div>
	  <div class="modal-body">
	  
		<form class="form-inline" method="post" data-toggle="validator" enctype="multipart/form-data" role="form" action="<?php echo $this->uri->baseUri;?>index.php/admin/voucher/cari_penerima">
		  <div class="form-group">
			<select name="berdasarkan" class="form-control" required>
				<option value="">Cari Berdasarkan </option>
				<option value="id_rekanan">ID Rekanan</option>
				<option value="no_voucher">No Voucher</option>
				<option value="rekanan.nama_rekanan">Nama Rekanan</option>
				<option value="nama_penerima">Nama Penerima</option>
				<option value="username">Username</option>
				
			</select>
		  </div>
		  <div class="form-group">
			<input type="text" name="kata_kunci" class="form-control" placeholder="Kata Kunci" required>
		  </div>
		  
	  <div class="modal-footer">
		  <button type="submit" class="btn btn-default"><i class="fa fa-search"></i>Search</button>	  
		<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
	  </div>
		</form>
	  </div>
	</div>
  </div>
</div>
<!-- END Modal Search -->

<!-- Modal Excel-->
<div class="modal fade" id="myModalExcel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog " role="document">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="myModalLabel">Export Data to Excel</h4>
	  </div>
	  <div class="modal-body">
	  <div class="row" >
		<div class="col-md-6">
		<a class="btn btn-app btn-flat" href="<?php echo $this->uri->baseUri;?>index.php/admin/excel/penerima_voucher">
		<i class="fa fa-file-excel-o"></i> Export All Data To Excel
		</a>
		</div>
		<div class="col-md-6">
		
		<div class="input-group">
		  <button class="btn btn-default pull-right" id="daterange-btn">
			<i class="fa fa-calendar"></i> Berdasarkan Rentang Waktu
			<i class="fa fa-caret-down"></i>
		  </button>
		</div>
		</div>
		</div>
		<hr>
		<div class="row">
		<div class="col-md-12">
		
		<form class="form-inline" method="post" data-toggle="validator" enctype="multipart/form-data" role="form" action="<?php echo $this->uri->baseUri;?>index.php/admin/excel/penerima_voucher">
		  
			  <div class="form-group">
				<label class="sr-only" for="dari_tgl">Dari</label>
				<input type="text" name="dari_tgl" class="form-control" id="dari_tgl" readonly>
			  </div>
			  <div class="form-group">
				<label class="sr-only" for="exampleInputPassword3">Ke</label>
				<input type="text" name="ke_tgl" class="form-control" id="ke_tgl" readonly>
			  </div>
			  <button type="submit" class="btn btn-default"><i class="fa fa-file-excel-o"></i> Export Now</button>
			</form>
		</div>
		
	  </div>
	  <div class="modal-footer">		   
		<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
	  </div>
	</div>
  </div>
</div>
<!-- END Modal Excel -->

<!-- MODAL INPUT -->
<div class="modal fade bs-example-modal-lg" id="myModalinput" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="myModalLabel">Input Data Slide</h4>
	  </div>
	  <div class="modal-body">
		<form data-toggle="validator" enctype="multipart/form-data" role="form" method="POST" action="<?php echo $this->uri->baseUri;?>index.php/admin/pengaturan/input_header">
		
		<div class="row" style="border-bottom:2px solid #B8B8B8; border-top:2px solid #B8B8B8; margin-bottom:10px;border-bottom-right-radius: 15em 1em; border-bottom-left-radius: 1em 3em;border-top-left-radius: 1em 3em; border-top-right-radius: 1em 3em;">
			
			<input type="hidden" name="oke" >
			<div class="col-md-6">					
			<div class="form-group">
			  <label>Gambar:</label>
			  <div class="input-group col-xs-12" >
			  <input name="image" type="file" required >
				<p class="help-block"> Ukuran yang dianjurkan 1280x400 Pixel (maximal 5MB)</p>
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
<!-- END Modal INPUT -->