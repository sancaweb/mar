<div class="box">
     <div class="box-header">
     <i class="icon-user icon-large"></i>
     <h5>View Data</h5>
                            
    </div>
	<div class="box-content box-table">
	<table class="table table-hover table-bordered">
	<thead>
	
	<tr>
        <th rowspan="2">Bulan</th>
        <th colspan="3">Drop</th>
        <th rowspan="2">Target</th>
        <th colspan="3">Storting</th>
        <th rowspan="2">PPC</th>
        <th colspan="3">DENDA</th>
        <th rowspan="2">Jml Anggota</th>
				  
    </tr>
	<tr>
        <th>Total</th>
        <th>Jasa</th>
        <th>Droping</th>
        <th>Pokok</th>
        <th>Jasa</th>
        <th>Total</th>
        <th>total</th>
        <th>Dibayar</th>
        <th>Sisa</th>
				  
    </tr>
	</thead>
	<tbody>
	<?php if ($ambil_bulan){
	foreach ($ambil_bulan as $ambil_bulan){
	$total_drop=$this->target->total_drop($ambil_bulan->tanggalnya);
	$total_jasa=$this->target->total_jasa($ambil_bulan->tanggalnya);
	$dropping=$total_drop + $total_jasa;
	$total_target=$this->target->total_target($ambil_bulan->tanggalnya);	
	$total_storting_pokok=$this->target->total_storting_pokok($ambil_bulan->tanggalnya);
	$total_storting_jasa=$this->target->total_storting_jasa($ambil_bulan->tanggalnya);	
	$total_storting_total=$this->target->total_storting_total($ambil_bulan->tanggalnya);
	$total_denda=$this->target->total_denda($ambil_bulan->tanggalnya);
	$total_denda_dibayar=$this->target->total_denda_dibayar($ambil_bulan->tanggalnya);
	$sisa_denda=$total_denda - $total_denda_dibayar;
	$total_anggota=$this->target->total_anggota($ambil_bulan->tanggalnya);
	
	
	if($total_target !=0){
			$ppc=floor($total_storting_total / $total_target * 100);
		}else{
			$ppc='0';
		}
	?>	
	<tr>
        <td><?php echo $ambil_bulan->tanggalnya;?></td>
        <td><?php echo 'Rp. '.number_format($total_drop,0,'','.');?></td>
        <td><?php echo 'Rp. '.number_format($total_jasa,0,'','.');?></td>
        <td><?php echo 'Rp. '.number_format($dropping,0,'','.');?></td>
        <td><?php echo 'Rp. '.number_format($total_target,0,'','.');?></td>
        <td><?php echo 'Rp. '.number_format($total_storting_pokok,0,'','.');?></td>
        <td><?php echo 'Rp. '.number_format($total_storting_jasa,0,'','.');?></td>
        <td><?php echo 'Rp. '.number_format($total_storting_total,0,'','.');?></td>
        <td><?php echo $ppc.'%';?></td>
		<td><?php echo 'Rp. '.number_format($total_denda,0,'','.');?></td>
		<td><?php echo 'Rp. '.number_format($total_denda_dibayar,0,'','.');?></td>
		<td><?php echo 'Rp. '.number_format($sisa_denda,0,'','.');?></td>
		<td><?php echo $total_anggota.' Orang';?></td>
    </tr>
	
	<?php
	}
	}?>
	
	</tbody>
	</table>
	
	
	</div>
	</div>