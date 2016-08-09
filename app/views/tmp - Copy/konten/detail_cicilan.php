<form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="<?php echo $this->uri->baseUri;?>cicilan/hasil_cari">
	<div class="row">
	<div class="span8">
	<div class="control-group">
    <label class="control-label" for="noreg">No. Registrasi</label>
    <div class="controls">
      <input name="noreg" type="text" id="noreg" value="<?php if (isset($data_pinjaman)){echo $data_pinjaman->noreg;}?>" readonly>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="noreg">Nama Nasabah</label>
    <div class="controls">
      <input name="nama" type="text" id="noreg" value="<?php if (isset($data_pinjaman)){echo $data_pinjaman->nama;}?>" readonly>
    </div>
  </div>
	<div class="control-group">
    <label class="control-label" for="id_pinjaman">ID Pinjaman</label>
    <div class="controls">
      <input name="id_pinjaman" type="text" id="id_pinjaman" value="<?php if (isset($data_pinjaman)){echo $data_pinjaman->id_pinjaman;}?>" readonly>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="noreg">Tgl. Pinjaman</label>
    <div class="controls">
      <input name="tgl_pinjaman" type="text" id="noreg" value="<?php if (isset($data_pinjaman)){echo $data_pinjaman->tgl_pinjaman;}?>" readonly>
    </div>
  </div>
  </div>
  <div class="span4">
  <div class="control-group">
    <label class="control-label" for="noreg">Jumlah Pinjaman</label>
    <div class="controls">
      <input name="tgl_pinjaman" type="text" id="noreg" value="<?php if (isset($data_pinjaman)){echo 'Rp. '.number_format($data_pinjaman->jumlah_pinjaman,0,'','.');}?>" readonly>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="noreg">Tenor</label>
    <div class="controls">
      <input name="tgl_pinjaman" type="text" id="noreg" value="<?php if (isset($data_pinjaman)){echo $data_pinjaman->tenor;}?>" readonly>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="noreg">Cicilan</label>
    <div class="controls">
      <input name="cicilan" type="text" id="noreg" value="<?php if (isset($data_pinjaman)){echo 'Rp. '.number_format($data_pinjaman->cicilan);}?>" readonly>
    </div>
  </div>
  </div>
  </div>
</form>

<div class="box">
     <div class="box-header">
     <i class="icon-user icon-large"></i>
     <h5>Data Cicilan</h5>
                            
    </div>
	<div class="box-content box-table">
<table class="table table-hover table-bordered">
              <thead>
			  <tr>
			  <td colspan="2"></td>
			  <td colspan="1"><?php //echo 'Rp. '.number_format($total_pokok_awal,0,'','.');?></td>
			  <td colspan="1"><?php //echo 'Rp. '.number_format($total_jasa_awal,0,'','.');?></td>
			  <td colspan="1"><strong>Total Denda: </strong><?php echo 'Rp. '.number_format($total_denda_awal,0,'','.');?></td>
			  <td colspan="2"></td>
			  <td colspan="1"><strong>Total Saldo: </strong><?php if (isset($data_pinjaman)){echo 'Rp. '.number_format($data_pinjaman->saldo_awal,0,'','.');}?></td>
			  <td colspan="1"></td>
			  </tr>
                <tr>
                  <th>Cicilan Ke</th>
                  <th>Tgl Bayar</th>
                  <th>Pokok</th>
                  <th>Bunga/Jasa</th>
                  <th>Denda</th>
                  <th>Total</th>
                  <th>Pembayaran</th>
                  <th>Saldo Akhir</th>
                  <th>Petugas</th>
				  
                </tr>
              </thead>
			  
			  <tfoot>
			  <tr>
			  <td colspan="2"><strong>Jumlah :</strong></td>
			  <td colspan="1"><strong><?php echo 'Rp. '.number_format($hitung_pokok_cicilan,0,'','.');?></strong></td>
			  <td colspan="1"><strong><?php echo 'Rp. '.number_format($hitung_bunga_cicilan,0,'','.');?></strong></td>
			  <td colspan="1"><strong>Denda Terbayar: <?php echo 'Rp. '.number_format($hitung_denda_bayar,0,'','.');?></strong></td>
			  <td colspan="1"><strong><?php echo 'Rp. '.number_format($hitung_jumlah_cicilan,0,'','.');?></strong></td>
			  <td colspan="1"><strong><?php echo 'Rp. '.number_format($hitung_pembayaran,0,'','.');?></strong></td>
			  <td colspan="2"></td>
			  </tr>
			  <tr>
			  <td colspan="2"></td>
			  <td colspan="1"><strong><?php //echo 'Rp. '.number_format($total_pokok_akhir,0,'','.');?></strong></td>
			  <td colspan="1"><strong><?php //echo 'Rp. '.number_format($total_jasa_akhir,0,'','.');?></strong></td>
			  <td colspan="1"><strong>Sisa Denda: <?php echo 'Rp. '.number_format($total_denda_akhir,0,'','.');?></strong></td>
			  <td colspan="1"><strong><?php //echo 'Rp. '.number_format($hitung_sisa_hutang,0,'','.');?></strong></td>
			  <td colspan="3"></td>
			  </tr>
				<tr>
				<td colspan="9">TOTAL BAYAR : <?php if (isset($total_history)){echo $total_history;}?>&nbsp;kali Bayar dari <?php echo $data_pinjaman->tenor;?>	kali cicilan.		
				</td>		
				</tr>
				<tr >
				<td colspan="9">
				<button type="button" class="btn btn-danger" onClick="javascript:window.close();"><i class="icon-backward"></i> Close</button>
				<a href="<?php echo $this->uri->baseUri.'cicilan/prin_history/'.base64_encode($data_pinjaman->id_pinjaman);?>" class="btn btn-primary" ><i class="icon-print"></i> Print Preview</a>
				</td>
				</tr>
			  </tfoot>
              <tbody>
			  <?php if (isset($hasil_cari)){?>
			  <?php if ($hasil_cari){
			   $i=0;
			   //$hitung_tenor=$hitung_tenor;			   
				 foreach ($hasil_cari as $hasil_cari){
				 $i++;
				 //$dt=$this->cicilan->view_history2($hasil_cari->id_cicilan);
				 
				?>
                <tr>
                  <td><?php echo $i;?></td>
                  <td><?php echo $hasil_cari->tgl_cicilan;?></td>
                  <td><?php echo 'Rp. '.number_format($hasil_cari->cicilan_pokok,0,'','.');?></td>
                  <td><?php echo 'Rp. '.number_format($hasil_cari->bunga_bulan,0,'','.');?></td>
				  <td><?php echo 'Rp. '.number_format($hasil_cari->denda,0,'','.');
					 if ($hasil_cari->denda > '0'){
						if($hasil_cari->byr_denda=="YES"){
					  echo ' (<font color="green"><strong>Sudah Dibayar</strong></font>)';				  
					  }else{
					  echo ' (<font color="red"><strong>Belum Dibayar</strong></font>)';
					  }
					}else{
						
					
					} 
					
				  ?></td>
				  <td><?php echo 'Rp. '.number_format($hasil_cari->jumlah_cicilan,0,'','.');?></td>
				  <td><?php echo 'Rp. '.number_format($hasil_cari->pembayaran,0,'','.');?></td>
				  
				  <td>
				  <?php
					echo 'Rp. '.number_format($hasil_cari->saldo,0,'','.');				  
				  ?>
				  </td>
				  <td><?php echo $hasil_cari->petugas;?></td>
                </tr>
				
				<?php
				  }}
			   } ?>
              </tbody>
            </table>
			</div>
			</div>