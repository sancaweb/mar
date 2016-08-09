		<?php if (isset($pesan)){
		echo $pesan;
	}?>
<form class="form-inline" enctype="multipart/form-data" role="form" method="POST" action="<?php echo $this->uri->baseUri;?>nasabah/cari_nasabah">
  <input name="katakunci" type="text" placeholder="Kata Kunci">
  <select name="berdasarkan" >
		  <option value="">-- Cari Berdasarkan --</option>
		  <option value="noreg">No. Registrasi Nasabah</option>
		  <option value="nama">Nama Nasabah</option>
		  <option value="noktp">Nomor KTP</option>
		</select>
  <button type="submit" class="btn"><i class="icon-search"></i> Cari Nasabah</button>
</form>