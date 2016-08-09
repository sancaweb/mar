<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" type="text/css" href="<?php echo $this->uri->baseUri.ADM_STYLE;?>/prin_voucher.css">
	<link rel="stylesheet" type="text/css" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $this->uri->baseUri.ADM_STYLE;?>dist/css/AdminLTE.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $this->uri->baseUri.ADM_STYLE;?>bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

	</head>
<body onload="window.print()">

		<div class="box-footer">
			<div class="row">			
				<div class="col-md-12 ">					
				<div class="form-group">
				  <div class="input-group col-xs-12" >
				  <a href="<?php echo $this->uri->baseUri;?>index.php/admin/voucher/generate_voucher" class="btn btn-danger"><i class="fa fa-arrow-circle-left"></i> Back</a>
				  <a onclick="window.print();" class="btn btn-primary"><i class="fa fa-print"></i> Print</a>
					
				  </div><!-- /.input group -->
				</div>					
				</div>
			</div> <!--- row --> 	
		</div>
<div class="book">
    <div class="page">
        <div class="subpage">
		<div class="row">
		<?php
		$i=0;
for ($x = 0; $x < 18; $x++) {
		
		//$no_voucher=$no_voucher[$i];
			echo'<div class="col-xs-4">
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
				  '.$no_voucher.'<i class="fa fa-arrow-circle-right"></i>
				</a>
			  </div>
			</div><!-- ./col -->
			';
			
			
		?>			
		<input type="hidden" name="pengulang[]" value="<?php echo $i;?>" />
			<input type="hidden" name="no_voucher[]" value="<?php echo 'xxxxx-xxxx-xxxxx';?>" />
			<input type="hidden" name="potongan" value="<?php echo $potongan;?>" />
		<?php
		$i++;
		}
		//END loop
		?>
		
			
			</div>
		</div>
			
    </div>
    <!--<div class="page">
        <div class="subpage">Page 2/2</div>    
    </div> -->
</div>
</body>
</html>



 