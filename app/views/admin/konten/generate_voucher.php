<?php if(isset($alert)){
	echo $alert;
}
?>
		  <?php
			if(isset($page)){
			if($page=='pro_generate_voucher'){
				
			}else{
				?>
			<div class="row">
			<div class="col-md-12">
			  <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Generate Voucher</h3>
				  <div class="box-tools pull-right">
					<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>			
					<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
				  </div>
				</div><!-- /.box-header -->
			<div class="box-body">				
			<a class="btn btn-app" data-toggle="modal" data-target="#myModalgenerate">
			<i class="fa fa-barcode"></i> Generate Voucher
			</a>
			</div><!-- ./box-body -->
			</div><!-- /.box -->
		</div><!-- /.col -->
		</div>
				<?php
			}
			}
		  ?>
<!-- List voucher -->
<?php
if(isset($page)){
	if($page=='pro_generate_voucher'){
		?>
		<form data-toggle="validator" enctype="multipart/form-data" role="form" method="POST" action="<?php echo $this->uri->baseUri;?>index.php/admin/voucher/save_and_print">
			
		<?php
		
for ($x = 0; $x < 18; $x++) {
		
		
			echo'<div class="col-lg-3 col-xs-6">
			  <!-- small box -->
			  <div class="small-box bg-green">
				<div class="inner">
				  <h3><sup style="font-size: 20px">Voucher Umroh</sup></h3>
				  <p>'.$nama_rekanan->nama_rekanan.' (Rp. '.$potongan.')</p>
				</div>
				<div class="icon">
				  <i class="ion ion-chatbubbles"></i>
				</div>
				<a href="#" class="small-box-footer">
				  '.$no_voucher.' <i class="fa fa-arrow-circle-right"></i>
				</a>
			  </div>
			</div><!-- ./col -->
			';
		?>			
			<input type="hidden" name="id_rekanan" value="<?php echo $id_rekanan;?>" />
			<input type="hidden" name="no_voucher" value="<?php echo $no_voucher;?>" />
			<input type="hidden" name="potongan" value="<?php echo $potongan;?>" />
			<input type="hidden" name="no_cetak" value="<?php echo $no_cetak;?>" />
			<input type="hidden" name="jumlah" value="<?php echo $jumlah;?>" />
			
		<?php
		}
		//END loop
		?>
		
		<div class="row">
			<div class="col-md-12">
			  <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Generate Voucher</h3>
				  <div class="box-tools pull-right">
					<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>			
					<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
				  </div>
				</div><!-- /.box-header -->
			<div class="box-body">					
				<a class="btn btn-app" data-toggle="modal" data-target="#myModalgenerate">
				<i class="fa fa-barcode"></i> Regenerate Voucher
				</a>
				
				&nbsp;||&nbsp;<input type="submit" class="btn btn-primary" value="Save and Print" />
				
				</div><!-- ./box-body -->
				</div><!-- /.box -->
			</div><!-- /.col -->
			</div>
		</form>
		<?php
	}
}
		
?>
<!-- END List Voucher -->

<!-- Modal Generate-->
<div class="modal fade bs-example-modal-lg" id="myModalgenerate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="myModalLabel">Edit Rekanan</h4>
	  </div>
	  <div class="modal-body">
		<!--FORM generate-->
		<form data-toggle="validator" enctype="multipart/form-data" role="form" method="POST" action="<?php echo $this->uri->baseUri;?>index.php/admin/voucher/pro_generate_voucher">
		<div class="row" style="border-bottom:2px solid #B8B8B8; border-top:2px solid #B8B8B8; margin-bottom:10px;border-bottom-right-radius: 15em 1em; border-bottom-left-radius: 1em 3em;border-top-left-radius: 1em 3em; border-top-right-radius: 1em 3em;">
		<input type="hidden" name="id" value="">
		
		<div class="col-md-12 ">					
		<div class="form-group">
		<label>Rekanan</label>
		<select class="form-control select2" name="rekanan" style="width: 100%;">
		<?php if(isset($rekanan)){
			if($rekanan){
				foreach($rekanan as $rekanan){
					?>
					<option value="<?php echo $rekanan->id_rekanan;?>"><?php echo $rekanan->nama_rekanan;?></option>
					<?php
				}
			}else{
				?>
				<option value="">Data tidak ada</option>
				<?php
			}
		}else{
			?>
			<option value="">Data tidak ada</option>
			<?php
		}?>
		
		</select>
	  </div><!-- /.form-group -->					
		</div>
		<div class="col-md-12 ">					
		<div class="form-group">		
		<label>Potongan Harga (Rp)</label>
		<div class="input-group" id="div_potongan">
		<input type="text" id="potongan" name="potongan" autocomplete="off" required />
		</div>
		</div>
		</div>
		
		<div class="col-md-6 ">					
		<div class="form-group">		
		<label>Quantity</label>
		<div class="input-group" id="div_potongan2">
		<input type="text" id="potongan2" name="jumlah" autocomplete="off" placeholder="Jumlah Voucher" required />
		</div>
		</div>
		</div>
		
		</div>
		
	  <div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		<input type="submit" class="btn btn btn-primary" value="Generate Voucher">
	  </div>
		</form>
		<!-- end form Generate-->
	  </div>
	</div>
  </div>
</div>
<!-- END Modal Generate -->