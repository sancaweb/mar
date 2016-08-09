<?php
	if (isset($pesan)){
	echo $pesan;
	}
?>
			<form class="form-horizontal" data-toggle="validator" enctype="multipart/form-data" role="form" method="POST" action="<?php echo $this->uri->baseUri;?>tabungan/ambil_tabungan">
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
    <label class="control-label" for="tabungan">Sisa Tabungan</label>
    <div class="controls">
      <input name="sisa" type="text" id="tabungan" value="<?php if ($saldo_tabungan){echo 'Rp. '.number_format($saldo_tabungan->saldo,0,'','.');}?>" readonly>
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
				  <?php 
				  if($this->session->getValue('code_grup')=='s_adm' )
					{
				  ?>
                  <th>Action</th>
				  <?php }else{
					echo '<th></th>';
				  }?>
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
				<tr >
				<td colspan="6">
				<a type="button" class="btn btn-danger" href="<?php echo $this->uri->baseUri.'tabungan';?>"><i class="icon-backward"></i> Close</a>
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
                  <td>
				  <?php 
				  if($this->session->getValue('code_grup')=='s_adm' )
					{
				  ?>
					<a class="btn btn-primary" href="<?php echo $this->uri->baseUri.'tabungan/edit_form/'.base64_encode($data_tabungan->noreg).'/'.base64_encode($data_tabungan->id);?>">
                    <i class="icon-pencil"></i> Edit 
                    </a>
					
					<a class="btn btn-primary" href="<?php echo $this->uri->baseUri.'tabungan/delete/'.base64_encode($data_tabungan->noreg).'/'.base64_encode($data_tabungan->id);?>">
                    <i class="icon-remove"></i> Hapus 
                    </a>
					<?php }?>
					</td>
                </tr>
				<?php
				 }}
			   }?>
              </tbody>
            </table>
			</div>
			</div>