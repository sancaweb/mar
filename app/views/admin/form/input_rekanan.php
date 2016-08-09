<div class="row">
	<div class="col-md-12">
	  <div class="box">
		<div class="box-header with-border">
		  <h3 class="box-title">Input data rekanan</h3>
		  <div class="box-tools pull-right">
			<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
			
			<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
		  </div>
		</div><!-- /.box-header -->
		<div class="box-body">
		  <form data-toggle="validator" enctype="multipart/form-data" role="form" method="POST" action="<?php echo $this->uri->baseUri;?>index.php/admin/rekanan/pro_input_rekanan">
		  <div id="itemRows">
			<div class="row" style="border-bottom:2px solid #B8B8B8; border-top:2px solid #B8B8B8; margin-bottom:10px;border-bottom-right-radius: 15em 1em; border-bottom-left-radius: 1em 3em;border-top-left-radius: 1em 3em; border-top-right-radius: 1em 3em;">
							
			<input type="hidden" name="pengulang[]" value="0">
			<div class="col-md-6">					
			<div class="form-group">
			  <label>Nama rekanan:</label>
			  <div class="input-group col-xs-12" >
			  <input name="rekanan[]" type="text" class="form-control" value="" required>
			  </div>
			</div>				  
			</div>
			<div class="col-md-6 ">					
			<div class="form-group">
			  <label>Alamat:</label>
			  <div class="input-group col-xs-12" >
			  <textarea name="alamat[]" class="form-control" rows="3" > </textarea>
			  </div><!-- /.input group -->
			</div>					
			</div>
			<div class="col-md-6 ">					
			<div class="form-group">
			  <label>Warna rekanan (untuk keperluan report graph):</label>
			  
			  <div class="input-group my-colorpicker">
			  <input type="text" name="warna[]" value="" class="form-control" required/>                      
			  
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
			    
				<select name="jenis[]" class="form-control" required>
				<option value="">Pilih Jenis Rekanan</option>
				<option value="umum">Umum</option>
				<option value="rekanan">Rekanan</option>
				
				</select>
			</div>
			  </div><!-- /.input group -->
			</div>
			
			
		  </div>
			</div> <!-- ItemRows -->
		  
		</div><!-- ./box-body -->
		<div class="box-footer">
		  <div class="row">
			
			<div class="col-md-12 ">					
			<div class="form-group">
			  <div class="input-group col-xs-12" >
			  <a class="btn btn-success" id="add_item" ><i class="fa fa-plus"></i>&nbsp;Tambah Row</a>&nbsp;||&nbsp;
				<input type="submit" class="btn btn btn-primary" value="Input">
			  </div><!-- /.input group -->
			</div>					
			</div>
		</div> <!--- row -->
		</div><!-- /.box-footer -->
		</form>
	  </div><!-- /.box -->
	</div><!-- /.col -->
  </div>