
<form class="form-inline" enctype="multipart/form-data" role="form" method="POST" action="
	<?php
		if (isset($page)){
			if ($page == 'view_cicilan'){
			echo $this->uri->baseUri.'cicilan/hasil_cari_view';
			}else{
			echo $this->uri->baseUri.'cicilan/hasil_cari';
			}
		}
	?>
	">
  <input name="katakunci" type="text" placeholder="Kata Kunci">
  <select name="berdasarkan" >
		  <option value="">-- Cari Berdasarkan --</option>
		  <option value="noreg">No. Registrasi Nasabah</option>
		  <option value="nama">Nama Nasabah</option>
		  <option value="id_pinjaman">ID Pinjaman</option>
		</select>
  <button type="submit" class="btn"><i class="icon-search"></i> Search</button>
</form>
<?php if (isset($hasil_cari)){?>

<form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="<?php echo $this->uri->baseUri;?>cicilan/hasil_cari">
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
    <label class="control-label" for="noreg">Tgl. Pinjaman</label>
    <div class="controls">
      <input name="tgl_pinjaman" type="text" id="noreg" value="<?php if (isset($data_pinjaman)){echo $data_pinjaman->tgl_pinjaman;}?>" readonly>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="noreg">Jumlah Pinjaman</label>
    <div class="controls">
      <input name="tgl_pinjaman" type="text" id="noreg" value="<?php if (isset($data_pinjaman)){echo $data_pinjaman->jumlah_pinjaman;}?>" readonly>
	  <span class="add-on" ><?php if (isset($data_pinjaman)){echo 'X'.$data_pinjaman->tenor;}?></span>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="noreg">Cicilan</label>
    <div class="controls">
      <input name="cicilan" type="text" id="noreg" value="<?php if (isset($data_pinjaman)){echo $data_pinjaman->cicilan;}?>" readonly>
    </div>
  </div>
</form>

<div class="box">
     <div class="box-header">
     <i class="icon-user icon-large"></i>
     <h5>Data Cicilan</h5>
                            
    </div>
	<div class="box-content box-table">
<table class="table table-hover ">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Tgl Bayar</th>
                  <th>Pokok</th>
                  <th>Bunga/Jasa</th>
                  <th>Denda</th>
                  <th>Total</th>
                  <th>Saldo Akhir</th>
				  
                </tr>
              </thead>
			  <!-- 
			  <tfoot>
				<tr>
				<td colspan="2">TOTAL: <?php if (isset($total_cari)){echo $total_cari;}?></td>
				<td></td>				
				<td colspan="5">Pagination eror/
				</td>			
				</tr>
			  </tfoot>
			  -->
              <tbody>
			  
			  <?php if ($hasil_cari){
			   $i=0;
				 foreach ($hasil_cari as $hasil_cari){
				 $i++;
				?>
                <tr>
                  <td><?php echo $i;?></td>
                  <td><?php echo $hasil_cari->tgl_cicilan;?></td>
                  <td><?php echo 'Rp. '.number_format($hasil_cari->cicilan_pokok,0,'','.');?></td>
                  <td><?php echo 'bunga/jasa';?></td>
				  <td><?php echo 'Rp. '.number_format($hasil_cari->denda,0,'','.');?></td>
				  <td><?php echo 'Rp. '.number_format($hasil_cari->jumlah_cicilan,0,'','.');?></td>
				  <td><?php echo 'Rp. '.number_format($hasil_cari->saldo,0,'','.');?></td>
                </tr>
				<?php
				 }
			   }?>
              </tbody>
            </table>
			</div>
			</div>
			<?php }?>