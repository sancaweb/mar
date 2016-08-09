<form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="<?php echo $this->uri->baseUri;?>cicilan/data_simpanan">
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
    <label class="control-label" for="saldo">Sisa Saldo</label>
    <div class="controls">
	<input name="saldo" type="text" id="saldo" value="<?php if (isset($saldo_data_simpanan)){
				echo 'Rp. '.number_format($saldo_data_simpanan->saldo,0,'','.');
				}?>" readonly>
	
    </div>
  </div>
</form>

<div class="box">
     <div class="box-header">
     <i class="icon-user icon-large"></i>
     <h5>Data Simpanan Masuk</h5>
                            
    </div>
	<div class="box-content box-table">
<table class="table table-hover table-bordered">
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
<table class="table table-hover table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Tgl Ambil</th>
                  <th>Nama Nasabah</th>
                  <th>Jumlah Pengambilan</th>
                  <th>Petugas</th>
				  
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
				<td colspan="2"></td>
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
				<tr >
				<td colspan="6">
				<button type="button" class="btn btn-danger" onClick="javascript:window.close();"><i class="icon-backward"></i> Close</button>
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
                  <td><?php echo $data_pengambilan->petugas;?></td>
                </tr>
				<?php
				 }}
			   }?>
              </tbody>
            </table>
			</div>
			</div>