

<div class="middle-content">
	<div class="container">
	<?php if(isset($alert)){
		echo $alert;
	}
	
	?>
	
	<?php
		if(isset($data_penerima_voucher)){
			if($data_penerima_voucher){
				?>
				<form id="form_penerima_voucher" data-toggle="validator" enctype="multipart/form-data" role="form" method="POST" action="<?php echo $this->uri->baseUri;?>index.php/klaim_voucher/edit_penerima">
				<input type="hidden" name="id_penerima" class="form-control" value="<?php echo $data_penerima_voucher->id; ?>" readonly>
				<?php
			}else{
				?>
				<form id="form_penerima_voucher" data-toggle="validator" enctype="multipart/form-data" role="form" method="POST" action="<?php echo $this->uri->baseUri;?>index.php/klaim_voucher/input_penerima">
				<?php
			}
		}else{
			?>
			<form id="form_penerima_voucher" data-toggle="validator" enctype="multipart/form-data" role="form" method="POST" action="<?php echo $this->uri->baseUri;?>index.php/klaim_voucher/input_penerima">
			<?php
		}
	?>
			<input type="hidden" name="id_rekanan" class="form-control" value="<?php echo $id_rekanan->id_rekanan; ?>" readonly>
			<input type="hidden" name="no_voucher" class="form-control" value="<?php echo $no_voucher; ?>" readonly>
			<input type="hidden" name="user_id" class="form-control" value="<?php echo $user_id; ?>" readonly>
		<div class="row" style="border-bottom:2px solid #B8B8B8; border-top:2px solid #B8B8B8; margin-bottom:10px;border-bottom-right-radius: 15em 1em; border-bottom-left-radius: 1em 3em;border-top-left-radius: 1em 3em; border-top-right-radius: 1em 3em;">
			<div class="col-md-6">					
			<div class="form-group">
			  <label>Nama Rekanan:</label>
			  <div class="input-group col-xs-12" >
			  <input type="text" class="form-control" value="<?php echo $nama_rekanan->nama_rekanan; ?>" readonly>
			  </div>
			</div>				  
			</div>	
		<div class="col-md-6">					
			<div class="form-group">
			  <label>Nama Penerima:</label>
			  <div class="input-group col-xs-12" >
			  <input type="text" name="nama_penerima" class="form-control" Placeholder="Nama Penerima"
			  <?php if(isset($data_penerima_voucher)){
				  if($data_penerima_voucher){
					  echo 'value="'.$data_penerima_voucher->nama_penerima.'" required';
				  }else{
					  echo 'value=" " required';
				  }
									  
				  }else{
					  echo 'value=" " required'; }?> >
			  <p class="help-block">Nama Penerima Voucher</p>
			  </div>
			</div>				  
			</div>
			<div class="col-md-6">					
			<div class="form-group">
			  <label>No Tlp/ HP:</label>
			  <div class="input-group col-xs-12" >
			  <input type="text" name="no_tlp" class="form-control" Placeholder="08xxxxxxxx" 
			  <?php if(isset($data_penerima_voucher)){
				  if($data_penerima_voucher){
					  echo 'value="'.$data_penerima_voucher->no_tlp.'" required';
				  }else{
					  echo 'value="" required';
				  }				  				  
			  }else{
				  echo 'value=" " required';
			  }?>
			  >
			  <p class="help-block">No Telpon atau Handphone</p>
			  </div>
			</div>				  
			</div>
			
		<div class="col-md-6">					
			<div class="form-group">
			  <label>Potongan:</label>
			  <div class="input-group col-xs-12" >
			  <input type="hidden" name="potongan" class="form-control" value="<?php echo 'Rp. '.number_format($potongan->potongan,0,'','.');?>" readonly>
			  <p class="help-block">Potongan Harga</p>
			  </div>
			</div>				  
			</div>	
			<div class="col-md-6">					
				<div class="form-group">
				  <label>Alamat</label>
				  <div class="input-group col-xs-12" >
				  <textarea class="form-control" name="alamat">
				  <?php if(isset($data_penerima_voucher)){
				  if($data_penerima_voucher){
					  echo $data_penerima_voucher->alamat;
					  }else{
						  echo 'value=" " required';
					  }
									  
				  }else{
					  echo 'value=" " required';
				  }?>
				  </textarea>
				  <p class="help-block">Alamat Penerima</p>
				  </div>
				</div>				  
				</div>	
		
			
			<div class="col-md-6">					
			<div class="form-group">
			  <label>Email:</label>
			  <div class="input-group col-xs-12" >
			  <input type="email" name="email" class="form-control" placeholder="tes@tes.com" 
				<?php if(isset($data_penerima_voucher)){
				  if($data_penerima_voucher){
					  echo 'value="'.$data_penerima_voucher->email.'" required';
				  }else{
					  echo 'value=" " required';
				  }
				  				  
			  }else{
				  echo 'value=" " required'; }?>
			 >
			  <p class="help-block">Contoh: aku@website.com</p>
			  </div>
			</div>				  
			</div>
			
			<div class="row">
			<div class="col-md-6">
				<a type="button" class="btn btn-danger" href="<?php echo $this->uri->baseUri;?>index.php/klaim_voucher"> Cancel </a>
			<input type="submit" class="btn btn-primary" value="Submit">
			</div>
			</div>
			
		</div>
		
		</form>



	</div> <!-- /.container -->
</div> <!-- /.middle-content -->
