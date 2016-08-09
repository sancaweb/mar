<?php
	if (isset($pesan)){
		echo $pesan;
	}
?>
<?php if (isset($data_ambil_simpanan)){
		if ($data_ambil_simpanan->saldo <= '0'){
			echo '<div class="alert alert-block alert-danger">
            <p>
             Maaf tidak ada saldo untuk nasabah yang dimaksud.<br/>
			 <a type="button" class="btn btn-danger" href="'.$this->uri->baseUri.'simpanan"><i class="icon-backward"></i> Close</a>
            </p>
            </div>';
		
		}else{
		?>
		<form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="<?php echo $this->uri->baseUri;?>simpanan/pro_ambil_simpanan">
	<div class="control-group">
    <label class="control-label" for="noreg">No. Registrasi</label>
    <div class="controls">
      <input name="noreg" type="text" id="noreg" value="<?php if (isset($data_nasabah)){echo $data_nasabah->noreg;}?>" readonly>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="noreg">Nama Nasabah</label>
    <div class="controls">
      <input name="nama" type="text" id="noreg" value="<?php if (isset($data_nasabah)){echo $data_nasabah->nama;}?>" readonly>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="noreg">Alamat</label>
    <div class="controls">
      <textarea rows="3" name="cicilan" readonly><?php if (isset($data_nasabah)){
	  echo $data_nasabah->dusun.','.$data_nasabah->rtrw.','.$data_nasabah->desa.','.
	  $data_nasabah->kec.','.$data_nasabah->kab.','.$data_nasabah->propinsi
	  ;	  
	  }?></textarea>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="tgl_pinjaman">Tanggal Pengambilan</label>
    <div class="controls">
		<div  class="input-prepend date">			
			<input name="tgl" class="span2" type="text" id="datepicker" value="<?php echo date('Y-m-d');?>">
			<span class="add-on" ><i class="icon-th" ></i></span>
		 </div>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="saldo">Sisa Saldo</label>
    <div class="controls">
	<input name="sisa_saldo" type="hidden" id="sisa_saldo" value="<?php if (isset($saldo_data_simpanan)){
				echo $saldo_data_simpanan->saldo;}?>" readonly>
	<input name="saldo" type="hidden" id="sisa" value="<?php if (isset($saldo_data_simpanan)){
				echo $saldo_data_simpanan->saldo;}?>" readonly>
	<input name="saldo2" type="text" id="sisa2" value="<?php if (isset($saldo_data_simpanan)){
				echo 'Rp. '.number_format($saldo_data_simpanan->saldo,0,'','.');
				}?>" readonly>
	
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="simpanan_keluar">Jumlah Pengambilan</label>
    <div class="controls">
	<input name="simpanan_keluar" onkeyup="simpanan();"type="text" id="simpanan_keluar" >
	<input name="simpanan_keluar2" type="text" id="simpanan_keluar2" readonly>
	
    </div>
  </div>
  <div class="control-group">
    <div class="controls">
	<a type="button" class="btn btn-danger" href="<?php echo $this->uri->baseUri.'simpanan';?>"><i class="icon-backward"></i> Back</a>
	<button type="submit" class="btn btn-primary">Simpan <i class="icon-envelope icon-large"></i></button>
    </div>
  </div>
</form>
		
		
		
		<?php
		
		}
}?>



<div class="box">
     <div class="box-header">
     <i class="icon-user icon-large"></i>
     <h5>Data Simpanan Masuk</h5>
                            
    </div>
	<div class="box-content box-table">
<table class="table table-hover ">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Tgl Pinjaman</th>
                  <th>ID Pinjaman</th>
                  <th>Nama Nasabah</th>
                  <th>Jumlah Pinjaman</th>
                  <th>Jumlah Simpanan</th>
				  
                </tr>
              </thead>
			  
			  <tfoot>
				<tr>
				
				<td colspan="2">
				<div class="alert alert-block alert-info">
				<p>
				 Total Pinjaman : 
					<?php if (isset($total_pinjaman)){
					echo $total_pinjaman.' kali pinjaman';
					}?>
				</p>
				</div>
								
				</td>
				<td colspan="3"></td>
				<td colspan="1">
				<div class="alert alert-block alert-info">
				<p>
				<strong>Total Simpanan Masuk:</strong> <?php if (isset($total_simpanan)){
					echo 'Rp. '.number_format($total_simpanan->simpanan_masuk,0,'','.');
					}?>
				</p>
				</div>
				</td>
				</tr>
			  </tfoot>
              <tbody>
			  <?php if (isset($data_simpanan)){?>
			  <?php if ($data_simpanan){
			   $i=0;
				 foreach ($data_simpanan as $data_simpanan){
				 $i++;
				?>
                <tr>
                  <td><?php echo $i;?></td>
                  <td><?php echo $data_simpanan->tgl_pinjaman;?></td>
                  <td><?php echo $data_simpanan->id_pinjaman;?></td>
                  <td><?php echo $data_simpanan->nama;?></td>
                  <td><?php echo 'Rp. '.number_format($data_simpanan->jumlah_pinjaman,0,'','.');?></td>
                  <td><?php echo 'Rp. '.number_format($data_simpanan->simpanan,0,'','.');?></td>
                </tr>
				<?php
				 }}
			   }?>
              </tbody>
            </table>
			</div>
			</div>
<div class="box">
     <div class="box-header">
     <i class="icon-user icon-large"></i>
     <h5>Data Pengambilan Simpanan</h5>
                            
    </div>
	<div class="box-content box-table">
<table class="table table-hover ">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Tgl Ambil</th>
                  <th>Nama Nasabah</th>
                  <th>Jumlah Pengambilan</th>
				  
                </tr>
              </thead>
			  
			  <tfoot>
				<tr>
				
				<td colspan="2">
				<div class="alert alert-block alert-info">
				<p>
				 Total Pengambilan : 
					<?php if (isset($hitung_pengambilan)){
					echo $hitung_pengambilan.' kali pengambilan';
					}?>
				</p>
				</div>
								
				</td>
				<td colspan="1"></td>
				<td colspan="1">
				<div class="alert alert-block alert-info">
				<p>
				<strong>Total Pengambilan Simpanan:</strong> <?php if (isset($total_pengambilan)){
					echo 'Rp. '.number_format($total_pengambilan->simpanan_keluar,0,'','.');
					}?>
				</p>
				</div>
				</td>
				</tr>
			  </tfoot>
              <tbody>
			  <?php if (isset($data_pengambilan)){?>
			  <?php if ($data_pengambilan){
			   $i=0;
				 foreach ($data_pengambilan as $data_pengambilan){
				 $i++;
				?>
                <tr>
                  <td><?php echo $i;?></td>
                  <td><?php echo $data_pengambilan->tgl;?></td>
                  <td><?php echo $data_pengambilan->nama;?></td>
                  <td><?php echo 'Rp. '.number_format($data_pengambilan->simpanan,0,'','.');?></td>
                </tr>
				<?php
				 }}
			   }?>
              </tbody>
            </table>
			</div>
			</div>