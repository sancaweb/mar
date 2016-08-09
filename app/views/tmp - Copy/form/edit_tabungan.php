<?php
	if (isset($pesan)){
	echo $pesan;
	}
?>
		<form class="form-horizontal" data-toggle="validator" enctype="multipart/form-data" role="form" method="POST" action="<?php echo $this->uri->baseUri;?>tabungan/edit_tabungan">
	<input name="id" type="hidden" id="id" value="<?php echo $data_tabungan2->id;?>" >
	<div class="control-group">
    <label class="control-label" for="noreg">No. Registrasi</label>
    <div class="controls">
      <input name="noreg" type="text" id="noreg" value="<?php if (isset($data_nasabah)){echo $data_nasabah->noreg;}?>" readonly >
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="noreg">Nama Nasabah</label>
    <div class="controls">
      <input name="nama" type="text" id="noreg" value="<?php if (isset($data_nasabah)){echo $data_nasabah->nama;}?>" readonly >
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="alamat">Alamat</label>
    <div class="controls">
      <textarea rows="3" name="alamat" id="alamat" class="span5" readonly><?php if (isset($data_nasabah)){
	  echo $data_nasabah->dusun.','.$data_nasabah->rtrw.','.$data_nasabah->desa.','.
	  $data_nasabah->kec.','.$data_nasabah->kab.','.$data_nasabah->propinsi
	  ;	  
	  }?></textarea>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="tgl">Tanggal</label>
    <div class="controls">
		<div  class="input-prepend date">			
			<input name="tgl" class="span2" type="text" id="datepicker" value="<?php echo $data_tabungan2->tgl;?>">
			<span class="add-on" ><i class="icon-th" ></i></span>
		 </div>
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="tabungan">Nominal</label>
    <div class="controls">
      <input name="tabungan_awal" type="hidden" id="tabungan_awal" value="<?php echo $data_tabungan2->tabungan;?>" required>
      <input name="tabungan" type="text" id="tabungan" value="<?php echo $data_tabungan2->tabungan;?>" onkeyup="nominal();"  minlength="2" required>
      <input name="tabungan2" type="text" id="tabungan2" value="<?php echo 'Rp,. '.number_format($data_tabungan2->tabungan,0,'','.');?>" readonly>
	  <span class="error" style="color: Red; display: none;">Hanya nomer yang di ijinkan.ex. 08xxxxxx</span>
    </div>
  </div>
	<div class="control-group">
		<label class="control-label" for="ket">Keterangan</label>
    <div class="controls">
      <select name="ket" id="ket" required >
		<option value="" >Silahkan Pilih</option>
		<option value="MASUK" <?php if ($data_tabungan2->ket=='MASUK'){echo 'selected';}?>>Menabung</option>
		<option value="KELUAR" <?php if ($data_tabungan2->ket=='KELUAR'){echo 'selected';}?>>Ambil Tabungan</option>
		</select>
    </div>
	</div>
  <div class="control-group">
    <div class="controls">
	<a type="button" class="btn btn-danger" href="<?php echo $this->uri->baseUri.'tabungan/view_detail/'.base64_encode($data_nasabah->noreg);?>"><i class="icon-backward"></i> Cancel</a>
      <button type="submit" class="btn btn-primary">Simpan <i class="icon-envelope icon-large"></i></button>
      
    </div>
  </div>
</form>
	
	
<div class="box">
     <div class="box-header">
     <i class="icon-user icon-large"></i>
     <h5>Data Tabungan</h5>
                            
    </div>
	<div class="box-content box-table">
<table class="table table-hover table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Tgl (Years-Month-Day)</th>
                  <th>Masuk</th>
                  <th>Keluar</th>			  
                  <th>Petugas</th>			  
                </tr>
              </thead>
			  
			  <tfoot>
				<tr>
				
				<td colspan="2">
				<div class="alert alert-block alert-info">
				<p>
				 Total Transaksi : 
					<?php if (isset($total_tabungan)){
					echo $total_tabungan.' kali transaksi';
					}?>
				</p>
				</div>
								
				</td>
				<td colspan="1">
				<div class="alert alert-block alert-info">
				<p>
				<strong>Saldo Masuk:</strong> <?php if ($saldo_tabungan){
					echo 'Rp. '.number_format($saldo_tabungan->tabungan_masuk,0,'','.');
					}else{
					echo 'Rp. '.number_format(0,0,'','.');
					}?>
				</p>
				</div></td>
				<td colspan="1"><div class="alert alert-block alert-info">
				<p>
				<strong>Saldo Keluar:</strong> <?php if ($saldo_tabungan){
					echo 'Rp. '.number_format($saldo_tabungan->tabungan_keluar,0,'','.');
					}else{
					echo 'Rp. '.number_format(0,0,'','.');
					}?>
				</p>
				</div>
				</td>
				<td colspan="2">
				<div class="alert alert-block alert-info">
				<p>
				<strong>Total Saldo:</strong> <?php if ($saldo_tabungan){
					echo 'Rp. '.number_format($saldo_tabungan->saldo,0,'','.');
					}else{
					echo 'Rp. '.number_format(0,0,'','.');
					}?>
				</p>
				</div>
				</td>
				</tr>
			  </tfoot>
              <tbody>
			  <?php if (isset($data_tabungan)){?>
			  <?php if ($data_tabungan){
			   $i=0;
				 foreach ($data_tabungan as $data_tabungan){
				 $i++;
				?>
                <tr>
                  <td><?php echo $i;?></td>
                  <td><?php echo $data_tabungan->tgl;?></td>
                  <td>
				  <?php
					if ($data_tabungan->ket=='MASUK'){
						echo 'Rp. '.number_format($data_tabungan->tabungan,0,'','.');
					}else{
						echo '-';
					}
				  ?>				  
				  </td>
                  <td>
					<?php
					if ($data_tabungan->ket=='KELUAR'){
						echo 'Rp. '.number_format($data_tabungan->tabungan,0,'','.');
					}else{
						echo '-';
					}
				  ?>
				  </td>
                  <td><?php echo $data_tabungan->petugas;?></td>
                </tr>
				<?php
				 }}
			   }?>
              </tbody>
            </table>
			</div>
			</div>