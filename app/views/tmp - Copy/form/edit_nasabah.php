		<?php if (isset($pesan)){
		echo $pesan;
	}?>
<form class="form-horizontal" data-toggle="validator" enctype="multipart/form-data" role="form" method="POST" action="<?php echo $this->uri->baseUri;?>nasabah/edit">
  <div class="control-group">
    <label class="control-label" for="noreg">No. Registrasi</label>
    <div class="controls">
      <input name="noreg" type="hidden" id="noreg" value="<?php if (isset($data_nasabah)){echo $data_nasabah->noreg;}?>">
      <input name="noreg2" type="text" id="noreg" value="<?php if (isset($data_nasabah)){echo $data_nasabah->noreg;}?>" readonly>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="nama">Nama</label>
    <div class="controls">
      <input name="nama" type="text" id="nama" value="<?php if (isset($data_nasabah)){echo $data_nasabah->nama;}?>"  minlength="2" required> 
	  
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="noktp">No. KTP</label>
    <div class="controls">
      <input name="noktp" type="text" id="noktp" value="<?php if (isset($data_nasabah)){echo $data_nasabah->noktp;}?>" minlength="2" data-validation-minlength-message="Isikan data yang benar" required>
	
	</div>
  </div>
  <div class="control-group">
		<label class="control-label" for="tlp">Telpon/HP</label>
    <div class="controls">
      <input name="tlp" type="text" id="tlp" minlength="5" data-validation-minlength-message="Isikan data yang benar, minimal 5 karakter" value="<?php if (isset($data_nasabah)){echo $data_nasabah->tlp;}?>" >
	  <span class="error" style="color: Red; display: none;">Hanya nomer yang di ijinkan.ex. 08xxxxxx</span>
    </div>
	</div>
  
  <div class="control-group">
    <label class="control-label" for="nama_suamiistri">Nama Suami / Istri</label>
    <div class="controls">
      <input name="suamiistri" type="text" id="nama_suamiistri" value="<?php if (isset($data_nasabah)){echo $data_nasabah->suamiistri;}?>" minlength="3" data-validation-minlength-message="Isikan data yang benar" required>
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
      <input name="dusun" type="text" id="dusun" value="<?php if (isset($data_nasabah)){echo $data_nasabah->dusun;}?>" minlength="2" data-validation-minlength-message="Isikan data yang benar" required>
    </div>
	</div>
	  <div class="control-group">
		<label class="control-label" for="rtrw">RT/RW</label>
    <div class="controls">
      <input name="rtrw" type="text" id="rtrw" value="<?php if (isset($data_nasabah)){echo $data_nasabah->rtrw;}?>" minlength="2" data-validation-minlength-message="Isikan data yang benar" required>
    </div>
	</div>
	<div class="control-group">
		<label class="control-label" for="propinsi_awal">Provinsi</label>
		
    <div class="controls">
	<input name="propinsi_awal" type="text" id="propinsi_awal" value="<?php if (isset($data_nasabah)){echo $data_nasabah->propinsi;}?>" readonly>
      <select name="propinsi" id="propinsi" >
		<option value="">--Pilih Provinsi--</option>
		<?php if ($propinsi){
		 foreach($propinsi as $dataprop){
			?>
			<option value="<?php echo $dataprop->id_prov;?>" ><?php echo $dataprop->nama_prov;?></option>
			<?php
		 }
		}?>
		</select>
    </div>
	</div>
	<div class="control-group">
		<label class="control-label" for="kota">Kabupaten/ Kota</label>
		
    <div class="controls">
	<input name="kab_awal" type="text" id="kab_awal" value="<?php if (isset($data_nasabah)){echo $data_nasabah->kab;}?>" readonly>
      <select name="kab" id="kota" >
		</select>
    </div>
	</div>
	<div class="control-group">
		<label class="control-label" for="kecamatan">Kecamatan</label>
		
    <div class="controls">
	<input name="kec_awal" type="text" id="kec_awal" value="<?php if (isset($data_nasabah)){echo $data_nasabah->kec;}?>" readonly>
      <select name="kec" id="kec" >
		</select>
    </div>
	</div>
	
	
	  <div class="control-group">
		<label class="control-label" for="desa">Desa/Kelurahan</label>
    <div class="controls">
      <input name="desa" type="text" id="desa" value="<?php if (isset($data_nasabah)){echo $data_nasabah->desa;}?>" minlength="2" data-validation-minlength-message="Isikan data yang benar" required>
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
      <input name="nama_kel" type="text" id="nama" value="<?php if (isset($data_nasabah)){echo $data_nasabah->nama_kel;}?>" minlength="2" data-validation-minlength-message="Isikan data yang benar" required>
    </div>
	</div>
  <div class="control-group">
		<label class="control-label" for="tlp_kel">Telpon/HP</label>
    <div class="controls">
      <input name="tlp_kel" type="text" id="tlp_kel" minlength="5" data-validation-minlength-message="Isikan data yang benar, minimal 5 karakter" value="<?php if (isset($data_nasabah)){echo $data_nasabah->tlp_kel;}?>">
	  <span class="error" style="color: Red; display: none;">Hanya nomer yang di ijinkan.ex. 08xxxxxx</span>
    </div>
	</div>
	  <div class="control-group">
		<label class="control-label" for="dusun">Kampung/Dusun</label>
    <div class="controls">
      <input name="dusun_kel" type="text" id="dusun" value="<?php if (isset($data_nasabah)){echo $data_nasabah->dusun_kel;}?>" minlength="2" data-validation-minlength-message="Isikan data yang benar" required> 
    </div>
	</div>
	  <div class="control-group">
		<label class="control-label" for="rtrw">RT/RW</label>
    <div class="controls">
      <input name="rtrw_kel" type="text" id="rtrw" value="<?php if (isset($data_nasabah)){echo $data_nasabah->rtrw_kel;}?>" minlength="2" data-validation-minlength-message="Isikan data yang benar" required>
    </div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="propinsi2">Provinsi</label>
		
    <div class="controls">
	<input name="propinsi_kel_awal" type="text" id="propinsi_kel_awal" value="<?php if (isset($data_nasabah)){echo $data_nasabah->propinsi_kel;}?>" readonly>
      <select name="propinsi_kel" id="propinsi2" >
		<option value="">--Pilih Provinsi--</option>
		<?php if ($propinsi){
		 foreach($propinsi as $dataprop2){
			?>
			<option value="<?php echo $dataprop2->id_prov;?>"><?php echo $dataprop2->nama_prov;?></option>
			<?php
		 }
		}?>
		</select>
    </div>
	</div>
	<div class="control-group">
		<label class="control-label" for="kota2">Kabupaten/ Kota</label>
		
    <div class="controls">
	<input name="kab_kel_awal" type="text" id="kab_kel_awal" value="<?php if (isset($data_nasabah)){echo $data_nasabah->kab_kel;}?>" readonly>
      <select name="kab_kel" id="kota2" >
		</select>
    </div>
	</div>
	<div class="control-group">
		<label class="control-label" for="kecamatan2">Kecamatan</label>
		
    <div class="controls">
	<input name="kec_kel_awal" type="text" id="kec_kel_awal" value="<?php if (isset($data_nasabah)){echo $data_nasabah->kec_kel;}?>" readonly>
      <select name="kec_kel" id="kec2" >
		</select>
    </div>
	</div>
	
	  <div class="control-group">
		<label class="control-label" for="desa">Desa/Kelurahan</label>
    <div class="controls">
      <input name="desa_kel" type="text" id="desa" value="<?php if (isset($data_nasabah)){echo $data_nasabah->desa_kel;}?>" minlength="2" data-validation-minlength-message="Isikan data yang benar" required>
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
			  <input name="pekerjaan" class="span5" type="text" id="pekerjaan" value="<?php if (isset($data_nasabah)){echo $data_nasabah->pekerjaan;}?>" minlength="2" data-validation-minlength-message="Isikan data yang benar" required>
			</div>
		  </div>
		<div class="control-group">
			<label class="control-label" for="nama_usaha">Nama Usaha</label>
			<div class="controls">
			  <input name="nama_pekerjaan" class="span5" type="text" id="nama_usaha" value="<?php if (isset($data_nasabah)){echo $data_nasabah->nama_pekerjaan;}?>" minlength="2" data-validation-minlength-message="Isikan data yang benar" required>
			</div>
		  </div>
		<div class="control-group">
		<label class="control-label" for="alamat_usaha">Alamat Usaha</label>
		<div class="controls">
		  <input name="alamat_pekerjaan" class="span5" type="text" id="alamat_usaha" value="<?php if (isset($data_nasabah)){echo $data_nasabah->alamat_pekerjaan;}?>" minlength="2" data-validation-minlength-message="Isikan data yang benar" required>
		</div>
		</div>
		<div class="control-group">
		<label class="control-label" for="telpon">Telpon</label>
    <div class="controls">
      <input name="tlp_pekerjaan" type="text" id="telpon" value="<?php if (isset($data_nasabah)){echo $data_nasabah->tlp_pekerjaan;}?>" minlength="5" data-validation-minlength-message="Isikan data yang benar, minimal 5 karakter">
	  <span class="error" style="color: Red; display: none;">Hanya nomer yang di ijinkan.ex. 08xxxxxx</span>
    </div>
	</div>
		
		</div>
	</div>
  
  <div class="control-group">
    <label class="control-label" for="status">status</label>
    <div class="controls">
		<select name="status">
		  <option value="AKTIF" <?php if($data_nasabah->rtrw == "AKTIF"){echo 'selected';}?>>Aktif</option>
		  <option value="NON AKTIF" <?php if($data_nasabah->rtrw == "NON AKTIF"){echo 'selected';}?>>Non Aktif</option>
		</select>
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
	<a type="button" class="btn btn-danger" href="<?php echo $this->uri->baseUri.'nasabah';?>" ><i class="icon-backward"></i> Back</a>
      <button type="submit" class="btn btn-primary">Simpan <i class="icon-folder-open"></i></button>
      
    </div>
  </div>
</form>