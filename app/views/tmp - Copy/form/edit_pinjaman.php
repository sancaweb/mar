	<?php if (isset($pesan)){
		echo $pesan.'<br/>';
		
	}?>
<form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="<?php echo $this->uri->baseUri;?>pinjaman/edit_pinjaman">
  <div class="control-group">
    <label class="control-label" for="noreg">No. Registrasi</label>
    <div class="controls">
      <input name="noreg" type="hidden" id="noreg" value="<?php if (isset($data_nasabah)){echo $data_nasabah->noreg;}?>">
      <input name="noreg2" type="text" id="noreg" value="<?php if (isset($data_nasabah)){echo $data_nasabah->noreg;}?>" disabled>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="nama">Nama</label>
    <div class="controls">
      <input name="nama"  type="hidden" id="nama" value="<?php if (isset($data_nasabah)){echo $data_nasabah->nama;}?>">
      <input name="nama2"  type="text" id="nama" value="<?php if (isset($data_nasabah)){echo $data_nasabah->nama;}?>" disabled>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="id_pinjaman">ID Pinjaman</label>
    <div class="controls">
      <input name="id_pinjaman" type="hidden" id="id_pinjaman" value="<?php if (isset($data_pinjaman)){echo $data_pinjaman->id_pinjaman;}?>">
      <input name="id_pinjaman2" type="text" id="id_pinjaman" value="<?php if (isset($data_pinjaman)){echo $data_pinjaman->id_pinjaman;}?>" disabled>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="tgl_pinjaman">Tanggal Pinjaman</label>
    <div class="controls">
		<div  class="input-prepend date">			
			<input name="tgl_pinjaman" class="span2" type="text" id="datepicker" value="<?php if (isset($data_pinjaman)){echo $data_pinjaman->tgl_pinjaman;}?>">
			<span class="add-on" ><i class="icon-th" ></i></span>
		 </div>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="jumlah_pinjaman">Jumlah Pinjaman</label>
    <div class="controls">
      <input autocomplete="off" name="jumlah_pinjaman" type="text" onkeyup="hitung();" value="<?php if (isset($data_pinjaman)){echo $data_pinjaman->jumlah_pinjaman;}?>" id="jumlah_pinjaman" placeholder="Jumlah pinjaman">
	<span class="add-on"><input type="text" id="jumlah_pinjaman2" value="<?php if (isset($data_pinjaman)){echo 'Rp. '.number_format($data_pinjaman->jumlah_pinjaman,0,'','.');}?>" disabled></span>
	</div>
  </div>
  <div class="control-group">
    <label class="control-label" for="tenor">Lama (Tenor) Pinjaman</label>
    <div class="controls">
	<input name="tenor" type="text" id="tenor" onchange="hitung();" value="<?php $data_pinjaman->tenor;?>" autocomplete="off">
		<span class="add-on">Bulan</span>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="bunga">Bunga (%)</label>
    <div class="controls">
		<select name="bunga" id="bunga" onchange="hitung();">
		  <option value="1" <?php if ($data_pinjaman->bunga == '1'){echo 'selected';}?>>1</option>
		  <option value="2" <?php if ($data_pinjaman->bunga == '2'){echo 'selected';}?>>2</option>
		  <option value="3" <?php if ($data_pinjaman->bunga == '3'){echo 'selected';}?>>3</option>
		  <option value="4" <?php if ($data_pinjaman->bunga == '4'){echo 'selected';}?>>4</option>
		  <option value="5" <?php if ($data_pinjaman->bunga == '5'){echo 'selected';}?>>5</option>
		  <option value="6" <?php if ($data_pinjaman->bunga == '6'){echo 'selected';}?>>6</option>
		  <option value="7" <?php if ($data_pinjaman->bunga == '7'){echo 'selected';}?>>7</option>
		  <option value="8" <?php if ($data_pinjaman->bunga == '8'){echo 'selected';}?>>8</option>
		  <option value="9" <?php if ($data_pinjaman->bunga == '9'){echo 'selected';}?>>9</option>
		  <option value="10" <?php if ($data_pinjaman->bunga == '10'){echo 'selected';}?>>10</option>
		</select>
		<span class="add-on">%</span>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="bunga_jasa_total">Bunga/Jasa total</label>
    <div class="controls">
      <input name="bunga_total" type="hidden" value="<?php if (isset($data_pinjaman)){echo $data_pinjaman->bunga_total;}?>" id="bunga_jasa_total" >
      <input name="bunga_total2" type="text" value="<?php if (isset($data_pinjaman)){echo 'Rp. '.number_format($data_pinjaman->bunga_total,0,'','.');}?>" id="bunga_jasa_total2" disabled>
	  <span class="add-on">Rumus: Bunga/jasa perbulan X Tenor</span>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="bunga_jasa">Bunga/Jasa perbulan</label>
    <div class="controls">
      <input name="bunga_bulan" type="hidden" id="bunga_jasa" value="<?php if (isset($data_pinjaman)){echo $data_pinjaman->bunga_bulan;}?>">
	  <input name="bunga_bulan2" type="text" id="bunga_jasa2" value="<?php if (isset($data_pinjaman)){echo 'Rp. '.number_format($data_pinjaman->bunga_bulan,0,'','.');}?>" disabled>
	  <span class="add-on">Rumus: Bunga(%)X Pinjaman</span>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="bunga_jasa_total">Cicilan Pokok</label>
    <div class="controls">
      <input name="cicilan_pokok" type="hidden" id="cicilan_pokok" value="<?php if (isset($data_pinjaman)){echo $data_pinjaman->cicilan_pokok;}?>">
      <input name="cicilan_pokok2" type="text" id="cicilan_pokok2" value="<?php if (isset($data_pinjaman)){echo 'Rp. '.number_format($data_pinjaman->cicilan_pokok,0,'','.');}?>" disabled>
	  <span class="add-on">Rumus: Total Cicilan - bunga per bulan.</span>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="pembayaran">Total cicilan</label>
    <div class="controls">
      <input name="cicilan" type="hidden" id="jumlah_cicilan" value="<?php if (isset($data_pinjaman)){echo $data_pinjaman->cicilan;}?>">
      <input name="cicilan2" type="text" id="jumlah_cicilan2" value="<?php if (isset($data_pinjaman)){echo 'Rp. '.number_format($data_pinjaman->cicilan,0,'','.');}?>" disabled>
	  <span class="add-on">Rumus: Saldo / Tenor</span>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="saldo">Saldo</label>
    <div class="controls">
      <input name="saldo_awal" type="hidden" id="saldo" value="<?php if (isset($data_pinjaman)){echo $data_pinjaman->saldo_awal;}?>">
      <input name="saldo2_awal" type="text" id="saldo2" value="<?php if (isset($data_pinjaman)){echo 'Rp. '.number_format($data_pinjaman->saldo_awal,0,'','.');}?>" disabled>
	  <span class="add-on">Rumus: (Bunga/Jasa x Tenor) + pinjaman</span>
    </div>
  </div>
  <!--
  <div class="control-group">
    <label class="control-label" for="pembayaran">Total cicilan</label>
    <div class="controls">
      <input name="total_cicilan" type="text" id="total_cicilan" >
      <input name="total_cicilan2" type="text" id="total_cicilan2" disabled>
	  <span class="add-on">Rumus: Saldo / Tenor</span>
    </div>
  </div>
  -->
  <div class="control-group">
    <label class="control-label" for="pembayaran">Simpanan</label>
    <div class="controls">
      <input name="simpanan_awal" type="hidden" id="simpanan_awal" value="<?php if (isset($data_pinjaman)){echo $data_pinjaman->simpanan;}?>" >
      <input name="simpanan" type="hidden" id="simpanan" value="<?php if (isset($data_pinjaman)){echo $data_pinjaman->simpanan;}?>" >
      <input name="simpanan2" type="text" id="simpanan2" value="<?php if (isset($data_pinjaman)){echo 'Rp. '.number_format($data_pinjaman->simpanan,0,'','.');}?>" disabled>
	  <span class="add-on">Rumus: 5% dari pinjaman</span>
    </div>
  </div>
  <hr/>
  <div class="control-group">
    <label class="control-label" for="petugas">Petugas Input</label>
    <div class="controls">
      <input name="petugas" type="text" id="petugas" value="<?php if (isset($data_pinjaman)){echo $data_pinjaman->petugas;}?>" disabled>	  
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="tgl_input">Tanggal Input</label>
    <div class="controls">
      <input name="tgl_input" type="text" id="tgl_input" value="<?php if (isset($data_pinjaman)){echo $data_pinjaman->tgl_input;}?>" disabled>	  
    </div>
  </div>
  
  <div class="control-group">
    <div class="controls">
	<a class="btn btn-danger" href="<?php echo $this->uri->baseUri.'pinjaman';?>"><i class="icon-backward"></i> Cancel</a>
      <button type="submit" class="btn btn-primary">Simpan <i class="icon-envelope icon-large"></i></button>
      
    </div>
  </div>
</form>