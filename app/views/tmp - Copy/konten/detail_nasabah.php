		<?php if (isset($pesan)){
		echo $pesan;
	}?>
<form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="<?php echo $this->uri->baseUri;?>nasabah/input">
  <div class="control-group">
    <label class="control-label" for="noreg">No. Registrasi</label>
    <div class="controls">
      <input name="noreg" type="text" id="noreg" value="<?php if (isset($data_nasabah)){echo $data_nasabah->noreg;}?>" disabled>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="nama">Nama</label>
    <div class="controls">
      <input name="nama" type="text" id="nama" value="<?php if (isset($data_nasabah)){echo $data_nasabah->nama;}?>" disabled>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="noktp">No. KTP</label>
    <div class="controls">
      <input name="noktp" type="text" id="noktp" value="<?php if (isset($data_nasabah)){echo $data_nasabah->noktp;}?>" disabled>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="tlp">Telpon/HP</label>
    <div class="controls">
      <input name="tlp" type="text" id="tlp" value="<?php if (isset($data_nasabah)){echo $data_nasabah->tlp;}?>" disabled>
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="nama_suamiistri">Nama Suami / Istri</label>
    <div class="controls">
      <input name="suamiistri" type="text" id="nama_suamiistri" value="<?php if (isset($data_nasabah)){echo $data_nasabah->suamiistri;}?>" disabled>
    </div>
  </div>
  <div class="box">
        <div class="box-header">
        <i class="icon-home"></i>
        <h5>Alamat Nasabah</h5>
        </div>
		<div class="box-content">
	  <div class="control-group">
		<label class="control-label" for="dusun">Kampung/Dusun</label>
    <div class="controls">
      <input name="dusun" type="text" id="dusun" value="<?php if (isset($data_nasabah)){echo $data_nasabah->dusun;}?>" disabled>
    </div>
	</div>
	  <div class="control-group">
		<label class="control-label" for="rtrw">RT/RW</label>
    <div class="controls">
      <input name="rtrw" type="text" id="rtrw" value="<?php if (isset($data_nasabah)){echo $data_nasabah->rtrw;}?>" disabled>
    </div>
	</div>
	<div class="control-group">
		<label class="control-label" for="propinsi">Provinsi</label>
    <div class="controls">
	<input name="propinsi" type="text" id="propinsi" value="<?php if (isset($data_nasabah)){echo $data_nasabah->propinsi;}?>" disabled>
    </div>
	</div>
	<div class="control-group">
		<label class="control-label" for="kota">Kabupaten/ Kota</label>
    <div class="controls">
	<input name="kab" type="text" id="kota" value="<?php if (isset($data_nasabah)){echo $data_nasabah->kab;}?>" disabled>
    </div>
	</div>
	<div class="control-group">
		<label class="control-label" for="kecamatan">Kecamatan</label>
    <div class="controls">
	<input name="kec" type="text" id="kec" value="<?php if (isset($data_nasabah)){echo $data_nasabah->kec;}?>" disabled>
    </div>
	</div>
	
	
	  <div class="control-group">
		<label class="control-label" for="desa">Desa/Kelurahan</label>
    <div class="controls">
      <input name="desa" type="text" id="desa" value="<?php if (isset($data_nasabah)){echo $data_nasabah->desa;}?>" disabled>
    </div>
	</div>
	
    </div>
  </div>
  
  <div class="box">
        <div class="box-header">
        <i class="icon-user"></i>
        <h5>Keluarga tak Serumah</h5>
        </div>
		<div class="box-content">
	  <div class="control-group">
		<label class="control-label" for="nama">Nama</label>
    <div class="controls">
      <input name="nama_kel" type="text" id="nama" value="<?php if (isset($data_nasabah)){echo $data_nasabah->nama_kel;}?>" disabled>
    </div>
	</div>
  <div class="control-group">
    <label class="control-label" for="tlp_kel">Telpon/HP</label>
    <div class="controls">
      <input name="tlp_kel" type="text" id="tlp_kel" value="<?php if (isset($data_nasabah)){echo $data_nasabah->tlp_kel;}?>" disabled>
    </div>
  </div>
	  <div class="control-group">
		<label class="control-label" for="dusun">Kampung/Dusun</label>
    <div class="controls">
      <input name="dusun_kel" type="text" id="dusun" value="<?php if (isset($data_nasabah)){echo $data_nasabah->dusun_kel;}?>" disabled>
    </div>
	</div>
	  <div class="control-group">
		<label class="control-label" for="rtrw">RT/RW</label>
    <div class="controls">
      <input name="rtrw_kel" type="text" id="rtrw" value="<?php if (isset($data_nasabah)){echo $data_nasabah->rtrw_kel;}?>" disabled>
    </div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="propinsi2">Provinsi</label>
    <div class="controls">
	<input name="propinsi_kel" type="text" id="propinsi2" value="<?php if (isset($data_nasabah)){echo $data_nasabah->propinsi_kel;}?>" disabled>
    </div>
	</div>
	<div class="control-group">
		<label class="control-label" for="kota2">Kabupaten/ Kota</label>
    <div class="controls">
	<input name="kab_kel" type="text" id="kota2" value="<?php if (isset($data_nasabah)){echo $data_nasabah->kab_kel;}?>" disabled>
    </div>
	</div>
	<div class="control-group">
		<label class="control-label" for="kecamatan2">Kecamatan</label>
    <div class="controls">
	<input name="kec_kel" type="text" id="kec2" value="<?php if (isset($data_nasabah)){echo $data_nasabah->kec_kel;}?>" disabled>
    </div>
	</div>
	
	  <div class="control-group">
		<label class="control-label" for="desa">Desa/Kelurahan</label>
    <div class="controls">
      <input name="desa_kel" type="text" id="desa" value="<?php if (isset($data_nasabah)){echo $data_nasabah->desa_kel;}?>" disabled>
    </div>
	</div>
    </div>
  </div>
  
	<div class="box">
        <div class="box-header">
        <i class="icon-briefcase"></i>
        <h5>Data Usaha/ Pekerjaan Nasabah</h5>
        </div>
		<div class="box-content">
		<div class="control-group">
			<label class="control-label" for="pekerjaan">Usaha/ Pekerjaan</label>
			<div class="controls">
			  <input name="pekerjaan" class="span5" type="text" id="pekerjaan" value="<?php if (isset($data_nasabah)){echo $data_nasabah->pekerjaan;}?>" disabled>
			</div>
		  </div>
		<div class="control-group">
			<label class="control-label" for="nama_usaha">Nama Usaha</label>
			<div class="controls">
			  <input name="nama_pekerjaan" class="span5" type="text" id="nama_usaha" value="<?php if (isset($data_nasabah)){echo $data_nasabah->nama_pekerjaan;}?>" disabled>
			</div>
		  </div>
		<div class="control-group">
		<label class="control-label" for="alamat_usaha">Alamat Usaha</label>
		<div class="controls">
		  <input name="alamat_pekerjaan" class="span5" type="text" id="alamat_usaha" value="<?php if (isset($data_nasabah)){echo $data_nasabah->alamat_pekerjaan;}?>" disabled>
		</div>
		</div>
		<div class="control-group">
		<label class="control-label" for="telpon">Telpon</label>
    <div class="controls">
      <input name="tlp_pekerjaan" type="text" id="telpon" value="<?php if (isset($data_nasabah)){echo $data_nasabah->tlp_pekerjaan;}?>" disabled>
    </div>
	</div>
		
		
		</div>
	</div>
  
  <div class="control-group">
    <label class="control-label" for="status">status</label>
    <div class="controls">
	<input name="status" type="text" id="status" value="<?php if (isset($data_nasabah)){echo $data_nasabah->status;}?>" disabled>
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="petugas">Petugas Input</label>
    <div class="controls">
	<input name="petugas" type="text" id="petugas" value="<?php if (isset($data_nasabah)){echo $data_nasabah->petugas;}?>" disabled>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="tgl_input">Tanggal Input</label>
    <div class="controls">
	<input name="tgl_input" type="text" id="tgl_input" value="<?php if (isset($data_nasabah)){echo $data_nasabah->tgl_input;}?>" disabled>
    </div>
  </div>
  <div class="control-group">
    <div class="controls">
	<button type="button" class="btn btn-danger" onClick="javascript:window.close();"><i class="icon-backward"></i> Close</button>	
    </div>
  </div>
</form>