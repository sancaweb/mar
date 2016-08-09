	<?php if (isset($pesan)){
		echo $pesan.'<br/>';
		
	}?>
<form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="<?php echo $this->uri->baseUri;?>pinjaman/input_pinjaman">
  <div class="control-group">
    <label class="control-label" for="noreg">No. Registrasi</label>
    <div class="controls">
      <input name="noreg" type="text" id="noreg" value="<?php if (isset($data_pinjaman)){echo $data_pinjaman->noreg;}?>" disabled>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="nama">Nama</label>
    <div class="controls">
      <input name="nama"  type="text" id="nama" value="<?php if (isset($data_pinjaman)){echo $data_pinjaman->nama;}?>" disabled>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="id_pinjaman">ID Pinjaman</label>
    <div class="controls">
      <input name="id_pinjaman" type="text" id="id_pinjaman" value="<?php if (isset($data_pinjaman)){echo $data_pinjaman->id_pinjaman;}?>" disabled>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="tgl_pinjaman">Tanggal Pinjaman</label>
    <div class="controls">
		<div  class="input-prepend date">			
			<input name="tgl_pinjaman" class="span2" type="text" value="<?php if (isset($data_pinjaman)){echo $data_pinjaman->tgl_pinjaman;}?>" disabled>
			<span class="add-on" ><i class="icon-th" ></i></span>
		 </div>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="jumlah_pinjaman">Jumlah Pinjaman</label>
    <div class="controls">
      <input name="jumlah_pinjaman" type="text" value="<?php if (isset($data_pinjaman)){echo 'Rp. '.number_format($data_pinjaman->jumlah_pinjaman,0,'','.');}?>" disabled>	
	</div>
  </div>
  <div class="control-group">
    <label class="control-label" for="tenor">Lama (Tenor) Pinjaman</label>
    <div class="controls">
		<input name="tenor" type="text" value="<?php if (isset($data_pinjaman)){echo $data_pinjaman->tenor;}?>" disabled>
		<span class="add-on">Bulan</span>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="bunga">Bunga (%)</label>
    <div class="controls">
		<input name="bunga" type="text" value="<?php if (isset($data_pinjaman)){echo $data_pinjaman->bunga;}?>" readonly>
		<span class="add-on">Bulan</span>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="bunga_jasa_total">Bunga/Jasa total</label>
    <div class="controls">
      <input name="bunga_total" type="text" id="bunga_jasa_total" value="<?php if (isset($data_pinjaman)){echo 'Rp. '.number_format($data_pinjaman->bunga_total,0,'','.');}?>" disabled>
	  <span class="add-on">Rumus: Bunga/jasa perbulan X Tenor</span>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="bunga_jasa">Bunga/Jasa perbulan</label>
    <div class="controls">
      <input name="bunga_bulan" type="text" id="bunga_jasa" value="<?php if (isset($data_pinjaman)){echo 'Rp. '.number_format($data_pinjaman->bunga_bulan,0,'','.');}?>" disabled>
	  <span class="add-on">Rumus: (5% X Pinjaman) X Tenor</span>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="bunga_jasa_total">Cicilan Pokok</label>
    <div class="controls">
      <input name="cicilan_pokok" type="text" id="cicilan_pokok" value="<?php if (isset($data_pinjaman)){echo 'Rp. '.number_format($data_pinjaman->cicilan_pokok,0,'','.');}?>" disabled>
	  <span class="add-on">Rumus: Total Cicilan - bunga per bulan.</span>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="pembayaran">Total cicilan</label>
    <div class="controls">
      <input name="cicilan" type="text" id="jumlah_cicilan" value="<?php if (isset($data_pinjaman)){echo 'Rp. '.number_format($data_pinjaman->cicilan,0,'','.');}?>" disabled>
	  <span class="add-on">Rumus: Saldo / Tenor</span>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="saldo">Saldo</label>
    <div class="controls">
      <input name="saldo_awal" type="text" id="saldo_awal" value="<?php if (isset($data_pinjaman)){echo 'Rp. '.number_format($data_pinjaman->saldo_awal,0,'','.');}?>" disabled>
	  <span class="add-on">Rumus: (Bunga/Jasa x Tenor) + pinjaman</span>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="saldo">Sisa Saldo</label>
    <div class="controls">
      <input name="saldo" type="text" id="saldo" value="<?php if (isset($data_pinjaman)){echo 'Rp. '.number_format($data_pinjaman->saldo_akhir,0,'','.');}?>" disabled>
	  <span class="add-on">Rumus: (Bunga/Jasa x Tenor) + pinjaman</span>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="pembayaran">Simpanan</label>
    <div class="controls">
      <input name="simpanan" type="text" id="simpanan" value="<?php if (isset($data_pinjaman)){echo 'Rp. '.number_format($data_pinjaman->simpanan,0,'','.');}?>" disabled>
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
	<?php if (isset($page)){
		if ($page == 'edit_pinjaman' || $page=='input_pinjaman'){
		?>
		<a type="button" class="btn btn-danger" href="<?php echo $this->uri->baseUri.'pinjaman/input_cari';?>"><i class="icon-backward"></i> Close</a>
		<?php
		}else{
			?>
			<button type="button" class="btn btn-danger" onClick="javascript:window.close();"><i class="icon-backward"></i> Close</button>
			
			<?php
		}
	}?>
		
      
    </div>
  </div>
</form>