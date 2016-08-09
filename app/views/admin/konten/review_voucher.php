<?php if(isset($alert)){
	echo $alert;
}
?>
<div class="row">
	<?php 
	// for ($x = 1; $x <= 12; $x++) {
		
		// $random=$this->randomstring->randomstring(4);
		// $random2=$this->randomstring->randomstring(4);
		// $random3=$this->randomstring->randomstring(4);
		
		// $no_voucher=$id_rekanan.'-'.$random.'-'.$random2.'-'.$random3;
			// echo'<div class="col-lg-3 col-xs-6">
			  // <!-- small box -->
			  // <div class="small-box bg-green">
				// <div class="inner">
				  // <h3>53<sup style="font-size: 20px">%</sup></h3>
				  // <p>Bounce Rate</p>
				// </div>
				// <div class="icon">
				  // <i class="ion ion-stats-bars"></i>
				// </div>
				// <a href="#" class="small-box-footer">
				  // '.$no_voucher.' <i class="fa fa-arrow-circle-right"></i>
				// </a>
			  // </div>
			// </div><!-- ./col -->';
		// }
		
		
		// $i=0;
		// for ($x = 1; $x <= 12; $x++) {
			// echo $no_voucher[$i].'-'.$i.'<br/>';
			// $i++;
		// }
		
		foreach($no_voucher as $number){
			echo $number;
		}
	?>
</div>
