	<?php if (isset($pesan)){
		echo $pesan.'<br/>';
		
	}?>
<form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="<?php echo $this->uri->baseUri;?>pinjaman/input_pinjaman">
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
      <input name="id_pinjaman" type="hidden" id="id_pinjaman" value="<?php if (isset($id_pinjaman)){echo $id_pinjaman;}?>">
      <input name="id_pinjaman2" type="text" id="id_pinjaman" value="<?php if (isset($id_pinjaman)){echo $id_pinjaman;}?>" disabled>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="tgl_pinjaman">Tanggal Pinjaman</label>
    <div class="controls">
		<div  class="input-prepend date">			
			<input name="tgl_pinjaman" class="span2" type="text" id="datepicker" value="<?php echo date('Y-m-d');?>">
			<span class="add-on" ><i class="icon-th" ></i></span>
		 </div>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="jumlah_pinjaman">Jumlah Pinjaman</label>
    <div class="controls">
      <input name="jumlah_pinjaman" type="text" onkeyup="hitung();" value="" id="jumlah_pinjaman" placeholder="Jumlah pinjaman" autocomplete="off">
	<span class="add-on"><input type="text" id="jumlah_pinjaman2" disabled></span>
	</div>
  </div>
  <div class="control-group">
    <label class="control-label" for="tenor">Lama (Tenor) Pinjaman</label>
	
    <div class="controls">
	<input name="tenor" type="text" id="tenor" onkeyup="hitung();" placeholder="Tenor" autocomplete="off">
		<span class="add-on">Bulan</span>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="bunga">Bunga (%)</label>
    <div class="controls">
		<select name="bunga" id="bunga" onchange="hitung();">
		  <option value="1">1</option>
		  <option value="2">2</option>
		  <option value="3">3</option>
		  <option value="4">4</option>
		  <option value="5" selected>5</option>
		  <option value="6">6</option>
		  <option value="7">7</option>
		  <option value="8">8</option>
		  <option value="9">9</option>
		  <option value="10">10</option>
		</select>
		<span class="add-on">%</span>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="bunga_jasa_total">Bunga/Jasa total</label>
    <div class="controls">
      <input name="bunga_total" type="hidden" id="bunga_jasa_total" >
      <input name="bunga_total2" type="text" id="bunga_jasa_total2" disabled>
	  <span class="add-on">Rumus: Bunga/jasa perbulan X Tenor</span>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="bunga_jasa">Bunga/Jasa perbulan</label>
    <div class="controls">
      <input name="bunga_bulan" type="hidden" id="bunga_jasa" >
	  <input name="bunga_bulan2" type="text" id="bunga_jasa2" disabled>
	  <span class="add-on">Rumus: Bunga(%) X Pinjaman</span>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="bunga_jasa_total">Cicilan Pokok</label>
    <div class="controls">
      <input name="cicilan_pokok" type="hidden" id="cicilan_pokok" >
      <input name="cicilan_pokok2" type="text" id="cicilan_pokok2" disabled>
	  <span class="add-on">Rumus: Total Cicilan - bunga per bulan.</span>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="pembayaran">Total cicilan</label>
    <div class="controls">
      <input name="cicilan" type="hidden" id="jumlah_cicilan" >
      <input name="cicilan2" type="text" id="jumlah_cicilan2" disabled>
	  <span class="add-on">Rumus: Saldo / Tenor</span>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="saldo">Saldo</label>
    <div class="controls">
      <input name="saldo_awal" type="hidden" id="saldo" >
      <input name="saldo2_awal" type="text" id="saldo2" disabled>
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
      <input name="simpanan" type="hidden" id="simpanan" >
      <input name="simpanan2" type="text" id="simpanan2" disabled>
	  <span class="add-on">Rumus: 5% dari pinjaman</span>
    </div>
  </div>
  
  <div class="control-group">
    <div class="controls">
	<button type="button" class="btn btn-danger" onClick="history.go(-1);return true;"><i class="icon-backward"></i> Cancel</button>
      <button type="submit" class="btn btn-primary">Simpan <i class="icon-envelope icon-large"></i></button>
      
    </div>
  </div>
</form>